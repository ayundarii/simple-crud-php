<?php
    include PROJECT_ROOT . '/model/product.php';

    class ProductController {
        private $model;
    
        public function __construct(){
            $this->model = new Product();
        }

        public function createProduct($data) {
            return $this->model->createProduct($data);
        }

        public function getProducts() {
            return $this->model->getProducts();
        }

        public function getDeletedProducts() {
            return $this->model->getDeletedProducts();
        }
        
        public function getProductById($id) {
            return $this->model->getProductById($id);
        }
    
        public function updateProduct($id, $data) {
            return $this->model->updateProduct($id, $data);
        }
    
        public function deleteProduct($id) {
            return $this->model->softDelete($id);
        }

        public function deleteMultipleProducts($ids) {
            return $this->model->multipleDelete($ids);
        }

        public function restoreData($ids) {
            return $this->model->restoreData($ids);
        }
    }
?>