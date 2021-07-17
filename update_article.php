<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  include_once('check_permission.php');
  $id = intval($_GET['id']);

  $stmt = $conn->prepare('SELECT * FROM k1325699_blog_articles WHERE id = ?');
  $stmt->bind_param('i',$id);
  $result = $stmt -> execute();
  if (!$result){
    die($conn->error);
  }
  $result = $stmt ->get_result();
  $row = $result->fetch_assoc();
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <nav class="navbar">
    <div class="wrapper navbar__wrapper">
      <div class="navbar__site-name">
        <a href='index.php'>Who's Blog</a>
      </div>
      <ul class="navbar__list">
        <div>
          <li><a href="all_article.php">文章列表</a></li>
          <li><a href="#">分類專區</a></li>
          <li><a href="#">關於我</a></li>
        </div>
        <div>
        <?php if(!empty($_SESSION['username'])) { ?>
          <li><a href="admin.php">管理後台</a></li>
          <li><a href="logout.php">登出</a></li>
          <?php }else{ ?>
          <li><a href="login.php">登入</a></li>
          <?php } ?>
        </div>
        </div>
      </ul>
    </div>
  </nav>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <form action="hand_update_article.php" method="POST">
          <input type="hidden" name="id" value = "<?php echo $_GET['id']; ?>">
          <div class="edit-post__title">
            發表文章：
          </div>
          <?php
            if(!empty($_GET['errcode'])){
              if ($_GET['errcode'] === '1'){
                echo '<h3 class = "error">資料不齊全</h3>';
              }
            }
          ?>
          <div class="edit-post__input-wrapper">
            <input class="edit-post__input" name="title" value="<?php echo $row['title']; ?>" />
          </div>
          <div class="edit-post__input-wrapper">
            <textarea rows="20" class="edit-post__content" name = "content"><?php echo $row['content']; ?></textarea>
          </div>
          <div class="edit-post__btn-wrapper">
              <input type="submit" value="送出" class="edit-post__btn">
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>