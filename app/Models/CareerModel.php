<?php namespace App\Models;
use CodeIgniter\Model;

class CareerModel extends Model {
    protected $table = 'careers';
    protected $allowedFields = ['title', 'category'];
    protected $useTimestamps = true;
}