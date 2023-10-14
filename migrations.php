<?php

use App\DataTypes;

require_once 'vendor/autoload.php';
$admins = [
    'id' => DataTypes::INTAUTO,

    'email' => DataTypes::STRINGUNIQUENOTNULL,
    'password' => DataTypes::STRINGNOTNULL,


];

$transactions = [
    'id' => DataTypes::INTAUTO,
    'receiver_name' => DataTypes::STRINGNOTNULL,
    'receiver_email' => DataTypes::STRINGNOTNULL,
    'sender_email' => DataTypes::STRINGNOTNULL,
    'amount' => DataTypes::FLOATNOTNULL,
    'date' => DataTypes::TIMESTAMPNOTNULLABLE,
    'type' => DataTypes::STRINGNOTNULL

];
$users = [
    'id' => DataTypes::INTAUTO,
    'name' => DataTypes::STRINGNOTNULL,
    'email' => DataTypes::STRINGUNIQUENOTNULL,
    'password' => DataTypes::STRINGNOTNULL,
    'balance' => DataTypes::FLOATNULLABLE

];
