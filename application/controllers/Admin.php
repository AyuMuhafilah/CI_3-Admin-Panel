<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends BAPLI_Controller
{
    public function index()
    {
        $this->output->enable_profiler(TRUE);

        $this->satpam(); // Penjaga Keamanan

        $user_id = $this->session->userdata(AUTH_USERDATA);
        $data['modules'] = $this->module_model->auth($user_id)->result_array();

        $data['modules'] = array_map(function ($module) {
            // Jika base_url == true (pada database) maka tambahkan base_url di data url tersebut
            $module['url'] = ($module['base_url']) ? base_url($module['url']) : $module['url'];
            return $module;
        }, $data['modules']);

        // View untuk halaman admin
        // Meload view berdasarkan urutannya
        // Diubah sesuai kebutuhan
        $this->load->view('admin/head');
        $this->load->view('admin/menus', $data);
        $this->load->view('admin/content');
        $this->load->view('admin/foot');
    }
}
