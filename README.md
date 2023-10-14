#PHPBankingCLIWEBApp

From main directory go to migrate.php 

Before running the migrate.php from Cli ensure that PDO settings of your environment matches if it doesnt go to 
Src folder there in Web folder there is a class called Database where there is a function called run make adjustments as per your environment

new PDO("mysql:host=$this->server;dbname=bankingapp", $this->username, $this->password);

You can now run migrate.php it will create 2 tables and insert data of an admin
php migrate.php 
For running CLI part run it form indexcli.php