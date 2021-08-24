<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 5 Simple Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
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

<nav class="navbar navbar-light bg-light p-3">

  <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
    <a class="navbar-brand" href="#">
        Restaurant Dashboard
    </a>
    <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
  
  <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="ddb" data-toggle="dropdown" aria-expanded="false">
        こんにちは､<?= $_SESSION['user']['name'] ?>さん
      </button>
      <ul class="dropdown-menu" aria-labelledby="ddb">
        <li><a class="dropdown-item" href="#">設定</a></li>
        <li><a class="dropdown-item" href="logout.php">ログアウト</a></li>
      </ul>
    </div>
  </div>

</nav>



<div class="container-fluid">
  <div class="row">
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          
      <div class="position-sticky pt-md-5">
        <ul class="nav flex-column">
          <li class="nav-item border-top border-secondary">
            <a class="nav-link<?= $active == '' ? ' active' : '' ?>" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
              </svg>
              <span class="ml-2">ダッシュボード</span>
            </a>
          </li>

          <li class="nav-item border-top border-secondary">
            <a class="nav-link<?= $active == 'order_list' ? ' active' : '' ?>" href="order_list.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
              </svg>
              <span class="ml-2">注文一覧</span>
            </a>
          </li>
      
          <li class="nav-item border-top border-bottom border-secondary">
            <ul id="accordion_menu">
              <li class="border-bottom border-secondary">
                <a data-toggle="collapse" href="#menu01" aria-controls="#menu01" aria-expanded="false" class="nav-link<?= $active == 'edit' ? ' active' : '' ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg>
                  <span class="ml-2">編集</span>
                </a>
              </li>

              <li>
                <ul id="menu01" class="collapse<?= $active == 'edit' ? ' show' : '' ?>" data-parent="#accordion_menu">
                  <li class="nav-item border-bottom border-secondary"><a href="edit_category.php" class="nav-link<?= $active == 'edit' && $edit == 'category' ? ' active' : '' ?>"><span class="ml-2">カテゴリ編集</span></a></li>
                  <li class="nav-item border-bottom border-secondary"><a href="edit_product.php" class="nav-link<?= $active == 'edit' && $edit == 'product' ? ' active' : '' ?>"><span class="ml-2">商品編集</span></a></li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    
