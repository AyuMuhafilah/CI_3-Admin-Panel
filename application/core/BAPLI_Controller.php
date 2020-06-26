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
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class BAPLI_Controller extends CI_Controller
{
    /**
     * Penjaga keamanan aplikasi
     * 
     * @var $satpam
     */
    private $satpam;

    /**
     * Penjaga keamanan aplikasi
     * 
     * Merubah status keamanan menjadi aktif/tidak
     * 
     * @param bool $aktif
     * @return void
     */
    public function satpam(bool $aktif = true)
    {
        $this->satpam = $aktif;

        // Jika user belum login
        if ($this->satpam && !$this->session->userdata(AUTH_USERDATA)) {
            redirect('login');
        }
    }
}
