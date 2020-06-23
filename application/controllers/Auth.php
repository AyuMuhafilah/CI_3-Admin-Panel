<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    
	public function index()
	{
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $this->load->model('User');
            $result = $this->User->Find(['username' => $this->input->post('username')]);
            if ($result->num_rows() > 0) {
                $result_set = $result->row_array();
                if ($result_set['password'] == $this->input->post('password')) {
                    $this->session->set_userdata('user', $result_set['id']);
                    redirect('Admin');
                } else {
                    echo "Password yang anda masukan salah";
                }
            } else {
                $this->session->set_flashdata('pesan', 'Maaf Username tidak terdaftar');
            }
        }
    }   
}