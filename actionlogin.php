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
    $login = new Login();
    if ($check_email_exists) {
        $sql = "SELECT name,email,password,balance FROM users WHERE email='$email';";
        $db = new Database();
        $pdo = $db->run();
        $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);

        $login = new Login();
        //Flattening the array 

        $isLoggedIn = $login->login(filtered_email: $result, inputpassword: $password);
        if ($isLoggedIn) {
            $_SESSION["email"] = $email;
            var_dump($email) . PHP_EOL;
            $balance = $login->viewBalanceorName(filtered_email: $result, option: 'balance');
            $name = $login->viewBalanceorName(filtered_email: $result, option: 'name');
            $_SESSION["balance"] = $balance;
            $_SESSION["name"] = $name;
            header("location:home.php");
        }
        if (!$isLoggedIn) {
            if (!isset($_SESSION['email'])) {
                header("location:login.php");
                exit;
            }
        }
    }
}
