#!/usr/bin/env bash

#== Bash helpers ==

function trace {
  echo " "
  echo "--> $1"
  echo " "
}

function ensure {
  echo " "
  echo "<-- $1"
  echo " "
}

#== Provision script ==

trace "Provision-script user: `whoami`"

trace "Restart web-stack"

trace "Restart PHP5"
service php7.0-fpm restart
ensure "Done!"

trace "Restart NGINX"
fuser -k 80/tcp
service nginx restart
ensure "Done!"

trace "Restart MYSQL"
service mysql restart
ensure "Done!"