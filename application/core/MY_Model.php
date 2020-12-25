<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Fany Muhammad Fahmi Kamilah
 */
class MY_Model extends CI_Model
{
    /**
     * Nama tabel
     * 
     * @var string $table
     */
    public $table;

    /**
     * Nama primary key
     * 
     * @var string $primaryKey
     */
    public $primaryKey = 'id';

    /**
     * Data seeding
     * 
     * @var array $seed
     */
    protected $seed_data = [];

    /**
     * Data seeding dummy
     * 
     * @var array $seed
     */
    protected $dumy_data = [];

    /**
     * Fungsi yang pertamakali di jalankan
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        if (!isset($this->table)) $this->table = str_replace('M_', '', get_class($this));
    }

    /**
     * Ambil semua data
     * 
     * @param int $limit
     * @param int $offset
     * @return CI_DB_result::class query result
     */
    public function all(int $limit = null, int $offset = null)
    {
        return $this->db->get($this->table, $limit, $offset);
    }

    /**
     * Ambil data berdasarkan field (get_where)
     * 
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @return CI_DB_result::class query result
     */
    public function find(array $where, int $limit = null, int $offset = null)
    {
        return $this->db->get_where($this->table, $where, $limit, $offset);
    }

    /**
     * Menyimpan data
     * 
     * Menambahkan data atau merubah data yang ada
     * 
     * @param array $set datanya
     * @param int $where kondisinya(jika update)
     * @return bool
     */
    public function save(array $set, array $where = [])
    {
        if (empty($where))
            return $this->db->insert($this->table, $set);
        else
            return $this->db->update($this->table, $set, $where);
    }

    /**
     * Menghapus data
     * 
     * @param array $where
     * @return bool
     */
    public function destroy(array $where)
    {
        return $this->db->delete($this->table, $where);
    }

    /**
     * Seeding database
     * 
     * --Info--
     * Hanya bisa dijalankan di class Seed
     * 
     * @param object $class isi $this
     * @return void
     */
    public function seed(object $class)
    {
        if (get_class($class) == 'Seed' && !empty($this->seed_data))
            if ($this->db->insert_batch($this->table, $this->seed_data))
                echo "\033[0;32mData tabel {$this->table} berhasil ditambahkan\033[0m\n";
            else
                echo "\033[0;31mData tabel {$this->table} gagal ditambahkan\033[0m\n";
    }

    /**
     * Seeding dummy database
     * 
     * --Info--
     * Hanya bisa dijalankan di class Seed
     * 
     * @param object $class isi $this
     * @return void
     */
    public function dummy(object $class)
    {
        if (get_class($class) == 'Seed' && !empty($this->dummy_data))
            if ($this->db->insert_batch($this->table, $this->dummy_data))
                echo "\033[0;32mData tabel {$this->table} berhasil ditambahkan\033[0m\n";
            else
                echo "\033[0;31mData tabel {$this->table} gagal ditambahkan\033[0m\n";
    }
}
