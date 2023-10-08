<?php

declare(strict_types=1);

namespace App;


class DataTypes
{
    const INTAUTO = "INT AUTO_INCREMENT PRIMARY KEY";
    const  STRING = "VARCHAR(100)";
    const UNIQUE = "UNIQUE";
    const NOTNULL = "NOT NULL";
    const STRINGUNIQUENOTNULL = DataTypes::STRING . ' ' . DataTypes::UNIQUE . ' ' . DataTypes::NOTNULL;
    const STRINGNOTNULL = DataTypes::STRING . ' ' . DataTypes::NOTNULL;
    const FLOATNOTNULL = DataTypes::FLOAT . ' ' . DataTypes::NOTNULL;
    const INT = "INT";
    const PRIMARYKEY = "PRIMARY KEY";
    const  FLOAT = "FLOAT";
}
