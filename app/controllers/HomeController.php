<?php
class HomeController {
    private $db;
    private $savingModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        require_once 'app/models/Saving.php';
        $this->savingModel = new Saving($this->db);
    }

    public function index() {
        require_once 'app/helpers/AuthMiddleware.php';
        AuthMiddleware::isAuthenticated(); // Pastikan user login
    
        $userId = AuthMiddleware::getUserId();
        $isAdmin = $_SESSION['user_role'] === 'admin';
    
        if ($isAdmin) {
            $savings = $this->savingModel->getAll(); // Admin melihat semua data
        } else {
            $savings = $this->savingModel->getByUserId($userId); // User hanya melihat miliknya
        }
    
        require_once 'app/views/home.php';
    }
    
    public function admin()
    {
        require_once 'app/helpers/AuthMiddleware.php';
        AuthMiddleware::isAdmin();
        
        $savings = $this->savingModel->getAll();
        require_once 'app/views/admin.php';
    }
}