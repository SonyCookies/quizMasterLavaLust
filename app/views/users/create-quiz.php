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
          <h2 class="text-4xl font-bold text-white text-center mb-6">Create Your Quiz</h2>

          <!-- Step-by-Step Quiz Creation Form -->
          <form id="quizForm" class="space-y-6">
            <!-- Progress Bar -->
            <div class="relative pt-1 mb-6">
              <div class="flex mb-2 items-center justify-between">
                <div class="text-white">
                  <span id="stepIndicator" class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full bg-white text-quiz-blue">
                    Step <span id="currentStepNumber">1</span> of 3
                  </span>
                </div>
              </div>
              <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-white/30">
                <div id="progressBar" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-white" style="width: 33%"></div>
              </div>
            </div>

            <!-- Step 1: Enter Quiz Title -->
            <div id="step-1" class="step">
              <label for="quizTitle" class="block text-white text-lg font-medium mb-2">What's your quiz called?</label>
              <input type="text" id="quizTitle" name="title" class="w-full p-3 bg-white/20 border border-white/30 rounded-lg text-white text-xl placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white" placeholder="Enter an engaging title" required>
            </div>

            <!-- Step 2: Select Quiz Type, Difficulty, and Category -->
            <div id="step-2" class="step hidden space-y-4">
              <div>
                <label for="quizType" class="block text-white text-lg font-medium mb-2">What type of quiz is this?</label>
                <select id="quizType" name="quizType" class="w-full p-3 bg-white/20 border border-white/30 rounded-lg text-white text-xl focus:outline-none focus:ring-2 focus:ring-white" required>
                  <option class="text-black" value="" disabled selected>Choose a quiz type</option>
                  <option class="text-black" value="multiple-choice">Multiple Choice</option>
                  <option class="text-black" value="identification">Identification</option>
                  <option class="text-black" value="true-false">True or False</option>
                </select>
              </div>

              <div>
                <label for="difficulty" class="block text-white text-lg font-medium mb-2">How challenging should it be?</label>
                <select id="difficulty" name="difficulty" class="w-full p-3 bg-white/20 border border-white/30 rounded-lg text-white text-xl focus:outline-none focus:ring-2 focus:ring-white" required>
                  <option class="text-black" value="" disabled selected>Select difficulty</option>
                  <option class="text-black" value="Easy">Easy</option>
                  <option class="text-black" value="Medium">Medium</option>
                  <option class="text-black" value="Hard">Hard</option>
                </select>
              </div>

              <div>
                <label for="category" class="block text-white text-lg font-medium mb-2">What's the main topic?</label>
                <select id="category" name="category" class="w-full p-3 bg-white/20 border border-white/30 rounded-lg text-white text-xl focus:outline-none focus:ring-2 focus:ring-white" required>
                  <option class="text-black" value="" disabled selected>Pick a category</option>
                  <option class="text-black" value="general-knowledge">General Knowledge</option>
                  <option class="text-black" value="science">Science</option>
                  <option class="text-black" value="history">History</option>
                  <option class="text-black" value="literature">Literature</option>
                  <option class="text-black" value="sports">Sports</option>
                </select>
              </div>
            </div>

            <!-- Step 3: Quiz Settings -->
            <div id="step-3" class="step hidden space-y-4">
              <h4 class="text-white text-xl font-semibold mb-4">Fine-tune your quiz</h4>
              <div class="flex items-center space-x-3 bg-white/20 p-4 rounded-lg">
                <input type="checkbox" id="timedCheck" name="isTimed" value="1" class="form-checkbox h-5 w-5 text-quiz-blue rounded focus:ring-quiz-light">
                <label for="timedCheck" class="text-white text-xl">Set a time limit for your quiz</label>
              </div>
              <!-- <div class="flex items-center space-x-3 bg-white/20 p-4 rounded-lg">
                <input type="checkbox" id="showResultsCheck" name="showResults" value="1" class="form-checkbox h-5 w-5 text-quiz-blue rounded focus:ring-quiz-light" checked>
                <label for="showResultsCheck" class="text-white">Show results immediately after submission</label>
              </div>
              <div class="flex items-center space-x-3 bg-white/20 p-4 rounded-lg">
                <input type="checkbox" id="publishCheck" name="is_published" value="1" class="form-checkbox h-5 w-5 text-quiz-blue rounded focus:ring-quiz-light">
                <label for="publishCheck" class="text-white">Publish quiz immediately</label>
              </div> -->
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-8">
              <button type="button" id="prevBtn" class="bg-white/20 hover:bg-white/30 text-white font-bold py-2 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white hidden">
                Previous
              </button>
              <button type="button" id="nextBtn" class="bg-white text-quiz-blue font-bold py-2 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white">
                Next
              </button>
              <button type="submit" id="submitBtn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white hidden">
                Create Quiz
              </button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    let currentStep = 1;
    const totalSteps = 3;

    function updateProgressBar() {
      const progress = (currentStep / totalSteps) * 100;
      $('#progressBar').css('width', `${progress}%`);
      $('#currentStepNumber').text(currentStep);
    }

    function nextStep() {
      if (validateStep()) {
        if (currentStep < totalSteps) {
          $(`#step-${currentStep}`).addClass('hidden');
          currentStep++;
          $(`#step-${currentStep}`).removeClass('hidden');
          updateProgressBar();
          $('#prevBtn').removeClass('hidden');
          if (currentStep === totalSteps) {
            $('#nextBtn').addClass('hidden');
            $('#submitBtn').removeClass('hidden');
          }
        }
      }
    }

    function prevStep() {
      if (currentStep > 1) {
        $(`#step-${currentStep}`).addClass('hidden');
        currentStep--;
        $(`#step-${currentStep}`).removeClass('hidden');
        updateProgressBar();
        if (currentStep === 1) {
          $('#prevBtn').addClass('hidden');
        }
        $('#nextBtn').removeClass('hidden');
        $('#submitBtn').addClass('hidden');
      }
    }

    function validateStep() {
      const inputs = $(`#step-${currentStep} input[required], #step-${currentStep} select[required]`);
      for (let input of inputs) {
        if (!$(input).val()) {
          toastr.error('Please fill in all required fields.');
          return false;
        }
      }
      return true;
    }

    $('#quizForm').on('submit', function(e) {
      e.preventDefault();
      if (validateStep()) {
        saveQuizDetails();
      }
    });

    function saveQuizDetails() {
      const formData = $('#quizForm').serialize();
      $.post('/quiz/api/save-quiz', formData, function(response) {
        const data = JSON.parse(response);
        if (data.success) {
          toastr.success('Quiz created successfully!');

          switch (data.quiz_type) {
            case "multiple-choice":
              window.location.href = `/quiz/create/multiple-choice/${data.quiz_id}`;
              break;
            case "true-false":
              window.location.href = `/quiz/create/true-false/${data.quiz_id}`;
              break;
            case "identification":
              window.location.href = `/quiz/create/identification/${data.quiz_id}`;
              break;
            default:
              window.location.href = `/quiz/create/default/${data.quiz_id}`;
              break;
          }

        } else {
          toastr.error('Failed to save quiz. Please try again.');
        }
      }).fail(function() {
        toastr.error('An error occurred. Please try again.');
      });
    }

    $(document).ready(function() {
      $('#nextBtn').on('click', nextStep);
      $('#prevBtn').on('click', prevStep);
      updateProgressBar();
    });
  </script>
</body>

</html>