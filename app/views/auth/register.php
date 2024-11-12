<?php
include APP_DIR . 'views/templates/header.php';
?>

<body class="bg-gray-100 font-sans">
    <?php include APP_DIR . 'views/templates/nav_auth.php'; ?>

    <main class="py-10">
        <div class="container mx-auto px-4">
            <div class="flex justify-center">
                <div class="w-full max-w-lg">
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="bg-gray-800 text-white text-lg font-semibold p-4">
                            Register
                        </div>
                        <div class="p-6">
                            <?php flash_alert(); ?>
                            <form id="regForm" method="POST" action="<?= site_url('auth/register'); ?>">
                                <?php csrf_field(); ?>

                                <div class="mb-6">
                                    <label for="username" class="block text-gray-700 font-semibold mb-2">Username</label>
                                    <input id="username" type="text" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" name="username" required>
                                </div>

                                <div class="mb-6">
                                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                                    <input id="email" type="email" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" name="email" required>
                                </div>

                                <div class="mb-6">
                                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                                    <input id="password" type="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" name="password" required>
                                </div>

                                <div class="mb-6">
                                    <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                                    <input id="password_confirmation" type="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" name="password_confirmation" required>
                                </div>

                                <div class="flex items-center justify-end">
                                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-700">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            var regForm = $("#regForm");
            if (regForm.length) {
                regForm.validate({
                    rules: {
                        email: {
                            required: true
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        password_confirmation: {
                            required: true,
                            minlength: 8
                        },
                        username: {
                            required: true,
                            minlength: 5,
                            maxlength: 20
                        }
                    },
                    messages: {
                        email: {
                            required: "Please input your email address."
                        },
                        password: {
                            required: "Please input your password",
                            minlength: jQuery.validator.format("Password must be at least {0} characters.")
                        },
                        password_confirmation: {
                            required: "Please input your password",
                            minlength: jQuery.validator.format("Password must be at least {0} characters.")
                        },
                        username: {
                            required: "Please input your username."
                        }
                    },
                });
            }
        });
    </script>
</body>

</html>