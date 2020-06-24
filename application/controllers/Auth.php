<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        // Load library
        $this->load->library('form_validation');

        // Aturan validasi user input
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // Ambil username dan password dari user input
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Query ke database
        $this->load->model('User');
        $user = $this->User->Find(['username' => $username]); // data user yang masih berbentuk query result
        $data_user = $user->row_array(); // data user yang sudah menjadi array

        // Nested if. Jika user input valid >> jika data user ditemukan >> jika password benar
        if (($this->form_validation->run()) && ($user->num_rows() > 0) && ($data_user['password'] == $password)) {
            $this->session->set_userdata('user', $data_user['id']); // Menyimpan session
            redirect('Admin');
        } else {
            // Tampilkan pesan hanya jika form sudah di submit
            if ($this->input->method() == 'post') $this->session->set_flashdata('error_message', 'Username dan Password tidak cocok');

            // Tampilkan halaman login
            $this->load->view('auth/login');
        }
    }
}
