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

        public function getProducts($table, $param) {
            try {
                $stmt = $this->conn->query("SELECT * FROM $table WHERE $param = 0");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error getting product: ".$e->getMessage();
            }
        }

        public function getProductsById($id, $table) {
            try {
                $stmt = $this->conn->prepare("SELECT * FROM $table WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "Error getting product: " . $e->getMessage();
            }
        }

        public function create($data, $table) {
            try {
                $columns = implode(', ', array_keys($data));
                $values = ':' . implode(', :', array_keys($data));
                $sql = "INSERT INTO $table ($columns) VALUES ($values)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute($data);
                return true;
            } catch (PDOException $e) {
                echo "Error creating product: " . $e->getMessage();
                return false;
            }
        }

        public function restoreData($listIds, $table, $param){
            try {
                $placeholders = implode(',', array_fill(0, count($listIds), '?'));
                $stmt = $this->conn->prepare("UPDATE $table SET $param = 0 WHERE id IN ($placeholders)");
                $stmt->execute($listIds);
                return true;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function multipleDelete($listIds, $table, $param) {
            try {
                $placeholders = implode(',', array_fill(0, count($listIds), '?'));
                $stmt = $this->conn->prepare("UPDATE $table SET $param = 1 WHERE id IN ($placeholders)");
                $stmt->execute($listIds);
                return true;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }


        public function update($id, $data, $table) {
            try {
                $setColumns = '';
                foreach ($data as $key => $column) {
                    $setColumns .= "$key=:$key, ";
                }
            
                $setColumns = rtrim($setColumns, ', ');
                $sql = "UPDATE $table SET $setColumns WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
            
                foreach ($data as $key => $column) {
                    $stmt->bindValue(":$key", $column);
                }
                
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error: ".$e->getMessage();
                return false;
            }
        }

        public function deletedDatas($table, $param){
            try {
                $stmt = $this->conn->query("SELECT * FROM $table WHERE $param = 1");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: ".$e->getMessage();
            }
        }
    }
?>