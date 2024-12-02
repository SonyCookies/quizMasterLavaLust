<?php
include APP_DIR . 'views/templates/header.php';
?>

<body class="bg-gray-100 font-sans">
    <?php
    include APP_DIR . 'views/templates/nav_auth.php';
    ?>
    <main class="py-10">
        <div class="container mx-auto px-4">
            <div class="flex justify-center">
                <div class="w-full max-w-md">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="bg-blue-600 text-white text-xl font-semibold p-4">Login</div>
                        <div class="p-6">
                            <?php flash_alert(); ?>
                            <form id="logForm" method="POST" action="<?= site_url('auth/login'); ?>">
                                <?php csrf_field(); ?>

                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                                    <?php $LAVA = &lava_instance(); ?>
                                    <input id="email" type="email" class="block w-full px-3 py-2 border rounded-md <?php echo $LAVA->session->flashdata('is_invalid') ? 'border-red-500' : 'border-gray-300'; ?>" name="email" required autocomplete="email" autofocus>
                                    <?php if ($LAVA->session->flashdata('err_message')): ?>
                                        <p class="text-red-500 text-xs mt-1">
                                            <strong><?php echo $LAVA->session->flashdata('err_message'); ?></strong>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-6">
                                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                                    <input id="password" type="password" class="block w-full px-3 py-2 border rounded-md border-gray-300" name="password" minlength="8" required autocomplete="current-password">
                                </div>

                                <div class="flex items-center justify-between">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">
                                        Login
                                    </button>

                                    <a href="<?= site_url('auth/password-reset'); ?>" class="text-sm text-blue-500 hover:text-blue-700">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- jQuery and validation scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script>
        $(function() {
            var logForm = $("#logForm");
            if (logForm.length) {
                logForm.validate({
                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 8
                        }
                    },
                    messages: {
                        email: {
                            required: "Please input your email address.",
                            email: "Please enter a valid email address."
                        },
                        password: {
                            required: "Please input your password.",
                            minlength: "Password must be at least 8 characters."
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>