<?php namespace App\Models;
use CodeIgniter\Model;

class ProfileModel extends Model {
    protected $table = 'company_profile';
    protected $allowedFields = [
        'philosophy', 'vision', 'mission_1', 'mission_2', 'mission_3', 
        'ceo_name', 'ceo_bio', 'building_img', 'ceo_img', 'address', 'maps_link'
    ];
}