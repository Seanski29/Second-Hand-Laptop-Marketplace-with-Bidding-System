<?php
class User {
    private $conn;
    private $table_name = "users"; 

    public $user_name;
    public $user_email;
    public $address;
    private $user_password; // Make password private
    public $product_id;
    public $product_name;
    public $product_description;
    public $product_image;
    public $starting_price;
    public $bid_deadline;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Getter and Setter methods for user_password
    public function getUserPassword() {
        return $this->user_password;
    }

    public function setUserPassword($user_password) {
        $this->user_password = password_hash($user_password, PASSWORD_BCRYPT);
    }

    public function create() {
        if (empty($this->user_name) || empty($this->user_email) || empty($this->address) || empty($this->user_password)) {
            return false; 
        }

        $query = "INSERT INTO " . $this->table_name . " (user_name, user_email, address, user_password) VALUES (:name, :email, :address, :password)";
        $stmt = $this->conn->prepare($query);

        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->user_email = htmlspecialchars(strip_tags($this->user_email));
        $this->address = htmlspecialchars(strip_tags($this->address));
        
        $stmt->bindParam(":name", $this->user_name);
        $stmt->bindParam(":email", $this->user_email);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":password", $this->user_password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function login($password) {
        $query = "SELECT user_name, user_email, user_password FROM " . $this->table_name . " WHERE user_email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->user_email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if (password_verify($password, $row['user_password'])) {
                $this->user_name = $row['user_name'];
                $this->user_email = $row['user_email'];
                return true;
            }
        }

        return false;
    }

    public function emailExists() {
        $query = "SELECT user_id FROM " . $this->table_name . " WHERE user_email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->user_email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }

    // Sell a product (insert into products table)
    public function sell($product_name, $product_description, $starting_price, $bid_deadline, $file) {
        // Directory for storing uploaded images
        $target_dir = "assets/images/";
        $file_name = basename($file["name"]);
        $target_file = $target_dir . uniqid() . "_" . $file_name; // Unique file name

        // Allowed file types and size limit
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        $max_file_size = 2 * 1024 * 1024; // 2MB

        // Validate file
        if (!in_array(mime_content_type($file["tmp_name"]), $allowed_types)) {
            return "Invalid file type. Only JPG, JPEG, and PNG files are allowed.";
        }
        if ($file["size"] > $max_file_size) {
            return "File size exceeds the 2MB limit.";
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            return "Failed to upload the file.";
        }

        // Insert product into the database
        $query = "INSERT INTO products (product_name, product_description, product_image, starting_price, bid_deadline) VALUES (:product_name, :product_description, :product_image, :starting_price, :bid_deadline)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':product_description', $product_description);
        $stmt->bindParam(':product_image', $target_file);
        $stmt->bindParam(':starting_price', $starting_price);
        $stmt->bindParam(':bid_deadline', $bid_deadline);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    
    //crud.php
    // Delete a product
    public function deleteProduct($product_id, $user_id) {
        $query = "DELETE FROM products WHERE product_id = :product_id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }

    // Edit a product
    public function editProduct($product_id, $product_name, $product_description, $starting_price, $bid_deadline) {
        $query = "UPDATE products SET product_name = :product_name, product_description = :product_description, starting_price = :starting_price, bid_deadline = :bid_deadline WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':product_description', $product_description);
        $stmt->bindParam(':starting_price', $starting_price);
        $stmt->bindParam(':bid_deadline', $bid_deadline);
        $stmt->bindParam(':product_id', $product_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read($user_id) {
        $query = "SELECT user_name, user_email, address, user_password FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->user_name = $row['user_name'];
            $this->user_email = $row['user_email'];
            $this->address = $row['address'];
            $this->user_password = $row['user_password']; // Assuming password is already hashed
        }
    }
}
?>