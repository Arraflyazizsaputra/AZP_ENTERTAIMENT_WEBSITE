<?php namespace App\Models;
use CodeIgniter\Model;

class SponsorModel extends Model {
    protected $table = 'sponsors';
    protected $allowedFields = ['name', 'logo'];
    protected $useTimestamps = true;
}