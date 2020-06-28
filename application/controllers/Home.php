<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $this->satpam->jaga(false); // Penjaga Keamanan

        // Tampilkan profiler
        // Profiler di php 7.4.* memunculkan error, harus menunggu codeigniter 3.1.12
        $this->output->enable_profiler(TRUE);

        $user_id = $this->session->userdata(AUTH_USERDATA); // ambil user_id
        $data['modules'] = $this->module_model->auth($user_id); // Query data modul ke database


        // View untuk halaman admin
        // Meload view berdasarkan urutannya
        $this->load->view('home/head');
        $this->load->view('home/menus', $data);
        $this->load->view('home/content');
        $this->load->view('home/foot');
        // ^^ Diubah sesuai kebutuhan
    }
}
