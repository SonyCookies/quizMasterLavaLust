<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Admin_Home extends Controller
{

    public function __construct()
    {
        parent::__construct();

        if (! logged_in()) {
            redirect('auth');
        }
    }

    public function dashboard()
    {
        // $quizzes = $this->db->table('quizzes')->where('is_published', 1 )->get_all();

        $this->call->view('/admin/dashboard');
        // $this->call->view('/users/homepage', ['quizzes' => $quizzes]);
    }
}