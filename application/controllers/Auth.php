<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        $this->satpam->no_ajax();

        // Tampilkan profiler
        // Profiler di php 7.4.* memunculkan error, harus menunggu codeigniter 3.1.12
        $this->output->enable_profiler(TRUE);

        // Load library
        $this->load->library('form_validation');

        // Aturan validasi user input
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // Ambil username dan password dari user input
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Query ke database jika user input valid
        if ($this->form_validation->run()) {

            $this->load->model('M_user');
            $this->load->model('M_role');

            $this->db->select("{$this->M_user->table}.*, {$this->M_role->table}.role");
            $this->M_user->joinRole();
            $user = $this->M_user->find(['username' => $username]); // data user yang masih berbentuk query result
            $data_user = $user->row_array(); // data user yang sudah menjadi array
        }

        // Nested if. Jika user input valid >> jika data user ditemukan >> jika password benar
        if (($this->form_validation->run()) && ($user->num_rows() > 0) && ($data_user['password'] == $password)) {
            $this->session->set_userdata(AUTH_USERDATA, $data_user['id']); // Menyimpan session
            $this->session->set_userdata('role_id', $data_user['role_id']); // Menyimpan session
            $this->session->set_userdata('role', $data_user['role']); // Menyimpan session
            redirect('Home');
        } else {
            // Tampilkan pesan hanya jika user input telah di validasi
            if ($this->form_validation->run()) {
                $this->session->set_flashdata('error_message', 'Username atau Password salah!!!');
                redirect('Auth');
            }

            // Tampilkan halaman login
            $this->load->view('auth/login');
        }
    }

    public function logout()
    {
        $this->satpam->no_ajax();
        $this->session->sess_destroy(); // Hancurkan session
        redirect('login');
    }
}
