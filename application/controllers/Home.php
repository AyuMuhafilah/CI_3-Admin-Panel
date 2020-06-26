<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        // Tampilkan profiler
        // Profiler di php 7.4.* memunculkan error, harus menunggu codeigniter 3.1.12
        $this->output->enable_profiler(TRUE);

        $this->satpam->jaga(); // Penjaga Keamanan

        $user_id = $this->session->userdata(AUTH_USERDATA); // ambil user_id
        $data['modules'] = $this->module_model->auth($user_id)->result_array(); // Query data modul ke database

        $data['modules'] = array_map(function ($module) {
            // Jika base_url == true (pada database) maka tambahkan base_url() di data url tersebut
            $module['url'] = ($module['base_url']) ? base_url($module['url']) : $module['url'];
            return $module;
        }, $data['modules']);

        // View untuk halaman admin
        // Meload view berdasarkan urutannya
        $this->load->view('admin/head');
        $this->load->view('admin/menus', $data);
        $this->load->view('admin/content');
        $this->load->view('admin/foot');
        // ^^ Diubah sesuai kebutuhan
    }
}
