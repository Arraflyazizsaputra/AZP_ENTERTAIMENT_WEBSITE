<?php

namespace App\Controllers;

use App\Models\ArtistModel;
use App\Models\AlbumModel;
use App\Models\ProfileModel;
use App\Models\AwardModel;
use App\Models\RunningTextModel;
use App\Models\DiscographyModel;
use App\Models\GalleryModel;
use App\Models\AuditionModel;
use App\Models\ApplicationModel;
use App\Models\ContactModel;
use App\Models\SponsorModel;
use App\Models\CareerModel;

class AdminController extends BaseController
{
    protected $artistModel;
    protected $albumModel;
    protected $profileModel;
    protected $awardModel;
    protected $runningTextModel;
    protected $discographyModel;
    protected $galleryModel;
    protected $auditionModel;
    protected $applicationModel;
    protected $contactModel;

    public function __construct()
    {
        $this->artistModel = new ArtistModel();
        $this->albumModel = new AlbumModel();
        $this->profileModel = new ProfileModel();
        $this->awardModel = new AwardModel();
        $this->runningTextModel = new RunningTextModel();
        $this->discographyModel = new DiscographyModel();
        $this->galleryModel = new GalleryModel();
        $this->auditionModel = new AuditionModel();
        $this->applicationModel = new ApplicationModel();
        $this->contactModel = new ContactModel();
    }

    // ==================== DASHBOARD ====================
    public function index()
    {
        $galleryModel = new GalleryModel();
        $auditionModel = new AuditionModel();
        $applicationModel = new ApplicationModel();

        $data = [
            'title' => 'Admin Dashboard',
            'totalArtists' => $this->artistModel->countAllResults(),
            'totalAlbums' => $this->albumModel->countAllResults(),
            'totalGallery' => $galleryModel->countAllResults(),
            'totalAuditions' => $auditionModel->where('status', 'Open')->countAllResults(),
            'totalApplications' => $applicationModel->where('status', 'Pending')->countAllResults(),
            'totalInquiries' => $this->contactModel->countAllResults(),
            'recentApplications' => $applicationModel->select('applications.*, auditions.title as audition_title')
                ->join('auditions', 'auditions.id = applications.audition_id')
                ->orderBy('applications.created_at', 'DESC')
                ->limit(5)
                ->findAll()
        ];

        return view('admin/dashboard', $data);
    }

    // ==================== ARTIST MANAGEMENT ====================
    public function artists()
    {
        $data = [
            'title' => 'Manage Artists',
            'artists' => $this->artistModel->findAll(),
        ];
        return view('admin/artists_management', $data);
    }

    public function saveArtist()
    {
        $id = $this->request->getPost('id');
        $filePhoto = $this->request->getFile('photo');
        
        $dataArtist = [
            'name' => $this->request->getPost('name'),
            'category' => $this->request->getPost('category'),
            'spotify_link' => $this->request->getPost('spotify_link'),
            'youtube_link' => $this->request->getPost('youtube_link'),
            'apple_link' => $this->request->getPost('apple_link'),
        ];
        
        if ($id) $dataArtist['id'] = $id;
        
        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            if ($id) {
                $old = $this->artistModel->find($id);
                if ($old && !empty($old['photo']) && file_exists('img/artists/' . $old['photo'])) {
                    unlink('img/artists/' . $old['photo']);
                }
            }
            
            $namaPhoto = $filePhoto->getRandomName();
            $filePhoto->move('img/artists', $namaPhoto);
            $dataArtist['photo'] = $namaPhoto;
        }
        
