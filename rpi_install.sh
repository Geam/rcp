#!/bin/bash

if [[ -z "$1" ]]
then

    echo "To do the installation, you will need to script two time with differents arguments"
    echo "  - first time: ./rpi_install.sh first"
    echo "  - second time: ./rpi_install.sh continue"

elif [[ "$1" == "first" ]]
then

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
