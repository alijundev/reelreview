
# SOFTWARE REQUIREMENTS SPECIFICATION

# APLIKASI WEB REELREVIEW BERBASIS LARAVEL DENGAN DOCKER COMPOSE

## 1. Pendahuluan

### 1.1 Tujuan Dokumen

Dokumen Software Requirements Specification ini dibuat untuk menjelaskan kebutuhan sistem dari aplikasi web ReelReview. Dokumen ini menjadi acuan dalam proses analisis, perancangan, implementasi, pengujian, dan pengembangan aplikasi.

ReelReview adalah aplikasi web berbasis Laravel yang digunakan sebagai platform informasi, rekomendasi, review, rating, dan watchlist film. Selain sebagai aplikasi web, project ini juga digunakan sebagai implementasi Docker Compose pada mata kuliah Sistem Operasi.

Dengan adanya dokumen ini, proses pengembangan aplikasi diharapkan lebih terarah, kebutuhan sistem lebih jelas, dan implementasi Docker dapat disesuaikan dengan rancangan yang sudah dibuat.

### 1.2 Ruang Lingkup Sistem

ReelReview merupakan aplikasi web yang menyediakan informasi film kepada pengguna. Pengguna dapat melihat daftar film, mencari film berdasarkan judul atau genre, melihat detail film, memberikan rating, menulis review, menandai review sebagai spoiler, serta menyimpan film ke dalam watchlist.

Aplikasi ini memiliki dua jenis pengguna, yaitu Admin dan User. Admin bertugas mengelola data film dan genre, sedangkan User dapat menggunakan fitur utama seperti melihat film, memberi review, memberi rating, dan menyimpan watchlist.

Dari sisi teknologi, aplikasi dikembangkan menggunakan Laravel sebagai framework utama, MySQL sebagai database, dan Docker Compose sebagai alat untuk menjalankan service aplikasi dan database dalam container yang terpisah.

### 1.3 Tujuan Pengembangan Sistem

Tujuan dari pengembangan aplikasi ReelReview adalah:

1. Membangun aplikasi web review dan rekomendasi film berbasis Laravel.
2. Menyediakan fitur pengelolaan data film dan genre oleh Admin.
3. Menyediakan fitur review, rating, dan watchlist bagi User.
4. Menggunakan MySQL sebagai database utama aplikasi.
5. Mengimplementasikan Docker Compose untuk menjalankan Laravel dan MySQL dalam container.
6. Membuat lingkungan pengembangan yang konsisten agar aplikasi dapat dijalankan di perangkat lain tanpa konfigurasi manual yang rumit.

### 1.4 Definisi Istilah

| Istilah        | Penjelasan                                                                     |
| -------------- | ------------------------------------------------------------------------------ |
| ReelReview     | Nama aplikasi web rekomendasi dan review film                                  |
| Laravel        | Framework PHP yang digunakan untuk membangun aplikasi                          |
| MySQL          | Database relasional yang digunakan untuk menyimpan data                        |
| Docker         | Platform container untuk menjalankan aplikasi secara terisolasi                |
| Docker Compose | Tool untuk menjalankan beberapa container menggunakan satu file konfigurasi    |
| Container      | Lingkungan terisolasi untuk menjalankan service aplikasi                       |
| Image          | Template yang digunakan untuk membuat container                                |
| Admin          | Pengguna yang memiliki akses untuk mengelola data aplikasi                     |
| User           | Pengguna umum yang dapat menggunakan fitur film, review, rating, dan watchlist |
| Genre          | Kategori film, seperti Action, Comedy, Horror, Drama, dan lainnya              |
| Review         | Ulasan teks dari pengguna terhadap film                                        |
| Rating         | Nilai yang diberikan pengguna terhadap film                                    |
| Watchlist      | Daftar film yang disimpan pengguna untuk ditonton nanti                        |
| Spoiler        | Penanda bahwa review mengandung bocoran cerita                                 |

---

## 2. Deskripsi Umum Sistem

### 2.1 Perspektif Produk

ReelReview adalah aplikasi web berbasis client-server. Pengguna mengakses aplikasi melalui web browser. Request dari browser diproses oleh aplikasi Laravel yang berjalan di dalam container Docker. Laravel kemudian berkomunikasi dengan database MySQL untuk mengambil atau menyimpan data.

Aplikasi ini tidak hanya berfokus pada fitur film, tetapi juga pada penerapan Docker Compose. Docker Compose digunakan agar service Laravel dan MySQL dapat berjalan secara bersamaan, terhubung melalui Docker network, dan memiliki penyimpanan database yang tetap menggunakan Docker volume.

### 2.2 Fungsi Utama Sistem

Secara umum, ReelReview memiliki fungsi utama sebagai berikut:

