# CodeIgniter 4 Framework

1. Deskripsi & Fungsi Utama Proyek
AZP Entertainment Website adalah platform web profil perusahaan (corporate entertainment website) dan sistem manajemen agensi hiburan terpadu berbasis framework CodeIgniter 4 dengan arsitektur MVC (Model-View-Controller). Website ini dirancang sebagai etalase digital profesional yang merepresentasikan identitas AZP Entertainment, berfungsi untuk memperkenalkan profil agensi, mempublikasikan portofolio karya musik, mempromosikan talenta/artis binaan, memfasilitasi audisi bakat baru secara daring, serta membuka peluang kolaborasi bisnis dan sponsor secara transparan dan interaktif.

2. Isi & Struktur Sistem
Sistem website ini terbagi menjadi dua ekosistem utama: Antarmuka Publik (Front-End) yang berorientasi pada pengalaman visual pengunjung dengan desain elegan dan modern, serta Panel Administrasi (Back-End Admin CMS) yang dilindungi sistem autentikasi berbasis sesi (Auth Filter). Melalui struktur modular CodeIgniter 4, seluruh data dinamis—mulai dari informasi perusahaan, katalog roster artis, pemutar musik digital, album, dokumentasi galeri studio, formulir audisi, hingga pesan kontak masuk—dikelola secara terpusat melalui relasi basis data MySQL yang terorganisir rapi dan aman.

3. Fitur Lengkap Sisi Publik (Front-End)
Beranda Dinamis & Interaktif (Home & Explore): Menyajikan hero section berkelas, teks pengumuman berjalan (running text ticker) yang dapat diatur dinamis dari admin, cuplikan rilisan musik terbaru, sorotan artis unggulan, serta pemutar audio (embedded audio player) untuk mendengarkan lagu karya artis AZP Entertainment secara langsung di browser.
Katalog & Profil Detail Artis (Artist Roster & Discography): Halaman khusus yang menampilkan daftar artis dengan fitur filter kategori. Setiap artis memiliki halaman profil eksklusif yang memuat biografi mendalam, daftar diskografi lagu, pemutar musik terintegrasi, galeri foto pertunjukan, dan capaian penghargaan (awards).
Galeri Studio & Media (Studio Gallery): Dokumentasi visual kegiatan studio, pemotretan, dan aktivitas di balik layar dengan dukungan teknologi pemuatan foto bertahap (AJAX load-more) guna menjaga kecepatan loading halaman secara optimal.
Pusat Audisi & Rekrutmen Bakat Baru (Audition Portal): Menampilkan informasi audisi terbuka lengkap dengan persyaratan dan formulir pendaftaran daring terintegrasi (online application form), memungkinkan calon artis mengunggah portofolio data diri secara mudah.
Peluang Kolaborasi & Karir (Opportunities & Sponsorship): Wadah informasi resmi terkait program kemitraan/sponsor bagi brand pihak ketiga serta lowongan karir profesional di lingkungan AZP Entertainment.
Tentang Kami & Kontak (About & Inquiries): Profil menyeluruh perusahaan, visi-misi, sejarah singkat, jejak penghargaan institusional, serta form kontak interaktif bagi pengunjung atau mitra bisnis untuk mengirimkan pesan resmi.

5. Fitur Lengkap Sisi Manajemen (Back-End Admin CMS)
Sistem Autentikasi & Keamanan: Fitur login dan register terproteksi menggunakan middleware AuthFilter untuk memastikan hanya administrator resmi yang dapat mengakses panel dashboard.
Dashboard Terpusat (Executive Summary): Halaman utama admin yang menampilkan ringkasan statistik operasional website secara seketika.
Manajemen Artis & Konten Profil (Artist & Profile Management): Operasi CRUD penuh untuk menambah, memperbarui, atau menghapus data artis, mendefinisikan detail biografi, serta mengelola lagu-lagu dalam diskografi artis via AJAX.
Manajemen Rilis Album & Berkas Musik (Album & Media Management): Pengelolaan peluncuran album, unggahan berkas sampul (cover art), dan berkas audio MP3 secara terstruktur pada direktori publik.
Manajemen Galeri Studio (Studio Gallery Management): Kontrol penuh atas dokumentasi foto dan sorotan visual studio yang tampil pada halaman galeri publik.
Manajemen Audisi & Seleksi Pelamar (Audition & Applicant Processing): Pengaturan jadwal pembukaan audisi serta peninjauan berkas pelamar masuk (applications viewer) dengan opsi eliminasi/penghapusan data.
Manajemen Kemitraan & Karir (Sponsor & Career Opportunities): Pengelolaan entitas sponsor aktif serta pembukaan lowongan pekerjaan di agensi.
Kotak Masuk Pesan (Inquiries Inbox): Pusat penampungan pesan masuk dari formulir kontak publik untuk mempermudah tindak lanjut komunikasi bisnis.
Pengaturan Teks Pengumuman & Profil Perusahaan (Global Settings): Kontrol fleksibel atas teks berjalan (running text), konten halaman About, dan daftar pencapaian penghargaan agensi.

7. Ringkasan Teknologi (Tech Stack)

Platform ini dibangun menggunakan:

Framework Backend: PHP 8+ dengan CodeIgniter 4 (arsitektur MVC).
Basis Data: MySQL / MariaDB via Query Builder & CI4 Models.
Antarmuka (Front-End): HTML5, CSS3, JavaScript (AJAX/Fetch API), Bootstrap untuk tata letak responsif, dan Audio API untuk streaming musik.
Server Environment: Apache (XAMPP) dengan konfigurasi perutean URL bersih (clean routes via .htaccess).
