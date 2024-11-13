<?php
include APP_DIR . 'views/templates/header.php';
?>

<body class="bg-gradient-to-br from-quiz-blue to-quiz-light min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>
    <main class="flex-grow container mx-auto px-4 py-8">
      <!-- Dashboard Header -->
      <div class="text-center mb-12">
        <h2 class="text-5xl font-bold text-white mb-4">Welcome to QuizMaster</h2>
        <p class="text-xl text-white/80">Your journey to knowledge begins here!</p>
      </div>

      <div class="grid md:grid-cols-2 gap-8">
        <!-- Make a Quiz Section -->
        <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl transform hover:scale-105 transition duration-300">
          <div class="p-8 text-center">
            <div class="w-20 h-20 bg-quiz-blue rounded-full flex items-center justify-center mx-auto mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
            </div>
            <h3 class="text-3xl font-semibold text-white mb-4">Create Your Quiz</h3>
            <p class="text-white/80 mb-6">Craft your own quiz and challenge others with your knowledge!</p>
            <a href="<?= site_url('quiz/create'); ?>" class="bg-white text-quiz-blue font-bold py-3 px-6 rounded-full inline-block hover:bg-quiz-light hover:text-white transition duration-300">Start Creating</a>
          </div>
        </div>

        <!-- List of Quizzes Section -->
        <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
          <div class="p-8">
            <h3 class="text-3xl font-semibold text-white text-center mb-6">Available Quizzes</h3>
            <ul class="space-y-4">
              <?php foreach ($quizzes as $quiz): ?>
                <li class="bg-white/20 rounded-lg p-4 flex justify-between items-center hover:bg-white/30 transition duration-300">
                  <span class="text-white font-medium"><?= htmlspecialchars($quiz['title']) ?></span>
                  <a href="<?= site_url('take-quiz?quiz_id=' . $quiz['quiz_id']) ?>" class="bg-quiz-blue text-white font-medium py-2 px-4 rounded-full hover:bg-white hover:text-quiz-blue transition duration-300">Take Quiz</a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>

      <!-- Quick Stats Section -->
      <div class="mt-12 bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl p-8">
        <h3 class="text-3xl font-semibold text-white text-center mb-8">Your Quiz Journey</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="text-center">
            <div class="text-4xl font-bold text-white mb-2">15</div>
            <div class="text-white/80">Quizzes Taken</div>
          </div>
          <div class="text-center">
            <div class="text-4xl font-bold text-white mb-2">3</div>
            <div class="text-white/80">Quizzes Created</div>
          </div>
          <div class="text-center">
            <div class="text-4xl font-bold text-white mb-2">89%</div>
            <div class="text-white/80">Average Score</div>
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