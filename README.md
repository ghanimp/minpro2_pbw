# Website Portofolio Dinamis

## Deskripsi
Website portofolio pribadi yang menampilkan profil, pengalaman, skills, dan sertifikat secara **dinamis** menggunakan database MySQL. Data tidak lagi hardcode di kodingan, tetapi diambil langsung dari database sehingga memudahkan pengelolaan konten tanpa perlu mengedit file source code.

## Teknologi yang Digunakan
- **PHP** - Backend processing dan koneksi database
- **MySQL** - Database untuk menyimpan semua konten
- **HTML** - Struktur halaman web
- **CSS** - Custom styling dan animasi
- **Bootstrap** - Framework CSS untuk layout responsif
- **Google Fonts (Poppins)** - Tipografi modern

## Struktur Database

### Database: `portfolio_db`

#### Tabel `users`
| Field | Type | Description |
|-------|------|-------------|
| id | INT (PK) | ID pengguna |
| name | VARCHAR(100) | Nama lengkap |
| tagline | VARCHAR(200) | Tagline/judul |
| about | TEXT | Deskripsi diri |
| profile_image | VARCHAR(255) | Path foto profil |

#### Tabel `experiences`
| Field | Type | Description |
|-------|------|-------------|
| id | INT (PK) | ID pengalaman |
| experience_name | VARCHAR(100) | Nama pengalaman |

#### Tabel `skills`
| Field | Type | Description |
|-------|------|-------------|
| id | INT (PK) | ID skill |
| skill_name | VARCHAR(50) | Nama skill |
| skill_level | INT | Level skill (0-100) |

#### Tabel `certificates`
| Field | Type | Description |
|-------|------|-------------|
| id | INT (PK) | ID sertifikat |
| title | VARCHAR(100) | Judul sertifikat |
| description | TEXT | Deskripsi sertifikat |
| image | VARCHAR(255) | Path gambar sertifikat |


## Fitur Dinamis

### Data yang Diambil dari Database:
- ✅ **Profile User** - Nama, tagline, deskripsi, foto profil
- ✅ **Experiences** - Daftar pengalaman
- ✅ **Skills** - Nama skill dan level persentase
- ✅ **Certificates** - Judul, deskripsi, dan gambar sertifikat

### Keunggulan Sistem Dinamis:
1. **Mudah Dikelola** - Cukup update database, website langsung berubah
2. **Terstruktur** - Data tersimpan rapi dalam tabel-tabel MySQL
3. **Skalabel** - Mudah menambahkan fitur baru seperti CRUD admin
4. **Aman** - Menggunakan prepared statements untuk mencegah SQL injection

## Penjelasan Kode

### 1. Koneksi Database (`config.php`)
```php
<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'portfolio_db';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
```
File ini berfungsi untuk menghubungkan website ke database MySQL. mysqli_connect() digunakan untuk membuat koneksi dengan parameter host, username, password, dan nama database. Jika koneksi gagal, program akan berhenti dan menampilkan pesan error. File ini akan dipanggil di halaman utama agar bisa mengakses database.

### 2. Mengambil Data dari Database (index.php)
```php
<?php
include 'config.php';

$userQuery = "SELECT * FROM users LIMIT 1";
$userResult = mysqli_query($conn, $userQuery);
$user = mysqli_fetch_assoc($userResult);

$experiencesQuery = "SELECT * FROM experiences";
$experiencesResult = mysqli_query($conn, $experiencesQuery);

$skillsQuery = "SELECT * FROM skills";
$skillsResult = mysqli_query($conn, $skillsQuery);

$certificatesQuery = "SELECT * FROM certificates";
$certificatesResult = mysqli_query($conn, $certificatesQuery);
?>
```
Setelah menghubungkan ke database, kita mengambil data dengan query SQL. mysqli_query() menjalankan perintah SQL ke database, lalu mysqli_fetch_assoc() mengubah hasilnya menjadi array agar mudah diakses.

### 3. Menampilkan Data Dinamis
Menampilkan nama:
```php
<h1><?php echo htmlspecialchars($user['name']); ?></h1>
```
htmlspecialchars() digunakan untuk keamanan, mengubah karakter berbahaya seperti < menjadi &lt;. Ini mencegah serangan XSS.


Menampilkan daftar experiences:
```php
<ul>
    <?php while($exp = mysqli_fetch_assoc($experiencesResult)): ?>
        <li><?php echo htmlspecialchars($exp['experience_name']); ?></li>
    <?php endwhile; ?>
</ul>
```
while loop akan terus berjalan selama masih ada data. Setiap iterasi, $exp berisi satu baris data dari tabel experiences. Kolom experience_name diambil dan ditampilkan sebagai list item.

Menampilkan skills dengan progress bar:
```php
<?php while($skill = mysqli_fetch_assoc($skillsResult)): ?>
    <div class="mb-3">
        <span><?php echo htmlspecialchars($skill['skill_name']); ?></span>
        <span><?php echo $skill['skill_level']; ?>%</span>
        <div class="progress-bar" style="width: <?php echo $skill['skill_level']; ?>%"></div>
    </div>
<?php endwhile; ?>
```
Skill ditampilkan dengan progress bar yang lebarnya diatur dinamis menggunakan CSS style="width: X%". Nilai X diambil dari kolom skill_level di database.

Menampilkan certificates:
```php
<?php while($cert = mysqli_fetch_assoc($certificatesResult)): ?>
    <div class="col-md-4">
        <div class="card modern-card">
            <img src="<?php echo htmlspecialchars($cert['image']); ?>">
            <h5><?php echo htmlspecialchars($cert['title']); ?></h5>
            <p><?php echo htmlspecialchars($cert['description']); ?></p>
        </div>
    </div>
<?php endwhile; ?>
```
Menampilkan certificates:

## Tampilan Website

<img width="850" height="700" alt="image" src="https://github.com/user-attachments/assets/1635428a-0655-49d2-bd34-d772c94e7258" />


<img width="850" height="700" alt="image" src="https://github.com/user-attachments/assets/91fc319c-19dd-4df8-918c-5c5d244497b4" />


<img width="850" height="700" alt="image" src="https://github.com/user-attachments/assets/717a8b48-0467-4b01-b1b6-4a5687c34aba" />
