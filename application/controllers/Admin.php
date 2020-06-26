<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends BAPLI_Controller
{
    public function index()
    {
        $this->satpam(); // Penjaga Keamanan

        echo "Selamat Datang" . $this->session->userdata(AUTH_USERDATA);
    }
}
