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

<body class="min-h-screen bg-gray-50">
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
                    <a href="<?= site_url('admin/leaderboards'); ?>" class="flex items-center gap-2 rounded-lg px-3 py-2 text-white bg-blue-500">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Leaderboards
                    </a>
                    <a href="<?= site_url('admin/change-password'); ?>" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Change password
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


            <!-- Dashboard Content -->
            <div class="p-4 md:p-6">
                <div class="mb-8 grid grid-cols-4 gap-4">
                    <!-- total -->
                    <?php
                    if (isset($topPlayer) && is_array($topPlayer)) {
                        $points = isset($topPlayer['points']) ? $topPlayer['points'] : 'No Data';
                        $name = isset($topPlayer['name']) ? $topPlayer['name'] : 'Unknown';
                    } else {
                        $points = 'No Data';
                        $name = 'Unknown';
                    }
                    ?>
                    <div class="col-span-2 flex justify-between rounded-lg bg-gradient-to-br from-blue-500 to-blue-700 p-6 text-white shadow-md">
                        <div class="flex flex-col justify-center font-bold text-2xl">
                            Top Player
                            <span class="text-base font-normal text-gray-200 ">
                                Player with overall most points
                            </span>
                        </div>

                        <!-- users data -->
                        <div class=" flex flex-col justify-center items-center">
                            <p class="text-3xl font-bold">
                                <?= htmlspecialchars($name) ?>
                            </p>
                            <span class="text-base text-gray-200 ">
                                Total points: <span class="text-white font-bold">

                                    <?= htmlspecialchars($points) ?>
                                </span>
                            </span>

                        </div>
                    </div>

                    <!-- approval -->
                    <?php
                    if (isset($topWeeklyPlayer) && is_array($topWeeklyPlayer)) {
                        $weeklyPoints = isset($topWeeklyPlayer['points']) ? $topWeeklyPlayer['points'] : 'No Data';
                        $weeklyName = isset($topWeeklyPlayer['name']) ? $topWeeklyPlayer['name'] : 'Unknown';
                    } else {
                        $weeklyPoints = 'No Data';
                        $weeklyName = 'Unknown';
                    }
                    ?>
                    <div class="col-span-2 flex justify-between rounded-lg bg-gradient-to-br from-purple-500 to-purple-700 p-6 text-white shadow-md">
                        <div class="flex flex-col justify-center font-bold text-2xl">
                            Top Weekly Player
                            <span class="text-base font-normal text-gray-200 ">
                                Player with most points this week
                            </span>
                        </div>

                        <!-- users data -->
                        <div class=" flex flex-col justify-center items-center">
                            <p class="text-3xl font-bold">
                                <?= htmlspecialchars($weeklyName) ?>
                            </p>
                            <span class="text-base text-gray-200 ">
                                Total points: <span class="text-white font-bold">
                                    <?= htmlspecialchars($weeklyPoints) ?>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <?php include APP_DIR . 'views/templates/adminLeaderboardTemplates/totalPoints.php' ?>


                <?php include APP_DIR . 'views/templates/adminLeaderboardTemplates/weeklyPoints.php' ?>


            </div>
        </main>
    </div>

    <script>
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
    </script>
</body>

</html>