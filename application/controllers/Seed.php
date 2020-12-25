<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Seeding class
 * 
 * Class untuk seeding database
 */
class Seed extends CI_Controller
{
    /**
     * Model model yang akan di masukan data nya
     * Pastikan urutan model sesuai dengan urutan insert
     */
    private $models = [
        // == Seed
        'M_role',
        'M_user',
        'M_menu',
        'M_menu_role',

        // == Dummy
        'M_foo',
        'M_example'
    ];

    /**
     * Fungsi yang pertamakali di panggil
     */
    public function __construct()
    {
        // Khusus dijalankan lewat CLI (tidak boleh lewat HTML)
        // dan dinonaktifkan ketika production
        // if (!is_cli() || (ENVIRONMENT === 'production')) show_404();

        parent::__construct();

        //  Load model
        foreach ($this->models as $model) {
            $this->load->model($model);
        }
    }

    /**
     * Jalankan seeding
     * 
     * @param bool $dummy Insert juga dummy nya?
     */
    public function run(bool $dummy = false)
    {
        echo "\033[0;33mMemulai Database Seeding\033[0m\n";
        foreach ($this->models as $model) {
            $this->$model->seed($this);
        }

        // ==== DUMMY ====
        if ($dummy) {
            echo "\033[0;33mData Dummy\033[0m\n";
            foreach ($this->models as $model) {
                $this->$model->dummy($this);
            }
        }
    }

    /**
     * Alternatif
     */
    public function index()
    {
        $this->run();
    }

    /**
     * Jalankan seeding bersama dummy nya
     */
    public function dummy()
    {
        $this->run(true);
    }
}