1. Menampilkan daftar film.
2. Menampilkan detail film.
3. Menampilkan genre film.
4. Melakukan pencarian film berdasarkan judul.
5. Melakukan filter film berdasarkan genre.
6. Menampilkan rekomendasi film.
7. Menyediakan fitur registrasi dan login pengguna.
8. Membedakan hak akses Admin dan User.
9. Menyediakan fitur CRUD data film oleh Admin.
10. Menyediakan fitur CRUD data genre oleh Admin.
11. Menyediakan fitur review film oleh User.
12. Menyediakan fitur rating film dengan skala 1 sampai 10.
13. Menyediakan fitur penanda spoiler pada review.
14. Menyediakan fitur watchlist.
15. Menjalankan aplikasi menggunakan Docker Compose.

### 2.3 Karakteristik Pengguna

#### 2.3.1 Guest

Guest adalah pengguna yang belum login ke aplikasi.

Guest dapat:

1. Melihat halaman utama.
2. Melihat daftar film.
3. Melihat detail film.
4. Melakukan pencarian film.
5. Melihat review film.
6. Melakukan registrasi.
7. Melakukan login.

#### 2.3.2 User

User adalah pengguna yang sudah memiliki akun dan berhasil login.

User dapat:

1. Melihat daftar film.
2. Melihat detail film.
3. Mencari film.
4. Memfilter film berdasarkan genre.
5. Memberikan rating pada film.
6. Menulis review.
7. Menandai review sebagai spoiler.
8. Menambahkan film ke watchlist.
9. Melihat daftar watchlist.
10. Menghapus film dari watchlist.
11. Logout dari aplikasi.

#### 2.3.3 Admin

Admin adalah pengguna yang memiliki hak akses pengelolaan data.

Admin dapat:

1. Login ke dashboard Admin.
2. Mengelola data genre.
3. Mengelola data film.
4. Melihat data review pengguna.
5. Menghapus review jika diperlukan.
6. Logout dari aplikasi.

### 2.4 Lingkungan Operasi

Aplikasi ReelReview dirancang untuk berjalan pada lingkungan berikut:

| Komponen                | Kebutuhan                                                           |
| ----------------------- | ------------------------------------------------------------------- |
| Sistem Operasi          | Windows, Linux, atau macOS                                          |
| Browser                 | Google Chrome, Firefox, Microsoft Edge, atau browser modern lainnya |
| Backend                 | Laravel                                                             |
| Bahasa Pemrograman      | PHP                                                                 |
| Database                | MySQL                                                               |
| Container Platform      | Docker                                                              |
| Container Orchestration | Docker Compose                                                      |
| Dependency Manager      | Composer                                                            |
| Frontend Build Tool     | Vite                                                                |
| Database Management     | phpMyAdmin, opsional                                                |

### 2.5 Batasan Sistem

Batasan sistem pada aplikasi ReelReview adalah:

1. Aplikasi hanya berbasis web.
2. Aplikasi tidak menyediakan layanan streaming film.
3. Aplikasi tidak menyediakan fitur download film.
4. Data film dikelola oleh Admin.
5. Rating dan review disimpan dalam satu tabel, yaitu tabel `reviews`.
6. Rekomendasi film pada tahap awal bersifat sederhana, misalnya berdasarkan genre atau rating.
7. Aplikasi menggunakan MySQL sebagai database utama.
8. Docker Compose digunakan sebagai environment development utama.
9. Aplikasi tidak bergantung pada Laragon atau konfigurasi lokal manual.
10. Fitur pembayaran, langganan, dan komentar bertingkat tidak termasuk dalam scope awal.

### 2.6 Asumsi dan Ketergantungan

Asumsi dalam pengembangan aplikasi:

1. Pengembang sudah menginstall Git dan Docker.
2. Aplikasi dijalankan menggunakan Docker Compose.
3. Laravel berjalan di container aplikasi.
4. MySQL berjalan di container database.
5. Database menggunakan nama `db_reelreview`.
6. User harus login untuk membuat review, memberi rating, dan menambahkan watchlist.
7. Admin dibedakan dari User menggunakan field `role`.
8. Data database disimpan menggunakan Docker volume agar tidak hilang ketika container dimatikan.
9. Tabel `migrations` dibuat otomatis oleh Laravel.

---

## 3. Kebutuhan Fungsional

## 3.1 Modul Autentikasi

### FR-001 Registrasi User

Sistem harus menyediakan fitur registrasi agar pengguna baru dapat membuat akun.

Input:

1. Nama.
2. Email.
3. Password.
4. Konfirmasi password.

Proses:

1. Sistem memvalidasi input.
2. Sistem memastikan email belum digunakan.
3. Sistem menyimpan password dalam bentuk hash.
4. Sistem memberikan role default sebagai `user`.

