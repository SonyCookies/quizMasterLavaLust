<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserQuestion_TrueFalse extends Controller
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
      ->where('quiz_id', $quiz_id)->get();
    $category = $this->db->table('categories')->where('category_id', $quiz['categoryId'])->get();
    $questions = $this->db->table('questions')->where('quiz_id', $quiz_id)->order_by('question_id', 'DESC')->get_all();
    $points = $this->db->table('questions')->select_sum('points', 'total')->where('quiz_id', $quiz_id)->get();

    $this->call->view('/users/tf-create', ['quiz' => $quiz, 'category' => $category, 'questions' => $questions, 'totalPoints' => $points['total']]);
  }


  public function save_tf_question()
  {
    $quiz_id = $this->io->post('quizId');
    $answer_mode = $this->io->post('answerMode');
    $questionText = $this->io->post('questionText');
    $answer = $this->io->post('answer');
    $points = $this->io->post('points');

    $data = [
      'quiz_id' => $quiz_id,
      'answer_mode' => $answer_mode,
      'question_text' => $questionText,
      'correct_answer' => $answer,
      'points' => $points
    ];

    $this->db->table('questions')->insert($data);
    $this->session->set_flashdata('success', 'Question added successfully!');


    header("Location: /quiz/create/truefalse/{$quiz_id}");
  }

  public function delete_tf_question()
  {
    $quiz_id = $this->io->post('quiz_id');
    $question_id = $this->io->post('question_id');

    $this->db->table('questions')->where('question_id', $question_id)->delete();
    $this->session->set_flashdata('success', 'Question deleted successfully!');

    header("Location: /quiz/create/truefalse/{$quiz_id}");
  }

  public function update_tf_question()
  {
    $quiz_id = $this->io->post('quiz_id');
    $question_id = $this->io->post('question_id');
    $answer_mode = $this->io->post('answerMode');
    $questionText = $this->io->post('questionText');
    $answer = $this->io->post('answer');
    $points = $this->io->post('points');

    $data = [
      'question_id' => $question_id,
      'answer_mode' => $answer_mode,
      'question_text' => $questionText,
      'correct_answer' => $answer,
      'points' => $points
    ];

    $this->db->table('questions')->where('question_id', $question_id)->update($data);
    $this->session->set_flashdata('success', 'Question updated successfully!');

    header("Location: /quiz/create/truefalse/{$quiz_id}");
  }
}
