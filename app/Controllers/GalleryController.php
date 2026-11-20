<?php

namespace App\Controllers;

use App\Models\GalleryModel;
// Gunakan BaseController agar bisa menggunakan fitur validasi dan library bawaan CI4
use App\Controllers\BaseController;

class GalleryController extends BaseController
{
    protected $galleryModel;

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
    }

    /**
     * 1. Menampilkan Daftar Galeri (Panel Admin)
     */
    public function index()
    {
        $data = [
            'title'   => 'Gallery Management',
            'gallery' => $this->galleryModel->orderBy('id', 'DESC')->findAll()
        ];
        
        // Memastikan diarahkan ke view admin
        return view('admin/gallery/index', $data);
    }

    /**
     * 2. Proses Simpan & Update Data
     */
    public function save()
    {
        // Validasi Input (Ukuran max 2MB)
        $rules = [
            'title' => 'required|min_length[3]',
            'image' => 'max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $id = $this->request->getPost('id');
        $fileGambar = $this->request->getFile('image');
        
        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ];

        if ($id) $data['id'] = $id;

        // Logika Upload Gambar
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            
            // Jika EDIT: Hapus gambar lama agar storage tidak penuh
            if ($id) {
                $oldData = $this->galleryModel->find($id);
                if ($oldData && !empty($oldData['image']) && file_exists('img/gallery/' . $oldData['image'])) {
                    unlink('img/gallery/' . $oldData['image']);
                }
            }

            // Simpan gambar baru
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('img/gallery', $namaGambar);
            $data['image'] = $namaGambar;
        }

        if ($this->galleryModel->save($data)) {
            return redirect()->to('/admin/gallery')->with('success', 'Galeri berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Gagal menyimpan data ke database.');
    }

    /**
     * 3. Menghapus Data Galeri
     */
    public function delete($id)
    {
        $data = $this->galleryModel->find($id);

        if ($data) {
            // Hapus file fisik dari folder img/gallery
            if (!empty($data['image']) && file_exists('img/gallery/' . $data['image'])) {
                unlink('img/gallery/' . $data['image']);
            }
            
            $this->galleryModel->delete($id);
            return redirect()->to('/admin/gallery')->with('success', 'Konten berhasil dihapus.');
        }

        return redirect()->to('/admin/gallery')->with('error', 'Data tidak ditemukan.');
    }

    /**
     * 4. API Load More (Untuk Tampilan Depan / Public)
     */
public function loadMore()
{
    $offset = (int) $this->request->getVar('offset'); // Pastikan mengambil 'offset'
    $limit = 4;

    // Gunakan builder agar lebih presisi
    $builder = $this->galleryModel->builder();
    $next_items = $builder->orderBy('id', 'DESC')
                          ->limit($limit, $offset)
                          ->get()
                          ->getResultArray();

    if (!empty($next_items)) {
        return $this->response->setJSON([
            'status'   => 'success',
            'data'     => $next_items,
            'base_url' => base_url('img/gallery/')
        ]);
    }

    return $this->response->setJSON(['status' => 'empty']);
}
}