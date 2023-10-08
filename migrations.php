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
    'from_user_id' => DataTypes::INT,
    'to_user_id' => DataTypes::INT,
    'FOREIGN KEY(from_user_id)' => 'REFERENCES users(id)',
    'FOREIGN KEY(to_user_id)' => 'REFERENCES users(id)',
    'amount' => DataTypes::FLOATNOTNULL,

];
$users = [
    'id' => DataTypes::INTAUTO,
    'name' => DataTypes::STRINGNOTNULL,
    'email' => DataTypes::STRINGUNIQUENOTNULL,
    'password' => DataTypes::STRINGNOTNULL,



];
