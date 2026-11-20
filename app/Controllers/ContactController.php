<?php

namespace App\Controllers;

use App\Models\ContactModel;
use App\Models\ProfileModel;

class ContactController extends BaseController
{
    protected $contactModel;
    protected $profileModel;

    public function __construct()
    {
        $this->contactModel = new ContactModel();
        $this->profileModel = new ProfileModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Contact Us | AZP STUDIO',
            'profile' => $this->profileModel->find(1) // Mengambil alamat & info agensi
        ];

        return view('pages/contact', $data);
    }

    public function send()
    {
        // Validasi input
        $rules = [
            'name'    => 'required|min_length[3]',
            'email'   => 'required|valid_email',
            'subject' => 'required|min_length[5]',
            'message' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Mohon isi form dengan benar.');
        }

        // Simpan ke database
        $this->contactModel->save([
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
        ]);

        return redirect()->to('/contact')->with('success', 'Pesan Anda telah terkirim. Terima kasih!');
    }
}