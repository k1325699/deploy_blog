<?php
  $server_name = "localhost:3306";
  $username = "root";
  $password = "as147258";
  $bd_name = "k1325699";

  $conn = new mysqli($server_name,$username,$password,$bd_name);

  if($conn->connect_error) {
    die("資料連線錯誤".$conn->connect_err);
  }
  $conn->query('SET NAMES UTF8');
  $conn->query('SET time_zone = "+8:00"');
?>