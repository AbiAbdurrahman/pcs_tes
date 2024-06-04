# Tes PCS Abdurrahman Saleh

## Introduction

Hi, team IT PCS Payment!

Nama saya Abdurrahman Saleh atau biasa dipanggil Abi. Saya adalah mantan Senior Software Engineer di PT Momentum Global Pratama, atau biasa dipanggil Tinkerlust, salah satu platform preloved
fashion e-commerce ternama di Indonesia. Saya mahir dalam beberapa bahasa pemrograman, seperti Java, PHP, Python, Ruby, dan Javascript. Saya pun juga bisa memahami framework Backend dan Frontend
yang menggunakan bahasa pemrograman tersebut seperti Springboot, Django, Laravel, RoR, Nodejs, dan Reactjs. Terima kasih atas kesempatan tes nya kali ini dan semoga saya bisa lanjut ke tahap selanjutnya

## Overview

Untuk tugas ini, saya menggunakan dua pendekatan backend dan frontend di platform yang terpisah. Untuk backend, saya menggunakan Laravel. Awalnya saya ingin menggunakan Django, tapi untuk
tugas dua hari, menurut saya syntax dan konteks penggunaan Laravel lebih mudah dimengerti dan diadaptasi daripada Django. Untuk backend nya, Alhamdulillah saya bisa menyelesaikan semua case
yang diminta sesuai dengan tugasnya

- Login
- Logout
- Lihat semua produk
- Masukkan produk ke cart
- Lihat cart
- Proses order
- Pembuatan kupon sesuai rule yang diberikan
- Lihat order

Sementara untuk frontend, berhubung waktunya yang kurang dan saya nya yang memang lebih fokus dan mampu di sisi backend, tidak bisa jauh menyelesaikannya. Saya hanya bisa mengerjakan
fitur untuk login, logout, dan melihat produk. Tapi jika diberikan waktu lebih banyak, misalkan sehari lagi, saya 100% yakin bisa menyelesaikannya dengan baik karena saya masih ada kemampuan
di sisi frontend, dan semoga preferensi dan kekurangan saya ini bisa diterima

## Cara Penggunaan

1. Git pull
2. Di pcs_api, setup dahulu .env database nya. Saya menggunakan MySql
3. `php artisan migrate`
4. Di repository root, `mysql -u root -p nama_db < pcs_tes_dump.sql`
5. `php artisan serve`
6. Di pcs_frontend, `npm install`
7. `npm run start`
