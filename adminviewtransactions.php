<?php
session_start();
require_once './vendor/autoload.php';

use App\Web\Admin;
use App\Web\Date;

$pagetitle = "All Transactions";
include './layouts/header.php';
$admin = new Admin();
$result = $admin->viewAllTransactions();
?>



<body class="h-full">
    <div class="min-h-full">
        <div class="bg-sky-600 pb-32">
            <!-- Navigation -->
            <?php include './layouts/adminnavbar.php'; ?>
            <header class="py-10">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-white">
                        Transactions
                    </h1>
                </div>
            </header>
        </div>

        <main class="-mt-32">
            <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg py-8">
                    <!-- List of All The Transactions -->
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <p class="mt-2 text-sm text-gray-700">
                                    List of transactions made by the customers.
                                </p>
                            </div>
                        </div>
                        <div class="mt-8 flow-root">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                                    Customer Name
                                                </th>
                                                <th scope="col" class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                                    Email
                                                </th>
                                                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Amount
                                                </th>
                                                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Date
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">

                                            <?php if (count($result)) foreach ($result as $arr) : ?>

                                                <tr>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-800 sm:pl-0"><?php echo $arr->receiver_name; ?></td>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-0">
                                                        <?php echo $arr->receiver_email; ?></td>
                                                    <td class="whitespace-nowrap px-2 py-4 text-sm font-medium <?php echo ($arr->type == 'Deposit') ? 'text-emerald-600' : 'text-red-600'; ?>">
                                                        <?php echo ($arr->type == 'Deposit') ? '+' . $arr->amount : '-' . $arr->amount; ?>
                                                    </td>


                                                    <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                                                        <?php
                                                        $date = $arr->date;
                                                        echo  Date::formatter(date: $date, format: 'd M Y h:i:A')



                                                        ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php if (!count($result)) echo "You dont have any transactions"; ?>






                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>