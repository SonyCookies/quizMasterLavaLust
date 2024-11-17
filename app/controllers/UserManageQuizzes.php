<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserManageQuizzes extends Controller
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
    $user = get_user_id();
    $quizzes = $this->db->table('quizzes as q')
      ->left_join('categories as c', 'q.categoryId = c.category_id')
      ->left_join('questions as qu', 'q.quiz_id = qu.quiz_id')
      ->select('q.*, c.category_id, c.name as category_name, COUNT(qu.question_id) as question_count, SUM(qu.points) as total_points')
      ->where('user_id', $user)
      ->group_by('q.quiz_id') // Group by quiz ID to aggregate properly
      ->get_all();

    $categories = $this->db->table('categories')->get_all();

    $this->call->view('/users/manage-quiz', ['quizzes' => $quizzes, 'categories' => $categories]);
  }

  public function update_quiz()
  {
    $quiz_id = $this->io->post('quiz_id');
    $title = $this->io->post('title');
    $category = $this->io->post('category');

    $data = [
      'title' => $title,
      'categoryId' => $category
    ];

    $this->db->table('quizzes')->where('quiz_id', $quiz_id)->update($data);
    $this->session->set_flashdata('success', 'Quiz updated successfully!');

    header("Location: /quiz/manage");
  }

  public function toggle_publish()
  {
    $quiz_id = $this->io->post('quiz_id');
    $is_published = $this->io->post('is_published') == 1 ? 0 : 1;

    $data = [
      'is_published' => $is_published
    ];

    $this->db->table('quizzes')->where('quiz_id', $quiz_id)->update($data);
    $this->session->set_flashdata('success', 'Quiz visibility updated successfully!');

    header("Location: /quiz/manage");
  }
}
