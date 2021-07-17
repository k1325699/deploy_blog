<?php
  session_start();
  require_once('conn.php');
  
  if(empty($_POST['username'])||empty($_POST['password'])) {
    header('Location:login.php?errcode=1');
    die("資料不齊全");
  }

  $username = $_POST['username'];
  $password = $_POST['password'];


  $stmt = $conn-> prepare('SELECT * FROM k1325699_blog_users WHERE username = ?');
  $stmt ->bind_param('s', $username);
  $result = $stmt ->execute();
  if(!$result){
    die($conn->error);
  }
  $result =$stmt->get_result();
  $row = $result->fetch_assoc();

  if (password_verify($password,$row['password'])){
    $_SESSION['username'] = $username;
  }else{
    header('Location:login.php?errcode=2');
    die("帳號或密碼錯誤");
  }
  header('Location:admin.php');
?>