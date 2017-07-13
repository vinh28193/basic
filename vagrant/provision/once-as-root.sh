#!/usr/bin/env bash

#== Import script args ==

timezone=$(echo "$1")
swapsize=$(echo "$2")
app_domain=$(echo "$3")
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

trace "Allocate swap for MySQL 5.6"
fallocate -l ${swapsize}M /swapfile
chmod 600 /swapfile
mkswap /swapfile
swapon /swapfile
echo '/swapfile none swap defaults 0 0' >> /etc/fstab
ensure "Done!"

trace "Configure locales"
update-locale LC_ALL="C"
dpkg-reconfigure locales
ensure "Done!"

trace "Configure timezone"
echo ${timezone} | tee /etc/timezone
dpkg-reconfigure --frontend noninteractive tzdata
ensure "Done!"

trace "Prepare root password for MySQL"
echo "mysql-server-5.6 mysql-server/root_password password root" | debconf-set-selections
echo "mysql-server-5.6 mysql-server/root_password_again password root" | debconf-set-selections
ensure "Done!"

trace "Additional repositories"
apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
echo 'deb http://dl.hhvm.com/ubuntu trusty main' >> /etc/apt/sources.list.d/hhvm.list
add-apt-repository -y ppa:ondrej/php
ensure "Done!"

trace "Update OS software"
apt-get update
apt-get upgrade -y
ensure "Done!"

trace "Install Zip"
apt-get install -y zip
ensure "Done!"

trace "Install Git"
apt-get install -y git
ensure "Done!"

trace "Install HHVM"
apt-get install -y hhvm
ensure "Done!"

trace "Install mysql-server-5.6"
apt-get install -y mysql-server-5.6
ensure "Done!"

trace "Install Php5"
apt-get install -y php7.0
apt-get install -y php7.0-cli
apt-get install -y php7.0-common
apt-get install -y php7.0-curl
apt-get install -y php7.0-fpm
apt-get install -y php7.0-gd
apt-get install -y php7.0-intl
apt-get install -y php7.0-json
apt-get install -y php7.0-mcrypt
apt-get install -y php7.0-mysql
apt-get install -y php7.0-opcache
apt-get install -y php7.0-readline
apt-get install -y php7.0-mbstring
apt-get install -y php7.0-dom
apt-get install -y php-xdebug
ensure "Done!"

trace "Install NGINX"
apt-get install -y nginx
ensure "Done!"

trace "Configure MySQL"
sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/my.cnf
ensure "Done!"

trace "Configure PHP-FPM"
echo 'xdebug.remote_enable=1
      xdebug.remote_handler=dbgp
      xdebug.remote_mode=req
      xdebug.remote_host=localhost
      xdebug.remote_port=9000
      xdebug.var_display_max_depth = -1
      xdebug.var_display_max_children = -1
      xdebug.var_display_max_data = -1
      xdebug.idekey = "PHPSTORM"' | tee /etc/php/7.0/mods-available/xdebug.ini
phpenmod mcrypt
ensure "Done!"

trace "disable xdebug temporarily to avoid composer performance issues"
phpdismod xdebug
ensure "Done!"

trace "Configure NGINX"
touch /etc/nginx/sites-enabled/app.conf
cat >> /etc/nginx/sites-enabled/app.conf <<'EOF'
server {
   charset utf-8;
   client_max_body_size 128M;

   listen 80; ## listen for ipv4
   #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

   server_name _domain;
   root        /var/www/app/web;
   index       index.php;

   access_log  /var/www/app/vagrant/nginx/logs/access.log;
   error_log   /var/www/app/vagrant/nginx/logs/error.log;

     location / {
       # Redirect everything that isn't a real file to index.php
       try_files $uri $uri/ /index.php$is_args$args;
   }

   # uncomment to avoid processing of calls to non-existing static files by Yii
   #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
   #    try_files $uri =404;
   #}
   #error_page 404 /404.html;

   location ~ \.php$ {
       include fastcgi_params;
       fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
       #fastcgi_pass   127.0.0.1:9000;
       fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
       try_files $uri =404;
   }

   location ~ /\.(ht|svn|git) {
       deny all;
   }
}
EOF
sed -i "s/_domain/$app_domain/" /etc/nginx/sites-enabled/app.conf
ensure "Done!"

trace "Initailize databases for MySQL"
echo "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root'" | mysql -uroot -proot
echo "FLUSH PRIVILEGES" | mysql -uroot -proot
echo "CREATE DATABASE basic" | mysql -uroot -proot
echo "CREATE DATABASE basic_test" | mysql -uroot -proot
ensure "Done!"

trace "Install composer"
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ensure "Done!"

trace "enable xdebug again"
phpenmod xdebug
ensure "Done!"