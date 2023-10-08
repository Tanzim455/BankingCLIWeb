<?php

use App\Database;

require_once 'vendor/autoload.php';
// $storageType = php_sapi_name() === 'cli' ? 'cli' : 'web'; // Determine the storage type

// var_dump($storageType);

// $record = [];
// $record["email"] = "tanzim67@gmail.com";
// $record["password"] = "password";
// $record["name"] = "Tanzim Ibthesam";
// $record["balance"] = 300;
// // var_dump($record);


function insert(string $tableName, array $array)
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
    return $stmt;
}
if (isset($_POST['add_record'])) {

    $columns = ['name', 'email', 'password', 'balance'];
    $stmt = insert(array: $columns, tableName: "users");
    // var_dump($sql);
    //Prepare Query for Execution
    var_dump($stmt);

    for ($i = 0; $i <= count($columns) - 1; $i++) {
        # code...
        $stmt->bindParam(":$columns[$i]", $_POST[$columns[$i]]) . PHP_EOL;
    }
    // Query Execution
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

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

</html>