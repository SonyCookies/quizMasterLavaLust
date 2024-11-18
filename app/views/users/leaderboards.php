<?php
include APP_DIR . 'views/templates/header.php';





?>

<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>
    <main class="flex-grow container mx-auto px-4 py-8">
      <div class="text-center mb-12">
        <h2 class="text-5xl font-bold text-white mb-4">Leaderboards</h2>
        <p class="text-xl text-white/80">See how you stack up against the competition!</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <!-- Top 5 Highest Total Points -->
        <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-white mb-4">Top 5 Highest Total Points</h3>
            <ul class="space-y-2">
              <?php if (!empty($topPoints)): ?>
                <?php foreach ($topPoints as $index => $entry): ?>
                  <li class="flex justify-between items-center bg-white/20 rounded-lg p-3">
                    <span class="text-white font-medium"><?= $index + 1 ?>. <?= htmlspecialchars($entry['username']) ?></span>
                    <span class="text-white font-bold"><?= number_format($entry['total_points']) ?> pts</span>
                  </li>
                <?php endforeach; ?>
              <?php else: ?>
                <li class="text-white">No data available</li>
              <?php endif; ?>
            </ul>
            <!-- Button to view full list -->
            <div class="mt-4 text-center">
              <a href="/leaderboards/full-points" class="inline-block px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                View Full List
              </a>
            </div>
          </div>
        </div>

        <!-- Top 5 Highest Accuracy Rate -->
        <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-white mb-4">Top 5 Highest Accuracy Rate</h3>
            <ul class="space-y-2">
              <?php if (!empty($topAccuracy)): ?>
                <?php foreach ($topAccuracy as $index => $entry): ?>
                  <li class="flex justify-between items-center bg-white/20 rounded-lg p-3">
                    <span class="text-white font-medium"><?= $index + 1 ?>. <?= htmlspecialchars($entry['username']) ?></span>
                    <span class="text-white font-bold"><?= number_format($entry['average_accuracy'], 1) ?>%</span>
                  </li>
                <?php endforeach; ?>
              <?php else: ?>
                <li class="text-white">No data available</li>
              <?php endif; ?>

            </ul>
            <!-- Button to view full list -->
            <div class="mt-4 text-center">
              <a href="/leaderboards/full-accuracy" class="inline-block px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                View Full List
              </a>
            </div>
          </div>
        </div>

      </div>

      <!-- Quiz Leaderboards -->
      <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl mb-8">
        <div class="p-6">
          <h3 class="text-2xl font-semibold text-white mb-6">Quiz Leaderboards</h3>

          <!-- Filter Form -->
          <form action="<?= site_url('leaderboards/filter') ?>" method="GET" class="mb-6 flex flex-wrap justify-start gap-4">
            <select name="category" class="bg-white/20 text-white border border-white/30 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-quiz-blue">
              <option class="text-black" value="">All Categories</option>
              <?php foreach ($categories as $category): ?>
                <option class="text-black" value="<?= htmlspecialchars($category['category_id']) ?>"
                  <?= isset($_GET['category']) && $_GET['category'] == $category['category_id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($category['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>

            <select name="type" class="bg-white/20 text-white border border-white/30 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-quiz-blue">
              <option class="text-black" value="">All Types</option>
              <option class="text-black" value="multiple-choice" <?= isset($_GET['type']) && $_GET['type'] == 'multiple-choice' ? 'selected' : '' ?>>Multiple Choice</option>
              <option class="text-black" value="identification" <?= isset($_GET['type']) && $_GET['type'] == 'identification' ? 'selected' : '' ?>>Identification</option>
              <option class="text-black" value="true-false" <?= isset($_GET['type']) && $_GET['type'] == 'true-false' ? 'selected' : '' ?>>True/False</option>
            </select>

            <button type="submit" class="bg-quiz-blue text-white font-bold py-2 px-4 rounded-full hover:bg-blue-600 transition duration-300">Filter</button>
          </form>

          <!-- Quizzes List -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($quizzes as $quiz): ?>
              <div class="bg-[#1a237e] rounded-xl overflow-hidden shadow-xl">
                <div class="p-6">
                  <h4 class="text-xl font-semibold text-white mb-2"><?= htmlspecialchars($quiz['title']) ?></h4>
                  <div class="flex justify-between items-center mb-4">
                    <span class="text-white/80"><?= htmlspecialchars($quiz['category_name']) ?></span>
                    <span class="bg-blue-600 text-white text-xs font-medium px-2.5 py-0.5 rounded-full"><?= htmlspecialchars($quiz['quizType']) ?></span>
                  </div>
                  <div class="flex justify-between items-center">
                    <div>
                      <span class="text-white font-bold"><?= $quiz['total_points'] ?> pts.</span>
                      <span class="text-white/60 text-sm ml-2"><?= $quiz['question_count'] ?> questions</span>
                    </div>
                  </div>
                </div>
                <div id="leaderboard-<?= $quiz['quiz_id'] ?>" class="bg-white p-4 rounded-lg shadow-lg">
                  <h5 class="text-sm font-semibold text-gray-900 mb-2">Top Scores</h5>
                  <?php if (empty($quiz['top_scores'])): ?>
                    <p class="text-sm text-gray-600">No one has taken this quiz yet.</p>
                  <?php else: ?>
                    <ul class="space-y-1">
                      <?php foreach ($quiz['top_scores'] as $index => $score): ?>
                        <li class="flex justify-between items-center">
                          <span class="text-sm text-gray-600"><?= $index + 1 ?>. <?= htmlspecialchars($score['username']) ?></span>
                          <span class="font-semibold text-sm text-gray-900">
                            <?= $score['score'] ?> <?= $score['score'] == 1 ? 'pt.' : 'pts.' ?>
                          </span>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                  <div class="mt-4 text-right">
                    <a href="<?= site_url('leaderboards/full/' . $quiz['quiz_id']) ?>" class="text-blue-600 hover:underline">
                      View Full Leaderboard
                    </a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

        </div>
      </div>
    </main>

    <?php
    include APP_DIR . 'views/templates/footer.php';
    ?>
  </div>

  <script>
    function toggleLeaderboard(quizId) {
      const leaderboard = document.getElementById(`leaderboard-${quizId}`);
      leaderboard.classList.toggle('hidden');
    }
  </script>
</body>

</html>