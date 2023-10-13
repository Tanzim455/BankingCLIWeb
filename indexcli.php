<?php

use App\Database;
use App\DataTypes;

require_once 'vendor/autoload.php';


use App\App;
use App\Login;
use App\Registration;
use App\Transaction;

$registration = new Registration();
$login = new Login();
$transaction = new Transaction();
$app = new App();



$app->main($registration, $login, $transaction);
