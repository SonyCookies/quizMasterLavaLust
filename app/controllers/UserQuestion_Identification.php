<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserQuestion_Identification extends Controller
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
    $quizData = $this->db->table('quizzes')->where('quiz_id', $quiz_id)->get();

    $this->call->view('/users/id-create', ['quizData' => $quizData]);
  }

  public function save_id_question()
  {
    if ($this->input->is_ajax_request()) {
      $questionText = $this->input->post('questionText');
      $answer = $this->input->post('answer');
      $points = $this->input->post('points');

      $data = [
        'question_text' => $questionText,
        'answer' => $answer,
        'points' => $points
      ];

      if ($this->db->table('questions')->insert($data)) {
        echo json_encode(['success' => true, 'message' => 'Question added successfully']);
      } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add question']);
      }
    } else {
      show_404();
    }
  }
}
