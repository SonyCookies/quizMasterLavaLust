<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserQuiz extends Controller
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
    $this->call->view('/users/create-quiz');
  }
  public function save_quiz()
  {
    $userId = $this->session->userdata('userId');
    if (!$userId) {
      echo json_encode(['success' => false, 'message' => 'User ID not found in session']);
      return;
    }

    $title = $this->io->post('title');
    $quizType = $this->io->post('quizType');
    $difficulty = $this->io->post('difficulty');
    $category = $this->io->post('category');
    $isTimed = isset($_POST['isTimed']) ? 1 : 0;

    $data = [
      'user_id'     => $userId,
      'title'       => $title,
      'quizType'    => $quizType,
      'difficulty'  => $difficulty,
      'category'    => $category,
      'isTimed'     => $isTimed,
      'created_at'  => date('Y-m-d H:i:s'),
    ];

    $this->db->table('quizzes')->insert($data);
    $quizId = $this->db->table('quizzes')
      ->order_by('created_at', 'DESC')
      ->limit(1)
      ->get();

    if ($quizId) {
      echo json_encode([
        'success' => true,
        'message' => 'Quiz created successfully!',
        'quiz_id' => $quizId['quiz_id'],
        'quiz_type' => $quizId['quizType']
      ]);
    } else {
      echo json_encode([
        'success' => false,
        'message' => 'Failed to create quiz. Please try again.'
      ]);
    }
  }


  public function get_quizzes()
  {
    $quizzes = $this->db->table('quizzes')->get_all();

    if ($quizzes) {
      echo json_encode($quizzes);
    } else {
      echo json_encode([]);
    }
  }

  // public function save_quiz()
  // {
  //   $userId = $this->session->userdata('userId');

  //   print_r($userId);
  //   $title = $this->io->post('title');
  //   $quizType = $this->io->post('quizType');
  //   $difficulty = $this->io->post('difficulty');
  //   $category = $this->io->post('category');
  //   $isTimed = isset($_POST['isTimed']) ? 1 : 0;
  //   $showResults = isset($_POST['showResults']) ? 1 : 0;


  //   // Prepare data for database insertion
  //   $bind = array(
  //     'user_id'     => $userId,
  //     'title'       => $title,
  //     'quizType'    => $quizType,
  //     'difficulty'  => $difficulty,
  //     'category'    => $category,
  //     'isTimed'     => $isTimed,
  //     'showResults' => $showResults,
  //     'created_at'  => date('Y-m-d H:i:s', time()), // Convert the timestamp to DATETIME format
  //   );

  //   // Insert into the database
  //   $quizId = $this->db->table('quizzes')->insert($bind);

  //   if ($quizId) {
  //     // Success message
  //     $this->session->set_flashdata('message', 'Quiz created successfully!');
  //     redirect('question/create/' . $quizId);
  //   } else {
  //     // Error message
  //     $this->session->set_flashdata('message', 'Failed to create quiz.');
  //     redirect('quiz/create');
  //   }
  // }
}
