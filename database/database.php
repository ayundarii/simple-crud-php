<?php
include PROJECT_ROOT . '/config/config.php';

    class Database {
        private $host;
        private $username;
        private $password;
        private $dbname;
        private $conn;
    
        public function __construct() {
            $this->host = DB_HOST;
            $this->username = DB_USERNAME;
            $this->password = DB_PASSWORD;
            $this->dbname = DB_NAME;
            $this->connect();
        }
    
        private function connect() {
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "Connection Succesful";
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                exit(); 
            }
        }

        public function getProducts() {
            try {
                $stmt = $this->conn->query("SELECT * FROM products WHERE is_deleted = 0");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error getting product: ".$e->getMessage();
            }
        }

        public function getProductsById($id) {
            try {
                $stmt = $this->conn->prepare("SELECT id, product_name, price, quantity, description FROM products WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "Error getting product: " . $e->getMessage();
            }
        }

        public function create($data) {
            try {
                $columns = implode(', ', array_keys($data));
                $values = ':' . implode(', :', array_keys($data));
                $sql = "INSERT INTO products ($columns) VALUES ($values)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute($data);
                return true;
            } catch (PDOException $e) {
                echo "Error creating product: " . $e->getMessage();
                return false;
            }
        }

        public function delete($id) {
            try{
                $stmt = $this->conn->prepare("DELETE FROM products WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute([$id]);
                return true;
            } catch (PDOException $e) {
                echo "Error deleting product: ".$e->getMessage();
                return false;
            }
            
            $this->conn = null;
        }

        public function softDelete($id) {
            try{
                $stmt = $this->conn->prepare("UPDATE products SET is_deleted = 1 WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error deleting record: ".$e->getMessage();
                return false;
            }
            
            $this->conn = null;
        }

        public function restoreData($listIds){
            try {
                $placeholders = implode(',', array_fill(0, count($listIds), '?'));
                $stmt = $this->conn->prepare("UPDATE products SET is_deleted = 0 WHERE id IN ($placeholders)");
                $stmt->execute($listIds);
                return true;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function multipleDelete($listIds) {
            try {
                $placeholders = implode(',', array_fill(0, count($listIds), '?'));
                $stmt = $this->conn->prepare("UPDATE products SET is_deleted = 1 WHERE id IN ($placeholders)");
                $stmt->execute($listIds);
                return true;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function update($id, $data) {
            try {
                $stmt = $this->conn->prepare("UPDATE products SET product_name = ?, price = ?, quantity = ?, description = ? WHERE id = ?");
                $stmt->execute([$data['product_name'], $data['price'], $data['quantity'], $data['description'], $id]);
                return true;
            } catch (PDOException $e) {
                echo "Error: ".$e->getMessage();
                return false;
            }
        }

        public function deletedDatas(){
            try {
                $stmt = $this->conn->query("SELECT * FROM products WHERE is_deleted = 1");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: ".$e->getMessage();
            }
        }
    }

    // try {
    //     global $db;

    //     $db = new Database();
    //     $products = $db->getProducts();
    //     foreach ($products as $product) {
    //         echo str_pad($product['product_name'], 20, " ") . " | ";
    //         echo str_pad($product['price'], 10, " ", STR_PAD_LEFT) . " | ";
    //         echo str_pad($product['quantity'], 5, " ", STR_PAD_LEFT) . " | ";
    //         echo $product['description'] . "\n";
    //         echo str_repeat("-", 50) . "\n";
    //     }
    // } catch (PDOException $e) {
    //     echo "Database connection failed: " . $e->getMessage();
    //     exit(); 
    // }
?>