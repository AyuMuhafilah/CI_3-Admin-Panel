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
        $this->satpam->jaga(); // Penjaga Keamanan

        $this->load->views(function () {
            $this->load->view('home/home');
        });
    }
}
