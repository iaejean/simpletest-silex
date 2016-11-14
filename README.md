##Simple Test Silex

A simple app to test Silex Framework, Ding Framework as DI and IoC Container, and Doctrine as ORM, etc...

###Requirements
- PHP v7+
- Apache v2+
- MySQL v5+
- Composer
- Bower

###Installation
- Create a directory for the app
- Into the new directory initialize a new git local repo
- Fetch from github the master branch
- Download PHP repositories
- Download Bower repositories
```
    //Console/Terminal
    mkdir myapp
    git init
    git remote add origin https://github.com/iaejean/simpletest-silex.git
    git fetch 
    git pull origin master
    composer install
    bower install
```

###Configuration

Inside the database dir, you will find and mwb file to edit the ER, and a dump.sql;

- Create a database
- Run dump.sql
- Edit index.php file into the src directory
```
    //MySQL Console
    create database myapp;
    use myapp;
    source database/dump.sql
```

```phpp    
    //...
    //src/index.php file line 30
    $app->register(new DoctrineServiceProvider(), [
        'db.options' => [
            'driver'    => 'pdo_mysql',
            'host'      => 'localhost',
            'dbname'    => 'myapp',
            'user'      => 'root',
            'password'  => '%YOUR_PASSWORD%',
            'charset'   => 'utf8'
        ]
    ]);
    //...
```

###Usage
You will find 4 sections:

 - home: Showing this same information
 - products: Showing a list of products as his price and description
 - stores: Showing a list of stores as his name, and direction
 - Search: Given a Store and Product selected, you will available to search for this product, if exist in stock you will find a field to set de valomun to buy, if there is no more in stock, you will find a butto for search wich others stores area available with the product 
        
###Todo

 - Add Validations with Symfony/validator
 - Add PHPUnit
