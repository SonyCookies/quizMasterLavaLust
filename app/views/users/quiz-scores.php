<?php
include APP_DIR . 'views/templates/header.php';
?>

<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php include APP_DIR . 'views/templates/nav.php'; ?>

    <main class="flex-grow container mx-auto px-4 py-8">
      <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
        <div class="p-6">

          <!-- Back to Profile Button -->
          <a href="<?= site_url('/profile') ?>"
            class="flex items-center text-white mb-6 hover:text-quiz-blue transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="font-semibold">Back to Profile</span>
          </a>

          <h1 class="text-3xl font-bold text-white mb-6">Your Quiz Scores</h1>
          <div class="overflow-x-auto">
            <table class="w-full text-white">
              <thead>
                <tr class="bg-white/20">
                  <th class="px-4 py-2 text-left">Quiz Title</th>
                  <th class="px-4 py-2 text-left">Category</th>
                  <th class="px-4 py-2 text-center">Score</th>
                  <th class="px-4 py-2 text-center">Percentage</th>
                  <th class="px-4 py-2 text-left">Date Taken</th>
                  <th class="px-4 py-2 text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($quizScores as $score): ?>
                  <tr class="border-b border-white/10">
                    <td class="px-4 py-2"><?= htmlspecialchars($score['quiz_name']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($score['category_name']) ?></td>
                    <td class="px-4 py-2 text-center"><?= htmlspecialchars($score['score']) ?></td>
                    <td class="px-4 py-2 text-center"><?= htmlspecialchars($score['percentage']) ?>%</td>
                    <td class="px-4 py-2"><?= date('M j, Y', strtotime($score['date_taken'])) ?></td>
                    <td class="px-4 py-2 text-center">
                      <a href="<?= site_url('quiz/take/' . $score['quiz_type'] . '/' . $score['quiz_id']) ?>"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-full inline-block transition duration-300">
                        Retake
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>

  </div>

  <?php include APP_DIR . 'views/templates/footer.php'; ?>
</body>

</html>