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
                <div class="w-full max-w-lg">
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="bg-gray-800 text-white text-lg font-semibold p-4">
                            Login
                        </div>
                        <div class="p-6">
                            <div class="bg-blue-100 text-blue-700 text-sm p-3 rounded mb-4">
                                <strong>Note:</strong> Password must be at least 8 characters and contain one of the following special characters (!@£$%^&*-_+=?), a number, uppercase, and lowercase letters.
                            </div>

                            <?php flash_alert(); ?>

                            <form id="myForm" action="<?= site_url('auth/set-new-password'); ?>" method="post">
                                <?php csrf_field(); ?>
                                <input type="hidden" name="token" value="<?php !empty($_GET['token']) && print $_GET['token']; ?>">

                                <div class="mb-4">
                                    <label for="password" class="block text-gray-700 font-semibold mb-2">New Password</label>
                                    <input id="password" type="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" name="password" required>
                                </div>

                                <div class="mb-4">
                                    <label for="re_password" class="block text-gray-700 font-semibold mb-2">Confirm New Password</label>
                                    <input id="re_password" type="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" name="re_password" required>
                                </div>

                                <div class="flex items-center justify-between">
                                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-700">
                                        Proceed
                                    </button>
                                    <a href="<?= site_url(); ?>" class="text-blue-500 hover:text-blue-700">
                                        Back to Home
                                    </a>
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
            var myForm = $("#myForm");
            if(myForm.length) {
                myForm.validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 8
                        },
                        re_password: {
                            required: true,
                            minlength: 8
                        }
                    },
                    messages: {
                        password: {
                            required: "Please input your password",
                            minlength: jQuery.validator.format("Password must be at least {0} characters.")
                        },
                        re_password: {
                            required: "Please input your password",
                            minlength: jQuery.validator.format("Password must be at least {0} characters.")
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
