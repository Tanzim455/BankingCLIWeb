<?php

declare(strict_types=1);

namespace App;

class Menu
{
    const LOGIN = "1.Login\n";
    const REGISTER = "2.Register\n";
    const EXIT = "3. Exit\n";
    const BALANCE = "4.Balance\n";
    const WITHDRAW = "5.WithDraw\n";
    const DEPOSIT  = "6. Deposit\n";
    const TRANSFER  = "7.Transfer\n";
    const TRANSACTIONS  = "8. View All Transactions\n";
    const LOGINEXIT     = "9. ExitLogin\n";
    const VIEWALLUSERS  = "1.View All Users \n";
    const VIEWALLTRANSACTIONS = "2.View All Transactions\n";
    const VIEWUSERBYTRANSACTIONS = "3.View Transaction of specific user \n";
    const ADMINEXIT = "4.Exit \n";

    public static function mainMenu(): void
    {
        echo "Menu:\n";
        echo MENU::LOGIN;
        echo MENU::REGISTER;
        echo Menu::EXIT;
    }
    public static function loginMenu(): void
    {
        echo "Login Menu\n";
        echo MENU::BALANCE;
        echo MENU::WITHDRAW;
        echo Menu::DEPOSIT;
        echo Menu::TRANSFER;
        echo MENU::TRANSACTIONS;
        echo MENU::LOGINEXIT;
    }
    public static function adminMenu(): void
    {
        echo "Admin Menu\n";
        echo MENU::VIEWALLUSERS;
        echo MENU::VIEWALLTRANSACTIONS;
        echo Menu::VIEWUSERBYTRANSACTIONS;
        echo Menu::ADMINEXIT;
    }
}
