<?php
  session_start();
  require_once('conn.php');

  $id = intval($_GET['id']);
  
  if($_SESSION['username']){
    $stmt = $conn->prepare('UPDATE k1325699_blog_articles SET is_deleted = 1 WHERE id = ?');
    $stmt->bind_param('i',$id);
    $result = $stmt->execute();
    if(!$result){
      die($conn->error);
    }
  }
  header('Location:admin.php');
?>