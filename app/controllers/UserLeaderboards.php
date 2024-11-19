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
      ->select('user_id, quiz_id, MAX(score) AS highest_score')
      ->group_by('user_id, quiz_id')
      ->get_all();

    $userTotalPoints = [];
    foreach ($topPoints as $entry) {
      if (!isset($userTotalPoints[$entry['user_id']])) {
        $userTotalPoints[$entry['user_id']] = 0;
      }
      $userTotalPoints[$entry['user_id']] += $entry['highest_score'];
    }


    foreach ($userTotalPoints as $userId => &$totalPoints) {
      $user = $this->db->table('users')
        ->select('username')
        ->where('id', $userId)
        ->get();
      $totalPoints = [
        'username' => $user['username'] ?? 'Unknown',
        'total_points' => $totalPoints
      ];
    }


    uasort($userTotalPoints, function ($a, $b) {
      return $b['total_points'] - $a['total_points'];
    });

    $topUsers = array_slice($userTotalPoints, 0, 5);


    $highestAccuracy = $this->db->table('user_scores')
      ->select('user_id, quiz_id, MAX(percentage) AS highest_accuracy')
      ->group_by('user_id, quiz_id')  
      ->get_all();

    $userTotalAccuracy = [];
    foreach ($highestAccuracy as $entry) {
      if (!isset($userTotalAccuracy[$entry['user_id']])) {
        $userTotalAccuracy[$entry['user_id']] = [
          'total_accuracy' => 0,
          'quiz_count' => 0
        ];
      }
      $userTotalAccuracy[$entry['user_id']]['total_accuracy'] += $entry['highest_accuracy'];
      $userTotalAccuracy[$entry['user_id']]['quiz_count']++;
    }

    foreach ($userTotalAccuracy as &$entry) {
      $entry['average_accuracy'] = $entry['quiz_count'] > 0 ? $entry['total_accuracy'] / $entry['quiz_count'] : 0;
    }

    uasort($userTotalAccuracy, function ($a, $b) {
      return $b['average_accuracy'] - $a['average_accuracy'];
    });

    foreach ($userTotalAccuracy as $userId => &$entry) {
      $user = $this->db->table('users')
        ->select('username')
        ->where('id', $userId)
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


    $weeklyRanking = $this->db->table('leaderboards')
      ->select('user_id, SUM(score) AS weekly_points')
      ->where('ranking_date', '>=', date('Y-m-d 00:00:00', strtotime('monday this week')))
      ->where('ranking_date', '<=', date('Y-m-d 23:59:59', strtotime('sunday this week')))
      ->group_by('user_id')
      ->order_by('weekly_points', 'DESC')
      ->limit(5)
      ->get_all();

    foreach ($weeklyRanking as &$entry) {
      $user = $this->db->table('users')
        ->select('username')
        ->where('id', $entry['user_id'])
        ->get();
      $entry['username'] = $user['username'] ?? 'Unknown';
    }


    $data = [
      'topPoints' => $topUsers,
      'weeklyRanking' => $weeklyRanking,
      'topAccuracy' => array_slice($userTotalAccuracy, 0, 5),  // Top 5 users
      'categories' => $categories,
      'quizzes' => $quizzes,
    ];

    $this->call->view('/users/leaderboards', $data);
  }


  public function filter_quizzes()
  {
    $category = $this->io->get('category');
    $type = $this->io->get('type');

    $topPoints = $this->db->table('user_scores')
      ->select('user_id, quiz_id, MAX(score) AS highest_score')
      ->group_by('user_id, quiz_id')
      ->get_all();

    $userTotalPoints = [];
    foreach ($topPoints as $entry) {
      if (!isset($userTotalPoints[$entry['user_id']])) {
        $userTotalPoints[$entry['user_id']] = 0;
      }
      $userTotalPoints[$entry['user_id']] += $entry['highest_score'];
    }

    foreach ($userTotalPoints as $userId => &$totalPoints) {
      $user = $this->db->table('users')
        ->select('username')
        ->where('id', $userId)
        ->get();
      $totalPoints = [
        'username' => $user['username'] ?? 'Unknown',
        'total_points' => $totalPoints
      ];
    }

    uasort($userTotalPoints, function ($a, $b) {
      return $b['total_points'] - $a['total_points'];
    });

    $topUsers = array_slice($userTotalPoints, 0, 5);

    $weeklyRanking = $this->db->table('leaderboards')
      ->select('user_id, SUM(score) AS weekly_points')
      ->where('ranking_date', '>=', date('Y-m-d 00:00:00', strtotime('monday this week')))
      ->where('ranking_date', '<=', date('Y-m-d 23:59:59', strtotime('sunday this week')))
      ->group_by('user_id')
      ->order_by('weekly_points', 'DESC')
      ->limit(5)
      ->get_all();

    foreach ($weeklyRanking as &$entry) {
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

    $query = $this->db->table('quizzes as q')
      ->left_join('categories as c', 'q.categoryId = c.category_id')
      ->left_join('questions as qu', 'q.quiz_id = qu.quiz_id')
      ->select('q.quiz_id, q.title, q.quizType, c.name as category_name, 
                    IFNULL(COUNT(qu.question_id), 0) as question_count, 
                    IFNULL(SUM(qu.points), 0) as total_points');

    if ($category) {
      $query->where('q.categoryId', $category);
    }

    if ($type) {
      $query->where('q.quizType', $type);
    }

    $quizzes = $query->group_by('q.quiz_id')->get_all();

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
      'topPoints' => $topUsers,
      'topAccuracy' => $topAccuracy,
      'categories' => $categories,
      'quizzes' => $quizzes,
      'weeklyRanking' => $weeklyRanking
    ];

    $this->call->view('/users/leaderboards', $data);
  }

  public function full_points()
  {
    $highestScores = $this->db->table('user_scores')
      ->select('user_id, quiz_id, MAX(score) AS highest_score')
      ->group_by('user_id, quiz_id')
      ->get_all();

    $userTotalPoints = [];
    foreach ($highestScores as $entry) {
      if (!isset($userTotalPoints[$entry['user_id']])) {
        $userTotalPoints[$entry['user_id']] = 0;
      }
      $userTotalPoints[$entry['user_id']] += $entry['highest_score'];
    }

    foreach ($userTotalPoints as $userId => &$totalPoints) {
      $user = $this->db->table('users')
        ->select('username')
        ->where('id', $userId)
        ->get();
      $totalPoints = [
        'username' => $user['username'] ?? 'Unknown',
        'total_points' => $totalPoints
      ];
    }

    uasort($userTotalPoints, function ($a, $b) {
      return $b['total_points'] - $a['total_points'];
    });

    $data = [
      'leaderboard' => array_slice($userTotalPoints, 0, 5)
    ];

    $this->call->view('/users/full-points-leaderboard', $data);
  }


  public function full_accuracy()
  {
    $highestAccuracy = $this->db->table('user_scores')
      ->select('user_id, quiz_id, MAX(percentage) AS highest_accuracy')
      ->group_by('user_id, quiz_id')
      ->get_all();

    $userTotalAccuracy = [];
    foreach ($highestAccuracy as $entry) {
      if (!isset($userTotalAccuracy[$entry['user_id']])) {
        $userTotalAccuracy[$entry['user_id']] = [
          'total_accuracy' => 0,
          'quiz_count' => 0
        ];
      }
      $userTotalAccuracy[$entry['user_id']]['total_accuracy'] += $entry['highest_accuracy'];
      $userTotalAccuracy[$entry['user_id']]['quiz_count']++;
    }

    foreach ($userTotalAccuracy as &$entry) {
      $entry['average_accuracy'] = $entry['quiz_count'] > 0 ? $entry['total_accuracy'] / $entry['quiz_count'] : 0;
    }

    uasort($userTotalAccuracy, function ($a, $b) {
      return $b['average_accuracy'] - $a['average_accuracy'];
    });

    foreach ($userTotalAccuracy as $userId => &$entry) {
      $user = $this->db->table('users')
        ->select('username')
        ->where('id', $userId)
        ->get();
      $entry['username'] = $user['username'] ?? 'Unknown';
    }

    $data = [
      'topAccuracy' => array_slice($userTotalAccuracy, 0, 5)  // Get the top 5 users by average accuracy
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
