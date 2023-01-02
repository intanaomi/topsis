<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{

    protected $table            = 'kriteria';
    protected $primaryKey       = 'id_kriteria';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_kriteria', 'atribut', 'bobot'];

    public function allData()
    {
        return $this->db->table('kriteria')
            ->get()->getResultArray();
    }

    public function jmlKriteria()
    {
        return $this->db->table('kriteria')->countAll();
    }
}
