<?php
  session_start();
  require_once('conn.php');

  if(empty($_POST['title'])||empty($_POST['content'])) {
    header('Location:edit.php?errcode=1');
    die('資料不齊全');
  }

  $title = $_POST['title'];
  $content =$_POST['content'];

  if($_SESSION['username']){
    $stmt = $conn->prepare('INSERT INTO k1325699_blog_articles(title , content) VALUES(?,?)');
    $stmt->bind_param('ss',$title,$content);
    $result = $stmt->execute();
    if(!$result){
      die($conn->error);
    }
  }
  header('Location:admin.php');
?>