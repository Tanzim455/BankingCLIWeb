<?php

declare(strict_types=1);

namespace App;

use App\Web\Database;
use PDO;

class Registration
{
    use FileWriting;
    public function checkUserEmailExistsinDatabase(string $email, string $tableName, string $type): bool
    {
        $database = new Database();
        $pdo = $database->run();
        $valid = true;
        $sql = "SELECT email FROM $tableName WHERE email='$email'";
        $stmt = $pdo->query($sql);

        if ($stmt) {
            $rowCount = $stmt->rowCount();
            // if ($rowCount) {
            //     echo "It matches";
            // }
            // if (!$rowCount) {
            //     echo "It does not match";
            // }
            // $emails = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($rowCount && $type == "Registration") {
                $valid = true;
                //return true
                echo "Sorry the email already exists";
            }
            if (!$rowCount && $type == "Registration") {
                $valid = false;
            }
            if ($rowCount && $type == "Login") {
                $valid = true;
                //return true

            }
            if (!$rowCount && $type == "Login") {
                $valid = false;
                echo "Sorry the email does not exist";
            }
            return $valid;
        }
    }
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

    public function formValidation(string $email, string $password, string $name, float $balance): bool
    {
        $formState = $this->formValidationState(email: $email, password: $password, name: $name, balance: $balance);
        if ($formState) {
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
        return false;
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
        $checkState = $this->formValidationState(email: $email, password: $password, name: $name, balance: $balance);
        // var_dump($this->formValidationState(email: $email, password: $password, name: $name, balance: $balance));
        var_dump($checkState);

        if (
            $checkState && !$check_email_exists

        ) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $values = [$name, $email, $hashed_password, $balance];
            $keys = ['name', 'email', 'password', 'balance'];
            $array_combine = array_combine($keys, $values);

            array_push($array, $array_combine);

            $this->write(array: $array, file: $file, filePath: $phpFilePath, variableName: "users");
        }
    }
    public function formValidationMessage(string $email, string $password, string $name, float $balance): bool
    {
        $valid = true; // Assume the input is valid initially

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "It is not an appropriate email address" . PHP_EOL;
            $valid = false;
        }
        if (strlen($password) < 8) {
            echo "Your password count needs to be greater or equal to 8" . PHP_EOL;
            $valid = false;
        }

        if (strlen($name) < 8) {
            echo "Your name must be at least 8 characters" . PHP_EOL;
            $valid = false;
        }
        if ($balance < 0) {
            echo  "Your balance cannot be negative" . PHP_EOL;
            $valid = false;
        }



        // If input is valid, return true, else return false
        return $valid;
    }

    public function formValidationState(string $email, string $password, string $name, float $balance): bool
    {
        $isValid = true;

        if (
            !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8 || strlen($name) < 8 || $balance < 0

        ) {
            $this->formValidationMessage(email: $email, password: $password, name: $name, balance: $balance);
            $isValid = false;
        }

        return $isValid;
    }
}
