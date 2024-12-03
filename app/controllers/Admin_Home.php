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


    public function generateReports()
    {
        $totalUser = $this->db->table('users')
            ->select_count('is_deactivated', 'active')
            ->where(['is_admin' => 0, 'is_deactivated' => 0])
            ->get();

        $totalDeactivatedUser = $this->db->table('users')
            ->select_count('is_deactivated', 'deactivated')
            ->where(['is_admin' => 0, 'is_deactivated' => 1])
            ->get();

        $averagePoints = $this->db->table('user_scores')
            ->select('AVG(score) as avePoints')
            ->get();

        $averageAccuracy = $this->db->table('user_scores')
            ->select('AVG(percentage) as aveAccuracy')
            ->get();

        $totalQuizzes = $this->db->table('quizzes')
            ->select_count('is_published', 'totalQuizzes')
            ->where('is_published', 1)
            ->get();

        $topPlayer = $this->db->table('users as u')
            ->left_join('user_scores as us', 'u.id=us.user_id')
            ->group_by('u.id')
            ->select('u.username as name, SUM(us.score) as points, AVG(us.percentage) as accuracy')
            ->where('u.is_deactivated', 0)
            ->where('u.is_admin', 0)
            ->order_by('points', 'DESC')
            ->get();

        $allUser = $this->db->table('users')
            ->where(['is_admin' => 0, 'is_deactivated' => 0])
            ->order_by('created_at', 'DESC')
            ->get_all();

        $allQuizzes = $this->db->table('quizzes as q')
            ->left_join('categories as c', 'q.categoryId = c.category_id')
            ->select('c.name as category_name, COUNT(*) as total, q.title as title, q.quizType as quizType, quiz_id')
            ->where(['q.is_published' => 1, 'q.is_archived' => 0])
            ->group_by('c.name')
            ->order_by('total', 'DESC')
            ->get_all();

        $totalPointsPlayers = $this->db->table('users as u')
            ->left_join('user_scores as us', 'u.id=us.user_id')
            ->select('u.username as name, SUM(us.score) as points, AVG(us.percentage) as accuracy')
            ->where('u.is_deactivated', 0)
            ->where('u.is_admin', 0)
            ->group_by('u.id')
            ->order_by('points', 'DESC')
            ->get_all();

        // Prepare text content
        $report = "QuizMaster Report\n";
        $report .= "=================\n\n";
        $report .= "Report Summary\n";
        $report .= "---------------\n";
        $report .= "Total Users: {$totalUser['active']}\n";
        $report .= "Deactivated Users: {$totalDeactivatedUser['deactivated']}\n";
        $report .= "Total Quizzes: {$totalQuizzes['totalQuizzes']}\n";
        $report .= "Average Points per Quiz: " . number_format($averagePoints['avePoints'], 2) . "\n";
        $report .= "Average Accuracy per Quiz: " . number_format($averageAccuracy['aveAccuracy'], 2) . "%\n\n";

        // Add top player
        $report .= "Top Player\n";
        $report .= "-----------\n";
        if ($topPlayer) {
            $report .= "Username: {$topPlayer['name']}\n";
            $report .= "Total Points: {$topPlayer['points']}\n";
            $report .= "Average Accuracy: " . number_format($topPlayer['accuracy'], 2) . "%\n";
        } else {
            $report .= "No top player data available.\n";
        }
        $report .= "\n";

        // Add leaderboard
        $report .= "Leaderboard Rankings\n";
        $report .= "---------------------\n";
        foreach ($totalPointsPlayers as $index => $entry) {
            $report .= ($index + 1) . ". {$entry['name']} - Points: {$entry['points']}, Accuracy: " . number_format($entry['accuracy'], 2) . "%\n";
        }
        $report .= "\n";

        // Add users
        $report .= "Users\n";
        $report .= "------\n";
        foreach ($allUser as $user) {
            $date = date_create($user['created_at']);
            $report .= "{$user['username']} ({$user['email']}), Created: " . date_format($date, "F j, Y") . "\n";
        }
        $report .= "\n";

        // Add quizzes
        $report .= "Quizzes\n";
        $report .= "--------\n";
        foreach ($allQuizzes as $quiz) {
            $report .= "{$quiz['title']} - Category: {$quiz['category_name']}, Type: {$quiz['quizType']}\n";
        }
        $report .= "\n";

        // Save the content to a text file
        $fileName = 'quizmaster_report.txt';
        file_put_contents($fileName, $report);

        // Output file for download
        header('Content-Type: text/plain');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        readfile($fileName);

        // Delete the file after download
        unlink($fileName);
        exit;
    }


    // dashboard
    public function dashboard()
    {
        $totalUser = $this->db->table('users')->select_count('is_deactivated', 'active')->where(['is_admin' => 0, 'is_deactivated' => 0])->get();
        $totalDeactivatedUser = $this->db->table('users')->select_count('is_deactivated', 'deactivated')->where(['is_admin' => 0, 'is_deactivated' => 1])->get();

        $averagePoints = $this->db->table('user_scores')->select('AVG(score) as avePoints')->get();
        $averageAccuracy = $this->db->table('user_scores')->select('AVG(percentage) as aveAccuracy')->get();

        $totalQuizzes = $this->db->table('quizzes')
            ->select_count('is_published', 'totalQuizzes')
            ->where('is_published', 1)
            ->get();

        $topPlayer = $this->db->table('users as u')
            ->left_join('user_scores as us', 'u.id=us.user_id')
            ->group_by('u.id')
            ->select('u.username as name, SUM(us.score) as points')
            ->where('u.is_deactivated', 0)
            ->where('u.is_admin', 0)
            ->order_by('points', 'DESC')
            ->limit(3)
            ->get();


        $allUser = $this->db->table('users')->where(['is_admin' => 0, 'is_deactivated' => 0])->order_by('created_at', 'DESC')->limit(5)->get_all();

        $allQuizzes = $this->db->table('quizzes as q')
            ->left_join('categories as c', 'q.categoryId = c.category_id')
            ->select('c.name as category_name, COUNT(*) as total, q.title as title, q.quizType as quizType, quiz_id')
            ->where(['q.is_published' => 1, 'q.is_archived' => 0])
            ->group_by('c.name')
            ->order_by('total', 'DESC')
            ->get_all();

        $totalPointsPlayers = $this->db->table('users as u')
            ->left_join('user_scores as us', 'u.id=us.user_id')
            ->select('u.username as name, SUM(us.score) as points, AVG(us.percentage)  as accuracy')
            ->where('u.is_deactivated', 0)
            ->where('u.is_admin', 0)
            ->group_by('u.id')
            ->order_by('points', 'DESC')
            ->limit(5)
            ->get_all();




        $data = array(
            'totalUser' => $totalUser,
            'totalDeactivatedUser' => $totalDeactivatedUser,
            'totalQuizzes' => $totalQuizzes,
            'topPlayer' => $topPlayer,
            'averagePoints' =>  $averagePoints,
            'allUser' => $allUser,
            'allQuizzes' => $allQuizzes,
            'averageAccuracy' => $averageAccuracy,
            'totalPointsPlayers' => $totalPointsPlayers,

        );



        $this->call->view('/admin/dashboard', $data);
    }

    // users
    public function users()
    {
        $allUser = $this->db->table('users')->where(['is_admin' => 0, 'is_deactivated' => 0])->order_by('created_at', 'DESC')->get_all();
        $totalUser = $this->db->table('users')->select_count('is_deactivated', 'active')->where(['is_admin' => 0, 'is_deactivated' => 0])->get();

        $deactivateUser = $this->db->table('users')->where(['is_admin' => 0, 'is_deactivated' => 1])->pagination(5, 1)->get_all();
        $totalDeactivatedUser = $this->db->table('users')->select_count('is_deactivated', 'deactivated')->where(['is_admin' => 0, 'is_deactivated' => 1])->get();

        $data = array(
            'allUser' => $allUser,
            'deactivateUser' => $deactivateUser,
            'totalUser' => $totalUser,
            'totalDeactivatedUser' => $totalDeactivatedUser
        );

        $this->call->view('/admin/users', $data);
    }
    // deactivate user
    public function deactivateUser($id)
    {
        $deactivateUser = [
            'is_deactivated' => 1
        ];
        $deactivateQuery = $this->db->table('users')->where('id', $id)->update($deactivateUser);
        if ($deactivateQuery) {
            redirect('admin/users');
        }
    }
    // activate user
    public function activateUser($id)
    {
        $activateUser = [
            'is_deactivated' => 0
        ];
        $activateQuery = $this->db->table('users')->where('id', $id)->update($activateUser);
        if ($activateQuery) {
            redirect('admin/users');
        }
    }


    // quizzes
    public function quizzes()
    {
        $allQuizzes = $this->db->table('quizzes as q')
            // ->select('quizzes.title', 'categories.name', 'quizzes.quizType', 'quizzes.isTimed')
            ->left_join('categories as c', 'q.categoryId = c.category_id')
            ->where(['is_published' => 1, 'is_archived' => 0])
            ->order_by('q.created_at', 'ASC')
            ->get_all();
        // OUTPUT: SELECT * FROM quizzes WHERE is_published = 1 && is_archived = 0


        $forApprovalQuiz = $this->db->table('quizzes as q')
            ->left_join('categories as c', 'q.categoryId = c.category_id')
            ->where('is_published', 0)
            ->where('is_rejected', 0)
            ->get_all();

        // OUTPUT: SELECT * FROM quizzes WHERE is_published = 0 && is_rejected = 0;

        $forArchivedQuiz = $this->db->table('quizzes as q')
            ->left_join('categories as c', 'q.categoryId = c.category_id')
            ->where('is_archived', 1)
            ->get_all();
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
            'archivedQuizzes' => $archivedQuizzes,
        );

        $this->call->view('/admin/quizzes', $data);
    }
    // add category
    public function addCategory()
    {
        if ($this->form_validation->submitted()) {
            $category = $this->io->post('category');
            $description = $this->io->post('description');

            $insertCategory = array(
                'name' => $category,
                'description' => $description
            );

            if ($this->db->table('categories')->insert($insertCategory)) {
                redirect('admin/quizzes');
            }
        }
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
        $topPlayer = $this->db->table('users as u')
            ->left_join('user_scores as us', 'u.id=us.user_id')
            ->group_by('u.id')
            ->select('u.username as name, SUM(us.score) as points')
            ->where('u.is_deactivated', 0)
            ->where('u.is_admin', 0)
            ->order_by('points', 'DESC')
            ->limit(1)
            ->get();

        $totalPointsPlayers = $this->db->table('users as u')
            ->left_join('user_scores as us', 'u.id=us.user_id')
            ->select('u.username as name, SUM(us.score) as points, AVG(us.percentage)  as accuracy')
            ->where('u.is_deactivated', 0)
            ->where('u.is_admin', 0)
            ->group_by('u.id')
            ->order_by('points', 'DESC')
            ->get_all();

        $topWeeklyPlayer = $this->db->table('users as u')
            ->left_join('leaderboards as l', 'u.id=l.user_id')
            ->group_by('u.id')
            ->select('u.username as name, SUM(l.score) as points')
            ->where('l.ranking_date', '>=', date('Y-m-d 00:00:00', strtotime('monday this week')))
            ->where('l.ranking_date', '<=', date('Y-m-d 23:59:59', strtotime('sunday this week')))
            ->where('u.is_deactivated', 0)
            ->where('u.is_admin', 0)
            ->order_by('points', 'DESC')
            ->limit(1)
            ->get();

        $weeklyPlayers = $this->db->table('users as u')
            ->left_join('leaderboards as l', 'u.id=l.user_id')
            ->select('u.username as name, SUM(l.score) as points')
            ->where('u.is_deactivated', 0)
            ->where('u.is_admin', 0)
            ->group_by('u.id')
            ->order_by('points', 'DESC')
            ->get_all();


        $data = array(
            'topPlayer' => $topPlayer,
            'totalPointsPlayers' => $totalPointsPlayers,
            'topWeeklyPlayer' => $topWeeklyPlayer,
            'weeklyPlayers' => $weeklyPlayers
        );

        $this->call->view('/admin/leaderboards', $data);
    }

    // change password
    public function changePass()
    {
        $userId = $this->session->userdata('userId');
        $adminPassword = $this->db->table('users')->select('password')->where('id', $userId)->get();

        if ($this->form_validation->submitted()) {
            $currentPass = $this->io->post('currentPass');
            $newPass = $this->io->post('newPass');
            $confPass = $this->io->post('confPass');

            if (password_verify($currentPass, $adminPassword['password'])) {

                if ($newPass === $confPass) {
                    $hashNewPass = password_hash($newPass, PASSWORD_BCRYPT);

                    $updateAdminPassword = $this->db->table('users')->where('id', $userId)->update(['password' => $hashNewPass]);
                    if ($updateAdminPassword) {
                        redirect('auth/logout');
                    } else {
                        redirect('/admin/change-password');
                    }
                } else {
                    redirect('/admin/change-password');
                }
            } else {
                redirect('/admin/change-password');
            }
        }

        $this->call->view('/admin/change-password');
    }
}
