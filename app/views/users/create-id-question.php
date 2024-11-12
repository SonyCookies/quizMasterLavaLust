<?php
include APP_DIR . 'views/templates/header.php';
?>

<style>
  /* Default readonly input style */
  .readonly-input {
    background-color: transparent;
    border: none;
  }

  /* Editable input style */
  .editable {
    background-color: #f3f4f6;
    /* Light gray background for visual indication */
    border: 1px solid #4a90e2;
    /* Blue border */
    padding: 2px 4px;
    border-radius: 4px;
  }
</style>

<body>
  <div id="app" class="bg-gray-100 min-h-screen flex flex-col">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>

    <main class="mt-5 pt-3 flex-grow">
      <div class="container mx-auto px-4">
        <!-- Dashboard Header -->
        <div class="text-center mb-5">
          <h2 class="text-4xl font-bold text-gray-800">Add Identification Question</h2>
          <p class="text-gray-500">Quiz Title: <?= htmlspecialchars($quizData['title']) ?></p>
          <p class="text-gray-500">Quiz Type: <?= htmlspecialchars($quizData['quizType']) ?></p>
        </div>

        <!-- Add Question Form -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
          <div class="p-6">
            <form id="questionForm" action="<?= site_url('question/add-id-question') ?>" method="POST">
              <input type="hidden" name="quizId" value="<?= $quizId ?>">

              <!-- Question Input -->
              <div class="mb-4">
                <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                <input type="text" name="question" id="question" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
              </div>

              <!-- Answer Input -->
              <div class="mb-4">
                <label for="answer" class="block text-sm font-medium text-gray-700">Answer</label>
                <input type="text" name="answer" id="answer" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
              </div>

              <!-- Add Question Button -->
              <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded w-full mt-4 inline-block">Add Question</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Questions List -->
        <div class="mt-6 bg-white shadow-lg rounded-lg p-6">
          <h3 class="text-3xl font-bold text-gray-800 text-center mb-4">Added Questions</h3>
          <ul class="space-y-4">
            <?php foreach ($questions as $question): ?>
              <form action="">
                <li class="bg-gray-50 rounded-lg p-4 transition-transform transform hover:shadow-md">
                  <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>">

                  <!-- Editable Question Text -->
                  <div class="text-gray-700 text-lg w-full mb-2 w-3/4 ">
                    <input type="text" name="question_text" value="<?= htmlspecialchars($question['question_text']) ?>" class="bg-transparent border-b border-gray-300 focus:outline-none readonly-input w-full" readonly>
                  </div>

                  <!-- Editable Correct Answer -->
                  <div class="text-green-600 font-semibold w-full mb-2 w-1/2">
                    <input type="text" name="correct_answer" value="<?= htmlspecialchars($question['correct_answer']) ?>" class="bg-transparent border-b border-gray-300 focus:outline-none readonly-input w-full" readonly>
                  </div>

                  <!-- Edit, Save, Cancel, Delete Buttons -->
                  <div class="flex flex-wrap space-x-4 md:space-x-2 justify-end mt-4 md:mt-0">
                    <!-- Edit Button -->
                    <button type="button" class="text-green-500 font-semibold edit-btn flex items-center">
                      <i class="fas fa-edit mr-1"></i>
                      <span class="hidden md:inline">Edit</span>
                    </button>

                    <!-- Save Button (Hidden initially) -->
                    <button type="submit" class="text-blue-500 font-semibold save-btn hidden flex items-center">
                      <i class="fas fa-check mr-1"></i>
                      <span class="hidden md:inline">Save</span>
                    </button>

                    <!-- Cancel Button (Hidden initially) -->
                    <button type="button" class="text-yellow-500 font-semibold cancel-btn hidden flex items-center">
                      <i class="fas fa-times mr-1"></i>
                      <span class="hidden md:inline">Cancel</span>
                    </button>

                    <!-- Delete Button -->
                    <button type="button" class="text-red-500 font-semibold delete-btn flex items-center" data-question-id="<?= $question['question_id'] ?>">
                      <i class="fas fa-trash-alt mr-1"></i>
                      <span class="hidden md:inline">Delete</span>
                    </button>
                  </div>
                </li>
              </form>
            <?php endforeach; ?>
          </ul>
        </div>


        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
          <div class="bg-white p-6 rounded-lg">
            <p class="text-lg mb-4">Are you sure you want to delete this question?</p>
            <div class="flex justify-end space-x-4">
              <button class="bg-red-500 text-white px-4 py-2 rounded cancel-delete-btn">Cancel</button>
              <form method="POST" action="delete_question.php" id="deleteForm">
                <input type="hidden" name="question_id" id="deleteQuestionId">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Confirm</button>
              </form>
            </div>
          </div>
        </div>



        <!-- Add More Questions Section -->
        <div class="mt-6">
          <p class="text-gray-700 text-center">Want to add more questions? Just click the "Add Question" button again!</p>
        </div>

      </div>
    </main>
  </div>

  <!-- Additional Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const toastrOptions = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      };

      // Show toastr message if $message is set
      <?php if (isset($message)): ?>
        toastr.options = toastrOptions;
        toastr.success("<?php echo $message; ?>");
      <?php endif; ?>

      function toggleEditMode(form, isEditable) {
        const questionText = form.find('input[name="question_text"]');
        const correctAnswer = form.find('input[name="correct_answer"]');

        questionText.prop('readonly', !isEditable).toggleClass('editable', isEditable);
        correctAnswer.prop('readonly', !isEditable).toggleClass('editable', isEditable);

        form.find('.save-btn, .cancel-btn').toggleClass('hidden', !isEditable);
        form.find('.edit-btn').toggleClass('hidden', isEditable);
      }

      $(document).on('click', '.edit-btn', function() {
        toggleEditMode($(this).closest('form'), true);
      });

      $(document).on('click', '.cancel-btn', function() {
        toggleEditMode($(this).closest('form'), false);
      });

      $(document).on('click', '.delete-btn', function() {
        const questionId = $(this).data('question-id');
        $('#deleteQuestionId').val(questionId);
        $('#deleteModal').removeClass('hidden');
      });

      $('.cancel-delete-btn').click(function() {
        $('#deleteModal').addClass('hidden');
      });

      $(document).on('click', '.save-btn', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        const data = {
          question_id: form.find('input[name="question_id"]').val(),
          question_text: form.find('input[name="question_text"]').val(),
          correct_answer: form.find('input[name="correct_answer"]').val()
        };

        $.post('/question/update-id-question', data, function(response) {
          toastr.options = toastrOptions;
          toastr.success("Question successfully updated!");
          toggleEditMode(form, false);
        }).fail(function() {
          alert('Failed to save changes. Please try again.');
        });
      });

      $('#deleteForm').submit(function(e) {
        e.preventDefault();
        const questionId = $('#deleteQuestionId').val();

        console.log(questionId);

        $.post('/question/delete-id-question', {
          question_id: questionId
        }, function(response) {
          toastr.options = toastrOptions;
          toastr.success("Question deleted successfully!");
          $(`.delete-btn[data-question-id="${questionId}"]`).closest('li').remove();
          $('#deleteModal').addClass('hidden');
        }).fail(function() {
          alert('Failed to delete question. Please try again.');
        });

      });
    });
  </script>


</body>

</html>