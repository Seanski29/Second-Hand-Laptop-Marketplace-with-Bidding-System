<?php
class User {
    private $conn;
    private $table_name = "users"; // Your users table in the database

    public $user_id;
    public $user_name;
    public $user_email;
    public $user_password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new user (example)
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (user_name, user_email, user_password) 
                  VALUES (:user_name, :user_email, :user_password)";

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->user_email = htmlspecialchars(strip_tags($this->user_email));
        $this->user_password = password_hash($this->user_password, PASSWORD_BCRYPT); // Encrypt the password

        // Bind data
        $stmt->bindParam(":user_name", $this->user_name);
        $stmt->bindParam(":user_email", $this->user_email);
        $stmt->bindParam(":user_password", $this->user_password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read user by email for login
    public function readByEmail() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_email = :user_email LIMIT 1";
        $stmt = $this->conn->prepare($query);

        // Bind the email parameter
        $stmt->bindParam(":user_email", $this->user_email);

        $stmt->execute();

        return $stmt;
    }
}
?>
