<?php

namespace App\Models;

use CodeIgniter\Model;

class AlternatifModel extends Model
{
    protected $table            = 'alternatif';
    protected $primaryKey       = 'id_alter';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_alter', 'hasil_alter', 'id_alter'];
}
