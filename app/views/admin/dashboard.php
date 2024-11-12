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
                    <a href="#" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Users
                    </a>
                    <a href="#" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Quizzes
                    </a>
                    <a href="#" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Leaderboard
                    </a>
                    <a href="#" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Settings
                    </a>
                </nav>
                <div class="border-t p-4">
                    <a href="#" class="flex items-center gap-2 rounded-lg px-3 py-2 text-red-500 hover:bg-red-100">
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
                <div class="mb-8 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Active Users Card -->
                    <div class="rounded-lg bg-gradient-to-br from-purple-500 to-purple-600 p-6 text-white shadow-sm">
                        <div class="flex items-center gap-2">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <h3 class="font-medium">Active Users</h3>
                        </div>
                        <p class="mt-4 text-3xl font-bold">2,543</p>
                        <p class="text-purple-100">Increased by 15%</p>
                    </div>

                    <!-- Total Quizzes Card -->
                    <div class="rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 p-6 text-white shadow-sm">
                        <div class="flex items-center gap-2">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <h3 class="font-medium">Total Quizzes</h3>
                        </div>
                        <p class="mt-4 text-3xl font-bold">1,250</p>
                        <p class="text-blue-100">Added this month: 125</p>
                    </div>

                    <!-- Quiz Completions Card -->
                    <div class="rounded-lg bg-gradient-to-br from-orange-500 to-orange-600 p-6 text-white shadow-sm">
                        <div class="flex items-center gap-2">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <h3 class="font-medium">Quiz Completions</h3>
                        </div>
                        <p class="mt-4 text-3xl font-bold">15,234</p>
                        <p class="text-orange-100">This week: 2,345</p>
                    </div>
                </div>

                <!-- Recent Users Table -->
                <div class="overflow-x-auto rounded-lg border bg-white shadow-sm">
                    <div class="border-b p-4">
                        <h2 class="text-lg font-medium">Recent User Activity</h2>
                    </div>
                    <table class="w-full">
                        <thead>
                            <tr class="border-b bg-gray-50 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Role</th>
                                <th class="px-6 py-3">Joined</th>
                                <th class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php
                            $users = [
                                ['name' => 'John Smith', 'email' => 'john@example.com', 'role' => 'Student', 'joined' => '2024-02-15', 'status' => 'Active'],
                                ['name' => 'Sarah Johnson', 'email' => 'sarah@example.com', 'role' => 'Teacher', 'joined' => '2024-02-14', 'status' => 'Active'],
                                ['name' => 'Michael Brown', 'email' => 'michael@example.com', 'role' => 'Student', 'joined' => '2024-02-13', 'status' => 'Pending'],
                                ['name' => 'Emily Davis', 'email' => 'emily@example.com', 'role' => 'Student', 'joined' => '2024-02-12', 'status' => 'Inactive'],
                            ];

                            foreach ($users as $user):
                            ?>
                                <tr>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900"><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"><?php echo htmlspecialchars($user['role']); ?></td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"><?php echo htmlspecialchars($user['joined']); ?></td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm">
                                        <?php
                                        $statusClass = 'bg-green-100 text-green-600';
                                        if ($user['status'] === 'Pending') {
                                            $statusClass = 'bg-yellow-100 text-yellow-600';
                                        } elseif ($user['status'] === 'Inactive') {
                                            $statusClass = 'bg-red-100 text-red-600';
                                        }
                                        ?>
                                        <span class="rounded-full <?php echo $statusClass; ?> px-2 py-1 text-xs font-medium"><?php echo htmlspecialchars($user['status']); ?></span>
                                    </td>
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
    </script>
</body>

</html>