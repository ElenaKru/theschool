<?php
require_once '../controllers/adminController.php';
session_start();
if(isset($_SESSION['admin_id'])){
header("Location: index.php"); exit();

}
$error = '';
if(isset($_POST['submit'])){
    AdminController::Login($_POST['email'], $_POST['password']);
    if(isset($_SESSION['admin_id'])){
        header("Location: index.php"); exit();
    }else{
        $error = 'Wrong email or password!';
    }
}
?>

<html>
<body>
<span style="color:red;">
<?php
echo $error;
?>
</span>

<form method="POST">
    login       <input name="email" type="text"><br>
    password    <input name="password" type="password"><br>
                <input name="submit" type="submit" value="login">

</form>
</body>
</html>