<?php

use App\Login;
use App\Web\Redirect;



require_once './vendor/autoload.php';
session_start();
Redirect::ifNotAuthenticated(sessionname: "email", location: "location:login.php");

$authuseremail = $_SESSION["email"];
$login = new Login();
$balance = $login->viewAuthUsersBalance(authuseremail: $authuseremail);
?>

<?php
$pagetitle = "Withdraw Balance";
include './layouts/header.php';

?>

<body class="h-full">
    <div class="min-h-full">
        <div class="bg-emerald-600 pb-32">
            <!-- Navigation -->
            <?php
            include './layouts/navbar.php';
            ?>
            <header class="py-10">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-white">
                        Deposit Balance
                    </h1>
                </div>
            </header>
        </div>

        <main class="-mt-32">
            <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg p-2">
                    <!-- Current Balance Stat -->
                    <?php
                    include './layouts/balance.php';

                    ?>

                    <hr />
                    <!-- Deposit Form -->
                    <div class="sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-semibold leading-6 text-gray-800">
                                Transfer Money from your account
                            </h3>
                            <div class="mt-4 text-sm text-gray-500">
                                <form action="actiontransfer.php" method="POST">
                                    <input type="email" name="receiver_email" id="email" class="block w-full ring-0 outline-none py-2 text-gray-800 border-b placeholder:text-gray-400 md:text-4xl" placeholder="Recipient's Email Address" required />

                                    <!-- Amount -->
                                    <div class="relative mt-4 md:mt-8">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-0">
                                            <span class="text-gray-400 md:text-4xl">$</span>
                                        </div>
                                        <input type="number" name="transfer" id="amount" class="block w-full ring-0 outline-none pl-4 py-2 md:pl-8 text-gray-800 border-b border-b-emerald-500 placeholder:text-gray-400 md:text-4xl" placeholder="0.00" required />
                                    </div>
                                    <div class="mt-5">
                                        <input type="submit" name="add_record" class="w-full px-6 py-3.5 text-base font-medium text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 rounded-lg md:text-xl text-center">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>