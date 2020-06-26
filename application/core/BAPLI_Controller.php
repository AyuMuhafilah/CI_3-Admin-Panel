<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * Class ini menginduk ke CI_Controller
 * Di tambahkan dengan tujuan menambahkan security pada setiap controller
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Fany Muhammad Fahmi Kamilah
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class BAPLI_Controller extends CI_Controller
{
    /**
     * Penjaga keamanan aplikasi
     * 
     * Menjaga sistem dari user yang tidak memiliki hak akses
     * 
     * @return void
     */
    public function satpam()
    {
        // Jika user sudan login
        if ($user_id = $this->session->userdata(AUTH_USERDATA)) {

            // Ambil URI string nya yang asli dan yang routed
            $uri = $this->uri->uri_string();
            $ruri = $this->uri->ruri_string();

            // variabel untuk izin module
            $pass = false;

            // Jika user berhak mengakses menu
            $modules = $this->module_model->auth($user_id)->result_array();
            foreach ($modules as $module) {
                if (($module['url'] != $uri) && ($module['url'] != $ruri)) continue; // periksa setiap izin module pada database
                $pass = true; // jika ada izin maka set variabel pass menjadi true
            }

            if (!$pass) $this->output->set_status_header(403); // jika tidak ada izin maka tampilkan error 403
        } else {
            redirect('login');
        }
    }
}
