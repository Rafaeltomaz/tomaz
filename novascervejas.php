<?php
include('inc/common.php');
$con = newDbConnection();
$sql = $con->prepare('INSERT INTO user (name, email, password, active) VALUES (?,?,?,?)');
$name = $_POST['name'];
$email = $_POST['email'];
$password = sha1($_POST['password']);
$active = 1;
$sql->bind_param('sssi', $name, $email, $password, $active);
if (!$sql->execute()) {
    dd($sql->error);
}
header('location:index.php?p=user-form&success=1');