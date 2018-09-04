#!/bin/sh

set -e # terminate on errors
set -xo pipefail

PID_FILE=/run/mysqld/mysqld.pid

DATA_DIR="$(mysqld --verbose --help --log-bin-index=`mktemp -u` 2>/dev/null | awk '$1 == "datadir" { print $2; exit }')"
PID_FILE=/run/mysqld/mysqld.pid

if [ true ]; then


  mkdir -p "$DATA_DIR"
  chown -R mysql:mysql "$DATA_DIR"

  echo 'Initializing database'
  mysql_install_db --user=mysql --datadir="$DATA_DIR" --rpm
  echo 'Database initialized'

  mysqld_safe --pid-file=$PID_FILE --skip-networking --nowatch

  mysql_options='--protocol=socket -uroot'

  for i in `seq 30 -1 0`; do
    if mysql $mysql_options -e 'SELECT 1' &> /dev/null; then
      break
    fi
    echo 'MySQL init process in progress...'
    sleep 1
  done
  if [ "$i" = 0 ]; then
    echo >&2 'MySQL init process failed.'
    exit 1
  fi

  if [ -z "$MYSQL_INITDB_SKIP_TZINFO" ]; then
    apk add --update-cache tzdata
    # sed is for https://bugs.mysql.com/bug.php?id=20545
    mysql_tzinfo_to_sql /usr/share/zoneinfo | sed 's/Local time zone must be set--see zic manual page/FCTY/' | mysql $mysql_options mysql
  fi

  mysql $mysql_options <<-EOSQL
    -- What's done in this file shouldn't be replicated
    --  or products like mysql-fabric won't work
    SET @@SESSION.SQL_LOG_BIN=0;

    DELETE FROM mysql.user ;
    CREATE USER 'root'@'%' IDENTIFIED BY '${MYSQL_ROOT_PASSWORD}' ;
    GRANT ALL ON *.* TO 'root'@'%' WITH GRANT OPTION ;
    DROP DATABASE IF EXISTS test ;
    FLUSH PRIVILEGES ;
EOSQL

  

  if [ true ]; then
    mysql $mysql_options -e "CREATE DATABASE IF NOT EXISTS demosite ;"
    mysql_options="$mysql_options demosite"
  fi     

  

  echo
  for f in /docker-entrypoint-initdb.d/*; do
    case "$f" in
      *.sh)     echo "$0: running $f"; . "$f" ;;
      *.sql)    echo "$0: running $f"; mysql $mysql_options < "$f"; echo ;;
      *.sql.gz) echo "$0: running $f"; gunzip -c "$f" | mysql $mysql_options; echo ;;
      *)        echo "$0: ignoring $f" ;;
    esac
    echo
  done

  pid="`cat $PID_FILE`"
  if ! kill -s TERM "$pid"; then
    echo >&2 'MySQL init process failed.'
    exit 1
  fi

  # make sure mysql completely ended
  sleep 2

  echo
  echo 'MySQL init process done. Ready for start up.'
  echo
fi

httpd

exec /usr/bin/mysqld --user=root

exit 0

# echo "CREATE DATABASE IF NOT EXISTS demosite; use demosite; source /www/demosite.sql ;" | mysql -u root

# echo "db imported"
