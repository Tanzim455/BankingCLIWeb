<?php



// include './actionregister.php';
include './actionregister.php';





//         # code...


?>





<body>
    <form name="frmAdd" action="actionregister.php" method="POST">
        <div class="demo-form-row">
            <label>Name:</label><br>
            <input type="text" name="name" class="demo-form-field" />
        </div>
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