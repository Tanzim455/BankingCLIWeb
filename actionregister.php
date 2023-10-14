<?php

use App\Registration;
use App\Web\Database;

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
    var_dump($check_email_exists);

    if ($validated && !$check_email_exists) {
        echo "Your registration is successful";
        $database = new Database();
        $stmt = $database->insert(array: $columns, tableName: "users", password: $hashed_password);
    }
}
