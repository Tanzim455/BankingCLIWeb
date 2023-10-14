<?php

use App\Web\Date;

session_start();
require_once './vendor/autoload.php';

?>

<?php
$pagetitle = "View Transaction of Specific user";
include './layouts/header.php';


?>

<?php
if (isset($_SESSION['result'])) {
    $result = $_SESSION['result'];

    // Use $result as needed

    // Unset the session variable to clear it after use
    unset($_SESSION['result']);
}
if (isset($_SESSION['errormessage'])) {
    $errormessage = $_SESSION['errormessage'];

    // Use $result as needed

    // Unset the session variable to clear it after use
    unset($_SESSION['errormessage']);
}

?>



<body class="h-full">
    <div class="min-h-full">
        <div class="bg-sky-600 pb-32">
            <!-- Navigation -->
            <?php

            include './layouts/adminnavbar.php';

            ?>
            <header class="py-10">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div>
                        <form action="actionviewtransactionadmin.php" method="post">
                            <input type="text" name="check_email" id="fir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter users email">
                            <input type="submit" name="add_record" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" />

                        </form>

                    </div>
                </div>
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-white">
                        Transactions of Al Nahian
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
                                    List of transactions made by Al Nahian.
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
                                                    Receiver Name
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

                                            <?php if (isset($result)) foreach ($result as $arr) : ?>

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
                                            <?php if (isset($errormessage)) echo "The email does not have any transactions"; ?>







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