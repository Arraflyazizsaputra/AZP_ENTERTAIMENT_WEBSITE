<?php

namespace App\Models;

use CodeIgniter\Model;

class AlbumModel extends Model
{
    protected $table            = 'albums';
    protected $primaryKey       = 'id';
    
    // TAMBAHKAN 'album_link' ke dalam array ini
    protected $allowedFields    = ['title', 'sub_title', 'artist_name', 'badge_text', 'image_path', 'album_link'];

    // Sesuai permintaan Anda, timestamps dimatikan
    protected $useTimestamps    = false; 
    
    /**
     * Mengambil data album.
     * Jika ID tidak disertakan, mengambil semua data diurutkan dari yang terbaru (ID terbesar).
     */
    public function getAlbumsWithArtist($id = false)
    {
        if ($id === false) {
            // Urutkan berdasarkan ID DESC agar inputan terbaru muncul di awal slide
            return $this->orderBy('id', 'DESC')->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}