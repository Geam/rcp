#!/bin/bash

ls | grep rpi_install.sh 2>&1 > /dev/null
if [[ "$?" == 0 ]]; then
    cd ..
fi

if [[ -z "$1" ]]
then

    echo "To do the installation, you will need to script two time with differents arguments"
    echo "  - first time: ./rpi_install.sh first"
    echo "  - second time: ./rpi_install.sh continue"

elif [[ "$1" == "first" ]]
then

    # install nginx
    if [[ -z "`ls /etc/nginx 2> /dev/null`" ]]; then
        sudo apt-get install nginx
        sudo service nginx start
        sudo cp install/ressources/database /etc/nginx/sites-available
        sudo ln -s /etc/nginx/sites-available /etc/nginx/sites-enabled
    fi

    # install mysql
    mysql --version 2>&1 > /dev/null
    if [[ "$?" == 127 ]]; then
        sudo apt-get install mysql-server php5-mysql
        sudo mysql_install_db
        sudo mysql_secure_installation
    fi

    php --version 2>&1 > /dev/null
    if [[ "$?" == 127 ]]; then
        sudo apt-get install php5-fpm
        sudo sed -i.back "s/cgi\.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php5/fpm/php.ini
        sudo sed -i.back "s:listen = .*:listen = /var/run/php5-fpm.sock:" /etc/php/fpm/pool.d/www.conf
        sudo service php5-fpm restart
    fi

    # get composer
    if [[ -n `composer --version 2> /dev/null` ]];
    then
        composer install
    else
        if [[ ! -e 'composer.phar' ]]; then
            curl -s http://getcomposer.org/installer | php
        fi
        php composer.phar install
    fi

    # set environment
    file='bootstrap/start.php'
    mv $file $file.back
    cat $file.back | sed "s/your-production-machine-name/`hostname`/" > $file

    mkdir 'app/config/production'
    cp 'app/config/app.php' 'app/config/database.php' 'app/config/mail.php' 'app/config/production'

    echo "The config file has been initialize, you need to set them. Thoses files are :"
    echo "  app/config/production/app.php"
    echo "  app/config/production/database.php"
    echo "  app/config/production/mail.php"
    echo "One you are done, re-run this script with continue"
    echo "./install continue"

elif [[ "$1" == "continue" ]]
then

    # create db
    php artisan migrate

    # generate key
    php artisan key:generate --env=production

    # change right
    chmod -R 775 'app/storage'

fi
