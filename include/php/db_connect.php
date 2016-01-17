<?php
    $db = new mysqli('localhost', 'root', 'root', 'eam');

    if ($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    if (!$db->set_charset("utf8")) {
        die('Error loading character set utf8: %s\n' . $mysqli->error);
    }
?>
