<?php
session_start();
require_once './vendor/autoload.php';

use App\Web\Redirect;

$pagetitle = "Add Customers";
include './layouts/header.php';


Redirect::ifNotAuthenticated(sessionname: "email", location: "location:login.php");



?>

<body class="h-full">
    <div class="min-h-full">
        <div class="pb-32 bg-sky-600">
            <!-- Navigation -->
            <?php include './layouts/adminnavbar.php'; ?>

            <header class="py-10">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-white">
                        Add a New Customer
                    </h1>
                </div>
            </header>
        </div>

        <main class="-mt-32">
            <div class="px-4 pb-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg">
                    <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2" action="adminactionregsiter.php" method="POST">
                        <div class="px-4 py-6 sm:p-8">
                            <?php if (isset($_SESSION['successmessage'])) : ?>
                                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        <span class="font-medium"><?php echo $_SESSION['successmessage'];
                                                                    unset($_SESSION['successmessage']);
                                                                    ?></span>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                <div class="sm:col-span-3">
                                    <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                    <div class="mt-2">
                                        <input type="text" name="name" id="first-name" autocomplete="given-name" required class="block w-full p-2 text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6" />
                                    </div>
                                </div>



                                <div class="sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Address</label>
                                    <div class="mt-2">
                                        <input type="email" name="email" id="email" autocomplete="email" required class="block w-full p-2 text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6" />
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                    <div class="mt-2">
                                        <input type="password" name="password" id="password" autocomplete="password" required class="block w-full p-2 text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
                            <button type="reset" class="text-sm font-semibold leading-6 text-gray-900">
                                Cancel
                            </button>
                            <input type="submit" name="add_record" class="px-3 py-2 text-sm font-semibold text-white 
                            rounded-md shadow-sm bg-sky-600 hover:bg-sky-500 focus-visible:outline 
                            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">

                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>