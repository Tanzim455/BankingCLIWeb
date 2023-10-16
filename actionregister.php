<?php

use App\Registration;
use App\Web\Database;

session_start();
require_once './vendor/autoload.php';

//         # code...
if (isset($_POST['add_record'])) {
    $columns = ['name', 'email', 'password'];

    $name = $_POST["name"];
    $email = $_POST["email"];

    $password = $_POST["password"];

    $registration = new Registration();
    $validated = $registration->formValidationState(name: $name, email: $email, password: $password, balance: NULL);

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $check_email_exists = $registration->checkUserEmailExistsinDatabase(email: $email, tableName: "users", type: "Registration");
    if ($check_email_exists) {

        $_SESSION['errormessage'] = $registration->formValidationState(name: $name, email: $email, password: $password, balance: NULL);
        echo "The error message is" . $_SESSION['errormessage'];
    }

    if ($validated && !$check_email_exists) {

        $database = new Database();
        $stmt = $database->insert(array: $columns, tableName: "users", password: $hashed_password);

        $_SESSION['successmessage'] = "Registration successfully done";
        header('location: register.php');
    }
}
