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
    $withdraw = $_POST["withdraw"];
    $sql = "SELECT balance FROM users WHERE email = :receiver_email";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':receiver_email', $receiver_email, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    ['balance' => $balance] = $result;
    // echo $balance;
    $updated_balance = $balance - $withdraw;
    var_dump($updated_balance);
    $transaction = new Transaction();
    if ($withdraw < 0) {
        echo "Sorry you cant withdraw a negative number";
    }
    if ($withdraw > $balance) {
        echo "Sorry you cannot withdraw an amount greater than your balance";
    }
    if ($withdraw > 0 && $withdraw < $balance) {
        try {
            $pdo->beginTransaction();

            // INSERT INTO transactions query
            $sql1 = 'INSERT INTO transactions (receiver_name, receiver_email, amount, date)
                     VALUES (:receiver_name, :receiver_email, :withdraw, NOW())';

            $stmt1 = $pdo->prepare($sql1);

            // Bind parameters for the first query
            $stmt1->bindParam(':receiver_name', $receiver_name);
            $stmt1->bindParam(':receiver_email', $receiver_email);
            $stmt1->bindParam(':withdraw', $withdraw);

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
