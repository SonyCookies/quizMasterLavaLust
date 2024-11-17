<?php
include APP_DIR . 'views/templates/header.php';
?>

<body>
  <div id="app" class="bg-gray-100 min-h-screen flex flex-col">
    <?php
    include APP_DIR . 'views/templates/nav.php';
    ?>

  
    <main class="mt-5 pt-3 flex-grow">
      <div class="container mx-auto px-4">
        <div class="text-center mb-5">
          <h2 class="text-4xl font-bold text-gray-800">Create a Quiz</h2>
        </div>

        <!-- Step-by-Step Quiz Creation Form -->
        <form id="quizForm" action="/submit-quiz" method="POST" class="mx-auto" style="max-width: 600px;">
          <!-- Step 1: Enter Quiz Title -->
          <div id="step-1" class="step">
            <h4 class="text-gray-800 mb-3">Enter the title of the quiz</h4>
            <input type="text" name="title" class="w-full p-3 mb-3 border border-gray-300 rounded" placeholder="Quiz Title" required>
            <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded w-full" onclick="nextStep()">Next</button>
          </div>

          <!-- Step 2: Select Quiz Type, Difficulty, and Category -->
          <div id="step-2" class="step hidden">
            <h4 class="text-gray-800 mb-3">What type of quiz?</h4>
            <select name="quizType" class="w-full p-3 mb-3 border border-gray-300 rounded" required>
              <option value="" disabled selected>Select type</option>
              <option value="multiple-choice">Multiple Choice</option>
              <option value="identification">Identification</option>
              <option value="true-false">True or False</option>
            </select>

            <h4 class="text-gray-800 mb-3">Difficulty Level</h4>
            <select name="difficulty" class="w-full p-3 mb-3 border border-gray-300 rounded" required>
              <option value="" disabled selected>Select difficulty</option>
              <option value="Easy">Easy</option>
              <option value="Medium">Medium</option>
              <option value="Hard">Hard</option>
            </select>

            <!-- Category Selection -->
            <h4 class="text-gray-800 mb-3">Select Category</h4>
            <select name="category" class="w-full p-3 mb-3 border border-gray-300 rounded" required>
              <option value="" disabled selected>Select category</option>
              <option value="generalKnowledge-trivia">General Knowledge & Trivia</option>
              <option value="science-technology">Science & Technology</option>
              <option value="history-politics">History & Politics</option>
              <option value="arts-culture">Arts & Culture</option>
              <option value="sports-leisure">Sports & Leisure</option>
              <option value="health-lifestyle">Health & Lifestyle</option>
              <option value="nature-environment">Nature & Environment</option>
              <option value="business-economics">Business & Economics</option>
              <option value="philosphy-pscyhology">Philosophy & Psychology</option>
              <option value="religion-mythodology">Religion & Mythodology</option>
              <option value="mathematics-logic">Mathematics & Logic</option>
            </select>
            
            <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded w-full mb-3" onclick="prevStep()">Back</button>
            <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded w-full" onclick="nextStep()">Next</button>
          </div>


          <!-- Step 3: Quiz Settings -->
          <div id="step-3" class="step hidden">
            <h4 class="text-gray-800 mb-3">Quiz Settings</h4>
            <div class="flex items-center mb-2">
              <input type="checkbox" name="isTimed" value="1" class="mr-2" id="timedCheck">
              <label for="timedCheck" class="text-gray-700">Is the quiz timed?</label>
            </div>
            <div class="flex items-center mb-2">
              <input type="checkbox" name="showResults" value="1" class="mr-2" id="showResultsCheck" checked>
              <label for="showResultsCheck" class="text-gray-700">Show results after submission</label>
            </div>
            <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded w-full mb-3" onclick="prevStep()">Back</button>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded w-full">Finish & Create Quiz</button>
          </div>
        </form>


      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <script>
    let currentStep = 1;

    // Move to the next step
    function nextStep() {
      if (validateStep()) {
        if (currentStep === 3) {
          saveQuizDetails(); // Save quiz details after the 3rd slide
        } else {
          document.getElementById(`step-${currentStep}`).classList.add('hidden');
          currentStep++;
          document.getElementById(`step-${currentStep}`).classList.remove('hidden');
        }
      }
    }

    function prevStep() {
      document.getElementById(`step-${currentStep}`).classList.add('hidden');
      currentStep--;
      document.getElementById(`step-${currentStep}`).classList.remove('hidden');
    }


    // Validate inputs
    function validateStep() {
      const inputs = document.querySelectorAll(`#step-${currentStep} input, #step-${currentStep} select`);
      for (let input of inputs) {
        if (!input.checkValidity()) {
          input.reportValidity();
          return false;
        }
      }
      return true;
    }

    // Save quiz details to the database
    function saveQuizDetails() {
      const quizData = {
        title: document.querySelector('input[name="title"]').value,
        quizType: document.querySelector('select[name="quizType"]').value,
        difficulty: document.querySelector('select[name="difficulty"]').value,
        isTimed: document.querySelector('input[name="isTimed"]').checked ? 1 : 0,
        showResults: document.querySelector('input[name="showResults"]').checked ? 1 : 0,
        is_published: document.querySelector('input[name="is_published"]').checked ? 1 : 0
      };

      console.log('Quiz Data:', quizData);

      fetch('api/save-quiz', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(quizData)
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Redirect to add-question.php with the quizId as a URL parameter
            window.location.href = `add-question.php?quizId=${data.quizId}`;
          } else {
            alert('Failed to save quiz. Please try again.');
          }
        })
        .catch(error => {
          console.error('Error saving quiz:', error);
        });
    }

    // Show question creation section after saving the quiz
    function showQuestionCreation(quizId) {
      document.getElementById(`step-${currentStep}`).classList.add('hidden');
      document.getElementById('question-creation-section').classList.remove('hidden');
      document.getElementById('quizId').value = quizId; // Store quizId for later use in questions
    }
    <?php
    $_lava = &lava_instance(); 
    if ($_lava->session->flashdata('message')): ?>
            // Show toastr notification if flashdata exists
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right", // Position of the toast
                "preventDuplicates": true,
                "showDuration": "300", // Show animation duration
                "hideDuration": "1000", // Hide animation duration
                "timeOut": "5000", // Timeout before the toast disappears
                "extendedTimeOut": "1000", // Time before closing if hovered
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn", // Animation method
                "hideMethod": "fadeOut" // Animation method
            };
            // Display the message from flashdata
            toastr.success("<?php echo $_lava->session->flashdata('message'); ?>");
        <?php endif; ?>
  </script>

</body>

</html>