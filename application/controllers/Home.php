<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $this->satpam->jaga(); // Penjaga Keamanan

        $this->load->views(function () {
            $this->load->view('home/home');
        });
    }
}
