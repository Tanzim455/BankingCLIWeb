<?php


use App\Registration;
use App\Web\Database;

require_once 'vendor/autoload.php';


function insert(string $tableName, array $array, ?string $password)
{
    $database = new Database();
    $pdo = $database->run();
    $implode = implode(",", $array);
    $arrayValues = '';
    $count = count($array) - 1;

    for ($i = 0; $i <= count($array) - 1; $i++) {

        if ($i == $count) {
            $arrayValues .= ":$array[$i]";
        }
        if ($i !== $count) {
            $arrayValues .= ":$array[$i],";
        }
    }
    $stmt = $pdo->prepare("INSERT INTO $tableName ($implode) VALUES ($arrayValues)");
    for ($i = 0; $i <= count($array) - 1; $i++) {
        //         # code...
        // var_dump(":$columns[$i]", $_POST[$columns[$i]]) . PHP_EOL;
        if ($array[$i] === 'password') {
            $stmt->bindParam(":$array[$i]", $password) . PHP_EOL;
        }

        if ($array[$i] !== 'password') {
            $stmt->bindParam(":$array[$i]", $_POST[$array[$i]]) . PHP_EOL;
        }
        //$stmt->bindParam(":$columns[$i]", $_POST[$columns[$i]]) . PHP_EOL;
    }
    $stmt->execute();
}




//         # code...
if (isset($_POST['add_record'])) {
    $columns = ['name', 'email', 'password', 'balance'];
    // echo " $columns[$i] " . ' => '  . $_POST[$columns[$i]];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $balance = $_POST["balance"];
    $password = $_POST["password"];

    // if (!is_numeric($balance)) {
    //     echo "Sorry the balance must be numeric";
    // }





    $registration = new Registration();
    $validated = $registration->formValidationState(name: $name, email: $email, password: $password, balance: $balance);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    //convert balance to float


    // $check_email_exists = $registration->checkUserEmailExistsinDatabase(email: $email, tableName: "users", type: "registration");
    //Check email exists for login
    $check_email_exists = $registration->checkUserEmailExistsinDatabase(email: $email, tableName: "users", type: "Registration");


    if ($validated && !$check_email_exists) {
        echo "execute the query";
        $stmt = insert(array: $columns, tableName: "users", password: $hashed_password);
    }
}

?>





<body>
    <form name="frmAdd" action="" method="POST">
        <div class="demo-form-row">
            <label>Name:</label><br>
            <input type="text" name="name" class="demo-form-field" />
        </div>
        <div class="demo-form-row">
            <label>Email:</label><br>
            <input type="text" name="email" class="demo-form-field" />
        </div>
        <div class="demo-form-row">
            <label>Balance:</label><br>
            <input type="number" name="balance" class="demo-form-field" />
        </div>
        <div class="demo-form-row">
            <label>Password:</label><br>
            <input type="password" name="password" class="demo-form-field" />
        </div>
        <div class="demo-form-row">
            <input name="add_record" type="submit" value="Add" class="demo-form-submit">
        </div>
    </form>
</body>