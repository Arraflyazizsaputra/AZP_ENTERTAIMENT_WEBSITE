<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/* --- 1. HALAMAN PUBLIK (FRONT-END) --- */
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('explore', 'Home::index');
$routes->get('auditions', 'Home::auditions');
$routes->get('opportunities', 'Home::opportunities');
$routes->get('contact', 'ContactController::index');

// --- GALLERY & LOAD MORE ---
// Letakkan loadMore sebelum rute lain yang mengandung kata 'gallery' jika ada
$routes->get('gallery', 'Home::gallery'); 
$routes->get('gallery/loadMore', 'Home::loadMore'); 

// --- ROSTER & DETAIL ARTIS ---
$routes->get('artists', 'ArtistController::index');
$routes->get('artists/(:segment)', 'ArtistController::index/$1');
$routes->get('artist/profile/(:num)', 'Home::artist_profile/$1'); // Halaman profil elegan
$routes->get('artist/detail/(:num)', 'Home::getArtistDetail/$1');  // Detail (modal/legacy)

// --- PROSES FORM & AJAX ---
$routes->post('contact/send', 'ContactController::send');
$routes->get('auditions/apply/(:num)', 'Home::apply/$1');
$routes->post('auditions/submit', 'Home::submitApplication');

/* --- 2. AUTENTIKASI --- */
$routes->get('login', 'AuthController::login');
$routes->post('login/process', 'AuthController::auth');
$routes->get('logout', 'AuthController::logout');

// Tambahkan rute ini untuk mengarahkan /admin langsung ke /login
$routes->addRedirect('admin', 'login'); 

$routes->get('register', 'AuthController::register');
$routes->post('register/save', 'AuthController::saveRegister');


/* --- 3. AREA ADMIN (PROTECTED) --- */
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    
    // Dashboard Utama
    $routes->get('dashboard', 'AdminController::index');
    
    // Management Artis & Profiles
    $routes->get('artists', 'AdminController::artists');
    $routes->post('artists/save', 'AdminController::saveArtist');
    $routes->get('artists/delete/(:num)', 'AdminController::deleteArtist/$1');
    $routes->get('profiles', 'AdminController::manage_profiles');
    $routes->post('profiles/save', 'AdminController::saveProfileContent'); 

    $routes->get('profiles', 'AdminController::manage_profiles'); // Menampilkan halaman yang Anda kirim
    $routes->post('profiles/save', 'AdminController::saveProfileContent');
    
    // Rute pendukung AJAX untuk Diskografi
    $routes->get('discography/get/(:num)', 'AdminController::getDiscography/$1');
    $routes->post('discography/add', 'AdminController::addDiscography');
    $routes->get('discography/delete/(:num)', 'AdminController::deleteDiscography/$1');

    // Management Album & Studio Gallery
    $routes->get('albums', 'AdminController::albums');
    $routes->post('albums/save', 'AdminController::saveAlbum');
    $routes->get('albums/delete/(:num)', 'AdminController::deleteAlbum/$1');
    
    $routes->get('gallery', 'AdminController::gallery');
    $routes->post('gallery/save', 'AdminController::saveGallery');
    $routes->get('gallery/delete/(:num)', 'AdminController::deleteGallery/$1');

    // Management Audisi & Pelamar
    $routes->get('auditions', 'AdminController::auditions');
    $routes->post('auditions/save', 'AdminController::saveAudition');
    $routes->get('auditions/delete/(:num)', 'AdminController::deleteAudition/$1');
    $routes->get('applications', 'AdminController::applications'); 
    $routes->get('applications/delete/(:num)', 'AdminController::deleteApplication/$1');

    // Management Opportunities (Sponsor & Karir)
    $routes->get('opportunities', 'AdminController::opportunities');
    $routes->post('opportunities/save-sponsor', 'AdminController::saveSponsor');
    $routes->get('opportunities/delete-sponsor/(:num)', 'AdminController::deleteSponsor/$1');
    $routes->post('opportunities/save-career', 'AdminController::saveCareer');
    $routes->get('opportunities/delete-career/(:num)', 'AdminController::deleteCareer/$1');

    // Management Pesan Masuk (Inquiries)
    $routes->get('inquiries', 'AdminController::inquiries'); 
    $routes->get('inquiries/delete/(:num)', 'AdminController::deleteInquiry/$1');

    // Settings
    $routes->get('running-text', 'AdminController::running_text');
    $routes->post('running-text/save', 'AdminController::saveRunningText');
    $routes->get('about', 'AdminController::about');
    $routes->post('about/save', 'AdminController::saveAbout');
    $routes->post('about/add-award', 'AdminController::addAward'); // Untuk menyimpan penghargaan baru
$routes->get('about/delete-award/(:num)', 'AdminController::deleteAward/$1'); // Untuk menghapus penghargaan
});