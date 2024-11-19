<?php
include APP_DIR . 'views/templates/header.php';
?>

<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>
    <main class="flex-grow container mx-auto px-4 py-16">
      <!-- Dashboard Header -->
      <div class="text-center mb-16">
        <h2 class="text-6xl font-extrabold text-white mb-4 leading-tight">Welcome to QuizMaster</h2>
        <p class="text-2xl text-white/80 max-w-3xl mx-auto">Your journey to knowledge begins here! Create, take quizzes, and track your progress.</p>
      </div>

      <div class="grid md:grid-cols-2 gap-12">
        <!-- Make a Quiz Section -->
        <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl overflow-hidden shadow-xl transform hover:scale-105 transition duration-300">
          <div class="p-10 text-center">
            <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-8">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
            </div>
            <h3 class="text-4xl font-bold text-white mb-6">Create Your Quiz</h3>
            <p class="text-white/90 mb-8 text-lg">Craft your own quiz and challenge others with your knowledge!</p>
            <a href="<?= site_url('quiz/create'); ?>" class="bg-white text-indigo-600 font-bold py-4 px-8 rounded-full inline-block hover:bg-indigo-100 hover:scale-105 transition duration-300 shadow-lg hover:shadow-xl">
              Start Creating
            </a>
          </div>
        </div>

        <!-- List of Quizzes Section -->
        <div class="bg-gradient-to-br from-blue-600 to-teal-500 rounded-2xl overflow-hidden shadow-xl">
          <div class="p-10">
            <h3 class="text-4xl font-bold text-white text-center mb-8">Available Quizzes</h3>
            <ul class="space-y-4">
              <?php foreach ($quizzes as $quiz): ?>
                <li class="bg-white/20 rounded-lg p-4 flex justify-between items-center hover:bg-white/30 transition duration-300">
                  <span class="text-white font-medium text-lg"><?= htmlspecialchars($quiz['title']) ?></span>
                  <a href="<?= site_url('quiz/take/' . $quiz['quizType'] . '/' . $quiz['quiz_id']) ?>"

                    class="bg-white text-blue-600 font-bold py-2 px-6 rounded-full hover:bg-blue-100 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                    Take Quiz
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>

      <!-- Quick Stats Section -->
      <div class="mt-16 bg-gradient-to-br from-orange-500 to-pink-500 rounded-2xl overflow-hidden shadow-xl p-10">
        <h3 class="text-4xl font-bold text-white text-center mb-12">Your Quiz Journey</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
          <div class="text-center bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition duration-300">
            <div class="text-5xl font-bold text-white mb-4"><?= $quizzesTakenCount ?></div>
            <div class="text-white/90 text-xl">Quizzes Taken</div>
          </div>
          <div class="text-center bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition duration-300">
            <div class="text-5xl font-bold text-white mb-4"><?= $quizzesCreatedCount ?></div>
            <div class="text-white/90 text-xl">Quizzes Created</div>
          </div>
          <div class="text-center bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition duration-300">
            <div class="text-5xl font-bold text-white mb-4"><?= $averageScoreValue ?>%</div>
            <div class="text-white/90 text-xl">Average Score</div>
          </div>
        </div>
      </div>
    </main>

    <?php
    include APP_DIR . 'views/templates/footer.php';
    ?>


  </div>

  <!-- Additional Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>

</html>