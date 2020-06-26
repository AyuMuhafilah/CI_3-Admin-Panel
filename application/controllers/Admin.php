<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends BAPLI_Controller
{
    public function index()
    {
        $this->satpam(); // Penjaga Keamanan

        $this->load->model('Module_model', 'module_model');

        $user_id = $this->session->userdata(AUTH_USERDATA);
        $data['modules'] = $this->module_model->auth($user_id)->result_array();

        // View untuk halaman admin
        // Meload view berdasarkan urutannya
        // Diubah sesuai kebutuhan
        $this->load->view('admin/head');
        $this->load->view('admin/menus', $data);
        $this->load->view('admin/content');
        $this->load->view('admin/foot');
    }
}
