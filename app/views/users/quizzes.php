<?php
include APP_DIR . 'views/templates/header.php';
?>

<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>
    <main class="flex-grow container mx-auto px-4 py-8">
      <!-- Quizzes Header -->
      <div class="text-center mb-12">
        <h2 class="text-5xl font-bold text-white mb-4">Available Quizzes</h2>
        <p class="text-xl text-white/80">Explore our collection of exciting quizzes!</p>
      </div>

      <!-- Filter Form -->
      <form action="<?= site_url('/quizzes/filter') ?>" method="GET" class="mb-6 flex flex-wrap justify-center gap-4">
        <select name="category" class="p-2 rounded-md">
          <option value="">All Categories</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?= htmlspecialchars($category['category_id']) ?>"
              <?= isset($_GET['category']) && $_GET['category'] == $category['category_id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($category['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>

        <select name="type" class="p-2 rounded-md">
          <option value="">All Types</option>
          <option value="multiple-choice" <?= isset($_GET['type']) && $_GET['type'] == 'multiple-choice' ? 'selected' : '' ?>>Multiple Choice</option>
          <option value="identification" <?= isset($_GET['type']) && $_GET['type'] == 'identification' ? 'selected' : '' ?>>Identification</option>
          <option value="true-false" <?= isset($_GET['type']) && $_GET['type'] == 'true-false' ? 'selected' : '' ?>>True/False</option>
        </select>

        <button type="submit" class="bg-quiz-blue text-white font-bold py-2 px-4 rounded-md">Filter</button>
      </form>

      <!-- Quizzes List -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($quizzes as $quiz): ?>
          <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl transform hover:scale-105 transition duration-300">
            <div class="p-6">
              <h3 class="text-2xl font-semibold text-white mb-2"><?= htmlspecialchars($quiz['title']) ?></h3>
              <div class="flex justify-between items-center mb-4">
                <span class="text-white/80"><?= htmlspecialchars($quiz['category_name']) ?></span>
                <span class="bg-quiz-blue text-white text-sm font-medium px-2.5 py-0.5 rounded-full"><?= htmlspecialchars($quiz['quizType']) ?></span>
              </div>
              <div class="flex justify-between items-center">
                <div>
                  <span class="bg-quiz-blue text-white text-sm font-medium px-2.5 py-0.5 rounded-full"><?= htmlspecialchars($quiz['total_points']) ?> pts.</span>
                  <span class="text-white/60 text-sm"><?= htmlspecialchars($quiz['question_count']) ?> questions</span>
                </div>
                <a href="<?= site_url('take-quiz?quiz_id=' . ($quiz['quiz_id'])) ?>"
                  class="bg-white text-quiz-blue font-bold py-2 px-4 rounded-full inline-block hover:bg-quiz-blue hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                  Take Quiz
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
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