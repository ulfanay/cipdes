# 🌐 CIPDES - Carangrejo Informasi Profil Desa

![PHP](https://img.shields.io/badge/PHP-7.4+-blue) 
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple)
![Leaflet](https://img.shields.io/badge/Leaflet-Map-green)
![License](https://img.shields.io/badge/License-MIT-yellow)

Portal informasi desa **Carangrejo, Kesamben, Jombang, Jawa Timur, 61484**  
Dibangun menggunakan **PHP + MySQL**, **Bootstrap 5** untuk UI, dan **LeafletJS** untuk peta interaktif.

---

## ✨ Fitur Utama

- 📖 **Profil Desa** – sejarah, geografis, demografi, potensi desa  
- 🎯 **Visi & Misi** – visi pembangunan desa & misi strategis  
- 📰 **Berita Desa** – berita terbaru lengkap dengan kategori & gambar  
- 📢 **Pesan & Pengumuman** – pesan dari masyarakat & pengumuman resmi  
- 🏘 **Kategori / Dusun** – informasi per dusun dalam wilayah Carangrejo  
- 🗺 **Peta Wilayah Desa** – menampilkan peta desa menggunakan OpenStreetMap (LeafletJS)  

---

## 🛠 Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/ulfanay/cipdes.git

2. Pindahkan ke folder xampp
   - C:\xampp\htdocs\cipdes
   
4. Buat database MySQL
   - Buka phpMyAdmin
   - Buat database: cipdes
   - Import file: database/cipdes.sql
     
6. Konfigurasi koneksi database
  - Salin includes/db.sample.php → jadi includes/db.php
  - Sesuaikan username & password MySQL kamu:
    
7. Jalankan XAMPP (Apache & MySQL aktif).
8. Akses Login
   - Username : admin
   - Password : admin123
10. Akses Project Admin
   - http://localhost/cipdes/admin/
11.  Akses project Beranda
   - http://localhost/cipdes/public/

## 📂Struktur Project
cipdes/
│
├── admin/                # Halaman admin (CRUD data)
├── includes/             # Header, footer, config db
├── public/               # Halaman publik (index.php, profil.php, dll)
│   ├── index.php
│   ├── profil.php
│   ├── visi_misi.php
│   ├── berita.php
│   ├── kategori.php
│   ├── pesan.php
│
├── uploads/              # Folder upload gambar (gitignore)
├── database/             # File SQL database
│   └── cipdes.sql
├── .gitignore
├── README.md

## 🖼 Tampilan Login, Dashboard Admin, Beranda
<img width="616" height="486" alt="gambar" src="https://github.com/user-attachments/assets/abfae12d-6e6b-4323-be95-94d098048f5e" />
<img width="1365" height="543" alt="gambar" src="https://github.com/user-attachments/assets/ba1f8c1e-d538-4a8e-a0c9-8742fc394eb9" />
<img width="1172" height="598" alt="gambar" src="https://github.com/user-attachments/assets/3b99861d-8832-4811-862d-01e46e394a1a" />
<img width="1154" height="623" alt="gambar" src="https://github.com/user-attachments/assets/312e8fc0-c001-4cb2-a62e-92339a88e196" />
<img width="1176" height="601" alt="gambar" src="https://github.com/user-attachments/assets/10521df4-afec-407b-afc1-88b896ff22c8" />
<img width="1132" height="598" alt="gambar" src="https://github.com/user-attachments/assets/a711be31-56c8-479d-9ccd-e2673c942756" />
<img width="1125" height="585" alt="gambar" src="https://github.com/user-attachments/assets/4c61220d-6193-4b6b-88b3-bfacd245870b" />
<img width="1199" height="616" alt="gambar" src="https://github.com/user-attachments/assets/ec971ea2-012b-40f1-b3d7-6f6f105e957f" />
<img width="1194" height="311" alt="gambar" src="https://github.com/user-attachments/assets/eac5c8df-7cce-4218-bf38-8f2a1f06fc46" />
<img width="1179" height="509" alt="gambar" src="https://github.com/user-attachments/assets/c930f20f-b1ff-4369-a7fa-3d3b8afbe4ad" />
<img width="1168" height="433" alt="gambar" src="https://github.com/user-attachments/assets/45606261-7b0c-4e96-b410-9eea4b9abd36" />

## 📜 Lisensi
Proyek ini dirilis di bawah lisensi MIT.
Silakan gunakan, modifikasi, dan sebarkan sesuai kebutuhan.

## 🤝 Kontribusi
Fork repo ini
- Buat branch baru: git checkout -b fitur-baru
- Commit perubahan: git commit -m "feat: tambah fitur baru"
- Push ke branch: git push origin fitur-baru
- Buat Pull Request

## 👨‍💻 Pengembang
Ulfanay
📍 Desa Carangrejo, Kesamben, Jombang, Jawa Timur
🔗 GitHub
   
---

## 📌 Langkah Tambahan
1. Simpan file ini di `cipdes/README.md`.  
2. Commit ke Git:
   ```bash
   git add README.md
   git commit -m "docs: add professional README"
   git push origin main

