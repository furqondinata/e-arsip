<?php

namespace App\Controllers;

use App\Models\Model_user;
use App\Models\Model_dep;

class User extends BaseController
{
    public function __construct()
    {
        $this->Model_user = new Model_user();
        $this->Model_dep = new Model_dep();
        helper('form');
    }

    public function index()
    {

        $data = array(
            'title' => 'User',
            'user' =>  $this->Model_user->all_data(),
            'isi' => 'user/v_index'
        );
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Add User',
            'dep' =>  $this->Model_dep->all_data(),
            'isi' => 'user/v_add'
        );
        return view('layout/v_wrapper', $data);
    }

    public function insert()
    {
        if ($this->validate([
            'nama_user' => [
                'label'  => 'Nama User',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'email' => [
                'label'  => 'email',
                'rules'  => 'required|is_unique[tbl_user.email]',
                'errors' => [
                    'required'   => '{field} Wajib Diisi !!!',
                    'is_unique'   => '{field} Sudah Ada,Input {field} lain !!!'
                ]
            ],
            'level' => [
                'label'  => 'level',
                'rules'  => 'required',
                'errors' => [
                    'required'   => '{field} Wajib Diisi !!!',
                ]
            ],
            'id_dep' => [
                'label'  => 'departemen',
                'rules'  => 'required',
                'errors' => [
                    'required'   => '{field} Wajib Diisi !!!',
                ]
            ],
            'foto' => [
                'label'  => 'foto',
                'rules'  => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded'   => '{field} Wajib Diisi !!!',
                    'max_size'   => 'Ukuran{field} Max 1024 kb  !!!',
                    'mime_in'   => 'Format{field}  wajib jpg dan png  !!!',
                ]
            ],
        ])) {
            // mengambil file foto yng akan di upload
            $foto = $this->request->getFile('foto');
            // merandom nama file foto
            $nama_file = $foto->getRandomName();

            // jika valid
            $data = array(
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'level' => $this->request->getPost('level'),
                'id_dep' => $this->request->getPost('id_dep'),
                'foto' => $nama_file,
            );
            // direktori upload file
            $foto->move('foto', $nama_file);
            $this->Model_user->add($data);
            session()->setFlashdata(
                'pesan',
                'Data Berhasil Ditambahkan!!!'
            );
            return redirect()->to(base_url('user'));
        } else {
            // jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user/add'));
        }
    }

    public function edit($id_user)
    {
        $data = array(
            'title' => 'Edit User',
            'dep' =>  $this->Model_dep->all_data(),
            'user' => $this->Model_user->detail_data($id_user),
            'isi' => 'user/v_edit'
        );
        return view('layout/v_wrapper', $data);
    }

    public function update($id_user)
    {
        if ($this->validate([
            'nama_user' => [
                'label'  => 'Nama User',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],

            'level' => [
                'label'  => 'level',
                'rules'  => 'required',
                'errors' => [
                    'required'   => '{field} Wajib Diisi !!!',
                ]
            ],
            'id_dep' => [
                'label'  => 'departemen',
                'rules'  => 'required',
                'errors' => [
                    'required'   => '{field} Wajib Diisi !!!',
                ]
            ],
            'foto' => [
                'label'  => 'foto',
                'rules'  => 'max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [

                    'max_size'   => 'Ukuran{field} Max 1024 kb  !!!',
                    'mime_in'   => 'Format{field}  wajib jpg dan png  !!!',
                ]
            ],
        ])) {
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                $data = array(
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'password' => $this->request->getPost('password'),
                    'level' => $this->request->getPost('level'),
                    'id_dep' => $this->request->getPost('id_dep'),
                );
                $this->Model_user->edit($data);
            } else {
                // menghapus foto lama
                $user =  $this->Model_user->detail_data($id_user);
                if ($user['foto'] != "") {
                    unlink('foto/' . $user['foto']);
                }
                // merandom nama file foto
                $nama_file = $foto->getRandomName();
                $data = array(
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'password' => $this->request->getPost('password'),
                    'level' => $this->request->getPost('level'),
                    'id_dep' => $this->request->getPost('id_dep'),
                    'foto' => $nama_file,
                );
                // direktori upload file
                $foto->move('foto', $nama_file);
                $this->Model_user->edit($data);
            }

            // mengambil file foto yng akan di upload
            // $foto = $this->request->getFile('foto');
            // merandom nama file foto
            // $nama_file = $foto->getRandomName();

            // jika valid

            session()->setFlashdata(
                'pesan',
                'Data Berhasil DiUpdate!!!'
            );

            return redirect()->to(base_url('user'));
        } else {
            // jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user/edit/' . $id_user));
        }
    }

    public function delete($id_user)
    {
        // menghapus foto lama
        $user =  $this->Model_user->detail_data($id_user);
        if ($user['foto'] != "") {
            unlink('foto/' . $user['foto']);
        }

        $data = array(
            'id_user' => $id_user,

        );
        $this->Model_user->delete_data($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiHapus!!!');
        return redirect()->to(base_url('user'));
    }
    //--------------------------------------------------------------------

}
