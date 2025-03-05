<?php
class SavingController {
    private $db;
    private $savingModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        //memuat model Saving untuk operasi data tabungan
        require_once 'app/models/Saving.php';
        $this->savingModel = new Saving($this->db);
    }
        //metode untuk menangani halaman penyimpanan tabungan
        public function index(){
        //middleware: memastikan user sudah login dan ambil user ID dari sesi
        require_once 'app/helpers/AuthMiddleware.php';
        $userId = AuthMiddleware::getuserId();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = $_POST['amount'];//mengambil jumlah tabungan dari input form
            $message = $_POST['message']; /mbil pesan dari input form
            
        //memproses penyimpanan data tabungan ke database menggunakan model Saving
         if ($this->savingModel->create($userId, $amount, $message)) { 
            header('Location: home');
            exit();

            }
        }
    
        require_once 'app/views/save.php';
    }
}