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
    $quizzes = $this->db->table('quizzes as q')->left_join('categories as c', 'q.categoryId = c.category_id')->get_all();
    $categories = $this->db->table('categories')->get_all();


    //get the count of question from questions table where it has a quiz id, can i use join?
    $this->call->view('/users/create-quiz', ['categories' => $categories, 'quizzes' => $quizzes]);
  }

  public function save_quiz()
  {
    $userId = $this->session->userdata('userId');
    $title = $this->io->post('title');
    $quizType = $this->io->post('quizType');
    $category = $this->io->post('category');

    $data = [
      'user_id'     => $userId,
      'title'       => $title,
      'quizType'    => $quizType,
      'categoryId'  => $category,
    ];

    $this->db->table('quizzes')->insert($data);

    $quiz_id = $this->db->last_id();
    $quiz = $this->db->table('quizzes')
      ->where('quiz_id', $quiz_id)->get();
    $category = $this->db->table('categories')->where('category_id', $quiz['categoryId'])->get();

    switch ($quizType) {
      case "multiple-choice":
        header("Location: /quiz/create/multiplechoice/{$quiz_id}");
        exit;
      case "identification":
        header("Location: /quiz/create/identification/{$quiz_id}");
        exit;
      case "true-false":
        header("Location: /quiz/create/truefalse/{$quiz_id}");
        break;
    }
  }
  public function get_quizzes()
  {

    $quizzes = $this->db->table('quizzes as q')->left_join('categories as c', 'q.categoryId=c.category_id')->get_all();

    header('Content-Type: application/json');
    echo json_encode($quizzes);
  }
}
