<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users'; // Nama tabel di phpMyAdmin harus 'users'
    protected $primaryKey = 'id';
    // Wajib memasukkan field yang boleh diisi di sini
    protected $allowedFields = ['username', 'email', 'password']; 
}