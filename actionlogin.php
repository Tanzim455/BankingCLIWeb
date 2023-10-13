<?php
session_start();

use App\Login;
use App\Registration;
use App\Web\Database;

require_once './vendor/autoload.php';







//         # code...
if (isset($_POST['add_record'])) {



    $email = $_POST["email"];

    $password = $_POST["password"];
    $registration = new Registration();
    $check_email_exists =
        $registration->checkUserEmailExistsinDatabase(email: $email, tableName: "users", type: "Login");
    if (!$check_email_exists) {
        var_dump($check_email_exists);
    }
    $login = new Login();
    if ($check_email_exists) {
        $sql = "SELECT name,email,password,balance FROM users WHERE email='$email';";
        $db = new Database();
        $pdo = $db->run();
        $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);


        $login = new Login();
        //Flattening the array 

        $isLoggedIn = $login->login(filtered_email: $result, inputpassword: $password);
        if ($isLoggedIn) {
            $_SESSION["email"] = $email;

            $balance = $login->viewBalanceorName(filtered_email: $result, option: 'balance');
            $name = $login->viewBalanceorName(filtered_email: $result, option: 'name');

            $_SESSION["name"] = $name;
            $_SESSION["balance"] = $balance;
            header("location:index.php");
        }
    }
}
