<nav class="bg-white shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            <!-- Brand -->
            <a href="<?= site_url(); ?>" class="text-xl font-semibold text-gray-800">
                LavaLust UI
            </a>

            <!-- Mobile Menu Button -->
            <button class="text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800 md:hidden" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 5h14M3 10h14M3 15h14" clip-rule="evenodd"></path>
                </svg>
            </button>

            <!-- Navigation Links -->
            <div class="hidden w-full md:flex md:items-center md:justify-between" id="navbarSupportedContent">
                <!-- Left Side Of Navbar (Empty) -->
                <ul class="flex space-x-4"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="flex space-x-4">
                    <li>
                        <a href="<?= site_url('auth/login'); ?>" class="text-gray-600 hover:text-gray-800">Login</a>
                    </li>
                    <li>
                        <a href="<?= site_url('auth/register'); ?>" class="text-gray-600 hover:text-gray-800">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
