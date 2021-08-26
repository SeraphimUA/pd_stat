<?php

namespace App\Models;

use CodeIgniter\Model;

class pubdomStat extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getCapacity($d_measure)
    {
        $query = $this->db->query('SELECT uanic_portal.uastat_month(:d_measure:) as stat', ['d_measure' => $d_measure]);

        $page = $query->getRowArray();

        $data = json_decode($page['stat'], true);

        return $data;
    }

    public function getPubdomCapacity($pd) {
        $query = $this->db->query('SELECT uanic_portal.stat_pubdom_capacity(:pd:) as stat', ['pd' => $pd]);

        $page = $query->getRowArray();

        $data = $page['stat'];

        return $data;
    }
}