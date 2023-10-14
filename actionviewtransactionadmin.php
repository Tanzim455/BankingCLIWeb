<?php

use App\Login;
use App\Web\Database;
use App\Web\Redirect;
use App\Web\Transactions;

session_start();
require_once './vendor/autoload.php';

Redirect::ifNotAuthenticated(sessionname: "email", location: "location:login.php");
if (isset($_POST["add_record"])) {
    $check_email = $_POST["check_email"];

    $errormessage = "The email does not have any transaction";
    $login = new Login();
    $transactions = new Transactions();
    $result = $transactions->viewAllTransactionsofSingleUser(email: $check_email);

    if (count($result)) {
        $_SESSION['result'] = $result;
        header("location:adminviewtransactionsofspecificcustomer.php");
    }
    if (!count($result)) {
        $_SESSION['errormessage'] = $errormessage;

        header("location:adminviewtransactionsofspecificcustomer.php");
    }
}
