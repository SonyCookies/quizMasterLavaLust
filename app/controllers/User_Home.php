<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class User_Home extends Controller
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
        // binago ko ito
        // $quizzes = $this->db->table('quizzes')->where('is_published', 1 )->where('is_archived', 0)->get_all();
        $quizzes = $this->db->table('quizzes')->where([
            'is_published' => 1,
            'is_archived' => 0
        ])->get_all();

        $this->call->view('/users/homepage', ['quizzes' => $quizzes]);
    }
}
