<?php
include './actionlogin.php';
// session_start();
// if (isset($_SESSION["email"])) {
//     echo "user is logged in";
// } else {
//     header("location:login.php");
// }
var_dump(isset($_SESSION["email"]));
if (isset($_SESSION["email"])) {
    header("location:home.php");
}

?>





<body>
    <form name="frmAdd" action="actionlogin.php" method="POST">

        <div class="demo-form-row">
            <label>Email:</label><br>
            <input type="text" name="email" class="demo-form-field" />
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