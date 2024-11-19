<?php
include APP_DIR . 'views/templates/header.php';
?>

<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>
    <main class="flex-grow container mx-auto px-4 py-16">
      <!-- Quizzes Header -->
      <div class="text-center mb-16">
        <h2 class="text-6xl font-extrabold text-white mb-4 leading-tight">
          Discover Your Next Challenge
        </h2>
        <p class="text-2xl text-white/80 max-w-3xl mx-auto">
          Explore our diverse collection of quizzes and put your knowledge to the test!
        </p>
      </div>

      <!-- Filter Form -->
      <form action="<?= site_url('/quizzes/filter') ?>" method="GET" class="mb-12">
        <div class="flex flex-wrap justify-center gap-4">
          <div class="relative">
            <select name="category" class="appearance-none bg-white/20 text-white border-2 border-white/30 rounded-full px-6 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent">
              <option value="">All Categories</option>
              <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['category_id']) ?>"
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
              <option value="">All Types</option>
              <option value="multiple-choice" <?= isset($_GET['type']) && $_GET['type'] == 'multiple-choice' ? 'selected' : '' ?>>Multiple Choice</option>
              <option value="identification" <?= isset($_GET['type']) && $_GET['type'] == 'identification' ? 'selected' : '' ?>>Identification</option>
              <option value="true-false" <?= isset($_GET['type']) && $_GET['type'] == 'true-false' ? 'selected' : '' ?>>True/False</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
          </div>

          <button type="submit" class="bg-white text-quiz-blue font-bold py-3 px-8 rounded-full hover:bg-quiz-blue hover:text-white transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
            Filter Quizzes
          </button>
        </div>
      </form>

      <!-- Quizzes List -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($quizzes as $quiz): ?>
          <div class="bg-gradient-to-br from-white/10 to-white/5 backdrop-filter backdrop-blur-lg rounded-2xl overflow-hidden shadow-xl transform hover:scale-105 transition duration-300">
            <div class="p-8">
              <h3 class="text-2xl font-bold text-white mb-4"><?= htmlspecialchars($quiz['title']) ?></h3>
              <div class="flex justify-between items-center mb-6">
                <span class="text-white/80 text-sm"><?= htmlspecialchars($quiz['category_name']) ?></span>
                <span class="bg-quiz-blue text-white text-xs font-medium px-3 py-1 rounded-full"><?= htmlspecialchars($quiz['quizType']) ?></span>
              </div>
              <div class="flex flex-col space-y-4">
                <div class="flex justify-between items-center">
                  <span class="text-white/90 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <?= htmlspecialchars($quiz['total_points']) ?> pts
                  </span>
                  <span class="text-white/60 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    <?= htmlspecialchars($quiz['question_count']) ?> questions
                  </span>
                </div>
                <a href="<?= site_url('quiz/take/' . $quiz['quizType'] . '/' . $quiz['quiz_id']) ?>"
                  class="bg-white text-quiz-blue font-bold py-3 px-6 rounded-full inline-block hover:bg-quiz-blue hover:text-white hover:shadow-lg transform hover:-translate-y-1 transition duration-300 ease-in-out text-center">
                  Take the Challenge
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