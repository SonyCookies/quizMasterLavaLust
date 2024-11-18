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
        $user_id = get_user_id();

        $quizzesTaken = $this->db->table('user_scores')
            ->select('COUNT(DISTINCT quiz_id) AS quizzes_taken')
            ->where('user_id', $user_id)
            ->get();
        $quizzesTakenCount = $quizzesTaken['quizzes_taken'];

        $quizzesCreated = $this->db->table('quizzes')
            ->select('COUNT(quiz_id) AS quizzes_created')
            ->where('user_id', $user_id)
            ->get();
        $quizzesCreatedCount = $quizzesCreated['quizzes_created'];

            $averageScore = $this->db->table('user_scores')
                ->select('AVG(percentage) AS average_score')
                ->where('user_id', $user_id)
                ->get();

            $averageScoreValue = ($averageScore['average_score'] === NULL) ? 0 : number_format($averageScore['average_score'], 2);


        $quizzes = $this->db->table('quizzes')
            ->where('is_published', 1)
            ->order_by('RAND()')
            ->limit(3)
            ->get_all();

        $this->call->view('/users/homepage', [
            'quizzes' => $quizzes,
            'quizzesTakenCount' => $quizzesTakenCount,
            'quizzesCreatedCount' => $quizzesCreatedCount,
            'averageScoreValue' => $averageScoreValue
        ]);
    }
}
