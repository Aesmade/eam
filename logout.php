<?php
    session_start();

    $redirect_url = $_SESSION['redirect_url'] == '/eam/profile.php?' ? 'index.php' : $_SESSION['redirect_url'];

    // Unset all of the session variables.
    $_SESSION = array();

    // Destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
    header('Location: ' . htmlspecialchars($redirect_url));
?>
