<?php 
  class Post {
    // DB stuff
    private $conn;
    private $table = 'posts';

    // Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                                FROM ' . $this->table . ' p
                                LEFT JOIN
                                  categories c ON p.category_id = c.id
                                ORDER BY
                                  p.created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                                    FROM ' . $this->table . ' p
                                    LEFT JOIN
                                      categories c ON p.category_id = c.id
                                    WHERE
                                      p.id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->title = $row['title'];
          $this->body = $row['body'];
          $this->author = $row['author'];
          $this->category_id = $row['category_id'];
          $this->category_name = $row['category_name'];
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->body = htmlspecialchars(strip_tags($this->body));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));

          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':body', $this->body);
          $stmt->bindParam(':author', $this->author);
          $stmt->bindParam(':category_id', $this->category_id);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET title = :title, body = :body, author = :author, category_id = :category_id
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->body = htmlspecialchars(strip_tags($this->body));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':body', $this->body);
          $stmt->bindParam(':author', $this->author);
          $stmt->bindParam(':category_id', $this->category_id);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }