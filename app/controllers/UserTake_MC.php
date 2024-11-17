<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserTake_MC extends Controller
{

  public function __construct()
  {
    parent::__construct();

    if (! logged_in()) {
      redirect('auth/login');
    }
  }

  public function index($quiz_id)
  {

    $quiz = $this->db->table('quizzes')
      ->left_join('categories', 'quizzes.categoryId = categories.category_id')
      ->select('quizzes.*, categories.name AS category_name')
      ->where('quizzes.quiz_id', $quiz_id)
      ->get();


    $questions = $this->db->table('questions')
      ->left_join('answer_options', 'questions.question_id = answer_options.question_id')
      ->select('questions.*, answer_options.id AS option_id, answer_options.option_text, answer_options.is_correct')
      ->where('questions.quiz_id', $quiz_id)
      ->order_by('questions.question_id', 'ASC')
      ->get_all();

    $this->call->view('/users/multiple-choice', ['questions' => $questions, 'quiz' => $quiz]);
  }

  // public function submit_multiple_choice()
  // {
  //   $quiz_id = $this->io->post('quizId');
  //   $submitted_answers = $this->io->post();
  //   unset($submitted_answers['quizId']);

  //   $correct_answers = $this->db->table('questions')
  //     ->left_join('answer_options', 'questions.question_id = answer_options.question_id')
  //     ->select('questions.question_id, answer_options.option_text AS correct_answer, answer_options.is_correct')
  //     ->where('questions.quiz_id', $quiz_id)
  //     ->where('answer_options.is_correct', 1)
  //     ->get_all();

  //   $correct_answers_map = [];
  //   foreach ($correct_answers as $answer) {
  //     $correct_answers_map[$answer['question_id']] = $answer['correct_answer'];
  //   }

  //   $score = 0;
  //   $total_questions = count($correct_answers_map);
  //   $result_details = [];

  //   foreach ($submitted_answers as $question_id => $user_answer) {
  //     // Remove the 'question_' prefix from the question_id in the submitted answers
  //     $question_id = str_replace('question_', '', $question_id);

  //     $is_correct = isset($correct_answers_map[$question_id]) && $user_answer === $correct_answers_map[$question_id];
  //     $score += $is_correct ? 1 : 0;

  //     $result_details[] = [
  //       'question_id' => $question_id,
  //       'user_answer' => $user_answer,
  //       'correct_answer' => isset($correct_answers_map[$question_id]) ? $correct_answers_map[$question_id] : 'N/A',
  //       'is_correct' => $is_correct,
  //     ];
  //   }

  //   echo json_encode($result_details);
  // }

  public function submit_multiple_choice()
  {
    $quiz_id = $this->io->post('quizId');
    $user_id = get_user_id();
    $quiz = $this->db->table('quizzes')->where('quiz_id', $quiz_id)->get();
    $submitted_answers = $this->io->post();
    unset($submitted_answers['quizId']);

    // Fetch questions along with correct answers
    $questions_with_answers = $this->db->table('questions')
      ->left_join('answer_options', 'questions.question_id = answer_options.question_id')
      ->select('questions.question_id, questions.question_text, questions.points, answer_options.option_text AS correct_answer, answer_options.is_correct')
      ->where('questions.quiz_id', $quiz_id)
      ->where('answer_options.is_correct', 1)
      ->get_all();

    $correct_answers_map = [];
    $total_points = 0;

    // Map the correct answers with points
    foreach ($questions_with_answers as $answer) {
      $correct_answers_map[$answer['question_id']] = [
        'question_text' => $answer['question_text'], // Store question text
        'correct_answer' => $answer['correct_answer'],
        'points' => $answer['points'],
      ];
      $total_points += $answer['points'];
    }

    $score = 0;
    $total_questions = count($correct_answers_map);
    $result_details = [];

    // Compare submitted answers with the correct answers
    foreach ($submitted_answers as $question_id => $user_answer) {
      $question_id = str_replace('question_', '', $question_id);

      $is_correct = isset($correct_answers_map[$question_id]) && $user_answer === $correct_answers_map[$question_id]['correct_answer'];

      $points = $is_correct ? $correct_answers_map[$question_id]['points'] : 0;
      $score += $points;

      // Add question_text to the result details
      $result_details[] = [
        'question_id' => $question_id,
        'question_text' => $correct_answers_map[$question_id]['question_text'], // Include question text
        'user_answer' => $user_answer,
        'correct_answer' => isset($correct_answers_map[$question_id]) ? $correct_answers_map[$question_id]['correct_answer'] : 'N/A',
        'points' => $correct_answers_map[$question_id]['points'],
        'is_correct' => $is_correct,
      ];
    }

    // Calculate percentage score
    $percentage = $total_points > 0 ? ($score / $total_points) * 100 : 0;

    // Save the score in the user_scores table
    $time_taken = 0; // Replace this with actual time taken if tracked
    $date_taken = date('Y-m-d H:i:s'); // Current timestamp

    $this->db->table('user_scores')->insert([
      'user_id' => $user_id,
      'quiz_id' => $quiz_id,
      'score' => $score,
      'total_score' => $total_points,
      'percentage' => round($percentage, 2), 
      'time_taken' => $time_taken,
      'date_taken' => $date_taken,
  ]);

    $result = [
      'score' => $score,
      'total_questions' => $total_questions,
      'total_points' => $total_points,
      'percentage' => round($percentage, 2),
      'result_details' => $result_details,
    ];

    // Pass the result and result_details to the view
    $this->call->view('/users/result-page', ['result' => $result, 'result_details' => $result_details, 'quiz' => $quiz]);
  }
}
