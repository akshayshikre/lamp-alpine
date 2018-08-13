#!/bin/sh

set -e # terminate on errors
set -x
set -xo pipefail

echo Testing script for master branch
sleep 30
docker images
docker ps -a
docker-compose logs
docker-compose port lamp-alpine 80
docker-compose exec lamp-alpine curl --retry 10 --retry-delay 5 -v http://127.0.0.1:80