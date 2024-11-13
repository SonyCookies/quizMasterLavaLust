<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class User_Home extends Controller
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
        $quizzes = $this->db->table('quizzes')->where('is_published', 1 )->get_all();

        $this->call->view('/users/homepage', ['quizzes' => $quizzes]);
    }
}
