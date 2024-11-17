<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserQuizList extends Controller
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
    $quizzes = $this->db->table('quizzes as q')
      ->left_join('categories as c', 'q.categoryId = c.category_id')
      ->left_join('questions as qu', 'q.quiz_id = qu.quiz_id')
      ->select('q.*, c.name as category_name, COUNT(qu.question_id) as question_count, SUM(qu.points) as total_points')
      ->group_by('q.quiz_id') // Group by quiz ID to aggregate properly
      ->get_all();

    $categories = $this->db->table('categories')->get_all();

    $this->call->view('/users/quizzes', ['quizzes' => $quizzes, 'categories' => $categories]);
  }

  public function filter_quizzes()
  {
    $category = $this->io->get('category');
    $type = $this->io->get('type');

    $query = $this->db->table('quizzes as q')
      ->left_join('categories as c', 'q.categoryId = c.category_id')
      ->left_join('questions as qu', 'q.quiz_id = qu.quiz_id')
      ->select('q.*, c.name as category_name, COUNT(qu.question_id) as question_count, SUM(qu.points) as total_points');

    // Apply category filter
    if ($category) {
      $query->where('q.categoryId', $category);
    }

    // Apply quiz type filter
    if ($type) {
      $query->where('q.quizType', $type);
    }

    $quizzes = $query->group_by('q.quiz_id')->get_all();
    $categories = $this->db->table('categories')->get_all();

    $this->call->view('/users/quizzes', ['quizzes' => $quizzes, 'categories' => $categories]);
  }
}