Output:

1. Akun berhasil dibuat.
2. User dapat login ke aplikasi.

Prioritas: Tinggi

### FR-002 Login

Sistem harus menyediakan fitur login untuk User dan Admin.

Input:

1. Email.
2. Password.

Proses:

1. Sistem memvalidasi email dan password.
2. Sistem memeriksa data akun di database.
3. Sistem mengarahkan pengguna sesuai role.

Output:

1. User diarahkan ke halaman utama.
2. Admin diarahkan ke dashboard Admin.

Prioritas: Tinggi

### FR-003 Logout

Sistem harus menyediakan fitur logout.

Proses:

1. Sistem menghapus session pengguna.
2. Sistem mengarahkan pengguna ke halaman login atau halaman utama.

Prioritas: Sedang

### FR-004 Hak Akses Role

Sistem harus membedakan akses berdasarkan role.

Aturan:

1. Admin dapat mengakses dashboard Admin.
2. User tidak dapat mengakses dashboard Admin.
3. Admin dapat mengelola film dan genre.
4. User hanya dapat menggunakan fitur umum seperti review, rating, dan watchlist.

Prioritas: Tinggi

---

## 3.2 Modul Genre

### FR-005 Menampilkan Daftar Genre

Sistem harus dapat menampilkan daftar genre film.

Data yang ditampilkan:

1. Nama genre.
2. Jumlah film dalam genre, jika dibutuhkan.

Prioritas: Sedang

### FR-006 Menambah Genre

Sistem harus memungkinkan Admin menambahkan genre baru.

Input:

1. Nama genre.

Output:

1. Genre berhasil disimpan ke database.

Prioritas: Tinggi

### FR-007 Mengedit Genre

Sistem harus memungkinkan Admin mengubah data genre.

Input:

1. Nama genre baru.

Output:

1. Genre berhasil diperbarui.

Prioritas: Sedang

### FR-008 Menghapus Genre

Sistem harus memungkinkan Admin menghapus genre.

Aturan:

1. Jika genre masih digunakan oleh film, sistem dapat mencegah penghapusan atau menghapus data terkait sesuai aturan relasi.
2. Penghapusan tidak boleh menyebabkan error pada data film.

Prioritas: Sedang

---

## 3.3 Modul Film

### FR-009 Menampilkan Daftar Film

Sistem harus dapat menampilkan daftar film kepada Guest, User, dan Admin.

Data yang ditampilkan:

1. Judul film.
2. Sinopsis singkat.
3. Sutradara.
4. Tahun rilis.
5. Durasi.
6. Genre.
7. Rating rata-rata, jika sudah ada review.

Prioritas: Tinggi

### FR-010 Menampilkan Detail Film

Sistem harus dapat menampilkan detail film.

Data yang ditampilkan:

1. Judul film.
2. Sinopsis.
3. Sutradara.
4. Tahun rilis.
5. Durasi.
6. Genre.
7. Review pengguna.
8. Rating pengguna.
9. Penanda spoiler pada review.
10. Tombol tambah ke watchlist bagi User.

Prioritas: Tinggi

### FR-011 Mencari Film Berdasarkan Judul

Sistem harus menyediakan fitur pencarian film berdasarkan judul.

Input:

1. Kata kunci judul film.

Output:

1. Daftar film yang sesuai dengan kata kunci.

Prioritas: Tinggi

### FR-012 Filter Film Berdasarkan Genre

Sistem harus menyediakan fitur filter film berdasarkan genre.

Input:

1. Genre yang dipilih.

Output:

1. Daftar film berdasarkan genre tersebut.

Prioritas: Sedang

### FR-013 Rekomendasi Film

Sistem harus menyediakan fitur rekomendasi film.

Aturan awal:

1. Rekomendasi dapat berdasarkan genre.
2. Rekomendasi dapat berdasarkan rating tertinggi.
3. Rekomendasi tidak wajib menggunakan machine learning.

Prioritas: Sedang

### FR-014 Menambah Data Film

Sistem harus memungkinkan Admin menambahkan data film.

Input:

1. Judul film.
2. Sinopsis.
3. Sutradara.
4. Tahun rilis.
5. Durasi.
6. Genre.

Output:

1. Film berhasil disimpan.

Prioritas: Tinggi

### FR-015 Mengedit Data Film

Sistem harus memungkinkan Admin mengubah data film.

Output:

1. Data film berhasil diperbarui.

Prioritas: Tinggi

### FR-016 Menghapus Data Film

Sistem harus memungkinkan Admin menghapus data film.

Aturan:

1. Film yang dihapus tidak tampil lagi di daftar film.
2. Data review dan watchlist terkait dapat ikut terhapus sesuai aturan relasi database.

Prioritas: Sedang

---

## 3.4 Modul Review dan Rating

