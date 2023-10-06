<?php

declare(strict_types=1);

namespace App;

class Admin
{
    public string $email;
    public string $password;

    public function viewAllUsers(): void
    {
        if (file_exists('output.php')) {
            include 'output.php';
        }
        if (!isset($users)) {
            echo "Users dont exist in data";
        }
        foreach ($users as $user) {
            $name = $user['name'];
            $email = $user['email'];
            $balance = $user['balance'];
            echo "Name " . $name . "\n";
            echo "Email: " . $email . "\n";

            echo "Balance: $" . $balance . "\n\n";
        }
    }
    public function viewTransactions(): void
    {
        if (file_exists('transactions.php')) {
            include 'transactions.php';
        }
        if (!isset($transactions)) {
            echo "Transactions dont exist in database \n";
        }
        if (isset($transactions)) {
            foreach ($transactions as $transaction) {
                $from = $transaction['from'];
                $to = $transaction['to'];
                $type = $transaction['type'];
                $amount = $transaction['amount'];
                echo "From " . $from . "\n";
                echo "To: " . $to . "\n";
                echo "Type: " . $type . "\n";
                echo "Balance: $" . $amount . "\n\n";
            }
        }
    }

    public function login(
        Login $login,
        Transaction $transaction
    ) {
        if (file_exists('admins.php')) {
            include 'admins.php';
        }
        while (true) {
            echo "Enter your email \n";
            $this->email = trim(fgets(STDIN));
            echo "Enter your password \n";
            $this->password = trim(fgets(STDIN));
            $filtered_email = $login->filterEmail(array: $admins, email: $this->email, filterBy: 'email');
            if (!$filtered_email) {
                echo "The email does not exist in database";
            }
            $result = $login->login(filtered_email: $filtered_email, inputpassword: $this->password);
            while (true) {
                if ($result) {
                    Menu::adminMenu();
                    $readline = readline("Enter specific option \n");
                    if ($readline == MenuNumbers::FIRST) {
                        $this->viewAllUsers();
                    }
                    if ($readline == MenuNumbers::SECOND) {
                        $this->viewTransactions();
                    }
                    if ($readline == MenuNumbers::THIRD) {
                        echo "Enter specific users email\n";
                        $this->email = trim(fgets(STDIN));
                        if (file_exists('transactions.php')) {
                            include 'transactions.php';
                        }
                        if (!isset($transactions)) {
                            echo "Transactions dont exist in database \n";
                        }
                        if (isset($transactions)) {
                            $filtered_email = $login->filterEmail(
                                array: $transactions,
                                email: $this->email,
                                filterBy: 'from'
                            );
                            if (!$filtered_email) {
                                echo "The filtered email does not exist \n";
                            }
                            $transaction->viewYourTransactions(array: $filtered_email);
                        }
                    }
                    if ($readline == MenuNumbers::FOUR) {
                        exit();
                    }
                }
            }
        }
    }
}
