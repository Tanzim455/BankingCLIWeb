<?php

use App\Admin;
use App\Login;
use App\Transaction;

require_once 'vendor/autoload.php';
$login = new Login();
$transaction = new Transaction();
$admin = new Admin();
$admin->login($login, $transaction);
