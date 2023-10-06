<?php

use App\Database;

require_once 'vendor/autoload.php';
// $storageType = php_sapi_name() === 'cli' ? 'cli' : 'web'; // Determine the storage type

// var_dump($storageType);

$record = [];
$record["email"] = "tanzim67@gmail.com";
$record["password"] = "password";
$record["name"] = "Tanzim Ibthesam";
$record["balance"] = 300;
// var_dump($record);


function insert(string $tableName, array $array)
{
    $database = new Database();
    $pdo = $database->run();
    $implode = implode(",", $array);
    $arrayValues = '';
    for ($i = 0; $i <= count($array) - 1; $i++) {

        if ($i == 3) {
            $arrayValues .= ":$array[$i]";
        }
        if ($i !== 3) {
            $arrayValues .= ":$array[$i],";
        }
    }
    $stmt = $pdo->prepare("INSERT INTO $tableName ($implode) VALUES ($arrayValues)");
    return $stmt;
}
$columns = ['name', 'email', 'password', 'balance'];
$stmt = insert(tableName: "users", array: $columns);

$stmt->bindParam(':name', $record['name']);
$stmt->bindParam(':email', $record['email']);
$stmt->bindParam(':password', $record['password']);
$stmt->bindParam(':balance', $record['balance']);
$stmt->execute();
