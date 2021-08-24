<?php session_start();
if(!isset($_SESSION['customer'])){
  header('Location: customer_input.php');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Self Order</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  
  <link rel="stylesheet" href="../css/style.css">
  
  <?php
    $ua = $_SERVER['HTTP_USER_AGENT'];
    if( (strpos($ua,'iPhone')!==false) || (strpos($ua,'iPad')!==false) || (strpos($ua,'Android')!==false) ){
  ?>
    <style>
    body > div:last-of-type{
    z-index:0 !important;
    top:-500px !important;
    }
    </style>
  <?php } ?>


</head>

<body>


  <div id="toast1" class="toast mx-auto position-fixed fade hide start-50 translate-middle" data-bs-delay="1000" role="alert" aria-live="assertive" aria-atomic="true" style="z-index:2100000000">
    <div class="toast-body text-center">
      注文リストに追加しました｡
    </div>
  </div>

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
            <a class="nav-link" aria-current="page" href="self_order.php">メニュー</a>
            <a class="nav-link" href="order_log.php">注文履歴</a>
          </div>
        </div>
      </div>
    </nav>

    

  </header>