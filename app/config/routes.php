<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/

$router->get('/', 'Auth');
$router->get('/home', 'User_Home');

//USER PROFILE
$router->get('/profile', 'UserProfile');
$router->post('/profile/update', 'UserProfile::update_profile');
//USER ACTIONS
$router->get('/quiz/manage', 'UserManageQuizzes');
$router->post('/quiz/update', 'UserManageQuizzes::update_quiz');
$router->post('/quiz/toggle-publish', 'UserManageQuizzes::toggle_publish');

//OPEN QUIZZES
$router->get('/quizzes', 'UserQuizList');
$router->get('/quizzes/filter', 'UserQuizList::filter_quizzes');
$router->get('/api/quizzes', 'UserQuizList::get_quizzes');

//CREATE QUIZ
$router->get('/quiz/create', 'UserQuiz');
$router->post('/quiz/api/save-quiz', 'UserQuiz::save_quiz');

//IDENTIFICATION CREATION
$router->get('/quiz/create/identification/{$quiz_id}', 'UserQuestion_Identification');
$router->post('/quiz/api/save-id-question', 'UserQuestion_Identification::save_id_question');
$router->post('/quiz/api/delete-id-question', 'UserQuestion_Identification::delete_id_question');
$router->post('/quiz/api/update-id-question', 'UserQuestion_Identification::update_id_question');

//TRUE OR FALSE CREATION
$router->get('/quiz/create/truefalse/{$quiz_id}', 'UserQuestion_TrueFalse');
$router->post('/quiz/api/save-tf-question', 'UserQuestion_TrueFalse::save_tf_question');
$router->post('/quiz/api/delete-tf-question', 'UserQuestion_TrueFalse::delete_tf_question');
$router->post('/quiz/api/update-tf-question', 'UserQuestion_TrueFalse::update_tf_question');

//MULTIPLE CHOICE CREATION
$router->get('/quiz/create/multiplechoice/{$quiz_id}', 'UserQuestion_MultipleChoice');
$router->post('/quiz/api/save-mc-question', 'UserQuestion_MultipleChoice::save_mc_question');
$router->post('/quiz/api/delete-mc-question', 'UserQuestion_MultipleChoice::delete_mc_question');
$router->post('/quiz/api/multiplechoice/choices', 'UserQuestion_MultipleChoice::get_choices_question');
$router->post('/quiz/api/update-mc-question', 'UserQuestion_MultipleChoice::update_mc_question');

//TAKE QUIZ
$router->get('/quiz/take/multiple-choice/{$quiz_id}', 'UserTake_MC');
$router->post('/quiz/submit/multiple-choice', 'UserTake_MC::submit_multiple_choice');

$router->get('/quiz/take/identification/{$quiz_id}', 'UserTake_ID');
$router->post('/quiz/submit/identification', 'UserTake_ID::submit_identification');

$router->get('/quiz/take/true-false/{$quiz_id}', 'UserTake_TF');
$router->post('/quiz/submit/true-false', 'UserTake_TF::submit_true_false');

//QUIZ SCORES
$router->get('/quiz/scores', 'UserProfile::quiz_scores');

//LEADERBOARDS
$router->get('/leaderboard', 'UserLeaderboards');
$router->get('/leaderboards/filter', 'UserLeaderboards::filter_quizzes');
$router->get('/leaderboards/full-points', 'UserLeaderboards::full_points');
$router->get('/leaderboards/full-accuracy', 'UserLeaderboards::full_accuracy');
$router->get('/leaderboards/full/{$quiz_id}', 'UserLeaderboards::quiz_leaderboard');




$router->group('/auth', function () use ($router) {
    $router->match('/register', 'Auth::register', ['POST', 'GET']);
    $router->match('/login', 'Auth::login', ['POST', 'GET']);
    $router->get('/logout', 'Auth::logout');
    $router->match('/password-reset', 'Auth::password_reset', ['POST', 'GET']);
    $router->match('/set-new-password', 'Auth::set_new_password', ['POST', 'GET']);
});



$router->get('/admin/dashboard', 'Admin_Home::dashboard');

// users
$router->get('/admin/users', 'Admin_Home::users');
$router->match('/admin/users/deactivate/{id}', 'Admin_Home::deactivateUser', ['POST', 'GET']);
$router->match('/admin/users/activate/{id}', 'Admin_Home::activateUser', ['POST', 'GET']);

// quiz
$router->get('/admin/quizzes', 'Admin_Home::quizzes');
// for approval quiz
$router->match('/admin/quizzes/approve/{id}', 'Admin_Home::approveQuiz', ['POST', 'GET']);
$router->match('/admin/quizzes/reject/{id}', 'Admin_Home::rejectQuiz', ['POST', 'GET']);
// archive quiz
$router->match('/admin/quizzes/archive/{id}', 'Admin_Home::archiveQuiz', ['POST', 'GET']);
$router->match('/admin/quizzes/publish/{id}', 'Admin_Home::publishQuiz', ['POST', 'GET']);
// add category
$router->match('/admin/quizzes/add-category', 'Admin_Home::addCategory', ['POST', 'GET']);

// leaderboards
$router->get('/admin/leaderboards', 'Admin_Home::leaderboards');

// change password admin
$router->match('/admin/change-password', 'Admin_Home::changePass', ['POST', 'GET']);
