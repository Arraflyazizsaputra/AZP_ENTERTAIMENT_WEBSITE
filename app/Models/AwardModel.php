<?php

namespace App\Models;

use CodeIgniter\Model;

class AwardModel extends Model
{
    // Nama tabel di database
    protected $table      = 'awards';
    
    // Nama primary key
    protected $primaryKey = 'id';

    // Kolom yang boleh diisi melalui form (Mass Assignment)
    protected $allowedFields = ['name', 'icon'];

    // Mengaktifkan fitur otomatis pengisian waktu
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Kosongkan jika tidak ada kolom updated_at di tabel awards
}