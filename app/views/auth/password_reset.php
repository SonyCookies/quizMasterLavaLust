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
                            Reset Password
                        </div>
                        <div class="p-6">
                            <form method="POST" action="<?= site_url('auth/password-reset'); ?>">
                                <?php csrf_field(); ?>

                                <div class="mb-6">
                                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                                    <?php $LAVA =& lava_instance(); ?>
                                    <input id="email" type="email" class="w-full px-4 py-2 border <?= $LAVA->session->flashdata('alert') ? 'border-red-500' : 'border-gray-300'; ?> rounded focus:outline-none focus:border-blue-500" name="email" required>
                                    <div class="mt-2">
                                        <span class="invalid-feedback text-red-500 text-sm">
                                            <strong>We can't find a user with that email address.</strong>
                                        </span>
                                        <span class="valid-feedback text-green-500 text-sm">
                                            <strong>Reset password link was sent to your email.</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end">
                                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-700">
                                        Send Password Reset Link
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
</body>
</html>
