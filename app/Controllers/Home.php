<?php

namespace App\Controllers;

use App\Models\ArtistModel;
use App\Models\AlbumModel;
use App\Models\GalleryModel;
use App\Models\RunningTextModel;
use App\Models\ProfileModel;
use App\Models\AwardModel;
use App\Models\DiscographyModel;
use App\Models\AuditionModel;
use App\Models\ApplicationModel;
use App\Models\SponsorModel;
use App\Models\CareerModel;

class Home extends BaseController
{
    protected $artistModel;
    protected $albumModel;
    protected $galleryModel;
    protected $runningTextModel;
    protected $discographyModel;
    protected $auditionModel;
    protected $applicationModel;
    protected $profileModel;
    protected $awardModel;

    public function __construct()
    {
        // Inisialisasi semua model di constructor agar efisien
        $this->artistModel      = new ArtistModel();
        $this->albumModel       = new AlbumModel();
        $this->galleryModel     = new GalleryModel();
        $this->runningTextModel = new RunningTextModel();
        $this->discographyModel = new DiscographyModel();
        $this->auditionModel    = new AuditionModel();
        $this->applicationModel = new ApplicationModel();
        $this->profileModel     = new ProfileModel();
        $this->awardModel       = new AwardModel();
    }

    /* --- 1. HALAMAN UTAMA --- */
    public function index()
    {
        $allArtists = $this->artistModel->findAll();
        
        // Logika Slider: Menggandakan data jika artis kurang dari 5 agar slider tidak kosong
        $featured_artists = (count($allArtists) > 0 && count($allArtists) < 5) 
                            ? array_merge($allArtists, $allArtists) 
                            : $allArtists;

        // Ambil 1 foto headline untuk Hero Section (pastikan kolom is_featured ada di DB)
        $headlinePhoto = $this->galleryModel->where('is_featured', 1)->orderBy('id', 'DESC')->first();

        $data = [
            'title'            => 'Home | AZP STUDIO',
            'hero_artist'      => $allArtists[0] ?? null, 
            'featured_artists' => $featured_artists,      
            'albums'           => $this->albumModel->getAlbumsWithArtist(),
            'running_texts'    => $this->runningTextModel->findAll(),
            'headline_gallery' => $headlinePhoto
        ];

        return view('pages/home', $data);
    }

    /* --- 2. GALLERY STUDIO --- */
    public function gallery()
{
    $data = [
        'title'   => 'Studio Gallery | AZP STUDIO',
        // Ubah limit menjadi 3 untuk baris pertama
        'gallery' => $this->galleryModel->orderBy('id', 'DESC')->limit(3)->findAll() 
    ];
    return view('pages/gallery_studio', $data);
}

    // Fungsi AJAX untuk memuat foto tambahan
    public function loadMore()
{
    // Mengambil offset dari parameter URL (?offset=...)
    $offset = (int) $this->request->getVar('offset');
    
    // Ambil 6 foto berikutnya. 
    // Sangat penting: Urutan (DESC) harus sama dengan method gallery()
    $moreData = $this->galleryModel->orderBy('id', 'DESC')
                                   ->limit(6, $offset) 
                                   ->findAll();

    if ($moreData) {
        return $this->response->setJSON([
            'status'   => 'success',
            'data'     => $moreData,
            'base_url' => base_url('img/gallery/') 
        ]);
    }

    return $this->response->setJSON(['status' => 'empty', 'data' => []]);
}

    /* --- 3. ABOUT & OPPORTUNITIES --- */
    public function about() 
    {
        $data = [
            'title'   => 'About Us | AZP STUDIO',
            'profile' => $this->profileModel->find(1), 
            'awards'  => $this->awardModel->findAll()
        ];
        return view('pages/about', $data);
    }

    public function opportunities()
    {
        $sponsorModel = new SponsorModel();
        $careerModel  = new CareerModel();

        $data = [
            'title'    => 'Opportunities | AZP STUDIO',
            'sponsors' => $sponsorModel->findAll(),
            'careers'  => $careerModel->findAll(),
            'profile'  => $this->profileModel->find(1)
        ];

        return view('pages/opportunities', $data);
    }

    /* --- 4. ARTIST PROFILES --- */
    public function artist_profile($id)
    {
        $artist = $this->artistModel->find($id);

        if (!$artist) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Artist Profile Not Found");
        }

        $data = [
            'title'  => $artist['name'] . ' - Official Profile | AZP STUDIO',
            'artist' => $artist,
            'albums' => $this->discographyModel->where('artist_id', $id)->orderBy('id', 'DESC')->findAll(),
        ];

        return view('pages/artist_profile', $data);
    }

    public function getArtistDetail($id)
    {
        $artist = $this->artistModel->find($id);

        if (!$artist) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Artist Not Found");
        }

        $data = [
            'title'  => $artist['name'] . ' | AZP STUDIO',
            'artist' => $artist,
            'albums' => $this->discographyModel->where('artist_id', $id)->orderBy('id', 'DESC')->findAll()
        ];

        return view('pages/artist_detail', $data);
    }

    /* --- 5. AUDITIONS & APPLICATIONS --- */
    public function auditions()
    {
        $data = [
            'title'     => 'Global Audition | AZP STUDIO',
            'auditions' => $this->auditionModel->where('status', 'Open')->orderBy('id', 'DESC')->findAll()
        ];
        return view('pages/auditions', $data);
    }

    public function apply($id)
    {
        $audition = $this->auditionModel->find($id);

        if (!$audition || $audition['status'] !== 'Open') {
            return redirect()->to('/auditions')->with('error', 'Audition is closed or not available.');
        }

        $data = [
            'title'    => 'Apply for ' . $audition['title'],
            'audition' => $audition
        ];

        return view('pages/apply_audition', $data);
    }

    public function submitApplication()
    {
        $rules = [
            'audition_id'    => 'required|is_not_unique[auditions.id]',
            'name'           => 'required|min_length[3]|max_length[100]',
            'email'          => 'required|valid_email',
            'phone'          => 'required|numeric|min_length[10]|max_length[15]',
            'portfolio_link' => 'required|valid_url',
            'message'        => 'permit_empty|max_length[1000]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Silakan periksa kembali formulir Anda.');
        }

        $data = [
            'audition_id'    => $this->request->getPost('audition_id'),
            'name'           => $this->request->getPost('name'),
            'email'          => $this->request->getPost('email'),
            'phone'          => $this->request->getPost('phone'),
            'portfolio_link' => $this->request->getPost('portfolio_link'),
            'message'        => $this->request->getPost('message'),
            'status'         => 'Pending'
        ];

        if ($this->applicationModel->save($data)) {
            return redirect()->to('/auditions')->with('success', 'Aplikasi berhasil dikirim!');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal mengirim aplikasi.');
    }
}