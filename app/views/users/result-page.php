<?php
include APP_DIR . 'views/templates/header.php';
?>

<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>

    <main class="flex-grow container mx-auto px-4 py-8">
      <!-- Dashboard Header -->
      <div class="text-center mb-12">
        <h2 class="text-5xl font-bold text-white mb-4">Quiz Results</h2>
        <p class="text-xl text-white/80">Your journey through the quiz!</p>
      </div>

      <!-- Results Summary Section -->
      <div class="bg-gradient-to-r from-quiz-blue to-quiz-purple rounded-xl overflow-hidden shadow-2xl p-10 text-white mb-10">
        <!-- Quiz Details Section -->
        <div class="grid grid-cols-2 gap-4 text-lg font-medium mb-8">
          <p>Quiz Title:</p>
          <p class="text-right font-semibold"><?= htmlspecialchars($quiz['title']) ?></p>
          <p>Total Questions:</p>
          <p class="text-right font-semibold"><?= $result['total_questions'] ?></p>
          <p>Total Points:</p>
          <p class="text-right font-semibold"><?= $result['total_points'] ?></p>
          <p>Your Score:</p>
          <p class="text-right font-semibold"><?= $result['score'] ?> / <?= $result['total_points'] ?></p>
        </div>

        <!-- Animated Percentage Section -->
        <div class="flex flex-col items-center mt-6">
          <div class="relative w-32 h-32 mb-4">
            <!-- Radial Progress Circle -->
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36">
              <circle
                class="text-gray-400"
                stroke="currentColor"
                stroke-width="3"
                fill="none"
                r="16"
                cx="18"
                cy="18"></circle>
              <circle
                class="text-white progress-bar"
                stroke="currentColor"
                stroke-width="3"
                stroke-dasharray="100"
                stroke-dashoffset="100"
                fill="none"
                r="16"
                cx="18"
                cy="18"></circle>
            </svg>
            <!-- Percentage Text -->
            <div class="absolute inset-0 flex items-center justify-center text-4xl font-extrabold" id="percentage-value">
              0%
            </div>
          </div>
          <p class="text-lg text-white/90 font-medium">Your Accuracy</p>
        </div>
      </div>



      <!-- Detailed Results Section -->
      <div class="bg-gradient-to-b from-quiz-blue to-quiz-purple rounded-xl shadow-2xl p-10 text-white mb-10">
        <h3 class="text-3xl font-bold text-center mb-8">Question-by-Question Breakdown</h3>

        <?php foreach ($result_details as $detail): ?>
          <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl p-6 mb-6 transition-transform transform hover:scale-105">
            <p class="text-xl font-bold mb-3"><?= htmlspecialchars($detail['question_text']) ?></p>
            <div class="space-y-2">
              <p class="text-lg">
                <strong>Your Answer:</strong>
                <span class="<?= $detail['is_correct'] ? 'text-green-400' : 'text-red-400' ?>">
                  <?= htmlspecialchars($detail['user_answer']) ?>
                </span>
              </p>
              <p class="text-lg"><strong>Correct Answer:</strong> <?= htmlspecialchars($detail['correct_answer']) ?></p>
              <p class="text-lg"><strong>Points for This Question:</strong> <?= $detail['points'] ?></p>
              <p class="mt-3">
                <strong>Status:</strong>
                <span class="<?= $detail['is_correct'] ? 'text-green-500' : 'text-red-500' ?>">
                  <?= $detail['is_correct'] ? 'Correct' : 'Incorrect' ?>
                </span>
              </p>
            </div>
          </div>
        <?php endforeach; ?>

        <div class="mt-10 text-center">
          <a href="<?= site_url('quizzes'); ?>"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition-transform transform hover:scale-110">
            Back to Quiz List
          </a>
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

  <!-- Add Tailwind's text-quiz-blue or use your custom color -->
  <style>
    .progress-bar {
      transform: rotate(-90deg);
      transform-origin: center;
      transition: stroke-dashoffset 1.5s ease-in-out;
    }
  </style>

  <!-- JavaScript Animation Script -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const percentage = <?= $result['percentage'] ?>;
      const circle = document.querySelector(".progress-bar");
      const percentageText = document.getElementById("percentage-value");

      // Set the circle's stroke-dashoffset for animation
      const offset = 100 - percentage;
      circle.style.strokeDashoffset = offset;

      // Animate the percentage text
      let currentPercentage = 0;
      const interval = setInterval(() => {
        if (currentPercentage >= percentage) {
          clearInterval(interval);
        } else {
          currentPercentage++;
          percentageText.textContent = `${currentPercentage}%`;
        }
      }, 15); // Adjust speed of increment (15ms per percentage)
    });
  </script>
</body>

</html>