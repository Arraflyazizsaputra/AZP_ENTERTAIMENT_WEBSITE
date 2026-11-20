<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtistModel extends Model
{
    protected $table      = 'artists';
    protected $primaryKey = 'id';
    protected $allowedFields = [
    'name', 
    'category',
    'photo', 
    'description', 
    'spotify_link', 
    'youtube_link', 
    'apple_link',
    'ig_link', 
    'tiktok_link', 
    'x_link', 
    'fb_link'
];
}
