<?php
    include 'include/php/db_connect.php';

    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $md5_password = md5($password);

        $stmt = $db->prepare("SELECT id, first_name, last_name FROM `User` where email = ? and password = ?");
        $stmt->bind_param('ss', $email, $md5_password);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user, $first_name, $last_name);
            $stmt->fetch();
            $_SESSION['user'] = $user;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $email;
        } else {
            $_SESSION['login_error'] = true;
        }
        $stmt->free_result();
        $stmt->close();
        $db->close();
    }

    // Redirect to the home page.
    header('Location: ' . htmlspecialchars($_SESSION['redirect_url']));
    exit();
?>
