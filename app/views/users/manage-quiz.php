<?php
include APP_DIR . 'views/templates/header.php';

?>

<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php include APP_DIR . 'views/templates/nav.php'; ?>
    <main class="flex-grow container mx-auto px-4 py-8">
      <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl">
        <div class="p-6">
          <a href="<?= site_url('profile') ?>"
            class="flex items-center text-white mb-6 hover:text-quiz-blue transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="font-semibold">Back to Profile</span>
          </a>
          <h1 class="text-3xl font-bold text-white mb-6">Manage Quizzes</h1>
          <div class="overflow-x-auto">
            <table class="w-full text-white">
              <thead>
                <tr class="bg-white/20">
                  <th class="px-4 py-2 text-left">Title</th>
                  <th class="px-4 py-2 text-left">Category</th>
                  <th class="px-4 py-2 text-center">Questions</th>
                  <th class="px-4 py-2 text-left">Created At</th>
                  <th class="px-4 py-2 text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($quizzes as $quiz): ?>
                  <tr class="border-b border-white/10">
                    <td class="px-4 py-2"><?= htmlspecialchars($quiz['title']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($quiz['category_name']) ?></td>
                    <td class="px-4 py-2 text-center"><?= $quiz['question_count'] ?></td>
                    <td class="px-4 py-2"><?= date('M j, Y', strtotime($quiz['created_at'])) ?></td>
                    <td class="px-4 py-2 text-center">
                      <!-- Edit Button -->
                      <button
                        class="bg-quiz-blue hover:bg-quiz-light text-white font-bold py-1 px-3 rounded-full inline-block transition duration-300 mr-2"
                        data-title="<?= htmlspecialchars($quiz['title']) ?>"
                        data-category-id="<?= htmlspecialchars($quiz['category_id']) ?>"
                        data-quiz-id="<?= htmlspecialchars($quiz['quiz_id']) ?>"
                        onclick="openEditModal(this)">
                        Edit
                      </button>

                      <!-- Manage Questions Button -->

                      <a
                        href="<?= site_url('/quiz/create/' .
                                ($quiz['quizType'] === 'multiple-choice' ? 'multiplechoice' : ($quiz['quizType'] === 'true-false' ? 'truefalse' : $quiz['quizType'])) .
                                '/' . $quiz['quiz_id']) ?>"
                        class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-1 px-3 rounded-full inline-block transition duration-300">
                        Manage Questions
                      </a>


                      <!-- Publish/Unpublish Form -->
                      <form
                        action="<?= site_url('/quiz/toggle-publish') ?>"
                        method="POST"
                        class="inline">
                        <input type="hidden" name="quiz_id" value="<?= $quiz['quiz_id'] ?>" />
                        <input type="hidden" name="is_published" value="<?= $quiz['is_published'] ?>" />
                        <button
                          type="submit"
                          class="py-1 px-3 rounded-full font-bold inline-block transition duration-300 text-white <?= $quiz['is_published'] ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' ?>">
                          <?= $quiz['is_published'] ? 'Unpublish' : 'Publish' ?>
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>

    <!-- Edit Quiz Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
      <div class="bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden shadow-xl p-6 max-w-md w-full mx-4">
        <h2 class="text-2xl font-bold text-white mb-4">Edit Quiz</h2>
        <form action="<?= site_url('/quiz/update') ?>" method="POST">
          <input type="hidden" name="quiz_id" id="quiz_id">
          <div class="mb-4">
            <label for="title" class="block text-white mb-2">Title</label>
            <input
              type="text"
              name="title"
              id="title"
              class="w-full px-4 py-2 rounded-md bg-white/20 text-white"
              required>
          </div>
          <div class="mb-4">
            <label for="category" class="block text-white mb-2">Category</label>
            <select
              name="category"
              id="category"
              class="w-full px-4 py-2 rounded-md bg-white/20 text-white"
              required>
              <?php foreach ($categories as $category): ?>
                <option class="text-black"
                  value="<?= htmlspecialchars($category['category_id']) ?>">
                  <?= htmlspecialchars($category['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="flex justify-end space-x-4">
            <button
              type="button"
              class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md"
              onclick="closeEditModal()">
              Cancel
            </button>
            <button
              type="submit"
              class="bg-quiz-blue hover:bg-quiz-light text-white font-bold py-2 px-4 rounded-md">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>


    <?php include APP_DIR . 'views/templates/footer.php'; ?>
  </div>

  <script>
    function openEditModal(button) {
      const modal = document.getElementById('editModal');
      document.getElementById('title').value = button.getAttribute('data-title');
      document.getElementById('category').value = button.getAttribute('data-category-id');
      document.getElementById('quiz_id').value = button.getAttribute('data-quiz-id');
      modal.classList.remove('hidden');
    }

    function closeEditModal() {
      const modal = document.getElementById('editModal');
      modal.classList.add('hidden');
    }
  </script>

  <?php
  include APP_DIR . 'views/templates/toastr.php';
  ?>


</body>


</html>