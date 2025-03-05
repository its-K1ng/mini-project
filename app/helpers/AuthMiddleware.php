<?php
class AuthMiddleware {
    //memastikan pengguna sudah login
    public static function isAuthenticated() {
        //memeriksa apakah sesi user_id sudah ada
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
            exit();
        }
    }

    // Memastikan pengguna adalah admin
    public static function isAdmin() {
        self::isAuthenticated();

        //memeriksa apakah role user adalah admin
        if ($_SESSION['user_role'] !== 'admin') {
            //jika bukan admin, arahkan ke halaman home

            header('Location: home');
            exit();
        }
    }

    // Memastikan pengguna adalah tamu (belum login)
    public static function isGuest() {
        if (isset($_SESSION['user_id'])) {
            header('Location: home');
            exit();
        }
    }

    // Mendapatkan ID pengguna yang sedang login
    public static function getuserId(){
        self::isAuthenticated();
        return $_SESSION['user_id'];
    }
}