<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Access extends CI_Controller
{
    public function index()
    {
        $this->satpam->jaga();
        $this->load->views(function () {
            $this->load->view('utility/access/index');
        });
    }
}
