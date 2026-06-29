# 🏪 Warung Mak Kei — Panduan Instalasi Lengkap

## Persyaratan Sistem

| Software     | Versi Minimum |
|-------------|--------------|
| PHP         | 8.3+         |
| MySQL       | 8.0+         |
| Composer    | 2.x          |
| Node.js     | 20.x (opsional) |
| Laravel     | 12.x         |

---

## 🚀 Langkah Instalasi

### 1. Clone / Download Project

```bash
# Jika dari git
git clone https://github.com/anda/warung-mak-kei.git
cd warung-mak-kei

# Atau buka folder project
cd warung-mak-kei
```

### 2. Install Dependencies PHP

```bash
composer install
```

### 3. Setup Environment

```bash
# Salin file .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=warung_mak_kei
DB_USERNAME=root
DB_PASSWORD=password_anda
```

Buat database MySQL:
```sql
CREATE DATABASE warung_mak_kei CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Jalankan Migration & Seeder

```bash
# Jalankan migration
php artisan migrate

# Jalankan seeder (data dummy + admin default)
php artisan db:seed

# Atau sekaligus fresh migration + seed
php artisan migrate:fresh --seed
```

### 6. Setup Storage

```bash
# Buat symbolic link untuk public storage
php artisan storage:link
```

### 7. Buat Folder Storage

```bash
mkdir -p storage/app/public/products
mkdir -p storage/app/public/products/gallery
mkdir -p storage/app/public/banners
mkdir -p storage/app/public/testimonials
mkdir -p storage/app/public/settings
```

### 8. Jalankan Server

```bash
php artisan serve
```

Website akan berjalan di: **http://localhost:8000**

---

## 🔐 Akses Admin

| Field    | Value                        |
|---------|------------------------------|
| URL     | http://localhost:8000/login  |
| Email   | admin@warungmakkei.com       |
| Password| password                     |

---

## 📁 Struktur Direktori Project

```
warung-mak-kei/
├── app/
│   ├── Helpers/
│   │   └── helpers.php              # Helper functions global (setting(), rupiah(), dll)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/               # Controller untuk panel admin
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ProductAdminController.php
│   │   │   │   ├── CategoryAdminController.php
│   │   │   │   ├── BannerAdminController.php
│   │   │   │   ├── TestimonialAdminController.php
│   │   │   │   ├── FaqAdminController.php
│   │   │   │   ├── ContactAdminController.php
│   │   │   │   └── SettingAdminController.php
│   │   │   ├── Auth/                # Controller autentikasi
│   │   │   └── Public/              # Controller halaman publik
│   │   │       ├── HomeController.php
│   │   │       ├── ProductController.php
│   │   │       ├── AboutController.php
│   │   │       ├── ContactController.php
│   │   │       ├── WishlistController.php
│   │   │       └── NewsletterController.php
│   │   ├── Middleware/
│   │   │   └── TrackVisitor.php     # Middleware tracking pengunjung
│   │   └── Requests/
│   │       ├── Admin/
│   │       │   └── ProductRequest.php
│   │       └── Auth/
│   │           └── LoginRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── ProductImage.php
│   │   ├── Banner.php
│   │   ├── Testimonial.php
│   │   ├── Faq.php
│   │   ├── ContactMessage.php
│   │   ├── WhatsappClick.php
│   │   ├── VisitorLog.php
│   │   ├── Newsletter.php
│   │   └── Setting.php
│   ├── Providers/
│   │   └── AppServiceProvider.php
│   └── Services/
│       ├── ImageService.php         # Menangani upload/delete gambar
│       └── ProductService.php       # Business logic produk
│
├── database/
│   ├── migrations/                  # 11 migration files
│   └── seeders/
│       ├── DatabaseSeeder.php       # Entry point seeder
│       ├── UserSeeder.php           # Admin default
│       ├── CategorySeeder.php       # 6 kategori
│       ├── ProductSeeder.php        # 20 produk dummy
│       ├── BannerSeeder.php         # 3 banner
│       ├── TestimonialSeeder.php    # 5 testimoni
│       ├── FaqSeeder.php            # 5 FAQ
│       └── SettingSeeder.php        # Pengaturan website
│
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php            # Layout utama publik
│   │   └── admin.blade.php          # Layout admin dengan sidebar
│   ├── components/public/
│   │   ├── navbar.blade.php         # Navigasi dengan search realtime
│   │   ├── footer.blade.php         # Footer lengkap
│   │   ├── floating-buttons.blade.php # WhatsApp float + back to top
│   │   ├── product-card.blade.php   # Card produk reusable
│   │   ├── pagination.blade.php     # Custom pagination
│   │   └── toast.blade.php          # Notifikasi flash
│   ├── public/
│   │   ├── home/index.blade.php     # Halaman beranda
│   │   ├── products/
│   │   │   ├── index.blade.php      # Daftar produk + filter
│   │   │   ├── show.blade.php       # Detail produk
│   │   │   └── wishlist.blade.php   # Halaman favorit
│   │   ├── about/index.blade.php    # Tentang kami
│   │   └── contact/index.blade.php  # Kontak + form
│   ├── admin/
│   │   ├── dashboard/index.blade.php
│   │   ├── products/{index,create,edit}.blade.php
│   │   ├── categories/{index,create,edit}.blade.php
│   │   ├── banners/{index,create,edit}.blade.php
│   │   ├── testimonials/{index,create,edit}.blade.php
│   │   ├── faqs/{index,create,edit}.blade.php
│   │   ├── contacts/{index,show}.blade.php
│   │   └── settings/index.blade.php
│   ├── auth/login.blade.php         # Halaman login admin
│   ├── errors/{404,500}.blade.php   # Custom error pages
│   └── seo/sitemap.blade.php        # XML Sitemap
│
└── routes/
    ├── web.php                      # Semua routes
    └── auth.php                     # Auth routes
