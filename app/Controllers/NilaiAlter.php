<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class NilaiAlter extends BaseController
{
     public function __construct()
     {
         $this->db = \Config\Database::connect();
     }

    public function index()
    {

        $alternatif = $this->AlternatifModel->findAll();
        $kriteria = $this->KriteriaModel->findAll();
        foreach ($alternatif as $alter){
            foreach ($kriteria as $kri){
                $data_nilai = $this->NilaiAlterModel
                    ->where('id_alter',$alter->id_alter)
                    ->where('id_kriteria',$kri->id_kriteria)
                    ->findAll();
//                dd($data_nilai);
                $nilaialter[$alter->id_alter][$kri->id_kriteria] = $data_nilai[0]->nilai;
            }
        }

        $data = [
            'judul' => 'Nilai Alternatif',
            'kriteria' => $this->KriteriaModel->findAll(),
            'alternatif' => $this->AlternatifModel->findAll(),
            'nilaialter' => $nilaialter,
        ];

//        dd($data['nilaialter']);
        echo view('nilaialter/index', $data);
    }

    public function ubah($id_alter)
    {
        // update nilaialter
        $data_kriteria = esc($this->request->getPost('kriteria'));
        foreach (array_keys($data_kriteria) as $kri){
            $nilaiAlter = $this->NilaiAlterModel
                ->where('id_alter', $id_alter)
                ->where('id_kriteria', $kri)
                ->first();
            $id_nilaiAlter = $nilaiAlter->id_nilaialter;
            $nilaiAlter->nilai = $data_kriteria[$kri];
            $this->NilaiAlterModel->update($id_nilaiAlter, $nilaiAlter);
        }

        /* memperbarui nilai topsis dengan query sql */
        $query = "SELECT d_minus/(d_minus+d_plus)*10 nilai_preferensi, id_alter FROM (
                    SELECT SUM(POWER(normalized - a_plus, 2)) d_plus, SUM(POWER(normalized - a_minus, 2)) d_minus, id_alter  FROM (
                        SELECT MAX(bobotized) a_plus, MIN(bobotized) a_minus, id_kri FROM (
                            SELECT normalized, normalized*kriteria.bobot bobotized, id_kri, a.id_alter id_alter from (
                                SELECT nilai/sqrt_sum normalized, nilaialter.id_kriteria id_kri, nilai, sqrt_sum, sqrt.id_alter id_alter
                                FROM (SELECT SQRT(SUM(nilai*nilai)) sqrt_sum, id_kriteria, id_alter
                                    FROM nilaialter GROUP BY id_kriteria) sqrt, nilaialter
                                WHERE nilaialter.id_kriteria=sqrt.id_kriteria
                            ) a, kriteria
                            WHERE id_kri=kriteria.id_kriteria    
                        ) b
                        GROUP BY id_kri    
                    ) solution,
                        (
                        SELECT nilai/sqrt_sum normalized, nilaialter.id_kriteria kri, nilai, sqrt_sum, id_alter
                        FROM (SELECT SQRT(SUM(nilai*nilai)) sqrt_sum, id_kriteria 
                            FROM nilaialter GROUP BY id_kriteria) sqrt, nilaialter
                        WHERE nilaialter.id_kriteria=sqrt.id_kriteria    
                    ) normalized
                    WHERE id_kri=kri
                    GROUP BY id_alter
                ) d";
        $result = $this->db->query($query);
        $result = $result->getResultArray();

//        dd($result);
        foreach ($result as $res){
            $query = "UPDATE `alternatif` SET `hasil_alter`=".$res['nilai_preferensi']." WHERE id_alter=".$res['id_alter'];
            $this->db->query($query);
        }

//        foreach ($data_kriteria as $kri){
//            foreach ($daftar_alternatif as $alter){
//                $nilai =
//            }
//        }

        return redirect()->back()->with('success', 'Data Alternatif Berhasil Diubah!');
    }

}
