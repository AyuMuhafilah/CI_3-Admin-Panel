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
    public string $table;

    /**
     * Nama primary key
     * 
     * @var string $primaryKey
     */
    public string $primaryKey = 'id';

    /**
     * Nama nama field
     * 
     * @var array $fields
     */
    private array $fields = [];

    /**
     * Data seeding
     * 
     * @var array $seed
     */
    private array $seed_data = [];

    /**
     * Array untuk menambah key saat migrasi
     * 
     * @var array $add_key
     */
    private array $add_keys;

    /**
     * Array untuk menambah field saat migrasi
     * 
     * @var array $add_field
     */
    private array $add_fields;

    /**
     * Fungsi yang pertamakali di jalankan
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = rtrim(get_class(), '_model');
    }

    /**
     * Ambil semua data
     * 
     * @return CI_DB_result::class query result
     */
    public function all()
    {
        return $this->db->get($this->table);
    }

    /**
     * Ambil data berdasarkan field (get_where)
     * 
     * @param array $where
     * @return CI_DB_result::class query result
     */
    public function find(array $where)
    {
        return $this->db->get_where($this->table, $where);
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
     * Migrasi database
     * 
     * @return void
     */
    public function migrate()
    {
        $this->dbforge->add_field($this->fields);
        $this->dbforge->add_key($this->primaryKey, true);

        if (isset($this->add_keys))
            foreach ($this->add_keys as $key)
                $this->dbforge->add_key($key['key'], $key['primary']);

        if (isset($this->add_fields))
            foreach ($this->add_fields as $field)
                $this->dbforge->add_field($field);

        if ($this->dbforge->create_table($this->table))
            echo "\033[0;32mTabel {$this->table} berhasil dibuat\033[0m\n";
        else
            echo "\033[0;31mTabel {$this->table} berhasil dibuat\033[0m\n";
    }

    /**
     * Seeding database
     * 
     * @return void
     */
    public function seed()
    {
        if ($this->db->insert_batch($this->table, $this->seed_data))
            echo "\033[0;32mData tabel {$this->table} berhasil ditambahkan\033[0m\n";
        else
            echo "\033[0;31mData tabel {$this->table} gagal ditambahkan\033[0m\n";
    }
}
