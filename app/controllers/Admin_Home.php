<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Admin_Home extends Controller
{

    public function __construct()
    {
        parent::__construct();

        if (! logged_in()) {
            redirect('auth/login');
        }
    }

    // dashboard
    public function dashboard()
    {
        // $quizzes = $this->db->table('quizzes')->where('is_published', 1 )->get_all();

        $this->call->view('/admin/dashboard');
        // $this->call->view('/users/homepage', ['quizzes' => $quizzes]);
    }

    // users
    public function users()
    {
        $this->call->view('/admin/users');
    }

    // quizzes
    public function quizzes()
    {
        $allQuizzes = $this->db->table('quizzes')->where('is_published', 1)->where('is_archived', 0)->get_all();
        // OUTPUT: SELECT * FROM quizzes WHERE is_published = 1 && is_archived = 0

        $forApprovalQuiz = $this->db->table('quizzes')->where('is_published', 0)->where('is_rejected', 0)->get_all();
        // OUTPUT: SELECT * FROM quizzes WHERE is_published = 0 && is_rejected = 0;

        $forArchivedQuiz = $this->db->table('quizzes')->where('is_archived', 1)->get_all();
        // OUTPUT: SELECT * FROM quizzes WHERE is_archived = 1;

        $totalQuizzes = $this->db->table('quizzes')
            ->select_count('is_published', 'totalQuizzes')
            ->where('is_published', 1)
            ->get();
        // OUTPUT: SELECT COUNT(is_published) AS totalQuizzes WHERE is_pubished == 1;

        $pendingQuizzes = $this->db->table('quizzes')
            ->select_count('is_published', 'pendingQuizzes')
            ->where('is_published', 0)
            ->where('is_rejected', 0)
            ->get();
        // OUTPUT: SELECT COUNT(is_published) AS pendingQuizzes WHERE is_pubished == 0 && is_rejected == 0;

        $archivedQuizzes = $this->db->table('quizzes')
            ->select_count('is_archived', 'archivedQuizzes')
            ->where('is_archived', 1)
            ->get();

        $data = array(
            'totalQuizzes' => $totalQuizzes,
            'pendingQuizzes' => $pendingQuizzes,
            'forApprovalQuiz' => $forApprovalQuiz,
            'forArchivedQuiz' => $forArchivedQuiz,
            'allQuizzes' => $allQuizzes,
            'archivedQuizzes' => $archivedQuizzes
        );

        $this->call->view('/admin/quizzes', $data);
    }
    // reject quiz
    public function rejectQuiz($quiz_id)
    {
        $rejectQuiz = [
            'is_rejected' => 1
        ];

        if ($this->db->table('quizzes')->where('quiz_id', $quiz_id)->update($rejectQuiz)) {
            redirect('admin/quizzes');
        }
    }
    // approve quiz
    public function approveQuiz($quiz_id)
    {

        $approveQuiz = [
            'is_published' => 1
        ];

        if ($this->db->table('quizzes')->where('quiz_id', $quiz_id)->update($approveQuiz)) {
            redirect('admin/quizzes');
        }
    }
    // archive quiz
    public function archiveQuiz($quiz_id)
    {
        $archiveQuiz = [
            'is_archived' => 1
        ];

        if ($this->db->table('quizzes')->where('quiz_id', $quiz_id)->update($archiveQuiz)) {
            redirect('admin/quizzes');
        }
    }
    // unarchive quiz
    public function publishQuiz($quiz_id)
    {
        $publishQuiz = [
            'is_archived' => 0
        ];

        if ($this->db->table('quizzes')->where('quiz_id', $quiz_id)->update($publishQuiz)) {
            redirect('admin/quizzes');
        }
    }



    // leaderboards
    public function leaderboards()
    {
        $this->call->view('/admin/leaderboards');
    }

    // settings
    public function settings()
    {
        $this->call->view('/admin/settings');
    }
}
