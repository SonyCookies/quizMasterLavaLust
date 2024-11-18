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
          <a href="<?= site_url('leaderboard') ?>"
            class="flex items-center text-white mb-6 hover:text-quiz-blue transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="font-semibold">Back to Leaderboard</span>
          </a>

          <h1 class="text-3xl font-bold text-white mb-6">Full Points Leaderboard</h1>
          <div class="overflow-x-auto">
            <table class="w-full text-white">
              <thead>
                <tr class="bg-white/20">
                  <th class="px-4 py-2 text-left">Rank</th>
                  <th class="px-4 py-2 text-left">Username</th>
                  <th class="px-4 py-2 text-center">Total Points</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($leaderboard as $index => $entry): ?>
                  <tr class="border-b border-white/10">
                    <td class="px-4 py-2"><?= $index + 1 ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($entry['username']) ?></td>
                    <td class="px-4 py-2 text-center"><?= htmlspecialchars($entry['total_points']) ?> pts.</td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

          <!-- Pagination (Optional)
          <div class="flex justify-center mt-6">
            <?php if ($currentPage > 1): ?>
              <a href="<?= site_url('/leaderboards/full-points?page=' . ($currentPage - 1)) ?>"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full inline-block transition duration-300">
                Previous
              </a>
            <?php endif; ?>

            <?php if ($currentPage < $totalPages): ?>
              <a href="<?= site_url('/leaderboards/full-points?page=' . ($currentPage + 1)) ?>"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full inline-block transition duration-300 ml-4">
                Next
              </a>
            <?php endif; ?>
          </div> -->

        </div>
      </div>
    </main>

  </div>

  <?php include APP_DIR . 'views/templates/footer.php'; ?>
</body>

</html>