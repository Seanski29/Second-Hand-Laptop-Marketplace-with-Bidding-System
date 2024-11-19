<?php
require 'server/connection.php';
require 'server/crud.php'; // Ensure this file contains the User class

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a database connection
    $database = new Database();
    $db = $database->getConnection();  // Correct method to get the connection

    // Instantiate the User object
    $user = new User($db);

    // Clean and assign the data from the form
    $user->user_name = htmlspecialchars(trim($_POST['name']));
    $user->user_email = htmlspecialchars(trim($_POST['email']));
    $user->user_password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Don't forget to hash the password!

    // Try to create the user in the database
    if ($user->create()) {
        // User was successfully created, show success message
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Success</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            title: 'Success!',
            text: 'User was successfully registered!',
            icon: 'success'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php'; // Redirect after success
            }
        });
        </script>
        </body>
        </html>";
    } else {
        // If the creation failed, show an error
        echo "<div class='alert alert-danger mt-3'>Error: Unable to register user. Please try again.</div>";
    }
}
?>
