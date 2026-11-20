<?php
namespace App\Models;
use CodeIgniter\Model;

class DiscographyModel extends Model {
    protected $table = 'artist_discography';
    protected $primaryKey = 'id';
    protected $allowedFields = ['artist_id', 'album_title', 'album_cover', 'youtube_url', 'release_date'];

    public function getByArtist($artist_id) {
        return $this->where('artist_id', $artist_id)->orderBy('release_date', 'DESC')->findAll();
    }
}