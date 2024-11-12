<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class User_Question extends Controller
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

  public function create($quizId)
  {
    $message = $this->session->flashdata('message');

    $quizData = $this->db->table('quizzes')->where('quiz_id', $quizId)->get();
    $questions = $this->db->table('questions')->where('quiz_id', $quizId)->get_all();

    if (!$quizData) {
      $this->session->set_flashdata('message', 'Quiz not found.');
      redirect('quiz/create');
    }

    $data = [
      'message' => $message,
      'quizId'  => $quizId,
      'quizData' => $quizData,
      'questions' => $questions,
    ];

    switch ($quizData['quizType']) {
      case 'multiple-choice':
        $this->call->view('/users/create-mc-question', $data);
        break;
      case 'true-false':
        $this->call->view('/users/create-tf-question', $data);
        break;
      case 'identification':
        $this->call->view('/users/create-id-question', $data);
        break;
      default:
        $this->session->set_flashdata('message', 'Invalid quiz type.');
        redirect('quiz/create');
        break;
    }
  }

  public function add_id_question()
  {
    $quizId = $this->io->post('quizId');
    $question = $this->io->post('question');
    $answer = $this->io->post('answer');

    $data = [
      'quiz_id' => $quizId,
      'question_text' => $question,
      'correct_answer' => $answer,
    ];

    $this->db->table('questions')->insert($data);

    $this->session->set_flashdata('message', 'Question added successfully!');

    redirect('question/create/' . $quizId);
  }

  public function update_id_question()
  {
    $questionId = $this->io->post('question_id');
    $questionText = $this->io->post('question_text');
    $correctAnswer = $this->io->post('correct_answer');

    $this->db->table('questions')
      ->where('question_id', $questionId)
      ->update([
        'question_text' => $questionText,
        'correct_answer' => $correctAnswer,
      ]);

    $this->session->set_flashdata('message', 'Question updated successfully!');
  }

  public function delete_id_question()
  {

    $questionId = $this->io->post('question_id');


    $this->db->table('questions')->where('question_id', $questionId)->delete();

    $this->session->set_flashdata('message', 'Question deleted successfully!');
  }
}
