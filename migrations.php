<?php

use App\DataTypes;

require_once 'vendor/autoload.php';
$admins = [
    'id' => DataTypes::INTAUTO,
    'name' => DataTypes::STRINGNOTNULL,
    'email' => DataTypes::STRINGUNIQUENOTNULL,
    'password' => DataTypes::STRINGNOTNULL,
    'balance' => DataTypes::FLOATNOTNULL

];

$transactions = [
    'id' => DataTypes::INTAUTO,
    'from_user' => DataTypes::STRINGNOTNULL,
    'to_user' => DataTypes::STRINGNOTNULL,
    'amount' => DataTypes::FLOATNOTNULL,

];
$users = [
    'id' => DataTypes::INTAUTO,
    'name' => DataTypes::STRINGNOTNULL,
    'email' => DataTypes::STRINGUNIQUENOTNULL,
    'password' => DataTypes::STRINGNOTNULL,
    'balance' => DataTypes::FLOATNOTNULL

];
