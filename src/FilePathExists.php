<?php

declare(strict_types=1);

namespace App;

trait FilePathExists
{
    protected $users;

    public function filePathExists(): void
    {
        if (file_exists($this->phpFilePath)) {
            include $this->phpFilePath;
            $this->users = $users;
        }
    }
}
