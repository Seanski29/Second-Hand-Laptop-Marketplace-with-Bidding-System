<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
session_start();
require_once 'connection.php';
require_once 'crud.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    // Registration Logic
    if (isset($_POST['register'])) {

        $user->user_name = htmlspecialchars(trim($_POST['name']));
        $user->user_email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
        $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));

        // Check if passwords match
        if ($password !== $confirm_password) {
            echo "
            <script>
                Swal.fire({
                    title: 'Password Mismatch!',
                    text: 'Passwords do not match. Please try again.',
                    icon: 'error'
                });
            </script>";
        }
        // Check if email already exists
        elseif ($user->emailExists()) {
            echo "<script>
                Swal.fire({
                    title: 'Email In Use!',
                    text: 'Email is already in use. Please use a different email address.',
                    icon: 'error'
                });
            </script>";
        }
        else {
            // Set the password using the setter method
            $user->setUserPassword($password);

            // Create the user
            if ($user->create()) {
                echo "
                <script>
                    Swal.fire({
                        title: 'Registration Successful!',
                        text: 'You can now log in.',
                        icon: 'success'
                    }).then(function() {
                        window.location.href = 'login.php';  // Redirect to login page after SweetAlert closes
                    });
                </script>";
            } else {
                echo "
                <script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Registration failed. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>";
            }
        }
    }

    // Login Logic
    if (isset($_POST['login'])) {

        $user->user_email = htmlspecialchars(trim($_POST['email']));
        $user_password = htmlspecialchars(trim($_POST['password'])); // Store the password in a local variable

        if ($user->login($user_password)) { // Pass the password to the login method
            $_SESSION['user_email'] = $user->user_email;
            $_SESSION['user_name'] = $user->user_name;
            $_SESSION['logged_in'] = true;

            echo "
            <script>
                Swal.fire({
                    title: 'Welcome!',
                    text: 'Login successful!',
                    icon: 'success',
                    confirmButtonText: 'Go to Home'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../index.php';  // Redirect to the main page
                    }
                });
            </script>";
        } else {
            echo "
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Invalid credentials. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            </script>";
        }
    }
}
?>