### FR-017 Menulis Review

Sistem harus memungkinkan User menulis review pada film.

Input:

1. ID film.
2. ID user.
3. Isi review.
4. Rating.
5. Status spoiler.

Proses:

1. Sistem memastikan User sudah login.
2. Sistem memvalidasi rating.
3. Sistem menyimpan review ke database.
4. Sistem menyimpan rating dalam tabel `reviews`.

Output:

1. Review berhasil ditambahkan.
2. Review tampil pada halaman detail film.

Prioritas: Tinggi

### FR-018 Memberikan Rating

Sistem harus memungkinkan User memberikan rating terhadap film.

Aturan:

1. Rating menggunakan skala 1 sampai 10.
2. Rating disimpan bersama review pada tabel `reviews`.
3. Satu User hanya dapat memberikan satu review dan rating untuk satu film.
4. Jika User ingin mengubah rating, maka data review diperbarui.

Prioritas: Tinggi

### FR-019 Menampilkan Review

Sistem harus menampilkan daftar review pada halaman detail film.

Data yang ditampilkan:

1. Nama User.
2. Rating.
3. Isi review.
4. Status spoiler.
5. Tanggal review.

Prioritas: Tinggi

### FR-020 Menandai Review Sebagai Spoiler

Sistem harus menyediakan opsi penanda spoiler pada review.

Aturan:

1. Jika `is_spoiler` bernilai true, sistem dapat menampilkan peringatan spoiler.
2. User lain dapat mengetahui bahwa review mengandung bocoran cerita.

Prioritas: Sedang

### FR-021 Mengedit Review Sendiri

Sistem harus memungkinkan User mengedit review miliknya sendiri.

Aturan:

1. User hanya dapat mengedit review miliknya.
2. User tidak dapat mengedit review milik orang lain.

Prioritas: Sedang

### FR-022 Menghapus Review Sendiri

Sistem harus memungkinkan User menghapus review miliknya sendiri.

Aturan:

1. User hanya dapat menghapus review miliknya.
2. Admin dapat menghapus review jika diperlukan.

Prioritas: Sedang

### FR-023 Admin Memantau Review

Sistem harus menyediakan fitur bagi Admin untuk melihat review pengguna.

Data yang ditampilkan:

1. Nama User.
2. Judul film.
3. Rating.
4. Isi review.
5. Status spoiler.
6. Tanggal review.

Prioritas: Sedang

---

## 3.5 Modul Watchlist

### FR-024 Menambahkan Film ke Watchlist

Sistem harus memungkinkan User menambahkan film ke watchlist.

Input:

1. ID user.
2. ID movie.

Aturan:

1. User harus login.
2. Film yang sama tidak boleh ditambahkan dua kali ke watchlist User yang sama.

Output:

1. Film berhasil masuk ke watchlist.

Prioritas: Sedang

### FR-025 Melihat Watchlist

Sistem harus menyediakan halaman watchlist.

Data yang ditampilkan:

1. Judul film.
2. Genre.
3. Tahun rilis.
4. Durasi.
5. Tombol hapus dari watchlist.

Prioritas: Sedang

### FR-026 Menghapus Film dari Watchlist

Sistem harus memungkinkan User menghapus film dari watchlist.

Output:

1. Film berhasil dihapus dari watchlist.

Prioritas: Sedang

---

## 3.6 Modul Docker

### FR-027 Menjalankan Aplikasi dengan Docker Compose

Sistem harus dapat dijalankan menggunakan Docker Compose.

Service minimal:

1. `app` untuk Laravel.
2. `db` untuk MySQL.
3. `phpmyadmin` opsional untuk database management.

Prioritas: Tinggi

### FR-028 Build Image Laravel

Sistem harus memiliki Dockerfile untuk membangun image aplikasi Laravel.

Dockerfile harus menyediakan:

1. PHP.
2. Composer.
3. Ekstensi PHP yang dibutuhkan Laravel.
4. Working directory aplikasi.
5. Dependency Laravel.
6. Perintah menjalankan aplikasi.

Prioritas: Tinggi

### FR-029 Koneksi Laravel ke MySQL Container

Sistem harus menghubungkan Laravel ke MySQL container.

Konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db_reelreview
DB_USERNAME=reelreview_user
DB_PASSWORD=reelreview_pass
```

Prioritas: Tinggi

### FR-030 Persistent Database dengan Docker Volume

Sistem harus menggunakan Docker volume untuk menyimpan data MySQL.

Tujuan:

1. Data tidak hilang ketika container dimatikan.
2. Data tetap tersedia ketika container dibuat ulang.
3. Pengembangan lebih aman untuk tim.

Prioritas: Tinggi

---

## 4. Kebutuhan Non-Fungsional

### 4.1 Kinerja

1. Sistem harus dapat menampilkan daftar film dengan waktu respon yang wajar.
2. Sistem harus dapat menjalankan pencarian film tanpa delay berlebihan.
3. Sistem harus mampu menangani beberapa pengguna secara bersamaan dalam skala kecil.
4. Query database harus dibuat efisien menggunakan Eloquent ORM atau Query Builder.

### 4.2 Keamanan

1. Password harus disimpan dalam bentuk hash.
2. Sistem harus menggunakan validasi input.
3. Sistem harus membatasi akses Admin dan User.
4. Sistem harus menggunakan CSRF protection pada form.
5. Sistem harus mencegah SQL Injection.
6. User hanya boleh mengedit dan menghapus review miliknya sendiri.
7. Admin memiliki akses terbatas pada pengelolaan data aplikasi.
8. File konfigurasi `.env` tidak boleh diunggah ke GitHub.

### 4.3 Reliability

1. Aplikasi harus tetap berjalan selama container aktif.
2. Database harus tetap tersimpan menggunakan Docker volume.
3. Sistem harus dapat dijalankan ulang tanpa kehilangan data.
4. Migration harus dapat membentuk struktur database secara konsisten.
5. Jika database belum siap, aplikasi harus dapat dijalankan kembali setelah database aktif.

### 4.4 Usability

1. Tampilan aplikasi harus mudah dipahami.
2. Menu utama harus jelas.
3. Form input harus memiliki label.
4. Pesan berhasil dan error harus mudah dibaca.
5. Admin harus mudah mengelola film dan genre.
6. User harus mudah mencari film, menulis review, dan menyimpan watchlist.

### 4.5 Maintainability

1. Struktur project harus mengikuti pola Laravel MVC.
2. Controller, Model, Migration, dan View harus dipisahkan dengan jelas.
3. Nama tabel dan field menggunakan snake_case.
4. Konfigurasi Docker diletakkan pada `Dockerfile` dan `docker-compose.yml`.
5. Konfigurasi environment diletakkan pada `.env`.
6. Dokumentasi setup ditulis pada `README.md`.

### 4.6 Portability

1. Project harus dapat dijalankan di laptop anggota kelompok yang berbeda.
2. Anggota kelompok tidak perlu menginstall PHP, MySQL, atau Laragon secara manual.
3. Anggota kelompok cukup menginstall Git dan Docker.
4. Project dapat dijalankan dengan Docker Compose setelah clone dari GitHub.

---

## 5. Kebutuhan Data

### 5.1 Database

Nama database:

```text
db_reelreview
```

Tabel utama:

```text
users
genres
movies
reviews
watchlists
migrations
```

Catatan:

Tabel `migrations` adalah tabel bawaan Laravel yang digunakan untuk mencatat riwayat migration. Tabel ini tidak perlu dibuat manual oleh developer.

---

## 5.2 Tabel Users

Tabel `users` digunakan untuk menyimpan data akun pengguna.

| Field      | Tipe Data                   | Keterangan                       |
| ---------- | --------------------------- | -------------------------------- |
| id         | bigint / int auto increment | Primary key                      |
| name       | varchar(255)                | Nama pengguna                    |
| email      | varchar(255), unique        | Email pengguna                   |
| password   | varchar(255)                | Password yang sudah di-hash      |
| role       | enum/string                 | Hak akses, yaitu admin atau user |
| created_at | timestamp                   | Waktu data dibuat                |
| updated_at | timestamp                   | Waktu data diperbarui            |

Aturan:

1. Email harus unik.
2. Password harus di-hash.
3. Role default adalah `user`.
4. Admin menggunakan role `admin`.

---

## 5.3 Tabel Genres

Tabel `genres` digunakan untuk menyimpan kategori film.

| Field      | Tipe Data                   | Keterangan            |
| ---------- | --------------------------- | --------------------- |
| id         | bigint / int auto increment | Primary key           |
| name       | varchar(100)                | Nama genre            |
| created_at | timestamp                   | Waktu data dibuat     |
| updated_at | timestamp                   | Waktu data diperbarui |

Contoh genre:

```text
Action
Comedy
Drama
Horror
Romance
Science Fiction
Animation
Documentary
```

---

## 5.4 Tabel Movies

Tabel `movies` digunakan untuk menyimpan data film.

| Field        | Tipe Data                   | Keterangan              |
| ------------ | --------------------------- | ----------------------- |
| id           | bigint / int auto increment | Primary key             |
| title        | varchar(255)                | Judul film              |
| synopsis     | text                        | Sinopsis film           |
| director     | varchar(255)                | Sutradara film          |
| release_year | year                        | Tahun rilis             |
| duration     | int                         | Durasi film dalam menit |
| genre_id     | foreign key                 | Relasi ke tabel genres  |
| created_at   | timestamp                   | Waktu data dibuat       |
| updated_at   | timestamp                   | Waktu data diperbarui   |

Aturan:

1. Setiap film memiliki satu genre.
2. Data film dikelola oleh Admin.
3. Film dapat memiliki banyak review.
4. Film dapat masuk ke banyak watchlist User.

---

## 5.5 Tabel Reviews

Tabel `reviews` digunakan untuk menyimpan review dan rating pengguna.

| Field       | Tipe Data                   | Keterangan                   |
| ----------- | --------------------------- | ---------------------------- |
| id          | bigint / int auto increment | Primary key                  |
| user_id     | foreign key                 | Relasi ke tabel users        |
| movie_id    | foreign key                 | Relasi ke tabel movies       |
| rating      | tinyint                     | Rating film dari 1 sampai 10 |
| review_text | text                        | Isi review                   |
| is_spoiler  | boolean                     | Penanda spoiler              |
| created_at  | timestamp                   | Waktu review dibuat          |
| updated_at  | timestamp                   | Waktu review diperbarui      |

Aturan:

1. Rating bernilai 1 sampai 10.
2. Review harus dimiliki oleh satu User.
3. Review harus terkait dengan satu Movie.
4. Satu User sebaiknya hanya memiliki satu review untuk satu Movie.
5. Jika `is_spoiler` bernilai true, review ditandai mengandung spoiler.

---

## 5.6 Tabel Watchlists

Tabel `watchlists` digunakan untuk menyimpan daftar film yang ingin ditonton User.

| Field      | Tipe Data                   | Keterangan             |
| ---------- | --------------------------- | ---------------------- |
| id         | bigint / int auto increment | Primary key            |
| user_id    | foreign key                 | Relasi ke tabel users  |
| movie_id   | foreign key                 | Relasi ke tabel movies |
| created_at | timestamp                   | Waktu data dibuat      |
| updated_at | timestamp                   | Waktu data diperbarui  |

Aturan:

1. Watchlist dimiliki oleh User.
2. Watchlist berisi data Movie.
3. Satu Movie tidak boleh ditambahkan dua kali ke watchlist User yang sama.

---

## 6. Rancangan Arsitektur Sistem

### 6.1 Arsitektur Umum

Arsitektur sistem ReelReview terdiri dari tiga komponen utama:

1. User atau Admin.
2. Aplikasi Laravel.
3. Database MySQL.

Alur sistem:

```text
User/Admin
   |
   | HTTP Request
   v
