<?php
include APP_DIR . 'views/templates/header.php';
?>

<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php include APP_DIR . 'views/templates/nav.php'; ?>

    <main class="flex-grow container mx-auto px-4 py-8">
      <div class="max-w-3xl mx-auto bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl shadow-xl overflow-hidden">
        <div class="p-8">
          <h2 class="text-4xl font-bold text-white text-center mb-6"><?= htmlspecialchars($quiz['title']) ?></h2>
          <div class="flex flex-col sm:flex-row justify-between items-center mb-6 text-white text-start sm:text-left">
            <div class="mb-2 sm:mb-0">
              <h5 class="text-lg font-semibold">Category: <span class="font-normal"><?= htmlspecialchars($category['name']) ?></span></h5>
              <h5 class="text-lg font-semibold">Quiz Type: <span class="font-normal"><?= htmlspecialchars($quiz['quizType']) ?></span></h5>
            </div>
            <div>
              <h5 class="text-lg font-semibold">Timed: <span class="font-normal"><?= htmlspecialchars($quiz['isTimed'] ? 'Yes' : 'No') ?></span></h5>
              <h5 class="text-lg font-semibold">Total Points: <span class="font-normal"><?= htmlspecialchars($totalPoints ? $totalPoints : 0) ?></span></h5>
            </div>
          </div>

          <!-- Multiple Choice Question Creation Form -->
          <form id="multipleChoiceForm" action="/quiz/api/save-mc-question" method="POST" class="space-y-6">
            <input type="hidden" name="quizId" value="<?= htmlspecialchars($quiz['quiz_id']) ?>">
            <input type="hidden" name="answerMode" value="Multiple Choice">

            <div>
              <label for="questionText" class="block text-white text-lg font-medium mb-2">Question</label>
              <input
                type="text"
                id="questionText"
                name="questionText"
                class="w-full p-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white"
                placeholder="Enter your question"
                required />
            </div>

            <div>
              <label class="block text-white text-lg font-medium mb-2">Choices</label>
              <div class="space-y-4">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                  <div class="flex items-center space-x-4">
                    <input
                      type="text"
                      name="choices[]"
                      class="flex-grow p-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white"
                      placeholder="Choice <?= $i ?>"
                      required
                      oninput="updateAnswerButton(this, <?= $i ?>)" />
                    <button
                      type="button"
                      class="choice-btn bg-blue-500 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-white"
                      data-answer="">
                      Set Correct
                    </button>
                  </div>


                <?php endfor; ?>
              </div>
              <!-- Hidden input to hold the selected answer -->
              <input type="hidden" id="correctAnswer" name="correctAnswer" required />
            </div>

            <div>
              <label for="points" class="block text-white text-lg font-medium mb-2">Points</label>
              <input
                type="number"
                id="points"
                name="points"
                min="1"
                max="10"
                class="w-full p-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white"
                placeholder="Enter point value (1-10)"
                required />
            </div>

            <button
              type="submit"
              class="w-full bg-white text-quiz-blue font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white">
              Add Question
            </button>
          </form>

          <!-- Question List -->
          <div class="mt-12 bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl p-6">
            <h3 class="text-2xl font-bold text-white mb-6">Question List</h3>
            <ul id="questionList" class="space-y-4">
              <?php foreach ($questions as $question): ?>
                <li class="bg-white/20 rounded-lg overflow-hidden">
                  <div class="p-4">
                    <div class="flex flex-col">
                      <h4 class="text-lg font-semibold text-white mb-2 break-words max-w-full">
                        <?= htmlspecialchars($question['question_text']) ?>
                      </h4>
                      <div class="mb-2">
                        <span class="bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                          <?= htmlspecialchars($question['points']) ?> pts
                        </span>
                      </div>
                      <p class="text-gray-200 mb-2">Correct Answer: <?= htmlspecialchars($question['correct_answer']) ?></p>
                      <div class="flex justify-between items-center mt-4">
                        <span class="text-sm text-gray-300">Multiple Choice</span>
                        <div class="space-x-2">
                          <button
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-full text-sm transition duration-300 ease-in-out open-edit-modal"
                            data-question-id="<?= htmlspecialchars($question['question_id']) ?>"
                            data-question-text="<?= htmlspecialchars($question['question_text']) ?>"
                            data-correct-answer="<?= htmlspecialchars($question['correct_answer']) ?>"
                            data-points="<?= htmlspecialchars($question['points']) ?>">
                            Edit
                          </button>
                          <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-full text-sm transition duration-300 ease-in-out open-delete-modal" data-question-id="<?= htmlspecialchars($question['question_id']) ?>">
                            Remove
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <button id="finishQuiz" class="mt-8 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white" onclick="window.location.href='/home';">
            Finish Quiz
          </button>
        </div>
      </div>
    </main>

    <?php include APP_DIR . 'views/templates/footer.php'; ?>
  </div>

  <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 backdrop-blur-sm hidden" aria-modal="true" role="dialog">
    <div class="relative bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl shadow-xl w-96">
      <!-- Modal Header -->
      <div class="border-b border-white/20 px-6 py-4">
        <h3 class="text-xl font-semibold text-white">
          Confirm Deletion
        </h3>
      </div>
      <!-- Modal Body -->
      <div class="p-6 text-center">
        <p class="text-white/80 text-sm">
          Are you sure you want to delete this question? This action cannot be undone.
        </p>
      </div>
      <!-- Form -->
      <form id="deleteForm" action="/quiz/api/delete-mc-question" method="POST" class="px-6 pb-4">
        <input type="hidden" id="deleteQuestionId" name="question_id" value="">
        <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quiz['quiz_id']) ?>">

        <!-- Action Buttons -->
        <div class="flex justify-between space-x-4">
          <button type="button" id="cancelDelete" class="w-1/2 px-4 py-2 bg-gray-700 text-gray-300 text-base font-medium rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
            Cancel
          </button>
          <button type="submit" class="w-1/2 px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
            Delete
          </button>
        </div>
      </form>
    </div>
  </div>

  <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 backdrop-blur-sm hidden" aria-modal="true" role="dialog">
    <div class="relative bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl shadow-xl w-96">
      <!-- Modal Header -->
      <div class="border-b border-white/20 px-6 py-4">
        <h3 class="text-xl font-semibold text-white">
          Edit Question
        </h3>
      </div>
      <!-- Modal Body -->
      <div class="p-6 space-y-4">
        <form id="editQuestionForm" action="/quiz/api/update-mc-question" method="POST" class="space-y-4">
          <input type="hidden" id="editQuestionId" name="question_id" />
          <input type="hidden" id="editQuizId" name="quiz_id" value="<?= htmlspecialchars($quiz['quiz_id']) ?>" />
          <input type="hidden" name="answerMode" value="Multiple Choice" />

          <div>
            <label for="editQuestionText" class="block text-white text-lg font-medium mb-2">Question</label>
            <input
              type="text"
              id="editQuestionText"
              name="questionText"
              class="w-full p-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white"
              placeholder="Enter your question"
              required />
          </div>

          <div>
            <label class="block text-white text-lg font-medium mb-2">Choices</label>
            <div id="editChoicesContainer" class="space-y-4">
              <!-- Choices will be dynamically populated here -->
            </div>
            <input type="hidden" id="editCorrectAnswer" name="correctAnswer" required />
          </div>

          <div>
            <label for="editPoints" class="block text-white text-lg font-medium mb-2">Points</label>
            <input
              type="number"
              id="editPoints"
              name="points"
              min="1"
              max="10"
              class="w-full p-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white"
              placeholder="Enter point value (1-10)"
              required />
          </div>

          <button
            type="submit"
            class="w-full bg-yellow-500 text-white font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white">
            Save Changes
          </button>
        </form>
      </div>
      <!-- Modal Footer -->
      <div class="flex justify-between space-x-4 px-6 pb-4">
        <button id="cancelEdit" class="w-full px-4 py-2 bg-gray-700 text-gray-300 text-base font-medium rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
          Cancel
        </button>
      </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    $(document).ready(function() {
      console.log('Test');
      $("#multipleChoiceForm").on("click", ".choice-btn", function() {
        const choiceText = $(this).data("answer"); // Read updated data-answer
        console.log("Clicked choice text:", choiceText); // Debug log

        if (choiceText && choiceText.trim() !== "") {
          $("#correctAnswer").val(choiceText); // Set correct answer
          console.log("Correct answer set to:", choiceText); // Debug log
        } else {
          console.warn("No valid choice text found for this button!");
        }

        // Reset button styles
        $("#multipleChoiceForm .choice-btn").removeClass("bg-opacity-50");
        $(this).addClass("bg-opacity-50");
      });
    });


    function updateAnswerButton(inputElement, index) {
      const choiceText = $(inputElement).val(); // Get input value
      const button = $(`#multipleChoiceForm .choice-btn:eq(${index - 1})`); // Select corresponding button

      if (choiceText.trim() !== "") {
        button.data("answer", choiceText); // Update data-answer attribute
        console.log(`Choice ${index}:`, choiceText); // Debug log
      } else {
        button.data("answer", ""); // Clear data-answer if input is empty
        console.log(`Choice ${index}: Empty`); // Debug log
      }
    }


    // DELETE MODAL
    $(".open-delete-modal").on("click", function() {
      var questionId = $(this).data("question-id");
      $("#deleteQuestionId").val(questionId);
      $("#deleteModal").removeClass("hidden");
    });

    $("#cancelDelete").on("click", function() {
      $("#deleteModal").addClass("hidden");
    });

    $(window).on("click", function(event) {
      if ($(event.target).is("#deleteModal")) {
        $("#deleteModal").addClass("hidden");
      }
    });

    $(document).on("keydown", function(event) {
      if (event.key === "Escape") {
        $("#deleteModal").addClass("hidden");
      }
    });

    //EDIT MODAL
    // Open Edit Modal
    $(".open-edit-modal").on("click", function() {
      const questionId = $(this).data("question-id");
      const questionText = $(this).data("question-text");
      const correctAnswer = $(this).data("correct-answer");
      const points = $(this).data("points");

      // Set values in the modal form fields
      $("#editQuestionId").val(questionId); // Populate hidden input for question_id
      $("#editQuestionText").val(questionText); // Populate input for question text
      $("#editCorrectAnswer").val(correctAnswer); // Populate correct answer (hidden)
      $("#editPoints").val(points); // Populate input for points

      $.post(
          '/quiz/api/multiplechoice/choices', {
            question_id: questionId
          },
          function(response) {

            const choicesContainer = $("#editChoicesContainer");
            choicesContainer.empty();

            response.choices.forEach((choice) => {
              const isCorrect = response.correct_answer === choice.option_text;
              const choiceHtml = `
                <div class="flex items-center space-x-4">
                  <input
                    type="text"
                    name="choices[]"
                    class="flex-grow p-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white"
                    value="${choice.option_text}"
                    required />
                  <button
                    type="button"
                    class="choice-btn bg-blue-500 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-white ${
                      isCorrect ? "bg-opacity-50" : ""
                    }"
                    data-answer="${choice.option_text}">
                    Set Correct
                  </button>
                </div>
              `;
              choicesContainer.append(choiceHtml);
            });

            $("#editModal").removeClass("hidden");
          })
        .fail(function() {
          toastr.error("Failed to fetch question data. Please try again.");
        });
    });

    // Close Edit Modal
    $("#cancelEdit").on("click", function() {
      $("#editModal").addClass("hidden");
    });

    // Handle "Set Correct" button clicks
    $(document).on("click", "#editChoicesContainer .choice-btn", function() {
      const correctAnswer = $(this).data("answer");
      $("#editCorrectAnswer").val(correctAnswer);

      // Highlight the selected correct answer button
      $("#editChoicesContainer .choice-btn").removeClass("bg-opacity-50");
      $(this).addClass("bg-opacity-50");
    });
  </script>

  <?php
  include APP_DIR . 'views/templates/toastr.php';
  ?>

</body>