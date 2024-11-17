<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserProfile extends Controller
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
    $user = $this->db->table('users')->select('id, username, email, created_at')->where('id', get_user_id())->get();

    $this->call->view('/users/profile', ['user' => $user]);
  }

  public function update_profile()
  {
    $user_id = get_user_id(); // Get the current user's ID
    $username = $this->io->post('username'); // Get the posted username

    $existing_user = $this->db
      ->table('users')
      ->select('id')
      ->where('username', $username)
      ->not_where('id', $user_id)
      ->get();

    if ($existing_user) {
      $this->session->set_flashdata('error', 'The username is already taken. Please choose a different one.');
      header("Location: /profile");
    }

    $data = [
      'username' => $username,
    ];

    $this->db->table('users')->where('id', $user_id)->update($data);

    $this->session->set_flashdata('success', 'User updated successfully!');
    header("Location: /profile");
  }


}
