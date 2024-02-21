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

        public function getProducts($table) {
            return $this->model->getProducts($table);
        }

        public function getDeletedProducts($table) {
            return $this->model->getDeletedProducts($table);
        }
        
        public function getProductById($id, $table) {
            return $this->model->getProductById($id, $table);
        }
    
        public function updateProduct($id, $data, $table) {
            return $this->model->updateProduct($id, $data, $table);
        }
    
        public function deleteProduct($id, $table) {
            return $this->model->softDelete($id, $table);
        }

        public function deleteMultipleProducts($ids, $table) {
            return $this->model->multipleDelete($ids, $table);
        }

        public function restoreData($ids, $table) {
            return $this->model->restoreData($ids, $table);
        }
    }
?>