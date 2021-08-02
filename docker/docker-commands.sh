#!/bin/bash
#title              :docker-commands.sh
#description        :This script contains quick commands to perform docker operations, build images, start, stop, connect to containers.
#version            :0.1
#usage              :bash docker-commands.sh [-u]
#==============================================================================


start-containers() {
  echo "Starting $1";
  EXTERNAL_IP="$(ipconfig getifaddr en0)" docker compose -f docker-compose.yml up -d
}

stop-containers() {
  echo "Stopping $1";
  EXTERNAL_IP="$(ipconfig getifaddr en0)" docker compose -f docker-compose.yml stop
}

restart-containers() {
  echo "Restarting $1";
  EXTERNAL_IP="$(ipconfig getifaddr en0)" docker compose -f docker-compose.yml restart
}

start-php72() {
  start-containers "PHP72"
}

connect-container() {
  echo "Connecting to $1 container";
  docker exec -it $1 bash
}

connect-php72() {
  connect-container "php723"
}

status() {
  docker ps
}

build-compose() {
  EXTERNAL_IP="$(ipconfig getifaddr en0)" docker compose -f docker-compose.yml build
}

build() {
  echo "Building docker images";
  build-compose "PHP72"
  echo "Docker images built successfully";
}

usage () {
    echo "usage: [[-uphp-72 ] | [-cphp-72]]"
    echo "  -uphp-72      | --up-php-72                 Start PHP 7.2"
    echo "  -cphp-72      | --con-php-72                 Connect PHP 7.2"
    echo "  -s            | --status                  Status"
    echo "  -h            | --help                    Displays this help message"
}

while [ "$1" != "" ]; do
    case $1 in
        -uphp-72 | --up-php-72 )               start-php72
                                              exit
                                              ;;
        -cphp-72 | --con-php-72 )               connect-php72
                                                      exit
                                                      ;;
        -s       | --status )                status
                                              exit
                                              ;;
        -h | --help )                       usage
                                              exit
                                              ;;
        * )                                 usage
                                              exit 1
    esac
    shift
done

usage
