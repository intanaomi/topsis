<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Hasil extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Informasi Nilai Preferensi Alternatif',
            'alternatif' => $this->AlternatifModel->orderBy('hasil_alter', 'desc')->findAll()
        ];

        echo view('hasil/index', $data);
    }

    public function tambah()
    {
        $data = [
            'id_alter' => null,
            'nama_alter' => esc($this->request->getPost('nama_alter'))
        ];
        $this->AlternatifModel->insert($data);

        return redirect()->back()->with('success', 'Data Alternatif Berhasil Ditambah!');
    }

    public function ubah($id_kriteria)
    {
        $data = [
            'nama_alter' => esc($this->request->getPost('nama_kriteria')),
        ];
        $this->AlternatifModel->update($id_kriteria, $data);
        return redirect()->back()->with('success', 'Data Alternatif Berhasil Diubah!');
    }

    public function hapus($id_alter)
    {
        $this->AlternatifModel->where('id_alter', $id_alter)->delete();

        return redirect()->back()->with('success', 'Data Kriteria Berhasil Dihapus!');
    }
}
