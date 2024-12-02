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
                    <a href="<?= site_url('admin/dashboard'); ?>" class="flex items-center gap-2 rounded-lg px-3 py-2 text-white bg-blue-500">
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
                <div class="flex items-center text-center justify-between mb-6">
                    <div class="text-3xl font-bold text-blue-500">QuizMaster</div>
                    <a href="<?= site_url('/admin/generate-reports') ?>" class="focus:outline-none bg-blue-500 hover:bg-blue-600 text-white transition-all ease-in-out rounded-lg shadow-md px-6 py-2 text-center">
                        Generate Reports
                    </a>
                </div>

                <div class="mb-8 grid gap-4 grid-cols-6 ">
                    <!-- users -->
                    <div class="col-span-3 flex flex-col bg-white  rounded-lg overflow-hidden  text-white shadow-md">
                        <div class="flex justify-between p-6 bg-gradient-to-br from-purple-500 to-purple-700">
                            <div class="flex flex-col  justify-center gap- font-bold text-2xl">
                                Total Users
                                <span class="text-base text-gray-200 font-normal">List of all users from QuizMaster</span>
                            </div>

                            <!-- users data -->
                            <div class=" flex items-center">
                                <p class="text-6xl font-bold"><?php echo $totalUser['active'] ?></p>
                            </div>
                        </div>
                        <div class="p-6 place-contents-center place-items-center">
                            <canvas id="userChart"></canvas>

                        </div>
                    </div>

                    <!-- all quiz -->
                    <div class="col-span-3 rounded-lg bg-white overflow-hidden text-white shadow-md">
                        <div class="flex justify-between bg-gradient-to-br from-blue-500 to-blue-700 p-6">
                            <div class="flex flex-col  justify-center gap- font-bold text-2xl">
                                Total Quizzes
                                <span class="text-sm text-gray-200 font-normal">List of all quizzes from QuizMaster</span>
                            </div>

                            <!-- users data -->
                            <div class=" flex items-center">
                                <p class="text-6xl font-bold"><?php echo $totalQuizzes['totalQuizzes'] ?></p>
                            </div>
                        </div>
                        <div class="p-6 place-contents-center place-items-center">
                            <canvas id="quizCategoryChart"></canvas>
                        </div>
                    </div>

                    <!-- leaderboard -->
                    <?php
                    if (isset($topPlayer) && is_array($topPlayer)) {
                        $points = isset($topPlayer['points']) ? $topPlayer['points'] : 'No Data';
                        $name = isset($topPlayer['name']) ? $topPlayer['name'] : 'Unknown';
                    } else {
                        $points = 'No Data';
                        $name = 'Unknown';
                    }
                    ?>
                    <div class="col-span-2 overflow-hidden rounded-lg bg-white text-white shadow-md">
                        <div class="flex justify-between  bg-gradient-to-br from-orange-500 to-orange-700 p-6">
                            <div class="flex flex-col justify-center font-bold text-2xl">
                                Top Player
                                <span class="text-base font-normal text-gray-200 ">
                                    Player with overall most points
                                </span>
                            </div>

                            <!-- users data -->
                            <div class=" flex flex-col justify-center items-center">
                                <p class="text-2xl font-bold">
                                    <?= htmlspecialchars($name) ?>
                                </p>
                                <span class="text-sm text-gray-200 ">
                                    Total points: <span class="text-white font-bold">

                                        <?= htmlspecialchars($points) ?>
                                    </span>
                                </span>

                            </div>
                        </div>
                        <div class="p-6">
                            <canvas id="topPlayersChart"></canvas>

                        </div>
                    </div>

                    <!-- avergae points -->
                    <div class="col-span-2 rounded-lg bg-white overflow-hidden text-white shadow-md">
                        <div class="flex justify-between bg-gradient-to-br from-green-500 to-green-700 p-6">
                            <div class="flex flex-col  justify-center gap- font-bold text-2xl">
                                Average Points
                                <span class="text-sm text-gray-200 font-normal">Average points per quiz</span>
                            </div>

                            <!-- users data -->
                            <div class=" flex items-center">
                                <p class="text-4xl font-bold"><?php echo number_format($averagePoints['avePoints'], 2); ?>
                                </p>
                            </div>
                        </div>
                        <div class="p-6 ">
                            <canvas id="avePoints"></canvas>
                        </div>
                    </div>

                    <!-- average accuracy -->
                    <div class="col-span-2 rounded-lg bg-white overflow-hidden text-dark shadow-md">
                        <div class="flex justify-between bg-gradient-to-br from-yellow-300 to-yellow-400 p-6">
                            <div class="flex flex-col  justify-center gap- font-bold text-2xl">
                                Average Accuracy
                                <span class="text-sm text-gray-700 font-normal">Average accuracy per quiz</span>
                            </div>

                            <!-- users data -->
                            <div class=" flex items-center">
                                <p class="text-4xl font-bold"><?php echo number_format($averageAccuracy['aveAccuracy'], 2) . '%'; ?>
                                </p>
                            </div>
                        </div>
                        <div class="p-6 ">
                            <canvas id="aveAccuracy"></canvas>
                        </div>
                    </div>


                </div>

                <!-- Recent Users Table -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white mb-8">
                    <div class="flex items-center justify-center p-6">
                        <div class="w-full">
                            <h2 class="text-2xl font-bold text-gray-900">New users</h2>
                            <p class="mt-2 text-sm text-gray-500">Manage all users from the quiz platform.</p>
                        </div>
                        <div class="w-full flex justify-end">
                            <a href="/admin/users" class="focus:outline-none text-white bg-purple-500 hover:bg-purple-600 hover:text-white transition-all ease-in-out rounded-lg shadow-md px-6 py-2 text-center">
                                View all
                            </a>
                        </div>

                    </div>
                    <table id="allUser" class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-white uppercase bg-purple-500">
                            <tr>
                                <th scope="col" class="px-6 py-3">Username</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Date created</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allUser as $user): ?>
                                <tr class="border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <?php echo $user['username'] ?>
                                    </th>
                                    <td class="px-6 py-4"><?php echo $user['email'] ?></td>
                                    <td class="px-6 py-4">
                                        <?php
                                        $date = date_create($user['created_at']);
                                        echo date_format($date, "F j, Y");
                                        ?>
                                    </td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="<?= site_url('admin/users/deactivate/' . $user['id']) ?>" class="font-medium bg-red-100 rounded-full px-3 py-1 text-red-600 hover:bg-red-200 hover:text-red-600 transition-all ease-in-out">Deactivate</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white mb-8 w-full">
                    <div class="flex justify-center items-center p-6">
                        <div class="w-full">
                            <h2 class="text-2xl font-bold text-gray-900">Recently added quizzes</h2>
                            <p class="mt-2 text-sm text-gray-500">Manage all quiz from QuizMaster.</p>
                        </div>


                        <div class="w-full flex justify-end">
                            <a href="/admin/quizzes" class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 hover:text-white transition-all ease-in-out rounded-lg shadow-md px-6 py-2 text-center">
                                View all
                            </a>
                        </div>
                    </div>
                    <table id="allQuiz" class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-white uppercase bg-blue-500">
                            <tr>

                                <th scope="col" class="px-6 py-3">
                                    Quiz Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php foreach ($allQuizzes as  $quiz): ?>
                                <tr class="border-b">

                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <?php echo $quiz['title'] ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?php echo $quiz['category_name'] ?>
                                    </td>

                                    <td class="px-6 py-4">
                                        <?php echo $quiz['quizType'] ?>
                                    </td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="<?= site_url('admin/quizzes/archive/' . $quiz['quiz_id']) ?>" class="font-medium bg-red-100 rounded-full px-3 py-1 text-red-600 hover:bg-red-200 hover:text-red-600 transition-all ease-in-out">Archive</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

                <div class=" relative overflow-x-auto shadow-md sm:rounded-lg bg-white mb-8 w-full">
                    <div class="flex justify-center items-center p-6">
                        <div class="w-full">
                            <h2 class="text-2xl font-bold text-gray-900">Latest player ranking</h2>
                            <p class="mt-2 text-sm text-gray-500">List of all player alongside with their rank.</p>
                        </div>
                        <div class="w-full flex justify-end">
                            <a href="/admin/leaderboards" class="focus:outline-none text-white bg-orange-500 hover:bg-orange-600 hover:text-white transition-all ease-in-out rounded-lg shadow-md px-6 py-2 text-center">
                                View all
                            </a>
                        </div>

                    </div>
                    <table id="totalPoints" class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-white uppercase bg-orange-500">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Rank
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Points
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Accuracy
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($totalPointsPlayers as $index => $points): ?>

                                <tr class="border-b">
                                    <td scope="row" class="px-6 py-4 ">
                                        <?php echo $index + 1 ?>
                                    </td>
                                    <th class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                        <?php echo $points['name'] ?>
                                    </th>

                                    <td class="px-6 py-4">
                                        <?php if ($points['points'] === null) {
                                            echo $points['points'] = 0 . ' pts';
                                        } else {
                                            echo $points['points'] . ' pts';
                                        }

                                        ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php
                                        // Use 0% as fallback if the value is not set or invalid
                                        $accuracy = isset($points['accuracy']) && is_numeric($points['accuracy']) ? $points['accuracy'] : 0;
                                        echo number_format($accuracy, 2) . '%';
                                        ?> </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

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


        // Total Users Chart
        const userChartCtx = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(userChartCtx, {
            type: 'pie',
            data: {
                labels: ['Active Users', 'Deactivated Users'],
                datasets: [{
                    data: [<?php echo $totalUser['active'] ?>, <?php echo $totalDeactivatedUser['deactivated'] ?>], // Replace second value with deactivated count if needed
                    backgroundColor: ['#a855f7', '#f97316'],
                }]
            }
        });

        document.getElementById('userChart').style.height = '300px';
        document.getElementById('userChart').style.width = '100%';

        // Quiz Category Chart
        const quizCategoryCtx = document.getElementById('quizCategoryChart').getContext('2d');
        const quizCategoryLabels = [<?php foreach ($allQuizzes as $quiz) {
                                        echo "'{$quiz['category_name']}',";
                                    } ?>];
        const quizCategoryData = [<?php foreach ($allQuizzes as $quiz) {
                                        echo "'{$quiz['total']}',";
                                    } ?>]; // Example data: adjust for actual category counts
        const quizCategoryChart = new Chart(quizCategoryCtx, {
            type: 'doughnut',
            data: {
                labels: quizCategoryLabels,
                datasets: [{
                    data: quizCategoryData,
                    backgroundColor: ['#FFC107', '#2196F3', '#FF5722', '#4CAF50'],
                }]
            }
        });

        document.getElementById('quizCategoryChart').style.height = '300px';
        document.getElementById('quizCategoryChart').style.width = '100%';

        // Top Players Chart
        const topPlayersCtx = document.getElementById('topPlayersChart').getContext('2d');
        const topPlayersLabels = [<?php foreach ($totalPointsPlayers as $player) {
                                        echo "'{$player['name']}',";
                                    } ?>];
        const topPlayersData = [<?php foreach ($totalPointsPlayers as $player) {
                                    echo "{$player['points']},";
                                } ?>];
        const topPlayersChart = new Chart(topPlayersCtx, {
            type: 'bar',
            data: {
                labels: topPlayersLabels,
                datasets: [{
                    label: 'Points',
                    data: topPlayersData,
                    backgroundColor: '#f97316',
                }]
            }
        });

        document.getElementById('topPlayersChart').style.height = '400px';
        document.getElementById('topPlayersChart').style.width = '100%';

        // average points
        const avePointsCtx = document.getElementById('avePoints').getContext('2d');
        const avePointsChart = new Chart(avePointsCtx, {
            type: 'bar',
            data: {
                labels: ['Average Points'], // Can include other categories or quizzes if needed
                datasets: [{
                    label: 'Average Points per Quiz',
                    data: [<?php echo number_format($averagePoints['avePoints'], 2); ?>], // Average value
                    backgroundColor: ['#4CAF50'],
                    borderColor: ['#388E3C'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => `${context.raw} Points`
                        }
                    }
                }
            }
        });


        // average accuracy
        const aveAccuracyCtx = document.getElementById('aveAccuracy').getContext('2d');
        const aveAccuracyChart = new Chart(aveAccuracyCtx, {
            type: 'bar',
            data: {
                labels: ['Average Accuracy'], // Can include other categories or quizzes if needed
                datasets: [{
                    label: 'Average Accuracy per Quiz',
                    data: [<?php echo number_format($averageAccuracy['aveAccuracy'], 2); ?>], // Average value
                    backgroundColor: ['#facc15'],
                    borderColor: ['#facc15'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => `${context.raw} Points`
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>