<?php
include PROJECT_ROOT . '/database/database.php';

//preparasi kolom dan data yg didpatkan di controller, database evaluate data
    class Product {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }
    
        public function getProducts($table){
            return $this->db->getProducts($table);
        }

        public function getDeletedProducts($table){
            return $this->db->deletedDatas($table);
        }
        
        public function createProduct($data, $table) {
            return $this->db->create($data, $table);
        }
    
        public function getProductById($id, $table) {
            return $this->db->getProductsById($id, $table);
        }
    
        public function updateProduct($id, $data, $table) {
            return $this->db->update($id, $data, $table);
        }

        public function multipleDelete($ids, $table) {
            return $this->db->multipleDelete($ids, $table);
        }

        public function restoreData($ids, $table) {
            return $this->db->restoreData($ids, $table);
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