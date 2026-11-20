<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditionModel extends Model
{
    protected $table            = 'auditions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Aktifkan Soft Deletes untuk keamanan data
    protected $useSoftDeletes   = true; 

    protected $allowedFields    = [
        'category', 
        'title', 
        'requirements', 
        'deadline', 
        'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; // Tambahkan kolom ini di DB jika pakai Soft Deletes

    // Aturan Validasi
    protected $validationRules = [
        'category'     => 'required|min_length[3]|max_length[50]',
        'title'        => 'required|min_length[5]|max_length[255]',
        'requirements' => 'required',
        'deadline'     => 'required|valid_date',
        'status'       => 'required|in_list[Open,Closed]'
    ];

    // Pesan Error Kustom
    protected $validationMessages = [
        'category' => [
            'required'   => 'Kategori harus diisi (misal: VOCAL/DANCE).',
            'min_length' => 'Nama kategori terlalu pendek.'
        ],
        'deadline' => [
            'valid_date' => 'Format tanggal tidak valid.'
        ],
        'status' => [
            'in_list' => 'Status harus pilih antara Open atau Closed.'
        ]
    ];

    /**
     * Helper: Ambil Audisi Aktif
     */
    public function getActiveAuditions()
    {
        return $this->where('status', 'Open')
                    ->where('deadline >=', date('Y-m-d'))
                    ->orderBy('deadline', 'ASC')
                    ->findAll();
    }

    /**
     * Helper: Menghitung jumlah pelamar per lowongan
     * Berguna untuk Dashboard Admin nanti
     */
    public function getAuditionWithApplicantCount()
    {
        return $this->select('auditions.*, COUNT(applications.id) as total_applicants')
                    ->join('applications', 'applications.audition_id = auditions.id', 'left')
                    ->groupBy('auditions.id')
                    ->orderBy('auditions.created_at', 'DESC')
                    ->findAll();
    }
}