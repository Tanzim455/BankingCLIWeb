<?php

declare(strict_types=1);

namespace App;

class Registration
{
    use FileWriting;
    public static function checkUserEmailExists($array, string $email): bool
    {

        if (isset($array)) {
            $all_users_email = array_column($array, 'email');
            if (in_array($email, $all_users_email)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function formValidation(string $email, string $password, string $name, float $balance): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "It is not an appropriate email address" . PHP_EOL;
        }
        if (strlen($password) < 8) {
            echo "Your password count needs to be greater or equal to 8" . PHP_EOL;
        }

        if (strlen($name) < 8) {
            echo "Your name must be at least 8 characters" . PHP_EOL;
        }
        if ($balance < 0) {
            echo  "Your balance cannot be negative";
        }
    }
    public function register(
        string $email,
        string $name,
        string $password,
        float $balance,
        array $array,
        $file,
        string $phpFilePath,
        bool $check_email_exists,

    ): void {
        $this->formValidation(email: $email, password: $password, name: $name, balance: $balance);
        if (
            filter_var($email, FILTER_VALIDATE_EMAIL) && !$check_email_exists
            && strlen($name) >= 8 && strlen($password) >= 8
            && $balance > 0
        ) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $values = [$name, $email, $hashed_password, $balance];
            $keys = ['name', 'email', 'password', 'balance'];
            $array_combine = array_combine($keys, $values);

            array_push($array, $array_combine);

            $this->write(array: $array, file: $file, filePath: $phpFilePath, variableName: "users");
        }
    }
}
