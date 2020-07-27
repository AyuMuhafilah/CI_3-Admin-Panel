<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function index()
    {
        $this->satpam->jaga();
        echo "OK";
    }
}
