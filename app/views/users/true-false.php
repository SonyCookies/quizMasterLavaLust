<?php
// Assuming the necessary files and database connection are included
include APP_DIR . 'views/templates/header.php';
?>

<?php
// Grouping the true/false questions
$groupedQuestions = [];
foreach ($questions as $entry) {
  $questionId = $entry['question_id'];
  if (!isset($groupedQuestions[$questionId])) {
    $groupedQuestions[$questionId] = [
      'question_id' => $entry['question_id'],
      'quiz_id' => $entry['quiz_id'],
      'question_text' => $entry['question_text'],
      'media_url' => $entry['media_url'],
      'correct_answer' => $entry['correct_answer'],
      'points' => $entry['points'],
    ];
  }
}
?>

<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php include APP_DIR . 'views/templates/nav.php'; ?>

    <main class="flex-grow container mx-auto px-4 py-8">
      <div class="max-w-3xl mx-auto bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl shadow-xl overflow-hidden">
        <div class="p-8">
          <!-- Quiz Title -->
          <h2 class="text-4xl font-bold text-white text-center mb-6">
            <?= htmlspecialchars($quiz['title']) ?>
          </h2>

          <!-- Quiz Details -->
          <div class="bg-white/10 border border-white/30 rounded-lg p-6 space-y-4 text-white">
            <div class="flex justify-between">
              <span class="font-semibold">Category:</span>
              <span><?= htmlspecialchars($quiz['category_name']) ?></span>
            </div>
            <div class="flex justify-between">
              <span class="font-semibold">Quiz Type:</span>
              <span class="capitalize"><?= htmlspecialchars($quiz['quizType']) ?></span>
            </div>
          </div>

          <!-- Quiz Form -->
          <form id="quizForm" action="/quiz/submit/true-false" method="POST" class="space-y-6">
            <input type="hidden" name="quizId" value="<?= htmlspecialchars($quiz['quiz_id']) ?>">

            <?php foreach ($groupedQuestions as $question): ?>
              <div class="mb-8 bg-white/10 border border-white/30 rounded-lg p-6 shadow-lg">
                <!-- Question Title -->
                <p class="text-xl font-bold text-white mb-4"><?= htmlspecialchars($question['question_text']) ?></p>

                <!-- Optional Media -->
                <?php if (!empty($question['media_url'])): ?>
                  <div class="mb-4">
                    <img src="<?= htmlspecialchars($question['media_url']) ?>" alt="Question Media" class="rounded-lg shadow-lg max-h-64 w-full object-cover">
                  </div>
                <?php endif; ?>

                <!-- True/False Options -->
                <div class="grid grid-cols-2 gap-4">
                  <div class="rounded-lg overflow-hidden">
                    <input
                      type="radio"
                      id="question_<?= $question['question_id'] ?>_true"
                      name="question_<?= $question['question_id'] ?>"
                      value="True"
                      class="hidden peer"
                      required />
                    <div class="p-4 border border-white/20 bg-white/5 text-white rounded-lg cursor-pointer peer-checked:bg-green-500 peer-checked:border-green-500 peer-checked:text-white hover:bg-white/20 hover:shadow-lg transition-all">
                      <label for="question_<?= $question['question_id'] ?>_true" class="cursor-pointer">
                        True
                      </label>
                    </div>
                  </div>
                  <div class="rounded-lg overflow-hidden">
                    <input
                      type="radio"
                      id="question_<?= $question['question_id'] ?>_false"
                      name="question_<?= $question['question_id'] ?>"
                      value="False"
                      class="hidden peer"
                      required />
                    <div class="p-4 border border-white/20 bg-white/5 text-white rounded-lg cursor-pointer peer-checked:bg-green-500 peer-checked:border-green-500 peer-checked:text-white hover:bg-white/20 hover:shadow-lg transition-all">
                      <label for="question_<?= $question['question_id'] ?>_false" class="cursor-pointer">
                        False
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>

            <!-- Submit Button -->
            <button
              type="submit"
              class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white">
              Submit Quiz
            </button>
          </form>
        </div>
      </div>
    </main>

    <?php include APP_DIR . 'views/templates/footer.php'; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>