<?php

namespace App\Models;

use CodeIgniter\Model;

class PerhitunganModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'perhitungan';
    protected $primaryKey       = 'id_perhitunngan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['normalisasi', 'terbobot', 'nilai_preferensi'];

    function getAll()
    {
        $builder = $this->db->table('perhitungan');
        $builder->join('alternatif', 'alternatif.id_alter = perhitungan.id_alter');
        $builder->join('kriteria', 'kriteria.id_kriteria = perhitungan.id_kriteria');
        $query = $builder->get();
        return $query->getResult();
    }
}
