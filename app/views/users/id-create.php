<?php
include APP_DIR . 'views/templates/header.php';
?>

<body class="bg-gradient-to-br from-quiz-blue to-quiz-light min-h-screen">
  <div id="app" class="flex flex-col min-h-screen">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>

    <main class="flex-grow container mx-auto px-4 py-8">
      <div class="max-w-3xl mx-auto bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl shadow-xl overflow-hidden">
        <div class="p-8">
          <h2 class="text-4xl font-bold text-white text-center mb-6"><?= htmlspecialchars($quizData['title']) ?></h2>

          <!-- Question Creation Form -->
          <form id="questionForm" class="space-y-6">
            <div>
              <label for="questionText" class="block text-white text-lg font-medium mb-2">Question</label>
              <input type="text" id="questionText" name="questionText" class="w-full p-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white" placeholder="Enter your question" required>
            </div>

            <div>
              <label for="answer" class="block text-white text-lg font-medium mb-2">Answer</label>
              <input type="text" id="answer" name="answer" class="w-full p-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white" placeholder="Enter the correct answer" required>
            </div>

            <div>
              <label for="points" class="block text-white text-lg font-medium mb-2">Points</label>
              <input type="number" id="points" name="points" min="1" max="10" class="w-full p-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white" placeholder="Enter point value (1-10)" required>
            </div>

            <button type="submit" class="w-full bg-white text-quiz-blue font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white">
              Add Question
            </button>
          </form>

          <!-- Question List -->
          <div class="mt-12">
            <h3 class="text-2xl font-bold text-white mb-4">Question List</h3>
            <ul id="questionList" class="space-y-4">
              <!-- Questions will be dynamically added here -->
            </ul>
          </div>

          <!-- Finish Quiz Button -->
          <button id="finishQuiz" class="mt-8 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white">
            Finish Quiz
          </button>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    $(document).ready(function() {

      let questions = [];

      $('#questionForm').on('submit', function(e) {
        e.preventDefault();
        const questionText = $('#questionText').val();
        const answer = $('#answer').val();
        const points = $('#points').val();

        if (questionText && answer && points) {
          const questionData = {
            questionText: questionText,
            answer: answer,
            points: points
          };

          $.post('/quiz/api/save-id-question', questionData, function(response) {
            if (response.success) {
              addQuestionToList(questionData);
              resetForm();
              toastr.success('Question added successfully!');
            } else {
              toastr.error('Failed to save question. Please try again.');
            }
          }).fail(function() {
            toastr.error('An error occurred while saving. Please try again.');
          });
        } else {
          toastr.error('Please fill in all fields.');
        }
      });

      function addQuestionToList(question) {
        $('#questionList').append(`
          <li class="bg-white/20 p-4 rounded-lg flex justify-between items-center">
            <span class="text-white">${question.questionText}</span>
            <button class="text-red-500 hover:text-red-700" onclick="removeQuestion(${questions.length - 1})">Remove</button>
          </li>
        `);
      }

      function removeQuestion(index) {
        questions.splice(index, 1);
        updateQuestionList();
        toastr.info('Question removed.');
      }

      function updateQuestionList() {
        $('#questionList').empty();
        questions.forEach((question, index) => {
          $('#questionList').append(`
            <li class="bg-white/20 p-4 rounded-lg flex justify-between items-center">
              <span class="text-white">${question.questionText}</span>
              <button class="text-red-500 hover:text-red-700" onclick="removeQuestion(${index})">Remove</button>
            </li>
        `);
        });
      }

      function resetForm() {
        $('#questionText').val('');
        $('#answer').val('');
        $('#points').val('');
      }

      $('#finishQuiz').on('click', function() {
        if (questions.length > 0) {
          console.log('Submitting questions:', questions);
          toastr.success('Quiz completed! Redirecting to dashboard...');
          setTimeout(function() {
            window.location.href = '/home';
          }, 2000);
        } else {
          toastr.error('Please add at least one question before finishing the quiz.');
        }
      });

    });
  </script>
</body>

</html>