<?php
include APP_DIR . 'views/templates/header.php';
?>

<body>
  <div id="app" class="bg-gray-100 min-h-screen flex flex-col">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>
    <main class="mt-5 pt-3 flex-grow">
      <div class="container mx-auto px-4">
        <!-- Dashboard Header -->
        <div class="text-center mb-5">
          <h2 class="text-4xl font-bold text-gray-800">Dashboard</h2>
          <p class="text-gray-500">You are logged in!</p>
        </div>

        <!-- Make a Quiz Section -->
        <div class="mb-4">
          <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 text-center">
              <h3 class="text-2xl font-semibold text-gray-800">Make a Quiz</h3>
              <p class="text-gray-500 mt-2">Create your own quiz by adding questions and answers for others to take!</p>
              <a href="<?= site_url('quiz/create'); ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded w-full mt-4 inline-block">Start Creating</a>
            </div>
          </div>
        </div>

        <!-- List of Quizzes Section -->
        <div>
          <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
              <h3 class="text-2xl font-semibold text-gray-800 text-center">List of Quizzes</h3>
              <p class="text-gray-500 text-center mt-2">Choose from the available quizzes and test your knowledge!</p>

              <!-- Dynamic List of quizzes with 'Take a Quiz' buttons -->
              <ul class="mt-4 space-y-4">
                <?php foreach ($quizzes as $quiz): ?>
                  <li class="flex justify-between items-center bg-gray-100 rounded-lg p-4">
                    <span class="text-gray-700"><?= htmlspecialchars($quiz['title']) ?></span>
                    <a href="<?= site_url('take-quiz?quiz_id=' . $quiz['quiz_id']) ?>" class="text-green-600 border border-green-600 hover:bg-green-600 hover:text-white font-medium py-1 px-3 rounded text-sm">Take a Quiz</a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>

  <!-- Additional Scripts, if needed -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>

</html>