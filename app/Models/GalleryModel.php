<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    protected $table      = 'gallery';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'image', 'description'];

    // UBAH INI MENJADI FALSE
    protected $useTimestamps = false; 
}