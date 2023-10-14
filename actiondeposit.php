<?php



session_start();
require_once './vendor/autoload.php';

use App\Login;
use App\Transaction;
use App\Web\Database;

if (isset($_POST['add_record'])) {
    $database = new Database();
    $pdo = $database->run();
    $receiver_name = $_SESSION["name"];
    $receiver_email = $_SESSION["email"];
    $type = "Deposit";
    $deposit = $_POST["deposit"];
    $sql = "SELECT balance FROM users WHERE email = :receiver_email";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':receiver_email', $receiver_email, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    ['balance' => $balance] = $result;

    $updated_balance = $deposit + $balance;

    $transaction = new Transaction();
    if ($deposit < 0) {
        echo "Sorry you cant deposit a negative number";
    }
    if ($deposit > 0) {
        try {
            $pdo->beginTransaction();

            // INSERT INTO transactions query
            $sql1 = 'INSERT INTO transactions (receiver_name, receiver_email,sender_email,amount,type, date)
                     VALUES (:receiver_name, :receiver_email,:sender_email,:deposit,:type, NOW())';

            $stmt1 = $pdo->prepare($sql1);

            // Bind parameters for the first query
            $stmt1->bindParam(':receiver_name', $receiver_name);
            $stmt1->bindParam(':receiver_email', $receiver_email);
            $stmt1->bindParam(':sender_email', $receiver_email);
            $stmt1->bindParam(':type', $type);
            $stmt1->bindParam(':deposit', $deposit);

            $stmt1->execute();  // Execute the first query

            //UPDATE users query
            $sql2 = 'UPDATE users SET balance = :updated_balance WHERE email = :receiver_email';

            $stmt2 = $pdo->prepare($sql2);

            // Bind parameters for the second query
            $stmt2->bindParam(':updated_balance', $updated_balance);
            $stmt2->bindParam(':receiver_email', $receiver_email);

            $stmt2->execute();  // Execute the second query

            $pdo->commit();
        } catch (\Throwable $th) {
            $pdo->rollBack();
            echo "Transaction failed: " . $th->getMessage();
        }
    }
}
