<?php
include APP_DIR . 'views/templates/header.php';
?>

<body class="bg-gradient-to-br from-indigo-900 to-purple-800 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>

    <main class="flex-grow container mx-auto px-4 py-8">
      <!-- Confetti Canvas -->
      <canvas id="confetti-canvas" class="fixed inset-0 w-full h-full pointer-events-none z-50"></canvas>

      <!-- Dashboard Header -->
      <div class="text-center mb-12 relative">
        <h2 class="text-6xl font-bold text-white mb-4 animate-fade-in-down">Quiz Results</h2>
        <p class="text-2xl text-white/80 animate-fade-in-up">Your journey through the quiz!</p>
      </div>

      <!-- Results Summary Section -->
      <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-3xl overflow-hidden shadow-2xl p-10 text-white mb-10 transform hover:scale-105 transition-all duration-300">
        <!-- Quiz Details Section -->
        <div class="grid grid-cols-2 gap-6 text-lg font-medium mb-8">
          <p class="text-white/80">Quiz Title:</p>
          <p class="text-right font-semibold"><?= htmlspecialchars($quiz['title']) ?></p>
          <p class="text-white/80">Total Questions:</p>
          <p class="text-right font-semibold"><?= $result['total_questions'] ?></p>
          <p class="text-white/80">Total Points:</p>
          <p class="text-right font-semibold"><?= $result['total_points'] ?></p>
          <p class="text-white/80">Your Score:</p>
          <p class="text-right font-semibold"><?= $result['score'] ?> / <?= $result['total_points'] ?></p>
        </div>

        <!-- Animated Percentage Section -->
        <div class="flex flex-col items-center mt-10">
          <div class="relative w-64 h-64 mb-8">
            <!-- Circular Progress Bar -->
            <svg class="w-full h-full" viewBox="0 0 100 100">
              <circle class="text-indigo-900 stroke-current" stroke-width="10" cx="50" cy="50" r="40" fill="transparent" />
              <circle class="text-indigo-300 progress-ring__circle stroke-current"
                stroke-width="10"
                stroke-linecap="round"
                cx="50"
                cy="50"
                r="40"
                fill="transparent"
                stroke-dasharray="251.2"
                stroke-dashoffset="251.2" />
            </svg>
            <!-- Percentage Text -->
            <div class="absolute inset-0 flex items-center justify-center text-6xl font-extrabold" id="percentage-value">
              0%
            </div>
          </div>
          <p class="text-2xl text-white/90 font-medium">Your Accuracy</p>
        </div>
      </div>

      <!-- Detailed Results Section -->
      <div class="bg-gradient-to-b from-indigo-700 to-purple-700 rounded-3xl shadow-2xl p-10 text-white mb-10">
        <h3 class="text-4xl font-bold text-center mb-12 animate-pulse">Question-by-Question Breakdown</h3>

        <?php foreach ($result_details as $index => $detail): ?>
          <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-2xl overflow-hidden shadow-xl p-8 mb-8 transition-all duration-300 hover:shadow-2xl hover:bg-white/20 transform hover:-translate-y-1">
            <p class="text-2xl font-bold mb-4 text-indigo-200">Question <?= $index + 1 ?>:</p>
            <p class="text-xl mb-6"><?= htmlspecialchars($detail['question_text']) ?></p>
            <div class="space-y-4">
              <p class="text-lg">
                <strong class="text-indigo-200">Your Answer:</strong>
                <span class="<?= $detail['is_correct'] ? 'text-green-400' : 'text-red-400' ?> ml-2">
                  <?= htmlspecialchars($detail['user_answer']) ?>
                </span>
              </p>
              <p class="text-lg">
                <strong class="text-indigo-200">Correct Answer:</strong>
                <span class="text-green-400 ml-2"><?= htmlspecialchars($detail['correct_answer']) ?></span>
              </p>
              <p class="text-lg">
                <strong class="text-indigo-200">Points:</strong>
                <span class="ml-2"><?= $detail['points'] ?></span>
              </p>
              <p class="text-lg">
                <strong class="text-indigo-200">Status:</strong>
                <span class="<?= $detail['is_correct'] ? 'text-green-500' : 'text-red-500' ?> ml-2 font-semibold">
                  <?= $detail['is_correct'] ? 'Correct' : 'Incorrect' ?>
                </span>
              </p>
            </div>
          </div>
        <?php endforeach; ?>

        <div class="mt-16 text-center">
          <a href="<?= site_url('quizzes'); ?>"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-10 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 inline-block">
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
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

  <style>
    @keyframes fade-in-down {
      0% {
        opacity: 0;
        transform: translateY(-20px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fade-in-up {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-fade-in-down {
      animation: fade-in-down 1s ease-out;
    }

    .animate-fade-in-up {
      animation: fade-in-up 1s ease-out;
    }

    .progress-ring__circle {
      transition: stroke-dashoffset 1.5s ease-in-out;
      transform: rotate(-90deg);
      transform-origin: 50% 50%;
    }
  </style>

  <!-- JavaScript Animation Script -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const percentage = <?= $result['percentage'] ?>;
      const circle = document.querySelector(".progress-ring__circle");
      const percentageText = document.getElementById("percentage-value");
      const radius = circle.r.baseVal.value;
      const circumference = radius * 2 * Math.PI;

      circle.style.strokeDasharray = `${circumference} ${circumference}`;
      circle.style.strokeDashoffset = circumference;

      function setProgress(percent) {
        const offset = circumference - (percent / 100 * circumference);
        circle.style.strokeDashoffset = offset;
      }

      // Animate the percentage text and circle
      let currentPercentage = 0;
      const interval = setInterval(() => {
        if (currentPercentage >= percentage) {
          clearInterval(interval);
          // Trigger confetti after the animation completes
          confetti({
            particleCount: 100,
            spread: 70,
            origin: {
              y: 0.6
            }
          });
        } else {
          currentPercentage++;
          percentageText.textContent = `${currentPercentage}%`;
          setProgress(currentPercentage);
        }
      }, 20); // Adjust speed of increment

      // Add hover effect to question cards
      const questionCards = document.querySelectorAll('.bg-white\\/10');
      questionCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
          card.style.transform = 'scale(1.05)';
        });
        card.addEventListener('mouseleave', () => {
          card.style.transform = 'scale(1)';
        });
      });
    });
  </script>
</body>

</html>