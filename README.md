# TP9DPBO2425C1

## Janji

Saya Dzaka Musyaffa Hidayat dengan NIM 2404913 mengerjakan Tugas Praktikum 9 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Deskripsi

Aplikasi ini adalah sistem manajemen database sederhana berbasis web yang dibangun menggunakan bahasa pemrograman PHP Native. Proyek ini bertujuan untuk mendemonstrasikan implementasi pola desain arsitektur Model-View-Presenter (MVP) tanpa menggunakan framework tambahan.

Aplikasi ini mengelola dua entitas utama yaitu "Pembalap" dan "Tim", yang saling berelasi. Sistem memisahkan logika bisnis (Model), tampilan antarmuka (View), dan penghubung alur data (Presenter) secara tegas untuk menjaga kode tetap bersih, terstruktur, dan mudah dikembangkan.

## Fitur Utama  

### 1. Manajemen Data Pembalap (CRUD)
- Menampilkan daftar pembalap dengan urutan berdasarkan poin tertinggi (Klasemen).
- Menambah data pembalap baru.
- Mengubah data pembalap yang sudah ada.
- Menghapus data pembalap.

### 2. Manajemen Data Tim (CRUD)
- Menampilkan daftar tim balap beserta detail mesin dan sasis.
- Menambah, mengubah, dan menghapus data tim.
- 
### 3. Relasi Data
- Pemilihan tim menggunakan dropdown menu yang dinamis saat menambah atau mengubah data pembalap.
- Data pembalap terhubung secara relasional dengan data tim melalui ID (Foreign Key).

### 4. Sistem Templating
- Kode PHP terpisah sepenuhnya dari kode HTML.
- Menggunakan file template eksternal (.html) untuk tampilan antarmuka, memungkinkan penggantian desain tanpa menyentuh logika program.

## Struktur Folder

```
TP9DPBO2425C1/
├── mvp_db.sql
├── Project/
│   ├── index.php
│   ├── models/
│   │   ├── DB.php
│   │   ├── KontrakModel.php
│   │   ├── KontrakModelTim.php
│   │   ├── Pembalap.php
│   │   ├── TabelPembalap.php
│   │   ├── TabelTim.php
│   │   └── Tim.php
│   ├── presenters/
│   │   ├── KontrakPresenter.php
│   │   ├── PresenterPembalap.php
│   │   └── PresenterTim.php
│   ├── template/
│   │   ├── form_pembalap.html
│   │   ├── form_tim.html
│   │   ├── skin_tim.html
│   │   └── skin.html
│   └── views/
│       ├── KontrakView.php
│       ├── KontrakViewTim.php
│       ├── ViewPembalap.php
│       └── ViewTim.php
└── README.md
```

## Struktur MVP (Model-View-Presenter)

Aplikasi ini membagi tanggung jawab kode ke dalam tiga lapisan utama:

### 1. Model

Bertanggung jawab untuk pengelolaan data dan interaksi langsung dengan database.
- ``DB.php``: Wrapper untuk koneksi database menggunakan PDO.
- ``Pembalap.php`` / ``Tim.php``: Kelas entitas (Domain Object) yang merepresentasikan struktur data.
- ``TabelPembalap.php`` / ``TabelTim.php``: Kelas Data Access Object (DAO) yang berisi query SQL (SELECT, INSERT, UPDATE, DELETE).
- ``KontrakModel.php`` / ``KontrakModelTim.php``: Interface yang mendefinisikan metode apa saja yang wajib dimiliki oleh Model.

### 2. View

Bertanggung jawab untuk menampilkan data kepada pengguna. View tidak boleh memproses logika bisnis atau query database.
- ``ViewPembalap.php`` / ``ViewTim.php``: Kelas yang bertugas memuat template HTML dan menyuntikkan data yang diterima dari Presenter ke dalam template tersebut.
- ``template/``: Folder berisi file HTML murni (skin.html, form.html) yang berfungsi sebagai kerangka tampilan.

### 3. Presenter

Bertanggung jawab sebagai penghubung antara Model dan View. Presenter menerima permintaan, mengambil data dari Model, memprosesnya jika perlu, dan mengirimkannya ke View.
- ``PresenterPembalap.php`` / ``PresenterTim.php``: Kelas yang mengatur alur logika, seperti memvalidasi input, memanggil fungsi simpan di Model, dan meminta View untuk menampilkan hasil.
- ``KontrakPresenter.php``: Interface yang mendefinisikan standar fungsi bagi Presenter.

### Entry Point (Controller Sederhana)

``index.php``: Berfungsi sebagai pintu masuk aplikasi (Router). File ini menentukan Presenter mana yang harus dipanggil berdasarkan parameter URL (page) dan aksi (action) yang diminta pengguna.

## Dokumentasi Program
