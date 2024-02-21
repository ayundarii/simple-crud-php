<?php
    include PROJECT_ROOT . '/model/product.php';

    class ProductController {
        private $model;
    
        public function __construct(){
            $this->model = new Product();
        }

        public function createProduct($data, $table) {
            if (empty($data) || !is_array($data)) {
                return false;
            }
            return $this->model->createProduct($data, $table);
        }

        public function getProducts($table, $param) {
            return $this->model->getProducts($table, $param);
        }

        public function getDeletedProducts($table, $param) {
            return $this->model->getDeletedProducts($table, $param);
        }
        
        public function getProductById($id, $table) {
            return $this->model->getProductById($id, $table);
        }
    
        public function updateProduct($id, $data, $table) {
            return $this->model->updateProduct($id, $data, $table);
        }

        public function deleteMultipleProducts($ids, $table, $param) {
            return $this->model->multipleDelete($ids, $table, $param);
        }

        public function restoreData($ids, $table, $param) {
            return $this->model->restoreData($ids, $table, $param);
        }
    }
?>