<?php

use App\Web\Database;

require_once 'vendor/autoload.php';
if (file_exists('migrations.php')) {
    include 'migrations.php';
}

//make a table
// Database::makeTable(tablename: "transactions", array: $transactions);
//Drop table
//Database::dropTables(tablename: "admins");
//Try to drop same table again
// Database::dropTables(tablename: "admins");
//Add table with new columns 
//See if admin table exists or not
//Add admin table 
Database::dropTables("users");
Database::makeTable(tablename: "users", array: $users);
//We get admins table with a new column balance