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

    $questions_with_answers = $this->db->table('questions')
      ->left_join('answer_options', 'questions.question_id = answer_options.question_id')
      ->select('questions.question_id, questions.question_text, questions.points, answer_options.option_text AS correct_answer, answer_options.is_correct')
      ->where('questions.quiz_id', $quiz_id)
      ->where('answer_options.is_correct', 1)
      ->get_all();

    $correct_answers_map = [];
    $total_points = 0;

    foreach ($questions_with_answers as $answer) {
      $correct_answers_map[$answer['question_id']] = [
        'question_text' => $answer['question_text'],
        'correct_answer' => $answer['correct_answer'],
        'points' => $answer['points'],
      ];
      $total_points += $answer['points'];
    }

    $score = 0;
    $total_questions = count($correct_answers_map);
    $result_details = [];

    foreach ($submitted_answers as $question_id => $user_answer) {
      $question_id = str_replace('question_', '', $question_id);

      $is_correct = isset($correct_answers_map[$question_id]) && $user_answer === $correct_answers_map[$question_id]['correct_answer'];

      $points = $is_correct ? $correct_answers_map[$question_id]['points'] : 0;
      $score += $points;

      $result_details[] = [
        'question_id' => $question_id,
        'question_text' => $correct_answers_map[$question_id]['question_text'],
        'user_answer' => $user_answer,
        'correct_answer' => isset($correct_answers_map[$question_id]) ? $correct_answers_map[$question_id]['correct_answer'] : 'N/A',
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

    $ranking_date = date('Y-m-d H:i:s');

    $data = [
      'user_id' => $user_id,
      'quiz_id' => $quiz_id,
      'score' => $score,
      'ranking_date' => $ranking_date,
    ];

    $this->db->raw("
          INSERT INTO leaderboards (user_id, quiz_id, score, ranking_date)
          VALUES (:user_id, :quiz_id, :score, :ranking_date)
          ON DUPLICATE KEY UPDATE
              score = GREATEST(score, VALUES(score))
      ", $data);

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
