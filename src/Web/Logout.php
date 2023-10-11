<?php

declare(strict_types=1);

namespace App\Web;

class Logout
{

    public static function logout()
    {
        session_start();
        session_destroy();
        header("location:login.php");
    }
}