Laravel Application Container
   |
   | Query Database
   v
MySQL Database Container
   |
   | Persistent Storage
   v
Docker Volume
```

### 6.2 Arsitektur Docker

Aplikasi dijalankan menggunakan Docker Compose dengan beberapa service:

| Service    | Fungsi                                       |
| ---------- | -------------------------------------------- |
| app        | Menjalankan aplikasi Laravel                 |
| db         | Menjalankan database MySQL                   |
| phpmyadmin | Mengelola database melalui browser, opsional |

Komponen Docker:

1. Dockerfile untuk membuat image Laravel.
2. docker-compose.yml untuk menjalankan service aplikasi.
3. Docker network untuk menghubungkan Laravel dan MySQL.
4. Docker volume untuk menyimpan data MySQL.
5. `.env` untuk konfigurasi database dan aplikasi.

### 6.3 Alur Docker Compose

Alur menjalankan aplikasi:

```text
Developer menjalankan docker compose up
        |
        v
Docker membaca docker-compose.yml
        |
        v
Docker membangun image Laravel
        |
        v
Docker menjalankan container app dan db
        |
        v
Laravel terhubung ke MySQL melalui service db
        |
        v
Aplikasi dapat diakses melalui browser
```

---

## 7. Use Case Sistem

### 7.1 Use Case Guest

Guest dapat:

1. Melihat halaman utama.
2. Melihat daftar film.
3. Melihat detail film.
4. Melihat review.
5. Mencari film.
6. Melihat genre.
7. Registrasi.
8. Login.

### 7.2 Use Case User

User dapat:

1. Login.
2. Logout.
3. Melihat daftar film.
4. Melihat detail film.
5. Mencari film.
6. Filter film berdasarkan genre.
7. Menulis review.
8. Memberikan rating.
9. Menandai review sebagai spoiler.
10. Mengedit review sendiri.
11. Menghapus review sendiri.
12. Menambahkan film ke watchlist.
13. Melihat watchlist.
14. Menghapus film dari watchlist.

### 7.3 Use Case Admin

Admin dapat:

1. Login.
2. Logout.
3. Mengakses dashboard Admin.
4. Menambahkan genre.
5. Mengedit genre.
6. Menghapus genre.
7. Menambahkan film.
8. Mengedit film.
9. Menghapus film.
10. Melihat review pengguna.
11. Menghapus review jika diperlukan.

### 7.4 Use Case Docker Environment

Docker Environment digunakan untuk:

1. Build image Laravel.
2. Menjalankan container Laravel.
3. Menjalankan container MySQL.
4. Membuat network antar container.
5. Menyimpan data database dengan volume.
6. Menjalankan ulang aplikasi di perangkat lain.

---

## 8. Kebutuhan Antarmuka

### 8.1 Halaman Utama

Halaman utama digunakan untuk menampilkan daftar film dan rekomendasi film.

Komponen:

1. Navbar.
2. Search bar.
3. Daftar film.
4. Filter genre.
5. Daftar rekomendasi.
6. Link login/register.

### 8.2 Halaman Login

Komponen:

1. Input email.
2. Input password.
3. Tombol login.
4. Link registrasi.

### 8.3 Halaman Registrasi

Komponen:

1. Input nama.
2. Input email.
3. Input password.
4. Input konfirmasi password.
5. Tombol registrasi.

### 8.4 Halaman Detail Film

Komponen:

1. Judul film.
2. Sinopsis.
3. Sutradara.
4. Tahun rilis.
5. Durasi.
6. Genre.
7. Rating rata-rata.
8. Review pengguna.
9. Form review.
10. Input rating 1 sampai 10.
11. Checkbox spoiler.
12. Tombol tambah ke watchlist.

### 8.5 Halaman Watchlist

Komponen:

1. Daftar film yang disimpan.
2. Judul film.
3. Genre.
4. Tahun rilis.
5. Tombol hapus dari watchlist.

### 8.6 Dashboard Admin

Komponen:

1. Menu dashboard.
2. Menu kelola genre.
3. Menu kelola film.
4. Menu review pengguna.
5. Statistik sederhana, seperti jumlah film, genre, dan review.

### 8.7 Halaman Kelola Genre

Komponen:

1. Tabel genre.
2. Form tambah genre.
3. Tombol edit.
4. Tombol hapus.

### 8.8 Halaman Kelola Film

Komponen:

1. Tabel film.
2. Form tambah film.
3. Form edit film.
4. Tombol hapus film.
5. Pilihan genre.

---

## 9. Aturan Bisnis

Aturan bisnis pada aplikasi ReelReview:

1. User harus login untuk membuat review.
2. User harus login untuk memberi rating.
3. User harus login untuk menambahkan film ke watchlist.
4. Guest hanya dapat melihat daftar film, detail film, dan review.
5. Admin dapat mengelola data film dan genre.
6. User tidak dapat mengakses dashboard Admin.
7. Rating menggunakan skala 1 sampai 10.
8. Rating dan review disimpan dalam tabel yang sama.
9. Review dapat ditandai sebagai spoiler.
10. Satu film harus memiliki satu genre.
11. Satu User tidak boleh menambahkan film yang sama dua kali ke watchlist.
12. Password pengguna harus disimpan dalam bentuk hash.
13. Data database harus disimpan dalam Docker volume.
14. `.env` tidak boleh diunggah ke repository GitHub.

---

## 10. Prioritas Pengembangan

### 10.1 Prioritas Utama

Fitur yang wajib dibuat terlebih dahulu:

1. Setup Laravel.
2. Setup Dockerfile.
3. Setup docker-compose.yml.
4. Setup koneksi MySQL.
5. Migration database.
6. Autentikasi login dan register.
7. Role Admin dan User.
8. CRUD genre.
9. CRUD movie.
10. Halaman daftar movie.
11. Halaman detail movie.
12. Review dan rating.

### 10.2 Prioritas Menengah

Fitur setelah fitur utama selesai:

1. Watchlist.
2. Filter genre.
3. Rekomendasi sederhana.
4. Penanda spoiler.
5. Dashboard ringkasan Admin.

### 10.3 Prioritas Tambahan

Fitur tambahan jika waktu masih tersedia:

1. Upload poster film.
2. Pagination film.
3. Sorting film berdasarkan rating atau tahun.
4. Tampilan UI lebih modern.
5. Seeder data film.
6. Export/import database untuk demo.

---

## 11. Kriteria Penerimaan Sistem

Sistem dianggap berhasil jika:

1. Aplikasi dapat dijalankan menggunakan Docker Compose.
2. Container Laravel dan MySQL berjalan dengan baik.
3. Laravel dapat terhubung ke MySQL dengan `DB_HOST=db`.
4. Database `db_reelreview` berhasil dibuat.
5. Migration berhasil membuat tabel `users`, `genres`, `movies`, `reviews`, dan `watchlists`.
6. User dapat registrasi dan login.
7. Admin dapat login dan mengakses dashboard Admin.
8. Admin dapat mengelola genre.
9. Admin dapat mengelola film.
10. User dapat melihat daftar film.
11. User dapat melihat detail film.
12. User dapat menulis review.
13. User dapat memberi rating 1 sampai 10.
14. User dapat menandai review sebagai spoiler.
15. User dapat menambahkan film ke watchlist.
16. Data database tidak hilang ketika container dimatikan.
17. Project dapat di-clone dan dijalankan di laptop anggota kelompok lain dengan Docker.

---

## 12. Risiko Pengembangan

| Risiko                               | Dampak                          | Solusi                                                                                          |
| ------------------------------------ | ------------------------------- | ----------------------------------------------------------------------------------------------- |
| Laravel tidak bisa konek ke database | Aplikasi error                  | Pastikan `DB_HOST=db`                                                                           |
| Port bentrok                         | Aplikasi tidak bisa dibuka      | Ubah port di docker-compose.yml                                                                 |
| Database hilang                      | Data terhapus                   | Gunakan Docker volume dan hindari `docker compose down -v`                                      |
| Migration error                      | Tabel gagal dibuat              | Periksa relasi dan urutan migration                                                             |
| Role tidak berjalan                  | User bisa masuk dashboard Admin | Buat middleware role                                                                            |
| Review duplikat                      | Data review tidak rapi          | Gunakan unique constraint pada `user_id` dan `movie_id`                                         |
| Teman tidak bisa menjalankan project | Development terhambat           | Buat README setup yang jelas                                                                    |
| BAB IV laporan masih kosong          | Laporan kurang kuat             | Isi dengan konfigurasi Docker, database, struktur project, fitur, dan cara menjalankan aplikasi |

---

## 13. Rencana Pengujian

### 13.1 Pengujian Docker

| No | Pengujian        | Skenario                                   | Hasil yang Diharapkan     |
| -- | ---------------- | ------------------------------------------ | ------------------------- |
| 1  | Build container  | Menjalankan `docker compose up -d --build` | Container berhasil dibuat |
| 2  | Container app    | Cek container Laravel                      | Container app berjalan    |
| 3  | Container db     | Cek container MySQL                        | Container db berjalan     |
| 4  | Koneksi database | Laravel mengakses MySQL                    | Koneksi berhasil          |
| 5  | Volume database  | Restart container                          | Data tetap tersedia       |
| 6  | Akses browser    | Buka localhost                             | Aplikasi tampil           |

### 13.2 Pengujian Fungsional

| No | Fitur           | Skenario                  | Hasil yang Diharapkan        |
| -- | --------------- | ------------------------- | ---------------------------- |
| 1  | Registrasi      | User membuat akun         | Akun berhasil dibuat         |
| 2  | Login           | User login                | User masuk ke sistem         |
| 3  | Role Admin      | Admin login               | Admin masuk dashboard        |
| 4  | CRUD Genre      | Admin menambah genre      | Genre tersimpan              |
| 5  | CRUD Film       | Admin menambah film       | Film tersimpan               |
| 6  | Daftar Film     | User membuka halaman film | Film tampil                  |
| 7  | Detail Film     | User membuka detail film  | Detail film tampil           |
| 8  | Review          | User menulis review       | Review tersimpan             |
| 9  | Rating          | User memberi rating       | Rating tersimpan             |
| 10 | Spoiler         | User menandai spoiler     | Review bertanda spoiler      |
| 11 | Watchlist       | User menambahkan film     | Film masuk watchlist         |
| 12 | Hapus Watchlist | User menghapus watchlist  | Film terhapus dari watchlist |

---

## 14. Kesimpulan SRS

Dokumen SRS ini menjelaskan kebutuhan sistem aplikasi ReelReview sebagai aplikasi web review dan rekomendasi film berbasis Laravel. Aplikasi ini memiliki dua jenis pengguna, yaitu Admin dan User. Admin bertugas mengelola data film dan genre, sedangkan User dapat melihat film, memberi review, memberi rating, menandai spoiler, dan menyimpan film ke watchlist.

Dari sisi teknologi, aplikasi menggunakan Laravel sebagai framework, MySQL sebagai database, dan Docker Compose sebagai environment pengembangan. Docker Compose digunakan untuk menjalankan container Laravel dan MySQL secara bersamaan, sehingga project dapat dijalankan secara konsisten di berbagai perangkat anggota kelompok.

Struktur database utama terdiri dari tabel `users`, `genres`, `movies`, `reviews`, dan `watchlists`, sedangkan tabel `migrations` digunakan oleh Laravel untuk mencatat riwayat migration. Dengan rancangan ini, aplikasi ReelReview diharapkan dapat dikembangkan secara lebih terarah dan sesuai dengan kebutuhan tugas Sistem Operasi.
