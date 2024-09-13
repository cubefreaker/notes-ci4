<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (!session('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $notes = model('NoteModel')->findAll();
        return view('notes/list', ['notes' => $notes]);
    }
}
