<?php

use App\Web\Admin;
use App\Web\Database;

require_once 'vendor/autoload.php';
if (file_exists('migrations.php')) {
    include 'migrations.php';
}


//To Drop any table
// Database::dropTables("users");
// Database::dropTables("transactions");

Database::makeTable("users", $users);
Database::makeTable("transactions", $transactions);

//Create admin
$database = new Database();
$pdo = $database->run();
$name = "Admin One";
$password = "password";
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
$email = "admin@gmail.com";
$is_admin = 1;

$admin = new Admin();
$admin->register(name: $name, email: $email, password: $hashed_password, is_admin: 1);
