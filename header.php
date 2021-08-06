<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Self Order</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <style>
    body{ padding-top: 60px; font-family: Meiryo, "Hiragino Kaku Gothic ProN", sans-serif;}
    .menu td.menu-photo,.menu td.menu-form{ width: 35%;}
    .menu td.menu-info{ width: 30%; text-align: center;}
  </style>
  
</head>

<body>

  <?php
    //卓番の登録
    if(!empty($_GET['number'])){
      if(!isset($_SESSION['number'])){
        $_SESSION['number'] = $_GET['number'];
      } 
    }
    ?>
    <header>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="self_order.php">テーブル <?= isset($_SESSION['number']) ? $_SESSION['number'] : '' ; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="self_order.php">メニュー</a>
            <a class="nav-link" href="self_order.php">店員を呼ぶ</a>
            <a class="nav-link" href="self_order.php">会計</a>
          </div>
        </div>
      </div>
    </nav>
  </header>