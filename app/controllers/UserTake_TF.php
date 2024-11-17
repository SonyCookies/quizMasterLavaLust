<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserTake_TF extends Controller
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


    $questions = $this->db->table('questions')->where('quiz_id', $quiz_id)->get_all();

    $this->call->view('/users/true-false', ['questions' => $questions, 'quiz' => $quiz]);
  }

  public function submit_true_false()
  {
    $quiz_id = $this->io->post('quizId');
    $user_id = get_user_id();
    $quiz = $this->db->table('quizzes')->where('quiz_id', $quiz_id)->get();
    $submitted_answers = $this->io->post();
    unset($submitted_answers['quizId']);

    $questions_with_answers = $this->db->table('questions')
      ->select('question_id, question_text, correct_answer, points')
      ->where('quiz_id', $quiz_id)
      ->get_all();

    $correct_answers_map = [];
    $total_points = 0;

    foreach ($questions_with_answers as $question) {
      $correct_answers_map[$question['question_id']] = [
        'question_text' => $question['question_text'],
        'correct_answer' => $question['correct_answer'],
        'points' => $question['points'],
      ];
      $total_points += $question['points'];
    }

    $score = 0;
    $total_questions = count($correct_answers_map);
    $result_details = [];

    foreach ($submitted_answers as $question_id => $user_answer) {
      $question_id = str_replace('question_', '', $question_id);

      $is_correct = isset($correct_answers_map[$question_id]) && strtolower(trim($user_answer)) === strtolower(trim($correct_answers_map[$question_id]['correct_answer']));

      $points = $is_correct ? $correct_answers_map[$question_id]['points'] : 0;
      $score += $points;

      $result_details[] = [
        'question_id' => $question_id,
        'question_text' => $correct_answers_map[$question_id]['question_text'],
        'user_answer' => $user_answer,
        'correct_answer' => $correct_answers_map[$question_id]['correct_answer'],
        'points' => $correct_answers_map[$question_id]['points'],
        'is_correct' => $is_correct,
      ];
    }

    $percentage = $total_points > 0 ? ($score / $total_points) * 100 : 0;

    $time_taken = 0;
    $date_taken = date('Y-m-d H:i:s');

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

    $this->call->view('/users/result-page', ['result' => $result, 'result_details' => $result_details, 'quiz' => $quiz]);
  }
}
