<?php
    // Connect to database
    mysql_connect('localhost', 'root', 'root') or exit("Cannot connect to database!");
    mysql_select_db('eam') or exit("Cannot find database table.");
?>
