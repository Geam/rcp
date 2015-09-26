#Rcp site

##Requirements

	PHP >= 5.4.0
	MCrypt PHP Extension

##How to install

### Step 1: Get the code
#### Option 1: Git Clone

```bash
$ git clone git://github.com/geam/rcp.git $HOME/database
```

#### Option 2: Download the repository
```bash
    cd
    wget https://github.com/geam/rcp/archive/master.zip
    unzip master.zip
    mv rcp-master database
```

### Step 2: Install script or manual

#### Install script
```bash
    cd $HOME/database
    ./install/rpi_install.sh
```

#### Manual
##### Manual step 1: Use Composer to install dependencies
###### Option 1: Composer is not installed globally

```bash
$ cd laravel
$ curl -s http://getcomposer.org/installer | php
$ php composer.phar install --dev
```

###### Option 2: Composer is installed globally

```bash
$ cd laravel
$ composer install --dev
```

If you haven't already, you might want to make [composer be installed globally](http://andrewelkins.com/programming/php/setting-up-composer-globally-for-laravel-4/) for future ease of use.

Please note the use of the `--dev` flag.

Some packages used to preprocess and minify assests are required on the development environment.

When you deploy your project on a production environment you will want to upload the ***composer.lock*** file used on the development environment and only run `php composer.phar install` on the production server.

This will skip the development packages and ensure the version of the packages installed on the production server match those you developped on.

NEVER run `php composer.phar update` on your production server.

##### Manual step 3: Configure Environments

Open ***bootstrap/start.php*** and edit the following lines to match your settings. You want to be using your machine name in Windows and your hostname in OS X and Linux (type `hostname` in terminal). Using the machine name will allow the `php artisan` command to use the right configuration files as well.

```php
$env = $app->detectEnvironment(array(

    'local' => array('your-local-machine-name'),
    'staging' => array('your-staging-machine-name'),
    'production' => array('your-production-machine-name'),
));
```

Now create the folder inside ***app/config*** that corresponds to the environment the code is deployed in. This will most likely be ***local*** when you first start a project.

You will now be copying the initial configuration file inside this folder before editing it. Let's start with ***app/config/app.php***. So ***app/config/local/app.php*** will probably look something like this, as the rest of the configuration can be left to their defaults from the initial config file:

```php
<?php

return array(

    'url' => 'http://myproject.local',

    'timezone' => 'UTC',

    'key' => 'YourSecretKey!!!',

    'providers' => append_config( array(

        /* Uncomment for use in development */
        //'Way\Generators\GeneratorsServiceProvider', // Generators
        //'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider', // IDE Helpers

        )
    ),

);
```

##### Manual step 4: Configure Database

Now that you have the environment configured, you need to create a database configuration for it. Copy the file ***app/config/database.php*** in ***app/config/local*** and edit it to match your local database settings. You can remove all the parts that you have not changed as this configuration file will be loaded over the initial one.

##### Manual step 5: Configure Mailer

In the same fashion, copy the ***app/config/mail.php*** configuration file in ***app/config/local/mail.php***. Now set the `address` and `name` from the `from` array in ***config/mail.php***. Those will be used to send account confirmation and password reset emails to the users.
If you don't set that registration will fail because it cannot send the confirmation email.

##### Manual step 6: Populate Database
Run these commands to create and populate Users table:

```bash
$ php artisan migrate
$ php artisan db:seed
```

##### Manual step 7: Set Encryption Key
***In app/config/app.php***

```
/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
| This key is used by the Illuminate encrypter service and should be set
| to a random, long string, otherwise these encrypted values will not
| be safe. Make sure to change it before deploying any application!
|
*/
```

```php
'key' => 'YourSecretKey!!!',
```

You can use artisan to do this

```bash
$ php artisan key:generate --env=local
```

The `--env` option allows defining which environment you would like to apply the key generation. In our case, artisan generates your key in ***app/config/local/app.php*** and leaves ***'YourSecretKey!!!'*** in ***app/config/app.php***. Now it can be generated again when you move the project to another environment.

##### Manual step 8: Make sure app/storage is writable by your web server.

If permissions are set correctly:

```bash
$ chmod -R 775 app/storage
```

Should work, if not try

```bash
$ chmod -R 777 app/storage
```

##### Manual step 9: Start Page (Three options for proceeding)

###### Create a new user
Create a new user at /user/create

###### Admin login
Navigate to /admin

    username: admin
    password: admin

-----
## Application Structure

The structure of this starter site is the same as default Laravel 4 with one exception.
This starter site adds a `library` folder. Which, houses application specific library files.
The files within library could also be handled within a composer package, but is included here as an example.

## Detect Language

If you want to detect the language on all pages you'll want to add the following to your routes.php at the top.

```php
Route::when('*','detectLang');
```

### Development

For ease of development you'll want to enable a couple useful packages. This requires editing the `app/config/app.php` file.

```php
'providers' => array(
    [...]
    /* Uncomment for use in development */
//  'Way\Generators\GeneratorsServiceProvider', // Generators
//  'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider', // IDE Helpers
),
```
Uncomment the Generators and IDE Helpers. Then you'll want to run a composer update with the dev flag.

```bash
$ php composer.phar update
```
This adds the generators and ide helpers.
To make it build the ide helpers automatically you'll want to modify the post-update-cmd in `composer.json`

```json
"post-update-cmd": [
	"php artisan ide-helper:generate",
	"php artisan optimize"
]
```

### Production Launch

By default debugging is enabled. Before you go to production you should disable debugging in `app/config/app.php`

```
    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => false,
```

## Troubleshooting

## Composer asking for login / password

Try using this with doing the install instead.

```bash
$ composer install --dev --prefer-source --no-interaction
```

## License

This is free software distributed under the terms of the MIT license
