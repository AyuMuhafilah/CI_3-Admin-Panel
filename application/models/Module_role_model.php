<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class model untuk tabel module_role
 * 
 * Tabel module_role merupakan tabel pembantu dalam relasi Many to Many antara
 * tabel modules dan tabel roles
 * 
 * Model ini tidak disarankan di gunakan langsung di controller, hanya di gunakan di model saja
 * 
 * @author		Fany Muhammad Fahmi Kamilah
 */
class Module_role_model extends CI_Model
{
    /**
     * Nama tabel
     * 
     * @var string $table
     */
    public $table = 'module_role';

    /**
     * Atribut bantu untuk fungsi array_map()
     */
    private $role_id;

    /**
     * Fungsi yang di panggil pertamakali
     * 
     * Digunakan untuk me-load model yang dibutuhkan
     */
    public function __construct()
    {
        parent::__construct();

        // Load model jika belum di load
        if (!$this->load->is_loaded('Module_model')) $this->load->model('Module_model', 'module_model');
    }

    /**
     * Modul apa saja yang bisa di akses role
     * 
     * @param int $role_id
     * @return array Sudah menjadi data array
     */
    public function modules(int $role_id,  int $parent_id = null)
    {
        $this->role_id = $role_id; // assign ke variabel object agar bisa di ambil di anonymous function

        // Query ke database
        $this->db->select($this->module_model->table . '.*'); // Select * dari tabel module saja (jangan select apapun dari tabel module_role)
        $this->db->join($this->module_model->table, $this->module_model->table . '.id = module_id'); // join dengan tabel module
        $modules = $this->db->get_where($this->table, ['role_id' => $role_id, 'parent' => $parent_id])->result_array();
        // ^^ SELECT modules.* FROM module_role JOIN modules ON modules.id = module_id WHERE ...

        // memetakan setiap data
        $modules = array_map(function ($module) {
            // Jika module bukan parent maka jangan di teruskan
            if (!$module['is_parent']) return $module;

            $childs = $this->modules($this->role_id, $module['id']); // Panggil method ini secara rekursif
            $module['childs'] = $childs; // append (tambahkan) array_key baru pada data
            return $module; // kembalikan data ke array asli

        }, $modules);

        return $modules;
    }

    /**
     * Method untuk membantu Class Satpam mendapatkan data yang ia butuhkan.
     * 
     * Jangan gunakan di controller, hanya untuk Class Satpam saja.
     * 
     * @param int $role_id
     * @return CI_DB_result::class query result
     */
    public function modulesForSatpam(int $role_id)
    {
        $this->db->select('url');
        $this->db->join($this->module_model->table, $this->module_model->table . '.id = module_id');
        return $this->db->get_where($this->table, ['role_id' => $role_id]);
    }

    /**
     * role apa saja yang bisa mengakses modul
     * 
     * @param int $module_id
     * @return CI_DB_result::class query result
     */
    public function roles($module_id)
    {
        # code...
    }
}
