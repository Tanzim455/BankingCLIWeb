<?php


use App\Web\Redirect;



require_once './vendor/autoload.php';
session_start();
if (!isset($_SESSION["email"])) {
    header("location:login.php");
    exit;
}
// Redirect::To(sessionname: "email", location: "location:login.php");
// echo $_SESSION["email"] . PHP_EOL;
// echo $_SESSION["balance"] . PHP_EOL;
// echo $_SESSION["name"] . PHP_EOL;




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="logout.php">Logout</a>
</body>

</html>