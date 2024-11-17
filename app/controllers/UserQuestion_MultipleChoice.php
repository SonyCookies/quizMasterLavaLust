<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserQuestion_MultipleChoice extends Controller
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

    $choices = $this->db->table('answer_options')->get_all();

    $this->call->view('/users/mc-create', ['quiz' => $quiz, 'category' => $category, 'questions' => $questions, 'totalPoints' => $points['total'], 'choices' => $choices]);
  }


  public function save_mc_question()
  {

    $quiz_id = $this->io->post('quizId');
    $answer_mode = $this->io->post('answerMode');
    $questionText = $this->io->post('questionText');
    $points = $this->io->post('points');
    $choices = $this->io->post('choices');
    $correctAnswer = $this->io->post('correctAnswer');

    $data = [
      'quiz_id' => $quiz_id,
      'answer_mode' => $answer_mode,
      'question_text' => $questionText,
      'correct_answer' => $correctAnswer,
      'points' => $points,
    ];


    $this->db->table('questions')->insert($data);
    $question_id = $this->db->last_id();

    foreach ($choices as $choice) {
      $isCorrect = ($choice === $correctAnswer) ? 1 : 0;
      $options_data = [
        'question_id' => $question_id,
        'option_text' => $choice,
        'is_correct' => $isCorrect
      ];


      $this->db->table('answer_options')->insert($options_data);
    }
    $this->session->set_flashdata('success', 'Question added successfully!');

    header("Location: /quiz/create/multiplechoice/{$quiz_id}");
  }

  public function delete_mc_question()
  {
    $quiz_id = $this->io->post('quiz_id');
    $question_id = $this->io->post('question_id');

    $this->db->table('questions')->where('question_id', $question_id)->delete();
    $this->session->set_flashdata('success', 'Question deleted successfully!');

    header("Location: /quiz/create/multiplechoice/{$quiz_id}");
  }

  public function get_choices_question()
  {
    $question_id = $this->io->post('question_id');
    $choices = $this->db->table('answer_options')->where('question_id', $question_id)->get_all();

    $choices = [
      'choices' => $choices,
    ];

    // Return the response in JSON format
    header('Content-Type: application/json');
    echo json_encode($choices);
  }


  public function update_mc_question()
  {
    $quiz_id = $this->io->post('quiz_id');
    $question_id = $this->io->post('question_id');
    $answer_mode = $this->io->post('answerMode');
    $questionText = $this->io->post('questionText');
    $points = $this->io->post('points');
    $correctAnswer = $this->io->post('correctAnswer');

    $data = [
      'quiz_id' => $quiz_id,
      'answer_mode' => $answer_mode,
      'question_text' => $questionText,
      'correct_answer' => $correctAnswer,
      'points' => $points,
      'question_id' => $question_id
    ];


    $this->db->table('questions')->where('question_id', $question_id)->update($data);

    $this->session->set_flashdata('success', 'Question updated successfully!');

    header("Location: /quiz/create/multiplechoice/{$quiz_id}");
  }
}
