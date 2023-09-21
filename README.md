# BindHQ_Assessment

## Overview
 The project has the following routes:
   - `/companies` which allows you view all companies and their sales
   - `/api/companies` which allows you view only a list of companies
   - `/api/companies/{id}/sales` which allows you view the sales of a specific company

## Setting up project
 To set up the project:
 - Clone the repo
 - Create the database
 - Install project dependencies using `composer install`
 - Run migrations using `php bin/console doctrine:migrations:migrate`
 - Import the database using the sql file in the /DB folder
 - Start the application using `symfony serve`

