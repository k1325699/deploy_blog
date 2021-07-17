<?php
  session_start();
  require_once('conn.php');

  
  $title = $_POST['title'];
  $content =$_POST['content'];
  $id = intval($_POST['id']);
  
  if(empty($_POST['title'])||empty($_POST['content'])) {
    header('Location:update_article.php?errcode=1&id='. $id);
    die('資料不齊全');
  }
  
  if($_SESSION['username']){
    $stmt = $conn->prepare('UPDATE k1325699_blog_articles SET title = ?, content = ? WHERE id = ?');
    $stmt->bind_param('ssi',$title,$content,$id);
    $result = $stmt->execute();
    if(!$result){
      die($conn->error);
    }
  }
  header('Location:article.php?id=' . $id);
?>