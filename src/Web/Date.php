<?php

declare(strict_types=1);

namespace App\Web;


class Date
{
    public static function formatter(string $date, string $format): string
    {
        $date_create = date_create($date);
        $formattedDate = $date_create->format($format);
        return $formattedDate;
    }
}
