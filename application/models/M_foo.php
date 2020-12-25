<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_foo extends MY_Model
{
    /**
     * Data seeding
     * 
     * @var array $seed
     */
    protected $seed_data = [
        [
            'field_name' => 'anything',
        ],
        [
            'field_name' => 'also anything',
        ],
    ];
}
