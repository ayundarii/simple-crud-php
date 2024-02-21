<?php
include PROJECT_ROOT . '/database/database.php';

//preparasi kolom dan data yg didpatkan di controller, database evaluate data
    class Product {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }
    
        public function getProducts($table, $param){
            return $this->db->getProducts($table, $param);
        }

        public function getDeletedProducts($table, $param){
            return $this->db->deletedDatas($table, $param);
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

        public function multipleDelete($ids, $table, $param) {
            return $this->db->multipleDelete($ids, $table, $param);
        }

        public function restoreData($ids, $table, $param) {
            return $this->db->restoreData($ids, $table, $param);
        }
    }
?>