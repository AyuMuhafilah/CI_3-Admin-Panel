<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Loader Class
 *
 * Loads framework components.
 * 
 * Menambahkan fitur views
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Loader
 * @author		Fany Muhammad Fahmi Kamilah
 */
class MY_Loader extends CI_Loader
{
    /**
     * Codeigniter super-object
     * 
     * @var $CI
     */
    private $CI;

    private $data;

    /**
     * Fungsi yang di panggil pertamakali
     * 
     * Digunakan untuk meng-assign CI super-object
     */
    public function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();
    }

    public function views(Closure $closure, array $before = null, array $after = null)
    {
        $user_id = $this->CI->session->userdata(AUTH_USERDATA); // ambil user_id
        $this->data['modules'] = $this->CI->module_model->auth($user_id); // Query data modul ke database

        if (!empty($before))
            $before = $before;
        else
            $before = $this->CI->config->item('views_before');

        if (!$this->CI->input->is_ajax_request())
            foreach ($before as $before)
                if (is_string($before))
                    $this->CI->load->view($before, $this->data);

        $closure();

        if (!empty($after))
            $after = $after;
        else
            $after = $this->CI->config->item('views_after');

        if (!$this->CI->input->is_ajax_request())
            foreach ($after as $after)
                if (is_string($after))
                    $this->CI->load->view($after, $this->data);
    }

    /**
     * Model Loader
     *
     * Loads and instantiates models. Don't load if the class is loaded
     *
     * @param	mixed	$model		Model name
     * @param	string	$name		An optional object name to assign to
     * @param	bool	$db_conn	An optional database connection configuration to initialize
     * @return	object|void
     */
    public function model($model, $name = '', $db_conn = FALSE)
    {
        if ($this->load->is_loaded($model)) return;
        parent::model($model, $name, $db_conn);
    }
}
