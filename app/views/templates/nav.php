<nav class="bg-gradient-to-l from-quiz-900 to-blue-700 shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            <!-- Brand -->
            <a href="<?= site_url(); ?>" class="text-2xl font-bold text-white hover:text-gray-200 transition duration-300">
                QuizMaster
            </a>

            <!-- Mobile Menu Button -->
            <button class="text-white hover:text-gray-200 focus:outline-none focus:text-gray-200 md:hidden" type="button" id="mobileMenuButton" aria-label="Toggle navigation">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </button>

            <!-- Navigation Links -->
            <div class="hidden md:flex md:items-center md:space-x-6" id="navbarContent">
                <!-- Left Side Of Navbar -->
                <ul class="flex space-x-4">
                    <li><a href="<?= site_url('quizzes'); ?>" class="text-white hover:text-gray-200 transition duration-300">Quizzes</a></li>
                    <li><a href="<?= site_url('leaderboard'); ?>" class="text-white hover:text-gray-200 transition duration-300">Leaderboard</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="flex items-center space-x-4">
                    <?php if (!logged_in()): ?>
                        <li>
                            <a href="<?= site_url('auth/login'); ?>" class="text-white hover:text-gray-200 transition duration-300">Login</a>
                        </li>
                        <li>
                            <a href="<?= site_url('auth/register'); ?>" class="bg-white text-quiz-blue hover:bg-gray-200 transition duration-300 py-2 px-4 rounded-full font-medium">Register</a>
                        </li>
                    <?php else: ?>
                        <li class="relative group">
                            <button class="text-white hover:text-gray-200 transition duration-300 flex items-center space-x-1">
                                <span><?= html_escape(get_username(get_user_id())); ?></span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <ul class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block z-50">
                                <li><a href="<?= site_url('profile'); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a></li>
                                <li>
                                    <hr class="my-1 border-gray-200">
                                </li>
                                <li><a href="<?= site_url('auth/logout'); ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobileMenuButton').addEventListener('click', function() {
        var navbarContent = document.getElementById('navbarContent');
        navbarContent.classList.toggle('hidden');
        navbarContent.classList.toggle('block');
    });
</script>