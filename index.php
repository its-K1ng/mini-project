<?php
session_start();

// memuat file konfigurasi database
require_once 'config/database.php';
// memuat rute aplikasi (definisi URL ke kontroler)
require_once 'routes/web.php';
// mengecek apakah parameter URL tersedia di query string jika tidak ada, maka default akan diarahkan ke 'home'
$url = isset($_GET['url']) ? $_GET['url'] : 'home';
// Membuat instance dari kelas router, router  bertugas membaca URL yang diberikan dan memetakan URL tersebut ke kontroler yang sesuai
$router = new Router();
// menjalankan metode route() dari objek Router dengan parameter $url, router akan mencocokkan URL dengan daftar rute yang didefinisikan di file 'routes/web.php', jika URL ditemukan dalam daftar, kontroler yang sesuai akan dipanggil jika tidak ditemukan, aplikasi akan mengembalikan pesan "Page not found".
$router->route($url);