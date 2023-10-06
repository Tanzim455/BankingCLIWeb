<?php

declare(strict_types=1);

namespace App;


class DataTypes
{
    const INTAUTO = "INT AUTO_INCREMENT PRIMARY KEY";
    const  STRING = "VARCHAR(100)";
    const UNIQUE = "UNIQUE";
    const NOTNNULL = "NOT NULL";
    const STRINGUNIQUENOTNULL = DataTypes::STRING . ' ' . DataTypes::UNIQUE . ' ' . DataTypes::NOTNNULL;
    const STRINGNOTNULL = DataTypes::STRING . ' ' . DataTypes::NOTNNULL;
    const FLOATNOTNULL = DataTypes::FLOAT . ' ' . DataTypes::NOTNNULL;
    const INT = "INT";
    const PRIMARYKEY = "PRIMARY KEY";
    const  FLOAT = "FLOAT";
}
