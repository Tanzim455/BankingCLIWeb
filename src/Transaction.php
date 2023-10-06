<?php

declare(strict_types=1);

namespace App;

class Transaction
{
    use FileWriting;
    public function transactionKeyValues(
        string $from,
        string $to,
        string $type,
        float $amount,
        array $array,
        $file,
        string $transactionFilePath
    ): void {
        $transaction_keys = ['from', 'to', 'type', 'amount'];
        $transaction_values = [$from, $to, $type, $amount];
        $transaction_array_combine = array_combine($transaction_keys, $transaction_values);
        array_push($array, $transaction_array_combine);

        $this->write(array: $array, file: $file, filePath: $transactionFilePath, variableName: "transactions");
    }

    public function amountBalanceValidation(float $balance, float $amount): void
    {
        if ($amount > $balance) {
            echo "Sorry the amount is greater than your balance \n";
        }
        if ($amount < 0) {
            echo "Sorry The amount is a negative number \n";
        }
    }

    public function addorDeductBalance(
        array $array,
        string $email,
        string $type,
        float $amount,
        $file,
        ?string $receiptentemail,
        string $userFilePath
    ): void {
        $filtered_email = array_filter($array, fn ($u) => $u['email'] == $email);




        //Get array keys 
        $array_key_index_of_authenticated_user = array_keys($filtered_email)[0];


        if ($type == "WithDraw") {
            $array[$array_key_index_of_authenticated_user]['balance'] -= $amount;
        }
        if ($type == "Deposit") {
            $array[$array_key_index_of_authenticated_user]['balance'] += $amount;
        }
        if ($type == "Transfer") {
            $receiptentemail = array_filter($array, fn ($u) => $u['email'] == $receiptentemail);
            $array_key_index_of_receiptent_user = array_keys($receiptentemail)[0];
            $array[$array_key_index_of_authenticated_user]['balance'] -= $amount;
            $array[$array_key_index_of_receiptent_user]["balance"] += $amount;
        }
        // var_dump($array);
        $this->write(array: $array, file: $file, filePath: $userFilePath, variableName: "users");
    }

    public function viewYourTransactions(array $array): void
    {

        foreach ($array as $arr) {
            $from = $arr['from'];
            $to = $arr['to'];
            $type = $arr['type'];
            $amount = $arr['amount'];

            echo "From " . $from . "\n";
            echo "To: " . $to . "\n";
            echo "Type: " . $type . "\n";
            echo "Amount: $" . $amount . "\n\n";
        }
    }
}
