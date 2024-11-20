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

        try {
            
            if ($stmt->execute()) {
                return true;
            } else {
                
                $error = $stmt->errorInfo();
                echo "Error executing query: " . $error[2];
            }
        } catch (PDOException $exception) {
            
            echo "Error: " . $exception->getMessage();
        }

        return false; 
    }

    
    public function login() {
        // SQL query to get the user's password from the database using the email
        $query = "SELECT user_id, user_name, user_password FROM " . $this->table_name . " WHERE user_email = :email LIMIT 1";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->user_email);
    
        try {
            // Execute the query
            $stmt->execute();
    
            // Fetch the user data
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Check if row is valid (i.e., it's an array and not false)
            if ($row && is_array($row)) {
                // The user exists, now verify the password
                if (password_verify($this->user_password, $row['user_password'])) {
                    // If password matches, set user session data
                    $this->user_name = $row['user_name'];  // Store the user's name from the db
                    return true; // Successfully logged in
                } else {
                    // Password does not match
                    return false; // Invalid credentials
                }
            } else {
                // User doesn't exist
                return false; // Invalid credentials (user not found)
            }
        } catch (PDOException $exception) {
            // Handle exceptions (errors with the database)
            echo "Error: " . $exception->getMessage();
        }
    
        return false; // Default return false if anything goes wrong
    }
}
?>