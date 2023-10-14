<?php

declare(strict_types=1);

namespace App\Web;

use PDO;

class Transactions
{
    public function viewAllTransactionsofSingleUser(string $email): array
    {


        $database = new Database();
        $pdo = $database->run();
        $sql = "SELECT receiver_name, receiver_email, amount, type, date FROM transactions
        WHERE sender_email=:email";

        $stmt = $pdo->prepare($sql);

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->execute([
            ':email' => $email
        ]);

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}
