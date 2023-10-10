<?php

use App\Registration;
use App\Web\Database;

require_once './vendor/autoload.php';







//         # code...
if (isset($_POST['add_record'])) {
    $columns = ['name', 'email', 'password', 'balance'];
    // echo " $columns[$i] " . ' => '  . $_POST[$columns[$i]];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $balance = $_POST["balance"];
    $password = $_POST["password"];






    $registration = new Registration();
    $validated = $registration->formValidationState(name: $name, email: $email, password: $password, balance: $balance);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    //convert balance to float


    // $check_email_exists = $registration->checkUserEmailExistsinDatabase(email: $email, tableName: "users", type: "registration");
    //Check email exists for login
    $check_email_exists = $registration->checkUserEmailExistsinDatabase(email: $email, tableName: "users", type: "Registration");
    var_dump($check_email_exists);

    if ($validated && !$check_email_exists) {
        echo "execute the query";
        $database = new Database();
        $stmt = $database->insert(array: $columns, tableName: "users", password: $hashed_password);
    }
}
