<?php


use App\Web\Redirect;



require_once './vendor/autoload.php';
session_start();

// Redirect::To(sessionname: "email", location: "location:login.php");

if (isset($_SESSION["email"])) {
    echo "user is logged in";
} else {
    header("location:login.php");
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
    <a href="logout.php">Logout</a>
</body>

</html>