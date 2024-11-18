<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserLeaderboards extends Controller
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
    $topPoints = $this->db->table('user_scores')
      ->select('user_id, SUM(score) AS total_points')
      ->group_by('user_id')
      ->order_by('total_points', 'DESC')
      ->limit(5)
      ->get_all();

    foreach ($topPoints as &$entry) {
      $user = $this->db->table('users')
        ->select('username')
        ->where('id', $entry['user_id'])
        ->get();
      $entry['username'] = $user['username'] ?? 'Unknown';
    }

    $topAccuracy = $this->db->table('user_scores')
      ->select('user_id, AVG(percentage) AS average_accuracy')
      ->group_by('user_id')
      ->order_by('average_accuracy', 'DESC')
      ->limit(5)
      ->get_all();

    foreach ($topAccuracy as &$entry) {
      $user = $this->db->table('users')
        ->select('username')
        ->where('id', $entry['user_id'])
        ->get();
      $entry['username'] = $user['username'] ?? 'Unknown';
    }

    $categories = $this->db->table('categories')->get_all();

    $quizzes = $this->db->table('quizzes as q')
      ->left_join('categories as c', 'q.categoryId = c.category_id')
      ->left_join('questions as qu', 'q.quiz_id = qu.quiz_id')
      ->select('q.quiz_id, q.title, q.quizType, c.name as category_name, 
                    IFNULL(COUNT(qu.question_id), 0) as question_count, 
                    IFNULL(SUM(qu.points), 0) as total_points')
      ->group_by('q.quiz_id')
      ->get_all();

    foreach ($quizzes as &$quiz) {
      $topScores = $this->db->table('user_scores as us')
        ->left_join('users as u', 'us.user_id = u.id')
        ->select('u.username, us.score')
        ->where('us.quiz_id', $quiz['quiz_id'])
        ->order_by('us.score', 'DESC')
        ->limit(3)
        ->get_all();

      $quiz['top_scores'] = $topScores;
    }

    $data = [
      'topPoints' => $topPoints,
      'topAccuracy' => $topAccuracy,
      'categories' => $categories,
      'quizzes' => $quizzes
    ];

    $this->call->view('/users/leaderboards', $data);
  }


  public function filter_quizzes()
  {
    // Get the filter parameters
    $category = $this->io->get('category');
    $type = $this->io->get('type');

    // Fetch the top 5 points leaderboard
    $topPoints = $this->db->table('user_scores')
      ->select('user_id, SUM(score) AS total_points')
      ->group_by('user_id')
      ->order_by('total_points', 'DESC')
      ->limit(5)
      ->get_all();

    // Add username to the topPoints
    foreach ($topPoints as &$entry) {
      $user = $this->db->table('users')
        ->select('username')
        ->where('id', $entry['user_id'])
        ->get();
      $entry['username'] = $user['username'] ?? 'Unknown';
    }

    // Fetch the top 5 accuracy leaderboard
    $topAccuracy = $this->db->table('user_scores')
      ->select('user_id, AVG(percentage) AS average_accuracy')
      ->group_by('user_id')
      ->order_by('average_accuracy', 'DESC')
      ->limit(5)
      ->get_all();

    // Add username to the topAccuracy
    foreach ($topAccuracy as &$entry) {
      $user = $this->db->table('users')
        ->select('username')
        ->where('id', $entry['user_id'])
        ->get();
      $entry['username'] = $user['username'] ?? 'Unknown';
    }

    // Fetch all categories
    $categories = $this->db->table('categories')->get_all();

    // Build the query for filtered quizzes
    $query = $this->db->table('quizzes as q')
      ->left_join('categories as c', 'q.categoryId = c.category_id')
      ->left_join('questions as qu', 'q.quiz_id = qu.quiz_id')
      ->select('q.quiz_id, q.title, q.quizType, c.name as category_name, 
                    IFNULL(COUNT(qu.question_id), 0) as question_count, 
                    IFNULL(SUM(qu.points), 0) as total_points');

    // Apply category and type filters if provided
    if ($category) {
      $query->where('q.categoryId', $category);
    }

    if ($type) {
      $query->where('q.quizType', $type);
    }

    // Get filtered quizzes
    $quizzes = $query->group_by('q.quiz_id')->get_all();

    // Attach the top 3 scores for each quiz
    foreach ($quizzes as &$quiz) {
      $topScores = $this->db->table('user_scores as us')
        ->left_join('users as u', 'us.user_id = u.id')
        ->select('u.username, us.score')
        ->where('us.quiz_id', $quiz['quiz_id'])
        ->order_by('us.score', 'DESC')
        ->limit(3)
        ->get_all();

      $quiz['top_scores'] = $topScores;
    }

    // Pass all necessary data to the view
    $data = [
      'topPoints' => $topPoints,
      'topAccuracy' => $topAccuracy,
      'categories' => $categories,
      'quizzes' => $quizzes
    ];

    $this->call->view('/users/leaderboards', $data);
  }

  public function full_points()
  {
    $leaderboard = $this->db->table('user_scores')
      ->select('user_id, SUM(score) AS total_points')
      ->group_by('user_id')
      ->order_by('total_points', 'DESC')
      ->get_all();

    foreach ($leaderboard as &$entry) {
      $user = $this->db->table('users')
        ->select('username')
        ->where('id', $entry['user_id'])
        ->get();
      $entry['username'] = $user['username'] ?? 'Unknown';
    }

    $data = [
      'leaderboard' => $leaderboard
    ];

    $this->call->view('/users/full-points-leaderboard', $data);
  }

  public function full_accuracy()
  {
    $topAccuracy = $this->db->table('user_scores')
      ->select('user_id, AVG(percentage) AS average_accuracy')
      ->group_by('user_id')
      ->order_by('average_accuracy', 'DESC')
      ->get_all();

    foreach ($topAccuracy as &$entry) {
      $user = $this->db->table('users')
        ->select('username')
        ->where('id', $entry['user_id'])
        ->get();
      $entry['username'] = $user['username'] ?? 'Unknown';
    }

    $data = [
      'topAccuracy' => $topAccuracy
    ];

    $this->call->view('/users/full-accuracy-leaderboard', $data);
  }

  public function quiz_leaderboard($quiz_id)
  {
    // Validate quiz ID
    if (empty($quiz_id)) {
      show_404(); // Handle invalid quiz IDs
    }

    $quiz = $this->db->table('quizzes as q')
      ->left_join('categories as c', 'q.categoryId = c.category_id')
      ->select('q.quiz_id, q.title, c.name as category_name')
      ->where('q.quiz_id', $quiz_id)
      ->get();


    if (!$quiz) {
      show_404(); // Quiz not found
    }

    // Fetch full leaderboard for the quiz
    $leaderboard = $this->db->table('user_scores as us')
      ->left_join('users as u', 'us.user_id = u.id')
      ->select('us.user_id, u.username, us.score, us.percentage, us.date_taken')
      ->where('us.quiz_id', $quiz_id)
      ->order_by('us.score', 'DESC')
      ->get_all();

    // Prepare data for the view
    $data = [
      'quiz' => $quiz,
      'leaderboard' => $leaderboard
    ];

    // Render the leaderboard view
    $this->call->view('/users/quiz-leaderboards', $data);
  }
}
