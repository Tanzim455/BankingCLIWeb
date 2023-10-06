<?php

use App\Database;

require_once 'vendor/autoload.php';
if (file_exists('migrations.php')) {
    include 'migrations.php';
}


Database::makeTable(tablename: "transactions", array: $transactions);
