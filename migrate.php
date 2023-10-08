<?php

use App\Database;

require_once 'vendor/autoload.php';
if (file_exists('migrations.php')) {
    include 'migrations.php';
}


Database::makeTable(tablename: "admins", array: $admins);
// $database = new Database();
// var_dump($database->showTables(searchTerm: "posts"));
//Database::dropTables(tablename: "admins");
