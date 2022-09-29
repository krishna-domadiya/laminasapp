To run this project follow below steps:

1. Clone the project and go to the project folder.

2. Open command line tool and run the command: composer install

Note: Make sure you have php version 7.4 - 8.0 installed in your system. Make sure to install latest version of composer as well.

3. Run the command: composer dump-autoload after successful completion of installation.

4. You need to have MySQL database ready for the connection.

5. Create local.php file in config/autoload folder with following code for database connection:

return [
    'db' => [
        'driver' => 'PDO',
        'dsn' => 'mysql:host=localhost;dbname=DATABASE_NAME;charset=UTF8',
        'username' => 'USERNAME',
        'password' => 'PASSWORD',
    ]
];

6. Also, make sure to rename the table gateways based on your current table name along with column configuration.

7. To run the application, run the command: composer serve

Note: You can check the running application in browser using localhost:8080