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

    // REGISTER LOGIC IS LOGICING
    if (isset($_POST['register'])) {

        $user->user_name = htmlspecialchars(trim($_POST['name']));
        $user->user_email = htmlspecialchars(trim($_POST['email']));
        $user->user_password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash PASSWORD

        if ($user->create()) {
            echo "
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Registration successful!',
                    icon: 'success',
                    confirmButtonText: 'Proceed to Login'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';  // Redirect to login after confirmation
                    }
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

    // Login LOIGIGIBGLogic
    if (isset($_POST['login'])) {

        $user->user_email = htmlspecialchars(trim($_POST['email']));
        $user->user_password = htmlspecialchars(trim($_POST['password']));

        if ($user->login()) {
            $_SESSION['user_email'] = $user->user_email;
            $_SESSION['user_name'] = $user->user_name;

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
                    title: 'Invalid Credentials',
                    text: 'Incorrect email or password. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../login.php';  // Redirect back to login page
                    }
                });
            </script>";
        }
    }
}
?>
