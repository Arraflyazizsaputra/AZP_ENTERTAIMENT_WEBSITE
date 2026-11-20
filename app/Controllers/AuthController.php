<?php 

namespace App\Controllers;

// WAJIB: Impor UserModel agar bisa digunakan
use App\Models\UserModel;

class AuthController extends BaseController 
{
    public function login() {
    return view('auth/auth_page'); // Menampilkan file gabungan
}

    public function register() 
    {
        return redirect()->to('/login')->with('open_register', true);
}

    public function saveRegister()
{
    // 1. Inisialisasi Model
    $userModel = new \App\Models\UserModel();

    // 2. Lakukan Validasi (Penting untuk Nilai UAS)
    if (!$this->validate([
        'username' => [
            'rules'  => 'required|is_unique[users.username]|min_length[4]',
            'errors' => [
                'required'  => 'Username wajib diisi.',
                'is_unique' => 'Username sudah digunakan.',
                'min_length' => 'Username minimal 4 karakter.'
            ]
        ],
        'email' => [
            'rules'  => 'required|valid_email|is_unique[users.email]',
            'errors' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email sudah terdaftar.'
            ]
        ],
        'password' => [
            'rules'  => 'required|min_length[5]',
            'errors' => [
                'required'   => 'Password wajib diisi.',
                'min_length' => 'Password minimal 5 karakter.'
            ]
        ],
    ])) {
        // JIKA VALIDASI GAGAL:
        // Kembalikan ke halaman login dengan membawa input lama & pesan error
        // 'open_register' => true digunakan agar panel tetap di sisi registrasi
        return redirect()->to('/login')->withInput()->with('error', $this->validator->listErrors())->with('open_register', true);
    }

    // 3. Jika Validasi Berhasil, Siapkan Data
    $data = [
        'username' => $this->request->getVar('username'),
        'email'    => $this->request->getVar('email'),
        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
    ];

    // 4. Simpan ke Database
    $userModel->save($data);

    // 5. Arahkan ke Login dengan Pesan Sukses
    // Di sini kita tidak kirim 'open_register' agar form otomatis balik ke sisi Login
    return redirect()->to('/login')->with('success', 'Account created! Please sign in to enter the studio.');
}

    public function auth() 
    {
        $session  = session();
        $model    = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // MENCARI USER DI DATABASE BERDASARKAN USERNAME
        $dataUser = $model->where('username', $username)->first();

        if ($dataUser) {
            // VERIFIKASI PASSWORD (Membandingkan input dengan hash di DB)
            $passHash = $dataUser['password'];
            $verifyPassword = password_verify($password, $passHash);

            if ($verifyPassword) {
                // Jika password cocok, buat session
                $session->set([
                    'id'        => $dataUser['id'],
                    'username'  => $dataUser['username'],
                    'email'     => $dataUser['email'],
                    'logged_in' => true
                ]);
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Password Salah!');
            }
        } else {
            return redirect()->back()->with('error', 'Username Tidak Ditemukan!');
        }
    }

    public function logout() 
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}