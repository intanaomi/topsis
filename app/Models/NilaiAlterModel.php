<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiAlterModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'nilaialter';
    protected $primaryKey       = 'id_nilaialter';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nilai', 'id_alter', 'id_kriteria'];

    function getAll()
    {
        $builder = $this->db->table('nilaialter');
        $builder->join('alternatif', 'alternatif.id_alter = nilaialter.id_alter');
        $builder->join('kriteria', 'kriteria.id_kriteria = nilaialter.id_kriteria');
        $query = $builder->get();
        return $query->getResult();
    }
}
