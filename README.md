# ReelReview

ReelReview adalah aplikasi web rekomendasi dan review film berbasis Laravel. Project ini menggunakan Docker Compose untuk menjalankan environment development secara konsisten, sehingga anggota kelompok tidak perlu melakukan setup PHP, Composer, MySQL, atau Laragon secara manual di laptop masing-masing.

Tujuan utama penggunaan Docker pada project ini adalah agar aplikasi dapat dijalankan dengan cara yang sama di berbagai perangkat.

```text
Clone repository
Copy file environment
Jalankan Docker Compose
Generate APP_KEY
Jalankan migration dan seeder
Aplikasi siap digunakan
```

---

## 1. Teknologi yang Digunakan

Project ini menggunakan teknologi berikut:

| Teknologi | Fungsi |
|---|---|
| Laravel | Framework utama aplikasi web |
| PHP | Bahasa pemrograman backend |
| MySQL | Database aplikasi |
| Docker | Menjalankan aplikasi dalam container |
| Docker Compose | Mengatur beberapa container dalam satu konfigurasi |
| phpMyAdmin | Opsional, untuk melihat dan mengelola database melalui browser |
| Git | Mengambil dan mengelola source code dari GitHub |

---

## 2. Requirement yang Harus Diinstall

Sebelum menjalankan project, pastikan perangkat sudah memiliki beberapa tools berikut.

### 2.1 Requirement Wajib

| Tool | Keterangan |
|---|---|
| Git | Digunakan untuk clone repository dari GitHub |
| Docker | Digunakan untuk menjalankan container |
| Docker Compose | Digunakan untuk menjalankan beberapa service seperti app dan database |

### 2.2 Untuk Pengguna Windows

Install:

```text
1. Git for Windows
2. Docker Desktop for Windows
```

Catatan:

```text
Docker Desktop sudah menyediakan Docker Engine, Docker CLI, dan Docker Compose.
```

Setelah install Docker Desktop, buka aplikasinya terlebih dahulu dan pastikan Docker sudah berjalan sebelum menjalankan command project.

### 2.3 Untuk Pengguna Linux, Termasuk Fedora

Ada dua pilihan:

```text
Pilihan 1: Docker Desktop for Linux
Pilihan 2: Docker Engine + Docker Compose Plugin
```

Untuk development di Linux, Docker Engine + Docker Compose Plugin sudah cukup.

Pastikan command berikut tersedia:

```bash
docker --version
docker compose version
```

Jika command di atas belum tersedia, install Docker sesuai dokumentasi resmi Docker untuk distribusi Linux yang digunakan.

### 2.4 Untuk Pengguna macOS

Install:

```text
1. Git
2. Docker Desktop for Mac
```

Setelah install Docker Desktop, buka aplikasinya dan pastikan Docker sudah berjalan.

### 2.5 Tools yang Tidak Wajib Diinstall

Karena project berjalan lewat Docker, anggota kelompok tidak wajib menginstall tools berikut secara manual:

```text
PHP
Composer
MySQL
phpMyAdmin
Laragon
XAMPP
WAMP
```

Semua kebutuhan utama aplikasi akan dijalankan melalui container Docker.

---

## 3. Struktur Service Docker

Project ini menggunakan beberapa service utama:

| Service | Fungsi | Port |
|---|---|---|
| app | Menjalankan aplikasi Laravel | 8000 |
| db | Menjalankan database MySQL | 3307 di host, 3306 di container |
| phpmyadmin | Mengelola database melalui browser | 8080 |

Alur sederhananya:

```text
Browser
  -> Laravel Container
      -> MySQL Container
          -> Docker Volume
```

Penjelasan:

```text
Laravel berjalan di container app.
MySQL berjalan di container db.
Data MySQL disimpan di Docker volume agar tidak hilang ketika container dimatikan.
```

---

## 4. Cara Clone Project dari GitHub

Clone repository:

```bash
git clone https://github.com/alijundev/reelreview.git
```

Masuk ke folder project:

```bash
cd reelreview
```

---

## 5. Setup File Environment

Laravel membutuhkan file `.env` untuk menyimpan konfigurasi aplikasi.

Setelah clone repository, copy file `.env.example` menjadi `.env`.

