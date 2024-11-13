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
$router->get('/quiz/create', 'User_Quiz');
$router->post('/quiz/create', 'User_Quiz::create');
// $router->match('/quiz/create', 'User_Quiz::create', ['POST', 'GET']);
$router->post('/submit-quiz', 'User_Quiz::submit');
$router->get('/question/create/{$quizId}', 'User_Question::create');
$router->post('/question/add-id-question', 'User_Question::add_id_question');
$router->post('/question/update-id-question', 'User_Question::update_id_question');
$router->post('/question/delete-id-question', 'User_Question::delete_id_question');
$router->group('/auth', function () use ($router) {
    $router->match('/register', 'Auth::register', ['POST', 'GET']);
    $router->match('/login', 'Auth::login', ['POST', 'GET']);
    $router->get('/logout', 'Auth::logout');
    $router->match('/password-reset', 'Auth::password_reset', ['POST', 'GET']);
    $router->match('/set-new-password', 'Auth::set_new_password', ['POST', 'GET']);
});



$router->get('/admin/dashboard', 'Admin_Home::dashboard');
$router->get('/admin/users', 'Admin_Home::users');

$router->get('/admin/quizzes', 'Admin_Home::quizzes');
// for approval quiz
$router->match('/admin/quizzes/approve/{id}', 'Admin_Home::approveQuiz', ['POST', 'GET']);
$router->match('/admin/quizzes/reject/{id}', 'Admin_Home::rejectQuiz', ['POST', 'GET']);
// archive quiz
$router->match('/admin/quizzes/archive/{id}', 'Admin_Home::archiveQuiz', ['POST', 'GET']);
$router->match('/admin/quizzes/publish/{id}', 'Admin_Home::publishQuiz', ['POST', 'GET']);


$router->get('/admin/leaderboards', 'Admin_Home::leaderboards');
$router->get('/admin/settings', 'Admin_Home::settings');
