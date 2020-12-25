<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_role extends MY_Model
{

    /**
     * Data seeding
     * 
     * @var array $seed
     */
    protected $seed_data = [
        [
            'role' => 'Developer',
        ],
        [
            'role' => 'Administrator',
        ],
    ];
}