### Linux, macOS, atau Git Bash

```bash
cp .env.example .env
```

### Windows PowerShell

```powershell
copy .env.example .env
```

Pastikan konfigurasi database di file `.env` seperti berikut:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db_reelreview
DB_USERNAME=reelreview_user
DB_PASSWORD=reelreview_pass
```

Catatan penting:

```text
DB_HOST harus menggunakan db, bukan localhost.
```

Alasannya, Laravel dan MySQL berjalan pada container yang berbeda. Dalam Docker Compose, container Laravel mengakses container MySQL menggunakan nama service, yaitu `db`.

---

## 6. Menjalankan Project dengan Docker Compose

Jalankan command berikut dari root folder project:

```bash
docker compose up -d --build
```

Penjelasan command:

| Command | Fungsi |
|---|---|
| docker compose up | Menjalankan semua service di docker-compose.yml |
| -d | Menjalankan container di background |
| --build | Build ulang image jika ada perubahan Dockerfile atau dependency |

Cek apakah container sudah berjalan:

```bash
docker compose ps
```

Jika berhasil, akan muncul container seperti:

```text
reelreview_app
reelreview_db
reelreview_phpmyadmin
```

---

## 7. Generate APP_KEY Laravel

Setelah container berjalan, generate application key Laravel:

```bash
docker compose exec app php artisan key:generate
```

Command ini akan mengisi nilai `APP_KEY` di file `.env`.

---

## 8. Menjalankan Migration dan Seeder

Jalankan migration untuk membuat tabel database:

```bash
docker compose exec app php artisan migrate
```

Jika project menyediakan seeder data awal, jalankan:

```bash
docker compose exec app php artisan db:seed
```

Atau jalankan migration dan seeder sekaligus:

```bash
docker compose exec app php artisan migrate --seed
```

Seeder biasanya digunakan untuk membuat data awal seperti:

```text
Admin default
Genre default
Data film contoh
```

Jika seeder belum dibuat, cukup jalankan migration saja.

### 8.1 Menjalankan Build Asset (Vite) — Wajib!
Karena folder project di-mount ke container (`.:/var/www/html`), folder build Vite pada container akan tertimpa oleh host. Anda **wajib** melakukan compile asset CSS/JS agar tampilan dapat termuat dengan benar (menghindari error `Vite manifest not found`):

```bash
docker compose exec app npm run build
```

---

## 9. Mengakses Aplikasi

Setelah setup selesai, buka aplikasi melalui browser:

```text
http://localhost:8000
```

Akses phpMyAdmin:

```text
http://localhost:8080
```

Login phpMyAdmin:

```text
Server: db
Username: reelreview_user
Password: reelreview_pass
```

Jika login dengan user biasa tidak berhasil, coba gunakan root:

```text
Server: db
Username: root
Password: root
```

---

## 10. Command Penting Selama Development

### 10.1 Menjalankan Container

```bash
docker compose up -d
```

### 10.2 Menjalankan Container dan Build Ulang

```bash
docker compose up -d --build
```

Gunakan command ini jika ada perubahan pada:

```text
Dockerfile
docker-compose.yml
Dependency PHP
Dependency Node
```

### 10.3 Menghentikan Container

```bash
docker compose down
```

Command ini menghentikan container, tetapi tidak menghapus volume database.

### 10.4 Menghentikan Container dan Menghapus Database Lokal

```bash
docker compose down -v
```

Peringatan:

```text
Command ini akan menghapus volume database lokal.
Gunakan hanya jika ingin reset database dari awal.
```

### 10.5 Melihat Log Container

```bash
docker compose logs
```

Melihat log service app:

```bash
docker compose logs app
```

Melihat log service database:

```bash
docker compose logs db
```

### 10.6 Masuk ke Container App

```bash
docker compose exec app bash
```

Jika bash tidak tersedia:

```bash
docker compose exec app sh
```

### 10.7 Menjalankan Command Artisan

Format umum:

```bash
docker compose exec app php artisan nama-command
```

Contoh:

```bash
docker compose exec app php artisan route:list
docker compose exec app php artisan migrate
docker compose exec app php artisan migrate:fresh --seed
docker compose exec app php artisan cache:clear
docker compose exec app php artisan config:clear
```

### 10.8 Menjalankan Composer

Format umum:

```bash
docker compose exec app composer nama-command
```

Contoh:

```bash
docker compose exec app composer install
docker compose exec app composer require nama/package
```

### 10.9 Menjalankan NPM

Format umum:

```bash
docker compose exec app npm nama-command
```

Contoh:

```bash
docker compose exec app npm install
docker compose exec app npm run dev
docker compose exec app npm run build
```

---

## 11. Alur Setelah Ada Update dari GitHub

Jika ada anggota kelompok yang melakukan perubahan dan sudah push ke GitHub, anggota lain cukup menjalankan:

```bash
git pull
```

Setelah itu, sesuaikan dengan jenis perubahan.

### 11.1 Jika Hanya Perubahan Kode Biasa

Contoh perubahan:

```text
Controller
Model
View
Route
CSS
JavaScript
```

Biasanya cukup:

```bash
git pull
```

Lalu refresh browser.

### 11.2 Jika Ada Migration Baru

Jalankan:

```bash
docker compose exec app php artisan migrate
```

### 11.3 Jika Ada Perubahan Seeder

Jalankan:

```bash
docker compose exec app php artisan db:seed
```

Jika ingin reset database lokal dan isi ulang dari awal:

```bash
docker compose exec app php artisan migrate:fresh --seed
```

Peringatan:

```text
Command migrate:fresh akan menghapus semua tabel dan membuat ulang database.
Gunakan hanya untuk development lokal.
```

### 11.4 Jika Ada Package Composer Baru

Jalankan:

```bash
docker compose exec app composer install
```

### 11.5 Jika Ada Package NPM Baru

Jalankan:

```bash
docker compose exec app npm install
```

Jika project menggunakan build asset:

```bash
docker compose exec app npm run build
```

### 11.6 Jika Ada Perubahan Dockerfile atau docker-compose.yml

Jalankan:

```bash
docker compose up -d --build
```

---

## 12. Database dan Keamanan Data Lokal

Data MySQL disimpan menggunakan Docker volume.

Artinya:

```text
Container boleh dihentikan.
Container boleh dibuat ulang.
Data database tetap aman selama volume tidak dihapus.
```

Command yang aman untuk menghentikan container:

```bash
docker compose down
```

Command yang menghapus database lokal:

```bash
docker compose down -v
```

Jangan gunakan `docker compose down -v` jika tidak ingin data database lokal hilang.

---

## 13. Masalah yang Sering Terjadi

### 13.1 Port 8000 Sudah Digunakan

Masalah:

```text
Aplikasi tidak bisa jalan karena port 8000 sudah digunakan aplikasi lain.
```

Solusi:

Ubah bagian ports pada service app di `docker-compose.yml`:

```yaml
ports:
  - "8001:8000"
