<?php




use App\Web\Redirect;



require_once './vendor/autoload.php';
session_start();
Redirect::ifNotAuthenticated(sessionname: "email", location: "location:login.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <form action="actionwithdraw.php" method="post">
        <input type="number" name="withdraw" id=""><br>
        <div class="demo-form-row">
            <input name="add_record" type="submit" value="Add" class="demo-form-submit">
        </div>
    </form>
</head>

<body>

</body>

</html>