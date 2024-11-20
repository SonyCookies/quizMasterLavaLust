<?php
include APP_DIR . 'views/templates/header.php';
?>

<style>
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.open {
            transform: translateX(0);
        }
    }
</style>

<body class="min-h-screen bg-gray-50/90">
    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar fixed left-0 top-0 z-40 h-screen w-64 border-r bg-white transition-transform duration-300 ease-in-out md:translate-x-0">
            <div class="flex h-full flex-col">
                <div class="flex h-14 items-center justify-between border-b px-4">
                    <h1 class="text-lg font-bold text-blue-600">QuizMaster Admin</h1>
                    <button id="closeSidebar" class="md:hidden">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <nav class="flex-1 space-y-1 px-2 py-4">
                    <a href="<?= site_url('admin/dashboard'); ?>" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="<?= site_url('admin/users'); ?>" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Users
                    </a>
                    <a href="<?= site_url('admin/quizzes'); ?>" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Quizzes
                    </a>
                    <a href="<?= site_url('admin/leaderboards'); ?>" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Leaderboard
                    </a>
                    <a href="<?= site_url('admin/settings'); ?>" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Settings
                    </a>
                </nav>
                <div class="border-t p-4">
                    <a href="<?= site_url('auth/logout'); ?>" class="flex items-center gap-2 rounded-lg px-3 py-2 text-red-500 hover:bg-red-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 md:ml-64">
            <!-- Header -->
            <header class="flex h-14 items-center justify-between border-b bg-white px-4">
                <div class="flex items-center gap-2">
                    <button id="sidebarToggle" class="md:hidden">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <div class="relative">
                        <svg class="absolute left-2 top-2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" class="w-full rounded-md border border-gray-300 pl-8 pr-4 py-2 focus:border-blue-500 focus:ring-blue-500 sm:w-64" placeholder="Search...">
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative inline-block h-8 w-8 rounded-full bg-gray-200">
                        <img src="/placeholder-user.jpg" alt="User Avatar" class="h-full w-full rounded-full object-cover">
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-4 md:p-6">
                <div class="mb-8 grid gap-4 grid-cols-6">
                    <!-- total -->
                    <div class="col-span-2 flex justify-between rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 p-6 text-white shadow-md">
                        <div class="flex items-center  justify-center gap-3 font-bold text-2xl">
                            Total Quizzes
                        </div>

                        <!-- users data -->
                        <div class=" flex items-center">
                            <p class="text-6xl font-bold"><?php echo $totalQuizzes['totalQuizzes'] ?></p>
                        </div>
                    </div>

                    <!-- approval -->
                    <div class="col-span-2 flex justify-between rounded-lg bg-gradient-to-br from-orange-500 to-orange-600 p-6 text-white shadow-md">
                        <div class="flex items-center justify-center gap-3 font-bold text-2xl">
                            Pending Quizzes
                        </div>

                        <!-- users data -->
                        <div class=" flex items-center">
                            <p class="text-6xl font-bold"><?php echo $pendingQuizzes['pendingQuizzes'] ?></p>
                        </div>
                    </div>

                    <!-- archived -->
                    <div class="col-span-2 flex justify-between rounded-lg bg-gradient-to-br from-green-500 to-green-600 p-6 text-white shadow-md">
                        <div class="flex items-center justify-center gap-3 font-bold text-2xl">
                            Archived Quizzes
                        </div>

                        <!-- users data -->
                        <div class=" flex items-center">
                            <p class="text-6xl font-bold"><?php echo $archivedQuizzes['archivedQuizzes'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="flex-items-center mb-8">
                    <button type="button" id="openAddCategory" class="focus:outline-none bg-yellow-300 hover:bg-yellow-400 transition-all ease-in-out rounded-lg shadow-md px-6 py-2 text-center">
                        Add Category
                    </button>
                </div>
                <div class="flex justify-center gap-6">
                    <!-- approval -->
                    <div class="flex w-full items-start justify-center">
                        <?php include APP_DIR . 'views/templates/adminQuizTemplates/pendingQuizTable.php'; ?>

                    </div>
                    <div class="flex w-full items-start justify-center">
                        <?php include APP_DIR . 'views/templates/adminQuizTemplates/archivedQuizTable.php'; ?>
                    </div>
                    <!-- archived quizzes -->
                </div>

                <!-- list of all quizzes -->
                <?php include APP_DIR . 'views/templates/adminQuizTemplates/allQuizTable.php'; ?>
            </div>
        </main>
    </div>

    </div>

    <!-- add category modal -->
    <div id="addCategory" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full bg-black bg-opacity-50">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add Category
                    </h3>
                    <button id="closeAddCategory" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="<?= site_url('admin/quizzes/add-category') ?>" method="post">
                    <div class="flex flex-col gap-3">
                        <div>
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <input type="text" name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter category" required="">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write category description here"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="flex items-center justify-center px-6 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg mt-6 text-white">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add new category
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const closeSidebar = document.getElementById('closeSidebar');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });

            closeSidebar.addEventListener('click', function() {
                sidebar.classList.remove('open');
            });
        });

        // add category
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("addCategory");
            const openModalButton = document.getElementById("openAddCategory");
            const closeModalButton = document.getElementById("closeAddCategory");

            function showModal() {
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            }

            // Function to hide the modal
            function hideModal() {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
            }

            // Event listeners for the buttons
            openModalButton.addEventListener("click", showModal);
            closeModalButton.addEventListener("click", hideModal);

            modal.addEventListener("click", function(event) {
                if (event.target === modal) {
                    hideModal();
                }
            });
        });
    </script>
</body>

</html>