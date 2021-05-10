<?php

namespace App\Controllers;

use App\Models\ModelKategori;


class Kategori extends BaseController
{
    public function __construct()
    {
        $this->ModelKategori = new ModelKategori();
        helper('form');
    }
    public function index()
    {
        $data = array(
            'title' => 'Kategori',
            'kategori' =>   $this->ModelKategori->all_data(),
            'isi' => 'v_kategori'
        );
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = array('nama_kategori' => $this->request->getPost('nama_kategori'));
        $this->ModelKategori->add($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!!!');
        return redirect()->to(base_url('kategori'));
    }

    public function edit($id_kategori)
    {
        $data = array(
            'id_kategori' => $id_kategori,
            'nama_kategori' => $this->request->getPost('nama_kategori')
        );
        $this->ModelKategori->edit($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiUpdate!!!');
        return redirect()->to(base_url('kategori'));
    }

    public function delete($id_kategori)
    {
        $data = array(
            'id_kategori' => $id_kategori,

        );
        $this->ModelKategori->delete_data($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiHapus!!!');
        return redirect()->to(base_url('kategori'));
    }


    //--------------------------------------------------------------------

}
