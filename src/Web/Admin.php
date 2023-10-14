<?php

declare(strict_types=1);

namespace App\Web;

use PDO;

class Admin
{

    public function register(string $name, string $email, string $password, int $is_admin): void
    {
        $database = new Database();
        $pdo = $database->run();
        $sql1 = 'INSERT INTO users (name, email,password,is_admin)
VALUES (:name, :email,:password, :is_admin)';


        $stmt1 = $pdo->prepare($sql1);

        // Bind parameters for the first query
        $stmt1->bindParam(':name', $name);
        $stmt1->bindParam(':email', $email);
        $stmt1->bindParam(':password', $password);
        $stmt1->bindParam(':is_admin', $is_admin);


        $stmt1->execute();  // Execute the first query
    }

    public function viewAllUsers(): array
    {
        $database = new Database();
        $pdo = $database->run();
        $sql = "SELECT name,email FROM users WHERE is_admin=0";
        $stmt = $pdo->query($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public function viewAllTransactions(): array
    {


        $database = new Database();
        $pdo = $database->run();
        $sql = "SELECT receiver_name, receiver_email, amount, type, date FROM transactions";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}
