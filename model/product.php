<?php
include PROJECT_ROOT . '/database/database.php';

//preparasi kolom dan data yg didpatkan di controller, database evaluate data
    class Product {
        // private $controller = new ProductController;
        private $db;

        private $product_name;
        private $price;
        private $quantity;
        private $description;

        public function __construct() {
            $this->db = new Database();
        }
    
        public function getProducts(){
            return $this->db->getProducts();
        }

        public function getDeletedProducts(){
            return $this->db->deletedDatas();
        }
        
        public function createProduct($data) {
            if (empty($data) || !is_array($data)) {
                return false;
            }
            return $this->db->create($data);
        }
    
        public function getProductById($id) {
            return $this->db->getProductsById($id);
        }
    
        public function updateProduct($id, $data) {
            return $this->db->update($id, $data);
        }
    
        public function softDelete($id) {
            return $this->db->softDelete($id);
        }

        public function multipleDelete($ids) {
            return $this->db->multipleDelete($ids);
        }

        public function restoreData($ids) {
            return $this->db->restoreData($ids);
        }
    }

    // $con = new Product($db);
    // $products = $con->getProducts();
    //     foreach ($products as $product) {
    //         echo str_pad($product['product_name'], 20, " ") . " | ";
    //         echo str_pad($product['price'], 10, " ", STR_PAD_LEFT) . " | ";
    //         echo str_pad($product['quantity'], 5, " ", STR_PAD_LEFT) . " | ";
    //         echo $product['description'] . "\n";
    //         echo str_repeat("-", 50) . "\n";
    //     }
?>