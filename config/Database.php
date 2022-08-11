<?php 
  class Database {
    // DB Params
    private $host = "sql6.freesqldatabase.com";
    private $db_name = "sql6512306";
    private $username = "sql6512306";
    private $password = "Ya1c99w8PJ";
    private $conn;
    
    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }
