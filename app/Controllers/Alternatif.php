<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Alternatif extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Informasi Data Alternatif',
            'alternatif' => $this->AlternatifModel->findAll()
        ];

        echo view('alternatif/index', $data);
    }

    public function tambah()
    {
        $data = [
            'id_alter' => null,
            'nama_alter' => esc($this->request->getPost('nama_alter'))
        ];
        $this->AlternatifModel->insert($data);

        $id_alter = $this->AlternatifModel->where('nama_alter', $data['nama_alter'])->findAll();
        $id_alter = $id_alter[0]->id_alter;
        //        dd($id_alter);

        $data_kriteria = $this->KriteriaModel->findAll();
        //        dd($data_kriteria);
        foreach ($data_kriteria as $kriteria) {
            $dataa = array(
                'id_nilaialter' => null,
                'id_kriteria' => $kriteria->id_kriteria,
                'id_alter' => $id_alter,
                'nilai' => 0
            );
            //            dd($dataa);
            $this->NilaiAlterModel->insert(array(
                'id_nilaialter' => null,
                'id_kriteria' => $kriteria->id_kriteria,
                'id_alter' => $id_alter,
                'nilai' => 0
            ));
        }

        return redirect()->back()->with('success', 'Data Alternatif Berhasil Ditambah!');
    }

    public function ubah($id_alter)
    {
        $data = [
            'nama_alter' => esc($this->request->getPost('nama_alter')),
        ];
        $this->AlternatifModel->update($id_alter, $data);

        return redirect()->back()->with('success', 'Data Alternatif Berhasil Diubah!');
    }

    public function hapus($id_alter)
    {
        $this->AlternatifModel->where('id_alter', $id_alter)->delete();
        $this->NilaiAlterModel->where('id_alter', $id_alter)->delete();

        return redirect()->back()->with('success', 'Data Kriteria Berhasil Dihapus!');
    }
}
