<?php
include APP_DIR . 'views/templates/header.php';

$labels = [];
$scores = [];

foreach ($chartData as $score) {
  $labels[] = date('M j, Y', strtotime($score['date_taken']));
  $scores[] = $score['percentage'];
}
?>

<script>
  const labels = <?php echo json_encode($labels); ?>;
  const scores = <?php echo json_encode($scores); ?>;
</script>

<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>
    <main class="flex-grow container mx-auto px-4 py-8">
      <div class="max-w-6xl mx-auto space-y-8">
        <!-- Profile Header -->
        <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
          <div class="p-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
              <div class="flex items-center mb-4 md:mb-0">
                <div class="w-24 h-24 bg-blue-500 rounded-full flex items-center justify-center text-white text-4xl font-bold mr-6">
                  <?= strtoupper(substr($user['username'], 0, 1)) ?>
                </div>
                <div>
                  <h1 class="text-3xl font-bold text-white mb-2"><?= htmlspecialchars($user['username']) ?></h1>
                  <p class="text-blue-200 mb-1"><?= htmlspecialchars($user['email']) ?></p>
                  <p class="text-sm text-blue-300">Joined on <?= date('F j, Y', strtotime($user['created_at'])) ?></p>
                </div>
              </div>
              <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full hover:bg-blue-600 transition duration-300 edit-profile-btn"
                data-username="<?= htmlspecialchars($user['username']) ?>"
                data-email="<?= htmlspecialchars($user['email']) ?>">
                Edit Profile
              </button>
            </div>
          </div>
        </div>

        <!-- Quiz Management -->
        <div class="grid md:grid-cols-2 gap-6">
          <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
            <div class="p-8 text-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              <h3 class="text-2xl font-semibold text-white mb-4">Create Quiz</h3>
              <p class="text-blue-200 mb-6">Design your own quiz with custom questions and answers</p>
              <a href="<?= site_url('quiz/create'); ?>" class="bg-blue-500 text-white font-bold py-3 px-6 rounded-full inline-block hover:bg-blue-600 transition duration-300">Create New Quiz</a>
            </div>
          </div>
          <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
            <div class="p-8 text-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              <h3 class="text-2xl font-semibold text-white mb-4">Manage Quizzes</h3>
              <p class="text-blue-200 mb-6">Modify and control the visibility of your existing quizzes</p>
              <a href="<?= site_url('quiz/manage'); ?>" class="bg-blue-500 text-white font-bold py-3 px-6 rounded-full inline-block hover:bg-blue-600 transition duration-300">Manage Quizzes</a>
            </div>
          </div>
        </div>

        <!-- Leaderboard and Achievements -->
        <!-- <div class="grid md:grid-cols-2 gap-6">
          <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
            <div class="p-8">
              <h3 class="text-2xl font-semibold text-white mb-6">Global Leaderboard</h3>
              <ul class="space-y-4">
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
                    <span class="bg-blue-500 text-white text-sm font-medium px-2.5 py-0.5 rounded-full"><?= $entry['score'] ?> pts</span>
                  </li>
                <?php endforeach; ?>
              </ul>
              <a href="#" class="mt-6 text-blue-300 hover:text-white transition duration-300 inline-block">View Full Leaderboard</a>
            </div>
          </div>
          <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
            <div class="p-8">
              <h3 class="text-2xl font-semibold text-white mb-6">Your Achievements</h3>
              <div class="grid grid-cols-3 gap-4">
                <div class="text-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-2 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span class="text-white text-sm">Quiz Master</span>
                </div>
                <div class="text-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                  </svg>
                  <span class="text-white text-sm">Fast Learner</span>
                </div>
                <div class="text-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-2 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                  </svg>
                  <span class="text-white text-sm">Top Scorer</span>
                </div>
              </div>
              <a href="#" class="mt-6 text-blue-300 hover:text-white transition duration-300 inline-block">View All Achievements</a>
            </div>
          </div>
        </div> -->

        <!-- User Scores and Statistics -->
        <div class="grid md:grid-cols-2 gap-6">
          <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
            <div class="p-8">
              <h3 class="text-2xl font-semibold text-white mb-6">Overall Statistics</h3>
              <ul class="space-y-4">
                <li class="flex justify-between items-center text-white">
                  <span>Quizzes Completed:</span>
                  <span class="font-bold"><?= $overallStatistics['quizzes_completed'] ?></span>
                </li>
                <li class="flex justify-between items-center text-white">
                  <span>Average Score:</span>
                  <span class="font-bold"><?= number_format($overallStatistics['average_score'], 2) ?></span>
                </li>
                <li class="flex justify-between items-center text-white">
                  <span>Accuracy Rate:</span>
                  <span class="font-bold"><?= number_format($overallStatistics['accuracy_rate'], 2) ?>%</span>
                </li>
                <li class="flex justify-between items-center text-white">
                  <span>Total Points:</span>
                  <span class="font-bold"><?= number_format($overallStatistics['total_points']) ?></span>
                </li>
              </ul>
            </div>
          </div>

          <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
            <div class="p-8">
              <h3 class="text-2xl font-semibold text-white mb-6">Recent Quiz Scores</h3>
              <ul class="space-y-4">
                <?php if (!empty($recentScores)): ?>
                  <?php foreach ($recentScores as $score): ?>
                    <li class="flex justify-between items-center text-white">
                      <span><?= htmlspecialchars($score['quiz_name']) ?></span>
                      <span class="bg-blue-500 text-white text-sm font-medium px-2.5 py-0.5 rounded-full"><?= htmlspecialchars($score['percentage']) ?>%</span>
                    </li>
                  <?php endforeach; ?>
                <?php else: ?>
                  <li class="text-white">No recent quiz scores available.</li>
                <?php endif; ?>
              </ul>
              <a href="<?= site_url('quiz/scores'); ?>" class="mt-6 text-blue-300 hover:text-white transition duration-300 inline-block">View All Scores</a>
            </div>
          </div>
        </div>

        <!-- Performance Trends Section -->
        <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
          <div class="p-8">
            <h3 class="text-2xl font-semibold text-white mb-6">Performance Trends</h3>
            <p class="text-blue-200 mb-6">Here you can view how your performance has evolved over your recent quizzes.</p>
            <div class="relative h-64">
              <canvas id="performanceTrendsChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </main>

    <?php
    include APP_DIR . 'views/templates/footer.php';
    ?>
  </div>

  <!-- Edit Profile Modal -->
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
              <input type="text" class="w-full px-3 py-2 bg-white/20 border border-white/30 rounded-md text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-500" id="modalUsername" name="username">
            </div>
            <div>
              <label for="modalEmail" class="block text-sm font-medium text-white mb-1">Email</label>
              <input type="email" class="w-full px-3 py-2 bg-white/20 border border-white/30 rounded-md text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-500" id="modalEmail" name="email" disabled>
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition duration-300">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    var ctx = document.getElementById('performanceTrendsChart').getContext('2d');
    var performanceTrendsChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Score (%)',
          data: scores,
          borderColor: 'rgba(255, 255, 255, 1)',
          backgroundColor: 'rgba(59, 130, 246, 0.5)',
          borderWidth: 3,
          fill: true,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          title: {
            display: true,
            text: 'Your Performance Trends Over Time',
            color: '#ffffff',
            font: {
              size: 16,
              weight: 'bold',
            }
          },
          legend: {
            labels: {
              color: 'white',
            }
          }
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'Date',
              color: '#ffffff',
            },
            ticks: {
              color: '#ffffff'
            },
            grid: {
              color: 'rgba(255, 255, 255, 0.1)',
            }
          },
          y: {
            title: {
              display: true,
              text: 'Score (%)',
              color: '#ffffff',
            },
            ticks: {
              color: '#ffffff'
            },
            grid: {
              color: 'rgba(255, 255, 255, 0.1)',
            }
          }
        }
      }
    });

    $(document).ready(function() {
      $('.edit-profile-btn').on('click', function() {
        const username = $(this).data('username');
        const email = $(this).data('email');

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