        $this->artistModel->save($dataArtist);
        return redirect()->to('/admin/artists')->with('success', 'Artist data saved successfully!');
    }

    public function deleteArtist($id)
    {
        $data = $this->artistModel->find($id);
        if ($data) {
            if (!empty($data['photo']) && file_exists('img/artists/' . $data['photo'])) {
                unlink('img/artists/' . $data['photo']);
            }
            $this->artistModel->delete($id);
        }
        return redirect()->to('/admin/artists')->with('success', 'Artist removed.');
    }

    // ==================== ALBUM MANAGEMENT ====================
    public function albums()
    {
        $data = [
            'title' => 'Album Gallery Management',
            'albums' => $this->albumModel->getAlbumsWithArtist()
        ];
        return view('admin/album_management', $data);
    }

   public function saveAlbum()
{
    $id = $this->request->getPost('id');
    $fileImage = $this->request->getFile('image_path');
    
    $dataAlbum = [
        'title'       => $this->request->getPost('title'),
        'sub_title'   => $this->request->getPost('sub_title'),
        'artist_name' => $this->request->getPost('artist_name'),
        'badge_text'  => $this->request->getPost('badge_text'),
        'album_link'  => $this->request->getPost('album_link'), // TAMBAHKAN BARIS INI
    ];
    
    if ($id) $dataAlbum['id'] = $id;
    
    if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
        if ($id) {
            $old = $this->albumModel->find($id);
            if ($old && !empty($old['image_path']) && file_exists('img/albums/' . $old['image_path'])) {
                unlink('img/albums/' . $old['image_path']);
            }
        }
        
        $namaImage = $fileImage->getRandomName();
        $fileImage->move('img/albums/', $namaImage);
        $dataAlbum['image_path'] = $namaImage;
    }
    
    $this->albumModel->save($dataAlbum);
    return redirect()->to('/admin/albums')->with('success', 'Album updated successfully!');
}

    // ==================== ABOUT MANAGEMENT ====================
    public function about()
    {
        $data = [
            'title' => 'Manage About Us',
            'profile' => $this->profileModel->find(1),
            'awards' => $this->awardModel->findAll()
        ];
        return view('admin/about_management', $data);
    }

    public function saveAbout()
    {
        $oldProfile = $this->profileModel->find(1);
        
        $data = [
            'philosophy' => $this->request->getPost('philosophy'),
            'vision' => $this->request->getPost('vision'),
            'mission_1' => $this->request->getPost('mission_1'),
            'mission_2' => $this->request->getPost('mission_2'),
            'mission_3' => $this->request->getPost('mission_3'),
            'ceo_name' => $this->request->getPost('ceo_name'),
            'ceo_bio' => $this->request->getPost('ceo_bio'),
            'address' => $this->request->getPost('address'),
            'maps_link' => $this->request->getPost('maps_link'),
        ];
        
        $buildingImg = $this->request->getFile('building_img');
        if ($buildingImg && $buildingImg->isValid() && !$buildingImg->hasMoved()) {
            if ($oldProfile && !empty($oldProfile['building_img']) && file_exists('img/company/' . $oldProfile['building_img'])) {
                unlink('img/company/' . $oldProfile['building_img']);
            }
            
            $newName = $buildingImg->getRandomName();
            $buildingImg->move('img/company/', $newName);
            $data['building_img'] = $newName;
        }
        
        $ceoImg = $this->request->getFile('ceo_img');
        if ($ceoImg && $ceoImg->isValid() && !$ceoImg->hasMoved()) {
            if ($oldProfile && !empty($oldProfile['ceo_img']) && file_exists('img/company/' . $oldProfile['ceo_img'])) {
                unlink('img/company/' . $oldProfile['ceo_img']);
            }
            
            $newName = $ceoImg->getRandomName();
            $ceoImg->move('img/company/', $newName);
            $data['ceo_img'] = $newName;
        }
        
        $this->profileModel->update(1, $data);
        return redirect()->back()->with('success', 'About page updated!');
    }

    // ==================== ARTIST PROFILE MANAGEMENT ====================
    public function manage_profiles()
    {
        $artists = $this->artistModel->findAll();
        
        foreach ($artists as &$a) {
            $a['album_count'] = $this->discographyModel->where('artist_id', $a['id'])->countAllResults();
        }
        
        $data = [
            'title' => 'Artist Profile Content',
            'artists' => $artists,
        ];
        
        return view('admin/profile_management', $data);
    }

    public function saveProfileContent()
    {
        $id = $this->request->getPost('id');
        $this->artistModel->update($id, [
            'description' => $this->request->getPost('description'),
            'ig_link' => $this->request->getPost('ig_link'),
            'tiktok_link' => $this->request->getPost('tiktok_link'),
            'x_link' => $this->request->getPost('x_link'),
            'fb_link' => $this->request->getPost('fb_link'),
        ]);
        return redirect()->back()->with('success', 'Detailed artist profile updated!');
    }

    // ==================== RUNNING TEXT MANAGEMENT ====================
    public function running_text()
    {
        $data = [
            'title' => 'Manage Running Text',
            'running_texts' => $this->runningTextModel->findAll()
        ];
        return view('admin/running_text_view', $data);
    }

    public function saveRunningText()
    {
        $id = $this->request->getPost('id');
        $content = $this->request->getPost('content');
        
        if (!$id || !$content) {
            return redirect()->back()->with('error', 'Data tidak boleh kosong!');
        }
        
        $this->runningTextModel->update($id, ['content' => $content]);
        return redirect()->back()->with('success', 'Running text updated!');
    }

    // ==================== DISCOGRAPHY MANAGEMENT ====================
    public function getDiscography($artist_id)
    {
        $data = $this->discographyModel->where('artist_id', $artist_id)->findAll();
        return $this->response->setJSON($data ?: []);
    }

    public function addDiscography()
    {
        $file = $this->request->getFile('album_cover');
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('img/discography', $newName);
            
            $this->discographyModel->save([
                'artist_id' => $this->request->getPost('artist_id'),
                'album_title' => $this->request->getPost('album_title'),
                'youtube_url' => $this->request->getPost('youtube_url'),
                'album_cover' => $newName
            ]);
            
            return redirect()->back()->with('success', 'Album added!');
        }
        
        return redirect()->back()->with('error', 'Failed to upload cover.');
    }

    public function deleteDiscography($id)
    {
        $data = $this->discographyModel->find($id);
        
        if ($data) {
            if (file_exists('img/discography/' . $data['album_cover'])) {
                unlink('img/discography/' . $data['album_cover']);
            }
            
            $this->discographyModel->delete($id);
            return redirect()->back()->with('success', 'Album berhasil dihapus.');
        }
        
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    // ==================== GALLERY MANAGEMENT ====================
    public function gallery()
    {
        $data = [
            'title' => 'Gallery Management',
            'gallery' => $this->galleryModel->findAll()
        ];
        return view('admin/gallery_management', $data);
    }

    public function saveGallery()
    {
        $id = $this->request->getPost('id');
        $file = $this->request->getFile('image');
        
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ];
        
        if ($id) $data['id'] = $id;
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($id) {
                $oldData = $this->galleryModel->find($id);
                if ($oldData && !empty($oldData['image']) && file_exists('img/gallery/' . $oldData['image'])) {
                    unlink('img/gallery/' . $oldData['image']);
                }
            }
            
            $newName = $file->getRandomName();
            $file->move('img/gallery/', $newName);
            $data['image'] = $newName;
        } elseif (!$id) {
            return redirect()->back()->with('error', 'Silakan pilih gambar terlebih dahulu.');
        }
        
        $this->galleryModel->save($data);
        return redirect()->to('/admin/gallery')->with('success', 'Gallery data saved successfully!');
    }

    public function deleteGallery($id)
    {
        $data = $this->galleryModel->find($id);
        
        if ($data) {
            if (!empty($data['image']) && file_exists('img/gallery/' . $data['image'])) {
                unlink('img/gallery/' . $data['image']);
            }
            
            $this->galleryModel->delete($id);
            return redirect()->to('/admin/gallery')->with('success', 'Photo removed.');
        }
        
        return redirect()->to('/admin/gallery')->with('error', 'Data not found.');
    }

    // ==================== AUDITION MANAGEMENT ====================
    public function auditions()
    {
        $data = [
            'title' => 'Audition Management',
            'auditions' => $this->auditionModel->orderBy('id', 'DESC')->findAll()
        ];
        return view('admin/auditions', $data);
    }

    public function saveAudition()
    {
        $id = $this->request->getPost('id');
        
        $data = [
            'category' => strtoupper($this->request->getPost('category')),
            'title' => $this->request->getPost('title'),
            'requirements' => $this->request->getPost('requirements'),
            'deadline' => $this->request->getPost('deadline'),
            'status' => $this->request->getPost('status'),
        ];
        
        if (!empty($id)) {
            $data['id'] = $id;
        }
        
        if ($this->auditionModel->save($data)) {
            return redirect()->to('/admin/auditions')->with('success', 'Data audisi berhasil disimpan!');
        } else {
            $errors = implode(', ', $this->auditionModel->errors());
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $errors);
        }
    }

    public function deleteAudition($id)
    {
        if ($this->auditionModel->delete($id)) {
            return redirect()->to('/admin/auditions')->with('success', 'Audition deleted.');
        }
        
        return redirect()->to('/admin/auditions')->with('error', 'Failed to delete data.');
    }

    // ==================== APPLICATION MANAGEMENT ====================
    public function applications()
    {
        $data = [
            'title' => 'Audition Applications',
            'applications' => $this->applicationModel->select('applications.*, auditions.title as audition_title, auditions.category')
                ->join('auditions', 'auditions.id = applications.audition_id')
                ->orderBy('applications.created_at', 'DESC')
                ->findAll()
        ];
        return view('admin/applications', $data);
    }

    public function deleteApplication($id)
    {
        $this->applicationModel->delete($id);
        return redirect()->to('/admin/applications')->with('success', 'Applicant removed.');
    }

    // ==================== INQUIRY MANAGEMENT ====================
    public function inquiries()
{
    $data = [
        'title'     => 'Contact Messages | AZP STUDIO',
        'inquiries' => $this->contactModel->orderBy('created_at', 'DESC')->findAll()
    ];
    return view('admin/inquiries', $data);
}

