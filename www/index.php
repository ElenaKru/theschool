<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php"); exit();
}
?>

HELLO HOME PAGE

<a href="logout.php">logout</a>
