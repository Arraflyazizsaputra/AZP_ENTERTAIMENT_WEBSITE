<?php

namespace App\Models;

use CodeIgniter\Model;

class RunningTextModel extends Model
{
    protected $table            = 'running_text'; // Nama tabel di database
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Daftarkan kolom yang boleh diisi/diubah melalui form
protected $allowedFields = ['line_label', 'content', 'category']; // Tambahkan 'content' jika belum ada

    // Fitur tambahan: Mengambil semua data running text secara rapi
    public function getRunningTexts()
    {
        return $this->findAll();
    }
}