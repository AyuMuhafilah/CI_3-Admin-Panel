<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load model
        $this->load->model('M_menu');
        $this->load->model('M_menu_role');
        $this->load->model('M_user');
    }

    public function index()
    {
        $this->satpam->jaga(false); // Penjaga Keamanan

        // Tampilkan profiler
        // Profiler di php 7.4.* memunculkan error, harus menunggu codeigniter 3.1.12
        // $this->output->enable_profiler(TRUE);

        // View untuk halaman admin
        // Meload view berdasarkan urutannya
        $this->load->views(function () {
            $this->load->view('home/content');
        });
        // ^^ Diubah sesuai kebutuhan
    }
}
