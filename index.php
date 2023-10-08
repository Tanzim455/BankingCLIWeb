<?php

use App\Database;
use App\DataTypes;

require_once 'vendor/autoload.php';


// use App\App;
// use App\Login;
// use App\Registration;
// use App\Transaction;

// $registration = new Registration();
// $login = new Login();
// $transaction = new Transaction();
// $app = new App();


// // $app->main();
// $app->main($registration, $login, $transaction);
// $database = new Database();
// $database->run();
// $isCLI = php_sapi_name();
// // var_dump($isCLI);
// // var_dump(php_sapi_name());
// if ($isCLI === 'cli') {
//     echo "Write to File Storage";
// } else {
//     echo "Write to Database storage";
// }
// $users = [
//     'id' => DataTypes::INTAUTO,
//     'name' => DataTypes::STRING,
//     'email' => DataTypes::STRING,
//     'password' => DataTypes::STRING,
//     'balance' => DataTypes::FLOAT


// ];

// Database::makeTable(tablename: "users", array: $users);
// $databse = new Database();
Database::dropTables("admins", $admins);
