<?php
include './actionlogin.php';

use App\Web\Redirect;

require_once './vendor/autoload.php';


Redirect::To(sessionname: "email", location: "location:home.php");

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