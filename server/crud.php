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

    // Create user
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, email, password) VALUES (:name, :email, :password)";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->user_email = htmlspecialchars(strip_tags($this->user_email));
        $this->user_password = password_hash($this->user_password, PASSWORD_BCRYPT);

        // Bind values
        $stmt->bindParam(":name", $this->user_name);
        $stmt->bindParam(":email", $this->user_email);
        $stmt->bindParam(":password", $this->user_password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
