<?php
  require_once('conn.php');

  $username = $_POST['username'];
  $password =password_hash($_POST['password'],PASSWORD_DEFAULT);

  $stmt = $conn->prepare('INSERT INTO k1325699_blog_users(username , password) VALUES(?,?)');
  $stmt->bind_param('ss',$username,$password);
  $result = $stmt->execute();
  if(!$result){
    die($conn->error);
  }
  header('Location:register.php');
?>