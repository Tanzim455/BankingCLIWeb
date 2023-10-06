<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;

class Database
{
    public $server = "localhost";
    public $username = "root";
    private $password = "";
    public $conn = "";


    public  function run()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=bankingapp", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    public static function makeTable(string $tablename, array $array)
    {

        //Find out array key of all users
        $user_array_keys = array_keys($array);
        //get count of all arrays 
        $count = count($user_array_keys);
        $last_user_array_key = $user_array_keys[$count - 1];
        $concatenatedStrings = '';
        foreach ($array as $key => $value) {
            if ($key == $last_user_array_key) {
                $concatenatedStrings .= "$key $value" . PHP_EOL;
            }
            if ($key !== $last_user_array_key) {
                $concatenatedStrings .= "$key $value," . PHP_EOL;
            }
        }
        // echo $concatenatedStrings;
        $table = "CREATE TABLE $tablename($concatenatedStrings);";
        var_dump($table);
        $database = new Database();
        $pdo = $database->run();

        try {
            $pdo->exec($table);
            echo "Table created successfully";
        } catch (PDOException $e) {
            echo "Sorry there are errors" . $e->getMessage();
        }
    }
}
