<?php
session_start();
include 'alltransactions.php';

foreach ($result as $arr) {
    $from = $arr['receiver_name'];
    $to = $arr['receiver_email'];
    $type = $arr['type'];
    $amount = $arr['amount'];
    $date = $arr['date'];
    if ($type !== "Deposit") {
        echo "Amount: -" . $amount . "\n";
    } else {
        echo "Amount: $+" . $amount . "\n\n";
    }
    if ($type !== "date") {
        $date_create = date_create($date);
        echo $date_create->format('d M Y h:i:A');
    }
    echo "Reciever email " . $to . "\n";
    echo "Receiver Name" . $from . "\n";
}