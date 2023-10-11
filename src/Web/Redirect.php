<?php

declare(strict_types=1);

namespace App\Web;

class Redirect
{
    public string $sessionname;
    public string $location;
    public static function To(string $sessionname, string $location)
    {

        if (isset($_SESSION[$sessionname])) {
            header($location);
            exit;
        }
    }
}
