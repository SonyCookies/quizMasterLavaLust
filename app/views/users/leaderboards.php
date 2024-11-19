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

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12 justify-center">
        <!-- Weekly Ranking -->
        <div class="lg:col-span-2 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl overflow-hidden shadow-xl">
          <div class="p-8">
            <h3 class="text-3xl font-bold text-white mb-6">Weekly Ranking Top 5</h3>
            <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl p-6">
              <?php if (!empty($weeklyRanking)): ?>
                <ol class="space-y-4">
                  <?php foreach ($weeklyRanking as $index => $entry): ?>
                    <li class="flex items-center space-x-4">
                      <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-blue-500 text-white text-xl font-bold rounded-full">
                        <?= $index + 1 ?>
                      </div>
                      <div class="flex-grow">
                        <p class="text-white text-lg font-semibold"><?= htmlspecialchars($entry['username']) ?></p>
                      </div>
                      <div class="flex-shrink-0">
                        <span class="text-yellow-300 font-bold text-xl"><?= $entry['weekly_points'] ?> pts</span>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ol>
              <?php else: ?>
                <p class="text-white text-center">No data available</p>
              <?php endif; ?>
            </div>
            <div class="mt-8 text-center">
              <a href="/leaderboards/full-weekly" class="inline-block px-8 py-3 bg-white text-blue-600 font-bold rounded-full shadow-md hover:bg-blue-100 transition duration-300 ease-in-out transform hover:-translate-y-1">
                View Full Weekly Ranking
              </a>
            </div>
          </div>
        </div>

        <!-- Top 5 Highest Total Points -->
        <div class="bg-gradient-to-br from-green-500 to-teal-500 rounded-xl overflow-hidden shadow-xl">
          <div class="p-8">
            <h3 class="text-2xl font-bold text-white mb-6">All-Time Top 5 Points</h3>
            <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl p-6">
              <?php if (!empty($topPoints)): ?>
                <ol class="space-y-4">
                  <?php foreach ($topPoints as $index => $entry): ?>
                    <li class="flex items-center space-x-4">
                      <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-green-400 text-white font-bold rounded-full">
                        <?= $index + 1 ?>
                      </div>
                      <div class="flex-grow">
                        <p class="text-white font-semibold"><?= htmlspecialchars($entry['username']) ?></p>
                      </div>
                      <div class="flex-shrink-0">
                        <span class="text-yellow-300 font-bold"><?= number_format($entry['total_points']) ?> pts</span>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ol>
              <?php else: ?>
                <p class="text-white text-center">No data available</p>
              <?php endif; ?>
            </div>
            <div class="mt-6 text-center">
              <a href="/leaderboards/full-points" class="inline-block px-6 py-2 bg-white text-green-600 font-semibold rounded-full shadow-md hover:bg-green-100 transition duration-300 ease-in-out">
                View Full List
              </a>
            </div>
          </div>
        </div>

        <!-- Top 5 Highest Accuracy Rate -->
        <div class="bg-gradient-to-br from-orange-500 to-pink-500 rounded-xl overflow-hidden shadow-xl">
          <div class="p-8">
            <h3 class="text-2xl font-bold text-white mb-6">All-Time Top 5 Accuracy</h3>
            <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl p-6">
              <?php if (!empty($topAccuracy)): ?>
                <ol class="space-y-4">
                  <?php foreach ($topAccuracy as $index => $entry): ?>
                    <li class="flex items-center space-x-4">
                      <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-orange-400 text-white font-bold rounded-full">
                        <?= $index + 1 ?>
                      </div>
                      <div class="flex-grow">
                        <p class="text-white font-semibold"><?= htmlspecialchars($entry['username']) ?></p>
                      </div>
                      <div class="flex-shrink-0">
                        <span class="text-yellow-300 font-bold"><?= number_format($entry['average_accuracy'], 1) ?>%</span>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ol>
              <?php else: ?>
                <p class="text-white text-center">No data available</p>
              <?php endif; ?>
            </div>
            <div class="mt-6 text-center">
              <a href="/leaderboards/full-accuracy" class="inline-block px-6 py-2 bg-white text-orange-600 font-semibold rounded-full shadow-md hover:bg-orange-100 transition duration-300 ease-in-out">
                View Full List
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Quiz Leaderboards -->
      <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl overflow-hidden shadow-xl mb-8">
        <div class="p-8">
          <h3 class="text-3xl font-bold text-white mb-8">Quiz Leaderboards</h3>

          <!-- Filter Form -->
          <form action="<?= site_url('leaderboards/filter') ?>" method="GET" class="mb-8">
            <div class="flex flex-wrap justify-start gap-4">
              <div class="relative">
                <select name="category" class="appearance-none bg-white/20 text-white border-2 border-white/30 rounded-full px-6 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent">
                  <option class="text-gray-800" value="">All Categories</option>
                  <?php foreach ($categories as $category): ?>
                    <option class="text-gray-800" value="<?= htmlspecialchars($category['category_id']) ?>"
                      <?= isset($_GET['category']) && $_GET['category'] == $category['category_id'] ? 'selected' : '' ?>>
                      <?= htmlspecialchars($category['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                  </svg>
                </div>
              </div>

              <div class="relative">
                <select name="type" class="appearance-none bg-white/20 text-white border-2 border-white/30 rounded-full px-6 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent">
                  <option class="text-gray-800" value="">All Types</option>
                  <option class="text-gray-800" value="multiple-choice" <?= isset($_GET['type']) && $_GET['type'] == 'multiple-choice' ? 'selected' : '' ?>>Multiple Choice</option>
                  <option class="text-gray-800" value="identification" <?= isset($_GET['type']) && $_GET['type'] == 'identification' ? 'selected' : '' ?>>Identification</option>
                  <option class="text-gray-800" value="true-false" <?= isset($_GET['type']) && $_GET['type'] == 'true-false' ? 'selected' : '' ?>>True/False</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                  </svg>
                </div>
              </div>

              <button type="submit" class="bg-white text-indigo-600 font-bold py-3 px-6 rounded-full hover:bg-indigo-100 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                Filter Quizzes
              </button>
            </div>
          </form>

          <!-- Quizzes List -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($quizzes as $quiz): ?>
              <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl transition duration-300 hover:shadow-2xl hover:scale-105">
                <div class="p-6">
                  <h4 class="text-2xl font-bold text-white mb-3"><?= htmlspecialchars($quiz['title']) ?></h4>
                  <div class="flex justify-between items-center mb-4">
                    <span class="text-white/80 text-sm"><?= htmlspecialchars($quiz['category_name']) ?></span>
                    <span class="bg-indigo-500 text-white text-xs font-medium px-3 py-1 rounded-full"><?= htmlspecialchars($quiz['quizType']) ?></span>
                  </div>
                  <div class="flex justify-between items-center mb-6">
                    <div>
                      <span class="text-yellow-300 font-bold text-lg"><?= $quiz['total_points'] ?> pts</span>
                      <span class="text-white/60 text-sm ml-2"><?= $quiz['question_count'] ?> questions</span>
                    </div>
                  </div>
                  <div id="leaderboard-<?= $quiz['quiz_id'] ?>" class="bg-white/20 backdrop-filter backdrop-blur-lg rounded-lg p-4">
                    <h5 class="text-lg font-semibold text-white mb-3">Top Scores</h5>
                    <?php if (empty($quiz['top_scores'])): ?>
                      <p class="text-sm text-white/80">No one has taken this quiz yet.</p>
                    <?php else: ?>
                      <ul class="space-y-2">
                        <?php foreach ($quiz['top_scores'] as $index => $score): ?>
                          <li class="flex justify-between items-center">
                            <span class="text-sm text-white/90"><?= $index + 1 ?>. <?= htmlspecialchars($score['username']) ?></span>
                            <span class="font-semibold text-sm text-yellow-300">
                              <?= $score['score'] ?> <?= $score['score'] == 1 ? 'pt' : 'pts' ?>
                            </span>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    <?php endif; ?>
                    <div class="mt-4 text-right">
                      <a href="<?= site_url('leaderboards/full/' . $quiz['quiz_id']) ?>" class="text-white hover:text-yellow-300 transition duration-300">
                        View Full Leaderboard →
                      </a>
                    </div>
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