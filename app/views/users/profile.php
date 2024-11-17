<?php
include APP_DIR . 'views/templates/header.php';
?>

<style>
  .modal.fade .modal-dialog {
    transform: translate(0, -25%);
    transition: transform 0.3s ease-out;
  }

  .modal.show .modal-dialog {
    transform: translate(0, 0);
  }
</style>

<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>
    <main class="flex-grow container mx-auto px-4 py-8">
      <div class="max-w-4xl mx-auto">
        <!-- Profile Header -->
        <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl mb-8">
          <div class="p-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
              <div class="flex items-center">
                <div class="w-32 h-32 bg-quiz-blue rounded-full flex items-center justify-center text-white text-4xl font-bold mb-4 md:mb-0 md:mr-8">
                  <?= strtoupper(substr($user['username'], 0, 1)) ?>
                </div>
                <div class="text-left">
                  <h1 class="text-3xl font-bold text-white mb-2"><?= htmlspecialchars($user['username']) ?></h1>
                  <p class="text-white/80 mb-1"><?= htmlspecialchars($user['email']) ?></p>
                  <p class="text-white/60 text-sm">Joined on <?= date('F j, Y', strtotime($user['created_at'])) ?></p>
                </div>
              </div>
              <button
                class="bg-quiz-blue text-white font-bold py-2 px-4 rounded-md hover:text-quiz-blue transition duration-300 edit-profile-btn"
                data-username="<?= htmlspecialchars($user['username']) ?>"
                data-email="<?= htmlspecialchars($user['email']) ?>">
                Edit Profile
              </button>

            </div>
          </div>
        </div>


        <!-- Quiz Management -->
        <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl mb-8">
          <div class="p-8">
            <h2 class="text-2xl font-semibold text-white mb-6">Quiz Management</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="bg-white/20 rounded-lg p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <h3 class="text-xl font-semibold text-white mb-2">Create Quiz</h3>
                <p class="text-white/80 mb-4">Design your own quiz with custom questions and answers</p>
                <a href="<?= site_url('quiz/create'); ?>" class="bg-quiz-blue hover:bg-quiz-light text-white font-bold py-2 px-4 rounded-full inline-block transition duration-300">Create New Quiz</a>
              </div>
              <div class="bg-white/20 rounded-lg p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <h3 class="text-xl font-semibold text-white mb-2">Manage Quizzes</h3>
                <p class="text-white/80 mb-4">Modify and control the visibility of your existing quizzes</p>
                <a href="<?= site_url('quiz/manage'); ?>" class="bg-quiz-blue hover:bg-quiz-light text-white font-bold py-2 px-4 rounded-full inline-block transition duration-300">Manage Quizzes</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Leaderboard and Achievements -->
        <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl mb-8">
          <div class="p-8">
            <h2 class="text-2xl font-semibold text-white mb-6">Leaderboard and Achievements</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="bg-white/20 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Global Leaderboard</h3>
                <ul class="space-y-2">
                  <?php
                  $leaderboard = [
                    ['name' => 'John Doe', 'score' => 1250],
                    ['name' => 'Jane Smith', 'score' => 1100],
                    ['name' => 'Alice Johnson', 'score' => 950],
                  ];
                  foreach ($leaderboard as $index => $entry):
                  ?>
                    <li class="flex justify-between items-center text-white">
                      <span><?= $index + 1 ?>. <?= htmlspecialchars($entry['name']) ?></span>
                      <span class="font-bold"><?= $entry['score'] ?> pts</span>
                    </li>
                  <?php endforeach; ?>
                </ul>
                <a href="#" class="mt-4 text-quiz-blue hover:text-white transition duration-300 inline-block">View Full Leaderboard</a>
              </div>
              <div class="bg-white/20 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Your Achievements</h3>
                <div class="grid grid-cols-3 gap-4">
                  <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-white text-sm">Quiz Master</span>
                  </div>
                  <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span class="text-white text-sm">Fast Learner</span>
                  </div>
                  <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="text-white text-sm">Top Scorer</span>
                  </div>
                </div>
                <a href="#" class="mt-4 text-quiz-blue hover:text-white transition duration-300 inline-block">View All Achievements</a>
              </div>
            </div>
          </div>
        </div>

        <!-- User Scores and Statistics -->
        <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
          <div class="p-8">
            <h2 class="text-2xl font-semibold text-white mb-6">Your Quiz Performance</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="bg-white/20 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Overall Statistics</h3>
                <ul class="space-y-2">
                  <li class="flex justify-between items-center text-white">
                    <span>Quizzes Completed:</span>
                    <span class="font-bold">42</span>
                  </li>
                  <li class="flex justify-between items-center text-white">
                    <span>Average Score:</span>
                    <span class="font-bold">78%</span>
                  </li>
                  <li class="flex justify-between items-center text-white">
                    <span>Accuracy Rate:</span>
                    <span class="font-bold">82%</span>
                  </li>
                  <li class="flex justify-between items-center text-white">
                    <span>Total Points:</span>
                    <span class="font-bold">3,450</span>
                  </li>
                </ul>
              </div>
              <div class="bg-white/20 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Recent Quiz Scores</h3>
                <ul class="space-y-2">
                  <?php
                  $recentScores = [
                    ['name' => 'World Geography', 'score' => 90],
                    ['name' => 'Science Trivia', 'score' => 85],
                    ['name' => 'Math Challenge', 'score' => 75],
                    ['name' => 'History Quiz', 'score' => 88],
                  ];
                  foreach ($recentScores as $score):
                  ?>
                    <li class="flex justify-between items-center text-white">
                      <span><?= htmlspecialchars($score['name']) ?></span>
                      <span class="font-bold"><?= $score['score'] ?>%</span>
                    </li>
                  <?php endforeach; ?>
                </ul>
                <a href="#" class="mt-4 text-quiz-blue hover:text-white transition duration-300 inline-block">View All Scores</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </main>

    <?php
    include APP_DIR . 'views/templates/footer.php';
    ?>

  </div>

  <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
        <div class="modal-header border-b border-white/20 p-4">
          <h5 class="modal-title text-2xl font-semibold text-white" id="editProfileModalLabel">Edit Profile</h5>
          <button type="button" class="btn-close text-white opacity-70 hover:opacity-100 transition duration-300" data-bs-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="modal-body p-6">
          <form id="editProfileForm" action="/profile/update" method="post" class="space-y-4">
            <div>
              <label for="modalUsername" class="block text-sm font-medium text-white mb-1">Username</label>
              <input type="text" class="w-full px-3 py-2 bg-white/20 border border-white/30 rounded-md text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-quiz-blue" id="modalUsername" name="username">
            </div>
            <div>
              <label for="modalEmail" class="block text-sm font-medium text-white mb-1">Email</label>
              <input type="email" class="w-full px-3 py-2 bg-white/20 border border-white/30 rounded-md text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-quiz-blue" id="modalEmail" name="email" disabled>
            </div>
            <button type="submit" class="w-full bg-quiz-blue hover:bg-quiz-light text-white font-bold py-2 px-4 rounded-md transition duration-300">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.edit-profile-btn').on('click', function() {
        const username = $(this).data('username');
        const email = $(this).data('email');
        const createdAt = $(this).data('created-at');

        $('#modalUsername').val(username);
        $('#modalEmail').val(email);

        $('#editProfileModal').modal('show');
      });

    });
  </script>

  <?php
  include APP_DIR . 'views/templates/toastr.php';
  ?>


</body>

</html>