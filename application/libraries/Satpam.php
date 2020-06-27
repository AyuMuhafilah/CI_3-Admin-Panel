<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Penjaga keamanan aplikasi
 *
 * Menjaga sistem dari user yang tidak memiliki hak akses
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Fany Muhammad Fahmi Kamilah
 */
class Satpam
{
    /**
     * Codeigniter super-object
     * 
     * @var $CI
     */
    protected $CI;

    /**
     * Fungsi yang di panggil pertamakali
     * 
     * Digunakan untuk meng-assign CI super-object
     */
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    /**
     * Kerahkan satpam
     * 
     * Beri perintah pada satpam untuk berjaga terhadap user yang tidak memiliki hak akses
     * 
     * @param bool $module Cek hak akses module dari database
     * @return void
     */
    public function jaga(bool $module = true)
    {
        // Jika user sudan login
        if ($user_id = $this->CI->session->userdata(AUTH_USERDATA)) {

            // Jika satpam tidak ditugaskan untuk menjaga akses module maka tugas satpam selesai
            if (!$module) return;

            // Ambil URI string nya yang asli dan yang routed
            $uri = $this->CI->uri->uri_string();
            $ruri = $this->CI->uri->ruri_string();

            // variabel untuk izin module
            $pass = false;

            // Jika user berhak mengakses module
            $modules = $this->CI->module_model->auth($user_id)->result_array();
            foreach ($modules as $module) {
                if (($module['url'] != $uri) && ($module['url'] != $ruri)) continue; // periksa setiap izin module pada database
                $pass = true; // jika ada izin maka set variabel pass menjadi true
            }

            if (!$pass) $this->CI->output->set_status_header(403); // jika tidak ada izin maka tampilkan error 403
        } else {
            redirect('login');
        }
    }
}
