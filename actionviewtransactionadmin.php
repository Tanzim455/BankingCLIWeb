<?php

use App\Login;
use App\Web\Database;

session_start();
require_once './vendor/autoload.php';


if (isset($_POST["add_record"])) {
    $check_email = $_POST["check_email"];
    $database = new Database();

    $login = new Login();
    $pdo = $database->run();
    $sql = "SELECT receiver_name, receiver_email, amount, type, 
date FROM transactions WHERE sender_email=:email";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':email' => $check_email
    ]);

    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    var_dump($result);

    if (count($result)) {
        $_SESSION['result'] = $result;
        header("location:adminviewtransactionsofspecificcustomer.php");
    }
}
