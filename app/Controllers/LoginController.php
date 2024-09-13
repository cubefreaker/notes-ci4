<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    function __construct()
    {
        $this->validation = service('validation');
    }
    public function index()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('login', $data);
    }

    public function registerPage()
    {
        $data = [
            'title' => 'Register',
        ];
        return view('register', $data);
    }

    public function login()
    {
        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'valid_email' => '{field} tidak valid',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ]
        ];

        $this->validation->setRules($rules);
        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $input = $this->request->getPost();
        $user = model('UserModel')->where('email', $input['email'])->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'User tidak ditemukan');
        }

        if (!password_verify($input['password'], $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Password salah');
        }

        session()->set([
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/');
    }
    
    public function register()
    {
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => [
                    'required',
                    'min_length[3]',
                    'is_unique[users.username]',
                ],
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 3 karakter',
                    'is_unique' => '{field} sudah terdaftar',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => [
                    'required',
                    'valid_email',
                    'is_unique[users.email]',
                ],
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'valid_email' => '{field} tidak valid',
                    'is_unique' => '{field} sudah terdaftar',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => [
                    'required',
                    'min_length[6]',
                ],
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 6 karakter',
                ]
            ],
            'confirm_password' => [
                'label' => 'Konfirmasi Password',
                'rules' => [
                    'required',
                    'matches[password]',
                ],
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'matches' => '{field} tidak sama dengan password',
                ]
            ]
        ];

        $this->validation->setRules($rules);
        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $input = $this->request->getPost();

        $userModel = model('UserModel');

        $userModel->insert([
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => password_hash($input['password'], PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/login')->with('success', 'Register berhasil, silahkan login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logout berhasil');
    }
}
