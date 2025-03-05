<?php
class Router {
    // metode yang bertugas untuk memetakan URL ke kontroler yang sesuai
    public function route($url) {
        // struktur switch untuk memeriksa URL yang diterima

        switch($url) {
            case 'home': // jika URL adalah 'home'
                require_once 'app/controllers/HomeController.php'; // memuat file HomeController
                $controller = new HomeController(); // membuat instance dari HomeController
                $controller->index(); // memanggil metode 'index' pada HomeController
                break;
            
            case 'admin':
                require_once 'app/controllers/HomeController.php';
                $controller = new HomeController();
                $controller->admin();
                break;
            
            case 'save':
                require_once 'app/controllers/SavingController.php';
                $controller = new SavingController();
                $controller->index();
                break;

            case 'login':
                require_once 'app/controllers/AuthController.php';
                $controller = new AuthController();
                $controller->login();
                break;
            
            case 'register':
                require_once 'app/controllers/AuthController.php';
                $controller = new AuthController();
                $controller->register();
                break;

            case 'logout':
                require_once 'app/controllers/AuthController.php';
                $controller = new AuthController();
                $controller->logout();
                break;
            
            default:
                header("HTTP/1.0 404 Not Found");
                echo "Page not found";
                break;
        }
    }
}