```

Lalu jalankan ulang:

```bash
docker compose up -d
```

Akses aplikasi di:

```text
http://localhost:8001
```

### 13.2 Port 8080 Sudah Digunakan

Masalah:

```text
phpMyAdmin tidak bisa jalan karena port 8080 sudah digunakan.
```

Solusi:

Ubah bagian ports pada service phpmyadmin:

```yaml
ports:
  - "8081:80"
```

Akses phpMyAdmin di:

```text
http://localhost:8081
```

### 13.3 Laravel Tidak Bisa Terhubung ke Database

Pastikan konfigurasi `.env` seperti berikut:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=reelreview
DB_USERNAME=reelreview_user
DB_PASSWORD=reelreview_pass
```

Setelah mengubah `.env`, jalankan:

```bash
docker compose exec app php artisan config:clear
```

### 13.4 File .env Belum Ada

Jika muncul error karena `.env` tidak ditemukan, copy dari `.env.example`:

```bash
cp .env.example .env
```

Windows PowerShell:

```powershell
copy .env.example .env
```

Lalu generate key:

```bash
docker compose exec app php artisan key:generate
```

### 13.5 APP_KEY Kosong

Jalankan:

```bash
docker compose exec app php artisan key:generate
```

### 13.6 Tabel Database Belum Ada

Jalankan:

```bash
docker compose exec app php artisan migrate
```

### 13.7 Perubahan .env Tidak Terbaca

