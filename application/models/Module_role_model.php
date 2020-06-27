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
     * Ambil semua modul berdasarkan role_id yang berhak mengakses
     * 
     * @param int $role_id
     * @return CI_DB_result::class query result
     */
    public function modules(int $role_id)
    {
        $this->db->join($this->module_model->table, $this->module_model->table . '.id = module_id');
        return $this->db->get_where($this->table, ['role_id' => $role_id]);
    }

    /**
     * Ambil semua role berdasarkan module_id yang di akses
     * 
     * @param int $module_id
     * @return CI_DB_result::class query result
     */
    public function roles($module_id)
    {
        # code...
    }
}
