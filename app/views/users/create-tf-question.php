<?php
include APP_DIR . 'views/templates/header.php';
?>

<body>
  <div id="app" class="bg-gray-100 min-h-screen flex flex-col">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>


    <main class="mt-5 pt-3 flex-grow">
      <p>True or False</p>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <script>
    <?php if (isset($message)): ?>

      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      };
      toastr.success("<?php echo $message; ?>");
    <?php endif; ?>
  </script>

</body>

</html>