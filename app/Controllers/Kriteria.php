<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Kriteria extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Kriteria KPI',
            'kriteria' => $this->KriteriaModel->orderBy('id_kriteria', 'DESC')->findAll()
        ];

        echo view('kriteria/index', $data);
    }
    public function tambah()
    {
        $data = [
            'nama_kriteria' => esc($this->request->getPost('nama_kriteria')),
            'atribut' => esc($this->request->getPost('atribut')),
            'bobot' => esc($this->request->getPost('bobot'))
        ];

        $this->KriteriaModel->insert($data);

        $id_kriteria = $this->KriteriaModel->where( 'nama_kriteria', $data['nama_kriteria'])->findAll();
        $id_kriteria = $id_kriteria[0]->id_kriteria;
        $data_alternatif = $this->AlternatifModel->findAll();
        foreach ($data_alternatif as $alter) {
            $dataa = [
                'id_alter' => $alter->id_alter,
                'id_kriteria' => $id_kriteria,
                'nilai' => 0
            ];
            $this->NilaiAlterModel->insert($dataa);
        }

        return redirect()->back()->with('success', 'Data Kriteria Berhasil Ditambah!');
    }

    public function ubah($id_kriteria)
    {
        // $this->kriteria->update($id_kriteria, [
        //     'nama_kriteria' => esc($this->request->getPost('nama_kriteria')),
        //     'atribut' => esc($this->request->getPost('atribut')),
        //     'bobot' => esc($this->request->getPost('bobot'))
        // ]);
        $data = [
            'nama_kriteria' => esc($this->request->getPost('nama_kriteria')),
            'atribut' => esc($this->request->getPost('atribut')),
            'bobot' => esc($this->request->getPost('bobot'))
        ];
        $this->KriteriaModel->update($id_kriteria, $data);

        return redirect()->back()->with('success', 'Data Kriteria Berhasil Diubah!');
    }

    public function hapus($id_kriteria)
    {
        $this->KriteriaModel->where('id_kriteria', $id_kriteria)->delete();
        $this->NilaiAlterModel->where('id_kriteria', $id_kriteria)->delete();

        return redirect()->back()->with('success', 'Data Kriteria Berhasil Dihapus!');
    }
}
