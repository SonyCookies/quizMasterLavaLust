<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class User_Quiz extends Controller
{

  public function __construct()
  {
    parent::__construct();

    if (! logged_in()) {
      redirect('auth');
    }
  }

  public function index()
  {
    $this->call->view('/users/create-quiz');
  }
  public function submit()
  {
    $userId = $this->session->userdata('userId');

    print_r($userId);
    $title = $this->io->post('title');
    $quizType = $this->io->post('quizType');
    $difficulty = $this->io->post('difficulty');
    $category = $this->io->post('category');
    $isTimed = isset($_POST['isTimed']) ? 1 : 0;
    $showResults = isset($_POST['showResults']) ? 1 : 0;


    // Prepare data for database insertion
    $bind = array(
      'user_id'     => $userId,
      'title'       => $title,
      'quizType'    => $quizType,
      'difficulty'  => $difficulty,
      'category'    => $category,
      'isTimed'     => $isTimed,
      'showResults' => $showResults,
      'created_at'  => date('Y-m-d H:i:s', time()), // Convert the timestamp to DATETIME format
    );

    // Insert into the database
    $quizId = $this->db->table('quizzes')->insert($bind);

    if ($quizId) {
      // Success message
      $this->session->set_flashdata('message', 'Quiz created successfully!');
      redirect('question/create/' . $quizId);
    } else {
      // Error message
      $this->session->set_flashdata('message', 'Failed to create quiz.');
      redirect('quiz/create');
    }
  }

  public function get_quizzes()
  {
    $quizzes = $this->db->table('quizzes')->get_all();
    print_r($quizzes);

    if ($quizzes) {
      echo json_encode($quizzes);
    } else {
      echo json_encode([]);
    }
  }
}
