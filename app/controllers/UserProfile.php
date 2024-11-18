<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserProfile extends Controller
{

  public function __construct()
  {
    parent::__construct();

    if (! logged_in()) {
      redirect('auth/login');
    }
  }

  public function index()
  {
    $user_id = get_user_id();
    $user = $this->db->table('users')->select('id, username, email, created_at')->where('id', get_user_id())->get();

    $recentScores = $this->db->table('user_scores')
      ->select('quizzes.title AS quiz_name, user_scores.percentage, user_scores.date_taken')  // Add date_taken here
      ->join('quizzes', 'user_scores.quiz_id = quizzes.quiz_id')
      ->where('user_scores.user_id', $user_id)
      ->order_by('user_scores.date_taken', 'DESC')
      ->limit(5)
      ->get_all();

    $chartData = $this->db->table('user_scores')
      ->select('user_scores.percentage, user_scores.date_taken')  // Just the percentage and date_taken for chart
      ->where('user_scores.user_id', $user_id)
      ->order_by('user_scores.date_taken', 'ASC')  // Ensure data is ordered by date
      ->get_all();


    if (empty($recentScores)) {
      $recentScores = [];
    }

    $overallStatistics = $this->db->table('user_scores')
      ->select('COUNT(DISTINCT quiz_id) AS quizzes_completed, AVG(score) AS average_score, AVG(percentage) AS accuracy_rate, SUM(score) AS total_points')
      ->where('user_id', $user_id)
      ->get();

    $quizzesCompleted = $overallStatistics['quizzes_completed'] ?? 0;
    $averageScore = ($overallStatistics['average_score'] === NULL) ? 0 : number_format($overallStatistics['average_score'], 2);
    $accuracyRate = ($overallStatistics['accuracy_rate'] === NULL) ? 0 : number_format($overallStatistics['accuracy_rate'], 2);
    $totalPoints = $overallStatistics['total_points'] ?? 0;

    $overallStatistics = [
      'quizzes_completed' => $quizzesCompleted,
      'average_score' => $averageScore,
      'accuracy_rate' => $accuracyRate,
      'total_points' => $totalPoints,
    ];


    $this->call->view('/users/profile', ['user' => $user, 'recentScores' => $recentScores, 'overallStatistics' => $overallStatistics, 'chartData' => $chartData]);
  }

  public function update_profile()
  {
    $user_id = get_user_id(); // Get the current user's ID
    $username = $this->io->post('username'); // Get the posted username

    $existing_user = $this->db
      ->table('users')
      ->select('id')
      ->where('username', $username)
      ->not_where('id', $user_id)
      ->get();

    if ($existing_user) {
      $this->session->set_flashdata('error', 'The username is already taken. Please choose a different one.');
      header("Location: /profile");
    }

    $data = [
      'username' => $username,
    ];

    $this->db->table('users')->where('id', $user_id)->update($data);

    $this->session->set_flashdata('success', 'User updated successfully!');
    header("Location: /profile");
  }

  public function quiz_scores()
  {
    $user_id = get_user_id();

    $quizScores = $this->db->table('user_scores')
      ->select('quizzes.title AS quiz_name, quizzes.quizType as quiz_type, quizzes.quiz_id, categories.name AS category_name, quizzes.created_at, user_scores.score, user_scores.time_taken, user_scores.percentage, user_scores.date_taken')
      ->join('quizzes', 'user_scores.quiz_id = quizzes.quiz_id')
      ->join('categories', 'quizzes.categoryId = categories.category_id')
      ->where('user_scores.user_id', $user_id)
      ->order_by('user_scores.date_taken', 'DESC')
      ->get_all();




    $this->call->view('/users/quiz-scores', ['quizScores' => $quizScores]);
  }
}
