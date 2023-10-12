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
// Database::dropTables("transactions");
// Database::makeTable(tablename: "transactions", array: $transactions);
//We get admins table with a new column balance

// $database = new Database();

// $pdo = $database->run();

// $sql = "INSERT INTO transactions (receiver_name, receiver_email, amount, date)
//  VALUES ('John Doe', 'john.doe@example.com', 100.50, now());";
// $stmt = $pdo->query($sql);
// $stmt->execute();
// $sql = "SELECT date FROM transactions WHERE id=3";
// $stmt = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
// var_dump($stmt);
// ['date' => $date] = $stmt;
// echo $date;
// // //Convert this date to 
// // $date_create = date_create($date);
// // //check date create
// // var_dump($date_create->format('d M Y h:i:A'));

// try {
//     //code...
//     $pdo->beginTransaction();

//     $sql = 'INSERT INTO transactions (receiver_name, receiver_email, amount, date)
//     VALUES ("Tanzim Ibthesam", "tanzim67@gmail.com", 2000, now());';
//     $stmt = $pdo->query($sql);
//     $stmt->execute();
//     $sql2 = 'UPDATE users SET balance =11000  WHERE email="tanzim67@gmail.com"';
//     $stmt2 = $pdo->query($sql2);
//     $stmt2->execute();
//     $pdo->commit();
// } catch (\Throwable $th) {
//     //throw $th;
//     $pdo->rollBack();
//     echo "Transaction failed: " . $th->getMessage();
// }

// Database::dropTables("users");
Database::dropTables("transactions");

// Database::makeTable("users", $users);
Database::makeTable("transactions", $transactions);
