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

    # if apache is install (why would you install it when you've got nginx..
    if [[ -f "/etc/apache2" ]] && [[ ! -f "/var/www/apache_default" ]]; then
        read -p "It seems apache is install, would you like to remove it ? [yN]" yn
        case $yn in
            [yY]* )
                sudo apt-get remove apache2
                break
                ;;
            *)
                files=$(find "/var/www")
                sudo mkdir -p "/var/www/apache_default"
                sudo mv "$files" "/var/www/apache_default"
                sudo sed -i.back "s:/var/www$:/var/www/apache_default" /etc/apache2/sites-available/default
                sudo service apache2 reload
                break;;
        esac

    fi

    # install nginx
    if [[ -z "`ls /etc/nginx 2> /dev/null`" ]]; then
        sudo apt-get -y install nginx
        sudo service nginx start
        sudo cp install/ressources/database /etc/nginx/sites-available
        sudo ln -s /etc/nginx/sites-available/database /etc/nginx/sites-enabled/database
        if [[ ! -f "/var/www/" ]]; then
            sudo mkdir /var/www
        fi
    fi

    # install mysql
    mysql --version 2>&1 > /dev/null
    if [[ "$?" == 127 ]]; then
        sudo apt-get -y install mysql-server php5-mysql
        sudo mysql_install_db
        sudo mysql_secure_installation
    fi

    # install php
    php --version 2>&1 > /dev/null
    if [[ "$?" == 127 ]]; then
        sudo apt-get -y install php5-fpm php5-cli mcrypt
        sudo sed -i.back "s/cgi\.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php5/fpm/php.ini
        sudo sed -i.back "s:listen = .*:listen = /var/run/php5-fpm.sock:" /etc/php/fpm/pool.d/www.conf
        sudo php5enmod mcrypt
        sudo service php5-fpm restart
    fi

    # install phpmyadmin
    if [[ ! -f "/usr/share/phpmyadmin" ]]; then
        echo "######################################################"
        echo "# Installation of phpmyadmin                         #"
        echo "#                                                    #"
        echo "# When the installer ask which web server to use,    #"
        echo "# select none of them (tab and enter).               #"
        echo "# Say yes to the next question and you're good to go #"
        echo "######################################################"
        read -p "Press any key to continue install" foo
        sudo apt-get -y install phpmyadmin
        sudo cp install/ressources/phpmyadmin /etc/nginx/sites-available
        sudo ln -s /etc/nginx/sites-available/phpmyadmin /etc/nginx/sites-enabled/phpmyadmin
        sudo ln -s /usr/share/phpmyadmin /var/www/phpmyadmin
        #sudo chown -h www-data:www-data /var/www/phpmyadmin
        #sudo chown -R www-data:www-data /var/www/phpmyadmin
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

    # move the site to nginx dir
    sudo mv ../database /var/www
    cd /usr/share/nginx/www
    sudo chown -R www-data:www-data database
fi
