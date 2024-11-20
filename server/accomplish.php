<?php
session_start();
require_once 'connection.php';
require_once 'crud.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
    $database = new Database();
    $db = $database->getConnection();

    
    $user = new User($db);

  
    if (isset($_POST['register'])) {
        
        $user->user_name = htmlspecialchars(trim($_POST['name']));
        $user->user_email = htmlspecialchars(trim($_POST['email']));
        $user->user_password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

        
        if ($user->create()) {
            
            echo "
            <script>
                alert('Registration successful!');
                window.location.href = 'login.php';
            </script>";
        } else {
            echo "<script>alert('Error! Please try again.');</script>";
        }
    }

    
    if (isset($_POST['login'])) {
        
        $user->user_email = htmlspecialchars(trim($_POST['email']));
        $user->user_password = htmlspecialchars(trim($_POST['password']));

       
        if ($user->login()) {
          
            $_SESSION['user_email'] = $user->user_email;
            $_SESSION['user_name'] = $user->user_name; 

            echo "
            <script>
                alert('Login successful!');
                window.location.href = 'index.php';  
            </script>";
        } else {
            echo "<script>alert('Invalid login credentials. Please try again.');</script>";
        }
    }
}
?>
