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
?>