Jalankan:

```bash
docker compose exec app php artisan config:clear
```

Jika masih bermasalah, restart container:

```bash
docker compose restart app
```

### 13.8 Permission Error di Linux

Jika Docker membutuhkan akses root, jalankan dengan `sudo`:

```bash
sudo docker compose up -d --build
```

Alternatif yang lebih nyaman adalah menambahkan user ke group docker sesuai dokumentasi Docker.

---

## 14. Aturan Git untuk Anggota Kelompok

Agar project tidak berantakan, gunakan alur kerja berikut.

### 14.1 Jangan Langsung Coding di Branch Main

Branch `main` digunakan untuk kode yang sudah stabil.

Untuk membuat fitur baru, buat branch baru:

```bash
git checkout -b feature/nama-fitur
```

Contoh:

```bash
git checkout -b feature/crud-movie
```

### 14.2 Commit Perubahan

Cek file yang berubah:

```bash
git status
```

Tambahkan file:

```bash
git add .
```

Commit:

```bash
git commit -m "feat: add movie CRUD"
```

Push:

```bash
git push origin feature/crud-movie
```

### 14.3 Contoh Format Pesan Commit

| Prefix | Digunakan untuk |
|---|---|
| feat | Menambahkan fitur baru |
| fix | Memperbaiki bug |
| docs | Mengubah dokumentasi |
| style | Mengubah tampilan atau format kode |
| refactor | Merapikan kode tanpa mengubah fitur |
| chore | Perubahan kecil seperti konfigurasi |

Contoh:

```text
feat: add movie detail page
fix: repair database connection
docs: update setup guide
chore: update docker compose config
```

---

## 15. File yang Harus Masuk GitHub

Pastikan file berikut masuk ke repository:

```text
app/
bootstrap/
config/
database/
public/
resources/
routes/
tests/
Dockerfile
docker-compose.yml
.dockerignore
.gitignore
.env.example
composer.json
composer.lock
package.json
package-lock.json atau pnpm-lock.yaml
artisan
README.md
```

---

## 16. File yang Tidak Boleh Masuk GitHub

File berikut tidak boleh di-commit:

```text
.env
vendor/
node_modules/
storage/logs/
```

Pastikan `.gitignore` sudah memuat:

```gitignore
/vendor
/node_modules
/.env
/storage/logs
```

---

## 17. Catatan Development

Beberapa catatan penting untuk anggota kelompok:

```text
1. Jangan mengubah nama service db di docker-compose.yml tanpa menyesuaikan DB_HOST di .env.
2. Jangan menjalankan docker compose down -v kecuali ingin reset database lokal.
3. Setelah git pull, cek apakah ada migration baru.
4. Jika ada migration baru, jalankan php artisan migrate melalui container.
5. Jika ada package baru, jalankan composer install atau npm install melalui container.
6. Semua command Laravel dijalankan melalui docker compose exec app.
```

---

## 18. Ringkasan Setup Cepat

Untuk anggota kelompok yang baru clone project, jalankan command berikut:

```bash
git clone https://github.com/alijundev/reelreview.git
cd reelreview
cp .env.example .env
docker compose up -d --build
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
docker compose exec app npm run build
```

Untuk Windows PowerShell, bagian copy `.env` gunakan:

```powershell
copy .env.example .env
```

Akses aplikasi:

```text
http://localhost:8000
```

Akses phpMyAdmin:

```text
http://localhost:8080
```

---

## 19. Tujuan Penggunaan Docker pada Project Ini

Docker digunakan agar setiap anggota kelompok memiliki environment yang sama.

Tanpa Docker, setiap laptop bisa memiliki versi PHP, Composer, MySQL, dan konfigurasi server yang berbeda. Hal ini sering menyebabkan masalah seperti:

```text
Di laptop satu aplikasi jalan.
Di laptop lain aplikasi error.
```

Dengan Docker, environment aplikasi didefinisikan di dalam Dockerfile dan docker-compose.yml. Selama anggota kelompok memiliki Docker, project dapat dijalankan dengan cara yang sama.

## Klu masih error dari dockernya dan chatgpt ngabisa bantu nyelesaiin, restart aja tuh laptop, windows emang banyak masalah
