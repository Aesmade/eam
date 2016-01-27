<?php
    session_start();

    $redirect_url = strpos($_SESSION['redirect_url'], 'profile.php') !== false ? 'index.php' : $_SESSION['redirect_url'];

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
    header('Location: ' . $redirect_url);
?>
