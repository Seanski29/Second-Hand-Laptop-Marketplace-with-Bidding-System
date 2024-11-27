<?php
class User {
    private $conn;
    private $table_name = "users"; 

    public $user_name;
    public $user_email;
    public $user_password;
    
   

    

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function create() {
        if (empty($this->user_name) || empty($this->user_email) || empty($this->user_password)) {
            return false; 
        }

        $query = "INSERT INTO " . $this->table_name . " (user_name, user_email, user_password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($query);

        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->user_email = htmlspecialchars(strip_tags($this->user_email));
        $this->user_password = password_hash($this->user_password, PASSWORD_BCRYPT); 
        
        $stmt->bindParam(":name", $this->user_name);
        $stmt->bindParam(":email", $this->user_email);
        $stmt->bindParam(":password", $this->user_password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function login() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        $this->user_email = htmlspecialchars(strip_tags($this->user_email));
        $stmt->bindParam(":email", $this->user_email);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($this->user_password, $row['user_password'])) {
                $this->user_name = $row['user_name'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
}

class products {
    private $conn;
    private $table_name = "users"; 
    public $product_id;
    public $product_name;
    public $product_description;
    public $product_image;
    public $starting_price;
    public $bid_deadline;
   
    public function __construct($db) {
        $this->conn = $db;
    }
    public function sell() {
        // Ensure all fields are provided
        if (empty($this->product_name) || empty($this->product_description) || empty($this->product_image) || empty($this->starting_price) || empty($this->bid_deadline)) {
            return false; 
        }
    
        // Prepare the insert query
        $query = "INSERT INTO " . $this->table_name . " (product_name, product_description, product_image, starting_price, bid_deadline) 
                  VALUES (:name, :description, :image, :price, :deadline)";
        $stmt = $this->conn->prepare($query);
    
        // Sanitize and bind parameters
        $this->product_name = htmlspecialchars(strip_tags($this->product_name));
        $this->product_description = htmlspecialchars(strip_tags($this->product_description));
        $this->product_image = htmlspecialchars(strip_tags($this->product_image));  // Assuming $product_image is a file path or URL
        $this->starting_price = htmlspecialchars(strip_tags($this->starting_price)); // Ensure numeric values are properly handled
        $this->bid_deadline = htmlspecialchars(strip_tags($this->bid_deadline)); // Assuming this is in a valid date format
    
        // Bind parameters
        $stmt->bindParam(":name", $this->product_name);
        $stmt->bindParam(":description", $this->product_description);
        $stmt->bindParam(":image", $this->product_image);
        $stmt->bindParam(":price", $this->starting_price);
        $stmt->bindParam(":deadline", $this->bid_deadline);
    
        // Execute and return success or failure
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
}

    


?>