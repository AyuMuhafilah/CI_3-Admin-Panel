<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Migration class
 * 
 * Class untuk migrasi database
 */
class Migrate extends CI_Controller
{
    /**
     * Nama database
     */
    private $database = 'db_auth';

    /**
     * Fungsi yang pertamakali di panggil
     */
    public function __construct()
    {
        parent::__construct();
        // Khusus dijalankan lewat CLI (tidak boleh lewat HTML)
        // dan dinonaktifkan ketika production
        if (!is_cli() || (ENVIRONMENT === 'production')) {
            show_404();
            exit;
        }

        $this->load->dbforge();

        //  Load model
        $this->load->model('M_example');
        $this->load->model('M_foo');
        $this->load->model('M_role');
        $this->load->model('M_user');
        $this->load->model('M_menu');
        $this->load->model('M_menu_role');
    }

    /**
     * Menjalankan migrasi
     */
    public function run()
    {
        $this->db->query('use ' . $this->database);

        // ==== DDL ====
        $this->M_foo->migrate();
        $this->M_example->migrate();
        $this->M_role->migrate();
        $this->M_user->migrate();
        $this->M_menu->migrate();
        $this->M_menu_role->migrate();

        // ==== DML ====
        $this->M_foo->seed();
        $this->M_role->seed();
        $this->M_user->seed();
        $this->M_menu->seed();
        $this->M_menu_role->seed();

        // ==== DUMMY ====
        $this->M_example->seed();
    }

    /**
     * Membersihkan database
     * 
     * Rollback ke database kosong
     */
    public function clear()
    {
        if ($this->dbforge->drop_database($this->database)) echo "\033[1;32mDatabase di hapus\033[0m\n";
        if ($this->dbforge->create_database($this->database)) echo "\033[0;32mDatabse dibuat\033[0m\n";
    }

    /**
     * Rollback lalu jalankan migrasi
     */
    public function refresh()
    {
        $this->clear();
        $this->run();
    }

    public function index()
    {
        $this->run();
    }

    /**
     * Warna untuk Console
     * 
     * ==== Huruf ====
     * black => 0;30,
     * dark_gray => 1;30,
     * red => 0;31,
     * bold_red => 1;31,
     * green => 0;32,
     * bold_green => 1;32,
     * brown => 0;33,
     * yellow => 1;33,
     * blue => 0;34,
     * bold_blue => 1;34,
     * purple => 0;35,
     * bold_purple => 1;35,
     * cyan => 0;36,
     * bold_cyan => 1;36,
     * white => 1;37,
     * bold_gray => 0;37,
     *
     * ==== Background ====
     * black => 40,
     * red => 41,
     * magenta => 45,
     * yellow => 43,
     * green => 42,
     * blue => 44,
     * cyan => 46,
     * light_gray => 47,
     */
}
