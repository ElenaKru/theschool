<?php
session_start();
unset($_SESSION['admin_id']);
unset($_SESSION['name']);
session_destroy();
header("Location: login.php");
exit();
