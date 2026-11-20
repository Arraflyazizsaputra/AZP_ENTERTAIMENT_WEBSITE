<?php 

namespace App\Controllers;
use App\Models\ArtistModel;

class ArtistController extends BaseController {
    
    public function index($category = 'soloist') {
        $model = new ArtistModel();
        
        // Cek apakah kategori valid, jika tidak default ke soloist
        $valid_categories = ['soloist', 'band', 'aktor'];
        if (!in_array($category, $valid_categories)) {
            $category = 'soloist';
        }

        $data = [
            'title'          => 'AZP LABELS - ' . strtoupper($category),
            'current_cat'    => $category,
            // Filter database berdasarkan kategori yang dipilih di URL
            'artists'        => $model->where('category', $category)->orderBy('name', 'ASC')->findAll()
        ];
        
        return view('pages/artists_list', $data);
    }
}