```

---

## ⚙️ Fitur yang Sudah Diimplementasikan

### Halaman Publik
- ✅ Beranda dengan hero slider, kategori, produk unggulan, terlaris, promo, testimoni, FAQ, CTA
- ✅ Halaman produk dengan search realtime AJAX, filter kategori, filter khusus, sorting, pagination
- ✅ Detail produk dengan galeri foto, tombol WA/Tokopedia/Shopee/GoFood, produk terkait
- ✅ Halaman Tentang Kami (sejarah, visi, misi, keunggulan)
- ✅ Halaman Kontak (form, Google Maps, info kontak)
- ✅ Wishlist berbasis session (simpan produk favorit)
- ✅ Newsletter subscription
- ✅ Custom error pages (404, 500)

### Fitur Premium
- ✅ Search realtime AJAX
- ✅ Dark mode (localStorage)
- ✅ Wishlist session-based
- ✅ Recently viewed products (session)
- ✅ Back to top button
- ✅ Floating WhatsApp button
- ✅ Newsletter
- ✅ Badge "Best Seller" & "Promo"
- ✅ Loading skeleton
- ✅ Empty state yang bagus

### Panel Admin
- ✅ Login dengan email + password (Breeze)
- ✅ Dashboard statistik dengan grafik (Chart.js)
- ✅ CRUD Produk (+ upload multi gambar galeri)
- ✅ CRUD Kategori
- ✅ CRUD Banner Promosi
- ✅ CRUD Testimoni
- ✅ CRUD FAQ
- ✅ Baca & update status pesan masuk
- ✅ Pengaturan website (settings)
- ✅ Toggle produk unggulan / best seller
- ✅ Dark mode di admin panel
- ✅ Sidebar responsive

### SEO & Security
- ✅ Meta title, description, Open Graph
- ✅ Schema.org JSON-LD (Product, FoodEstablishment)
- ✅ Sitemap XML dinamis
- ✅ robots.txt
- ✅ CSRF Protection
- ✅ Mass Assignment Protection
- ✅ Form Request Validation
- ✅ Password Hashing
- ✅ Route Middleware auth
- ✅ Rate Limiting pada login
- ✅ Input sanitasi

---

## 🔧 Kustomisasi

### Mengubah Nomor WhatsApp
Login ke admin → Pengaturan → Kontak → Nomor WhatsApp

### Mengubah Warna Tema
Edit konfigurasi Tailwind di `resources/views/layouts/app.blade.php`:
```javascript
colors: {
    primary: { ... },  // Hijau (warna utama)
    accent: { ... },   // Orange (warna aksen)
}
```

### Menambahkan Produk via Seeder
Edit `database/seeders/ProductSeeder.php` dan tambahkan data.

### Deploy ke Production

```bash
# Set environment
APP_ENV=production
APP_DEBUG=false

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Set storage permission
chmod -R 775 storage bootstrap/cache
```

---

## 💡 Tips

1. **Upload gambar**: Semua gambar disimpan di `storage/app/public/`. Pastikan `php artisan storage:link` sudah dijalankan.

2. **Setting WhatsApp**: Masuk admin → Pengaturan → Kontak → isi nomor WA format internasional tanpa `+` (cth: `6281234567890`)

3. **Menambah admin**: Jalankan `php artisan tinker` dan buat user baru dengan `User::create([...])` + `Hash::make('password')`.

4. **Cache settings**: Setting website di-cache untuk performa. Setelah update, cache di-clear otomatis.

5. **Gambar placeholder**: Letakkan file `placeholder-product.jpg` di `public/images/` untuk gambar default produk.

---

## 📞 Teknologi yang Digunakan

| Stack       | Detail                          |
|------------|----------------------------------|
| Backend     | Laravel 12, PHP 8.3+            |
| Database    | MySQL 8+                         |
| Frontend    | Tailwind CSS (CDN), Alpine.js   |
| Template    | Laravel Blade                   |
| Auth        | Laravel Breeze                  |
| Charts      | Chart.js 4                      |
| Icons       | Inline SVG (Heroicons)          |
| Fonts       | Google Fonts (Plus Jakarta Sans)|
| ORM         | Eloquent                         |
| Storage     | Laravel Storage (public disk)   |

---

Dibuat dengan ❤️ untuk Warung Mak Kei
