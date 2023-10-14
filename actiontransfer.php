<?php



session_start();
require_once './vendor/autoload.php';


use App\Registration;

use App\Web\Database;

if (isset($_POST['add_record'])) {
    $database = new Database();
    $pdo = $database->run();
    // $receiver_name = $_SESSION["name"];
    $sender_email = $_SESSION["email"];
    var_dump($sender_email);
    $type = "Transfer";
    $transfer = $_POST["transfer"];
    $receiver_email = $_POST["receiver_email"];
    $sql = "SELECT balance FROM users WHERE email = :sender_email";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':sender_email', $sender_email, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    ['balance' => $senders_balance] = $result;
    echo $senders_balance;
    //Check whether sender email exists or not
    $registration = new Registration();
    $check_sender_email_exists =
        $registration->checkUserEmailExistsinDatabase(email: $receiver_email, tableName: "users", type: "Login");
    var_dump($check_sender_email_exists);
    if ($check_sender_email_exists) {
        //find balance of the receiver 
        $sql = "SELECT balance,name FROM users WHERE email =:receiver_email";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':receiver_email', $receiver_email, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        ['balance' => $receiver_balance, 'name' => $receiver_name] = $result;
        echo $receiver_balance;
        //find transfer amount of sender
        //ensure tranfer money is not greater than senders balance 
        var_dump($transfer);
        if ($transfer > $senders_balance) {
            echo "Sorry the amount you want to transfer is greater than your balance";
        }
        if ($transfer < 0) {
            echo "Sorry the amount transferred cannot be negative";
        }
        if ($transfer <= $senders_balance && $transfer > 0) {
            //Add balance to receivers balance 
            $receivers_updated_balance = $receiver_balance + $transfer;
            echo "Receivers updated balance is $receivers_updated_balance";
            //Deduct balance from sender
            $senders_updated_balance = $senders_balance - $transfer;
            echo "Senders updated balance $senders_updated_balance";
            try {
                $pdo->beginTransaction();

                // INSERT INTO transactions query
                $sql1 = 'INSERT INTO transactions (receiver_name, receiver_email,sender_email,amount,type, date)
            VALUES (:receiver_name, :receiver_email,:sender_email, :deposit,:type, NOW())';

                $stmt1 = $pdo->prepare($sql1);

                // Bind parameters for the first query
                $stmt1->bindParam(':receiver_name', $receiver_name);
                $stmt1->bindParam(':receiver_email', $receiver_email);
                $stmt1->bindParam(':sender_email', $sender_email);
                $stmt1->bindParam(':type', $type);
                $stmt1->bindParam(':deposit', $transfer);

                $stmt1->execute();  // Execute the first query

                // Execute the first query

                //UPDATE senders balance
                $sql2 = 'UPDATE users SET balance =:senders_updated_balance WHERE email =:sender_email';

                $stmt2 = $pdo->prepare($sql2);

                // Bind parameters for the second query
                $stmt2->bindParam(':senders_updated_balance', $senders_updated_balance);
                $stmt2->bindParam(':sender_email', $sender_email);

                $stmt2->execute();  // Execute the second query
                //Update the receivers balance;
                $sql2 = 'UPDATE users SET balance =:receivers_updated_balance WHERE email =:receiver_email';

                $stmt2 = $pdo->prepare($sql2);

                // Bind parameters for the second query
                $stmt2->bindParam(':receivers_updated_balance', $receivers_updated_balance);
                $stmt2->bindParam(':receiver_email', $receiver_email);

                $stmt2->execute();  // Execute the second query

                $pdo->commit();
            } catch (\Throwable $th) {
                $pdo->rollBack();
                echo "Transaction failed: " . $th->getMessage();
            }
        }
    }
}
