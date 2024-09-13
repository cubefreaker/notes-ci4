<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class NotesController extends BaseController
{
    function __construct()
    {
        $this->validation = service('validation');
        $this->rules = [
            'title' => [
                'label' => 'Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'content' => [
                'label' => 'Konten',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ]
        ];
    }
    public function addPage()
    {
        if (!session('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silahkan login terlebih dahulu');
        }

        return view('notes/add');
    }

    public function editPage($id)
    {
        if (!session('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $note = model('NoteModel')->find($id);
        if (!$note) {
            return redirect()->back()->with('error', 'Note tidak ditemukan');
        }

        return view('notes/edit', ['note' => $note]);
    }

    public function add()
    {
        if (!session('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $this->validation->setRules($this->rules);
        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $input = $this->request->getPost();
        model('NoteModel')->save([
            'title' => $input['title'],
            'content' => $input['content'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/')->with('success', 'Note berhasil ditambahkan');
    }

    public function edit($id)
    {
        if (!session('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $this->validation->setRules($this->rules);
        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $input = $this->request->getPost();
        model('NoteModel')->update($id, [
            'title' => $input['title'],
            'content' => $input['content'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/')->with('success', 'Note berhasil diubah');
    }

    public function delete($id)
    {
        if (!session('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silahkan login terlebih dahulu');
        }
        
        model('NoteModel')->delete($id);
        return redirect()->to('/')->with('success', 'Note berhasil dihapus');
    }
}
