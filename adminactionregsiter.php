<?php

use App\Registration;
use App\Web\Database;

require_once './vendor/autoload.php';
session_start();






//         # code...
if (isset($_POST['add_record'])) {
    echo "Page is set";
    $columns = ['name', 'email', 'password'];
    // // echo " $columns[$i] " . ' => '  . $_POST[$columns[$i]];

    $name = $_POST['email'];

    $email = $_POST["email"];
    $password = $_POST["password"];



    $registration = new Registration();
    $validated = $registration->formValidationState(name: $name, email: $email, password: $password, balance: NULL);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);




    //Check email exists for login
    $check_email_exists = $registration->checkUserEmailExistsinDatabase(email: $email, tableName: "users", type: "Registration");
    var_dump($check_email_exists);

    if ($validated && !$check_email_exists) {

        $database = new Database();
        $stmt = $database->insert(array: $columns, tableName: "users", password: $hashed_password);
        $_SESSION['successmessage'] = "Registration successfully done";
        header('location: adminaddcustomers.php');
    }
}
