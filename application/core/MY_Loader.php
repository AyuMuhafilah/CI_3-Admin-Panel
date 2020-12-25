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
        if ($this->CI->session->userdata(AUTH_USERDATA)) {
            $role_id = $this->CI->session->userdata('role_id'); // ambil role_id
            $this->role_id = $role_id; // assign ke variabel object agar bisa di ambil di anonymous function

            $this->data['menus'] = $this->menus($role_id); // Query data modul ke database
        }

        if (empty($before))
            $before = $this->CI->config->item('views_before');

        if (!$this->CI->input->is_ajax_request()) {

            // data yang akan di kirim ke view 'sebelum'
            $this->data['variabelnya'] = 'datanya';

            foreach ($before as $before)
                if (is_string($before))
                    $this->CI->load->view($before, $this->data);
        }

        $closure();

        // Swal
        if ($swal = $this->CI->session->flashdata('Swal')) {
            $data['swal'] = $swal;
            $this->CI->load->view('custom_alert/sweetalert', $data);

            if ($this->CI->input->is_ajax_request())
                unset($_SESSION['Swal']);
        }
        // Swal(end)

        // toastr
        if ($toastr = $this->CI->session->flashdata('toastr')) {
            $data['toastr'] = $toastr;
            $this->CI->load->view('custom_alert/toastr', $data);

            if ($this->CI->input->is_ajax_request())
                unset($_SESSION['toastr']);
        }
        // toastr(end)

        if (empty($after))
            $after = $this->CI->config->item('views_after');

        if (!$this->CI->input->is_ajax_request()) {

            // data yang akan di kirim ke view 'sebelum'
            $this->data['variabelnya'] = 'datanya';

            foreach ($after as $after)
                if (is_string($after))
                    $this->CI->load->view($after, $this->data);
        }
    }

    /**
     * Model Loader
     *
     * Loads and instantiates models. Don't load if the model is loaded
     *
     * @param	mixed	$model		Model name
     * @param	string	$name		An optional object name to assign to
     * @param	bool	$db_conn	An optional database connection configuration to initialize
     * @return	object|void
     */
    public function model($model, $name = '', $db_conn = FALSE)
    {
        if (is_array($model)) {
            foreach ($model as $key => $value) {
                is_int($key) ? $this->model($value, '', $db_conn) : $this->model($key, $value, $db_conn);
            }
            return $this;
        }

        if ($this->CI->load->is_loaded($model)) return;
        parent::model($model, $name, $db_conn);
    }

    private function menus(int $role_id, int $parent_id = null)
    {
        $this->CI->load->model('M_menu');
        $this->CI->load->model('M_menu_role');

        // Query ke database
        $this->CI->db->select($this->CI->M_menu->table . '.*'); // Select * dari tabel menu saja (jangan select apapun dari tabel menu_role)
        $this->CI->db->order_by('order');

        $this->CI->M_menu_role->joinMenu(); // join dengan tabel menu
        $menus = $this->CI->M_menu_role->find(['role_id' => $role_id, 'parent_id' => $parent_id])->result_array();

        // ^^ SELECT menu.* FROM menu_role JOIN menu ON menus.id = menu_id WHERE ...

        // Menambahkan child &&
        // Menambahkan base_url() pada setiap data dengan status base_url == true
        $menus = array_map(function ($menu) {
            $menu['url'] = ($menu['base_url']) ? base_url($menu['url']) : $menu['url'];

            // Jika menu bukan parent maka jangan di teruskan
            if (!$menu['is_parent']) return $menu;

            $childs = $this->menus($this->role_id, $menu['id']); // Panggil method ini secara rekursif
            $menu['childs'] = $childs; // append (tambahkan) array_key baru pada data
            return $menu; // kembalikan data ke array asli

        }, $menus);

        return $menus;
    }
}
