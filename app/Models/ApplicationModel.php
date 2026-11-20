<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationModel extends Model
{
    protected $table            = 'applications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Field yang diizinkan untuk diisi melalui form
    protected $allowedFields    = [
        'audition_id', 
        'name', 
        'email', 
        'phone', 
        'portfolio_link', 
        'message', 
        'status'
    ];

    // Mengaktifkan fitur otomatis pencatatan waktu
protected $useTimestamps = true;
protected $createdField  = 'created_at';
protected $updatedField  = ''; // Kosongkan ini jika di database tidak ada kolom updated_at

    /**
     * Mengambil data lamaran beserta nama audisinya (JOIN)
     * Sangat berguna untuk tampilan di Dashboard Admin nanti
     */
    public function getApplicationsWithAudition()
    {
        return $this->select('applications.*, auditions.title as audition_title, auditions.category')
                    ->join('auditions', 'auditions.id = applications.audition_id')
                    ->orderBy('applications.created_at', 'DESC')
                    ->findAll();
    }
}