public function deleteInquiry($id)
{
    $data = $this->contactModel->find($id);
    if ($data) {
        $this->contactModel->delete($id);
        return redirect()->to('/admin/inquiries')->with('success', 'Pesan berhasil dihapus.');
    }
    return redirect()->to('/admin/inquiries')->with('error', 'Pesan tidak ditemukan.');
}

    // ==================== OPPORTUNITIES MANAGEMENT ====================
    public function opportunities()
    {
        $sponsorModel = new SponsorModel();
        $careerModel = new CareerModel();
        
        $data = [
            'title' => 'Manage Opportunities',
            'sponsors' => $sponsorModel->findAll(),
            'careers' => $careerModel->findAll()
        ];
        
        return view('admin/opportunities_management', $data);
    }

    // ==================== SPONSOR MANAGEMENT ====================
    public function saveSponsor()
    {
        $model = new SponsorModel();
        $id = $this->request->getPost('id');
        $file = $this->request->getFile('logo');
        
        $data = ['name' => $this->request->getPost('name')];
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('img/sponsors/', $newName);
            $data['logo'] = $newName;
            
            if ($id) {
                $old = $model->find($id);
                if ($old['logo'] && file_exists('img/sponsors/' . $old['logo'])) {
                    unlink('img/sponsors/' . $old['logo']);
                }
            }
        }
        
        $model->save(array_merge($data, ['id' => $id]));
        return redirect()->back()->with('success', 'Partner/Sponsor saved!');
    }

    public function deleteSponsor($id)
    {
        $model = new SponsorModel();
        $data = $model->find($id);
        
        if ($data['logo'] && file_exists('img/sponsors/' . $data['logo'])) {
            unlink('img/sponsors/' . $data['logo']);
        }
        
        $model->delete($id);
        return redirect()->back()->with('success', 'Sponsor removed.');
    }

    // ==================== CAREER MANAGEMENT ====================
    public function saveCareer()
    {
        $model = new CareerModel();
        $model->save([
            'id' => $this->request->getPost('id'),
            'title' => $this->request->getPost('title'),
            'category' => $this->request->getPost('category')
        ]);
        
        return redirect()->back()->with('success', 'Career info updated!');
    }

    public function deleteCareer($id)
    {
        (new CareerModel())->delete($id);
        return redirect()->back()->with('success', 'Career removed.');
    }

    public function deleteAlbum($id)
{
    // Cari data album berdasarkan ID
    $data = $this->albumModel->find($id);

    if ($data) {
        // Cek jika file gambar ada di folder, lalu hapus agar tidak memenuhi server
        if (!empty($data['image_path']) && file_exists('img/albums/' . $data['image_path'])) {
            unlink('img/albums/' . $data['image_path']);
        }

        // Hapus data dari database
        $this->albumModel->delete($id);

        return redirect()->to('/admin/albums')->with('success', 'Album berhasil dihapus.');
    }

    return redirect()->to('/admin/albums')->with('error', 'Data album tidak ditemukan.');
}

public function addAward()
{
    $awardModel = new \App\Models\AwardModel(); // Pastikan model ini sudah dibuat
    $file = $this->request->getFile('icon');

    if ($file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move('img/awards/', $newName);

        $awardModel->save([
            'name' => $this->request->getPost('name'),
            'icon' => $newName
        ]);

        return redirect()->back()->with('success', 'Penghargaan berhasil diupload!');
    }
    
    return redirect()->back()->with('error', 'Gagal mengupload gambar.');
}

public function deleteAward($id)
{
    $awardModel = new \App\Models\AwardModel();
    $award = $awardModel->find($id);

    if ($award) {
        // Hapus file fisik dari folder
        if (file_exists('img/awards/' . $award['icon'])) {
            unlink('img/awards/' . $award['icon']);
        }
        $awardModel->delete($id);
    }

    return redirect()->back()->with('success', 'Penghargaan berhasil dihapus.');
}
}