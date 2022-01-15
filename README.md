## Test and build
### Scrutinizer
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bashikr/mvc-proj/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/bashikr/mvc-proj/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/bashikr/mvc-proj/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/bashikr/mvc-proj/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/bashikr/mvc-proj/badges/build.png?b=main)](https://scrutinizer-ci.com/g/bashikr/mvc-proj/build-status/main)
### CircleCi

[![CircleCI](https://circleci.com/gh/bashikr/mvc-proj/tree/main.svg?style=svg)](https://circleci.com/gh/bashikr/mvc-proj/tree/main)

## About
MVC-PROJ is the concluding project of the MVC course which is done by Blekinge Institute of Technology. As demonstrated in the title of the repo, the course intention is to give us an intro to software design pattern MVC in this case with a focus on OOP using PHP. MVC-PROJ is created on top of the currently most famous PHP framework i.e. Laravel v7.29.

ToDoSmart is an application that helps users to manage their own daily life by adding note cards in a colorful way. In the beginning, new users have to register a new account to be able to log in to the app. When logging in one will be redirected to the landing page where one could create a new note. After creating notes there are two ways of presenting the notes where the first one is a list of the notes' titles and could be seen in the first figure. The second way of presenting the notes is done on the grid page as demonstrated in the second figure. The application supports editing and deleting a note if so desired.

![Landing page](https://github.com/bashikr/mvc-proj/tree/main/public/assets/images/landing-page.jpg)
<p align = "center">
Fig.1 - Landing page
</p>

![Grid](https://github.com/bashikr/mvc-proj/tree/main/public/assets/images/grid.jpg)
<p align = "center">
Fig.2 - The Grid page
</p>

## Installation
To be able to install the project and run it you have to have composer installed on your machine then you can execute the following commands in the root of this project:

    composer update
    composer install

Afterwards make a copy of .env.example and change it to .env. Open the application on localhost. You will see a page like this
 
![Generate app key](https://github.com/bashikr/mvc-proj/tree/main/public/assets/images/app-key.png)
<p align = "center">
Fig.3 - App key generation
</p>


Click on generate and then head to .env where the app key has been created. On line 9 to 14 you have to configure your database connection to be able to start the application:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=

Create a database locally (If you work on your local machine) and then add its name to the DB_DATABASE variable instead of **laravel**. Be sure to attach your DB_USERNAME and DB_PASSWORD. When you are finished from configuring the database connection head to the website on localhost where you will get a message like this:

![Run migrations](https://github.com/bashikr/mvc-proj/tree/main/public/assets/images/migrations.png)
<p align = "center">
Fig.4 - Database migration
</p>

Click on run migrations or execute `php artisan migrate` from the terminal and refresh the page. Finally, you have a working website where you have to register a new user and you are ready to login and experiment it.
