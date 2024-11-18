<?php
include APP_DIR . 'views/templates/header.php';
?>

<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php include APP_DIR . 'views/templates/nav.php'; ?>

    <main class="flex-grow container mx-auto px-4 py-8">
      <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
        <div class="p-6">

          <!-- Back to All Quizzes Button -->
          <a href="<?= site_url('leaderboard') ?>"
            class="flex items-center text-white mb-6 hover:text-quiz-blue transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="font-semibold">Back to Quizzes</span>
          </a>

          <!-- Quiz Title -->
          <h1 class="text-3xl font-bold text-white mb-6"><?= htmlspecialchars($quiz['title']) ?> Leaderboard</h1>
          <h2 class="text-lg font-semibold text-white/80 mb-4"><?= htmlspecialchars($quiz['category_name']) ?></h2>

          <!-- Leaderboard Table -->
          <div class="overflow-x-auto">
            <table class="w-full text-white">
              <thead>
                <tr class="bg-white/20">
                  <th class="px-4 py-2 text-left">Rank</th>
                  <th class="px-4 py-2 text-left">Username</th>
                  <th class="px-4 py-2 text-center">Score</th>
                  <th class="px-4 py-2 text-center">Percentage</th>
                  <th class="px-4 py-2 text-left">Date Taken</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($leaderboard)): ?>
                  <?php foreach ($leaderboard as $index => $entry): ?>
                    <tr class="border-b border-white/10">
                      <td class="px-4 py-2"><?= $index + 1 ?></td>
                      <td class="px-4 py-2"><?= htmlspecialchars($entry['username']) ?></td>
                      <td class="px-4 py-2 text-center"><?= $entry['score'] ?></td>
                      <td class="px-4 py-2 text-center"><?= number_format($entry['percentage'], 1) ?>%</td>
                      <td class="px-4 py-2"><?= date('M j, Y', strtotime($entry['date_taken'])) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" class="px-4 py-2 text-center text-white">No scores available for this quiz.</td>
                  </tr>
                <?php endif; ?>
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