# VaxMS
##### Improving Vaccination rates in rural areas and Developing countries

## Installation
For development it is possible to run the application locally, but the application has been created to run on Heroku.
Below you find an explanation for both.

### Local installation
To run the application locally, you will need to install PHP, [Composer](https://getcomposer.org) and a database such as
MySQL or SQLite. On a Windows machine you may do this through XAMPP.
The application has been tested and deployed on PHP 8.0.13. All the dependencies are installed by composer and the 
composer.lock file ensures that the versions that are installed are compatible with the app as it has been developed.

If you have PHP and composer installed, you can clone the repository into a local folder.
```
# go into the project folder
cd vaxms

# install all dependencies using composer
composer install
```

In your favourite database system, create a database and fill in the credentials in the .env file.
Next use Artisan to perform the database migrations belonging to the project.
```
php artisan migrate

# Windows
php artisan serve

# UNIX
composer require laravel/valet
valet install && valet link
```

The serve command will likely display localhost:8000 as the URL of the local application or if you use valet you should 
be able to use vaxms.test. This URL can be used on the 
local machine to view the application. However, when the Telegram functionalities for receiving messages is also desired
the local environment will need to be exposed to the 'outside' internet (i.e. a tunnel). This can be done using ngrok
or my personal favourite [Expose](https://expose.dev) by BeyondCode, for this you only need to run the `expose` command 
in the project folder (if you have valet configured correctly) and you will automatically get temporary URL that can be 
used. NB: you will need to edit the Telegram Webhook URL in the .env file every time the temporary URL changes.

### Heroku
Almost everything is ready to be deployed to heroku, you could even fork the repository and directly deploy the
application from github. The procfile and the NginX configuration file will make sure that the web server is started, 
the only thing you'll need to do is provision a Postgres DB server for the application using Heroku. All environment
variables in the .env.example file need to be added to the 'Config Vars' section of the apps settings in Heroku.

Use the Heroku [ps:scale command](https://devcenter.heroku.com/articles/heroku-cli-commands#heroku-ps-scale) to start
the dyno that runs the web server. And with the `heroku run` command, run `php artisan migrate --force` such that the
migrations are performed. (make sure that the Config Vars are set correctly to pgsql.)

### Schedule Worker
If the scheduled vaccination messages are to be tested, you will need to add a cron job that performs the 
`php artisan schedule:run` command every minute. In heroku this is most easily arranged by using the Cron To Go Add-On.

Locally the worker can be started by running the `php artisan schedule:work` command. This will run indefinitely and
does not need to be run manually every minute.

## Telegram
A Telegram bot needs to be created before the Telegram functionality can be used. This can be done by messaging 
@BotFather on Telegram and following the bot's instructions. A token is obtained which needs to be filled in, in the 
.env file (example in .env.example). 
