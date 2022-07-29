# A very simple MVC framework for PHP

A super simple custom MVC framework structured for readability and maintainablity. 
Is a decent base for creating new projects, it includes a login system on the 
user-authentication branch to get up to speed on a new project even faster.

## Installation

- For the lighter version:
- git clone https://github.com/DeveloperLewis/basic-php-mvc-framework.git
- composer install

- For the user login system version:
- git clone -b user-authentication https://github.com/DeveloperLewis/basic-php-mvc-framework.git
- composer install

- If you have cloned the user-authentication branch you will need to do the following before you startup the server:

- Enter the database.php class in the classes folder and change the username and password to match your database login.
- Enter the init.php and change the username and password to match your database login.

- The application will then create a database and the required tables so make sure the user of the database has the necessary permissions to do so.
- You now are able to get the framework running!

- The application will run in XAMPP, or at least needs PHP 8, mariadb and apache to work. However xampp is pre-configured and easier to get running!

- You can edit the init.php script to be able to run your own sql schema creation instead.
- Change the database user and database itself to run differently depending on your application.

## Features

- Structured layout
- Routing (Refactorable)
- Models via classes
- Views based on regular PHP
- Controllers
- Includes frontend frameworks

