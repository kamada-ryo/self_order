<?php session_start();

$msg = "";

if(!empty($_POST['token']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_SESSION['token'])){
  
  
  if (hash_equals($_SESSION['token'], $_POST['token'])) {
    
    include_once '../connect.php';
    $sql = $pdo->prepare('select * from r_user where login = ?');
    $sql->bindValue(1,$_POST['user'],PDO::PARAM_STR);
    $sql->execute();
    
    $result=$sql->fetch();
    if (password_verify($_POST['pass'],$result['password'])) {
      
      $_SESSION['user']=[
        'id'=>$result['user_id'],
        'name'=>$result['user_name'],
        'login'=>$result['login'],
        'pass'=>$result['password']
      ];
      
      header('Location: order_list.php');
    }else{
      $msg = 'ログイン名またはパスワードが違います｡';
    }
    
  }else{
    $msg = '不正なアクセスが検出されました｡';
  }

}elseif(isset($_SESSION['user']['id']) && isset($_SESSION['user']['name']) && isset($_SESSION['user']['login']) && isset($_SESSION['user']['pass'])){
  header('Location: admin.php');
}

// トークン生成
$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];
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

<body class="bg-light">


<?php
if($msg !== ""){ ?>

  <div id="toast1" class="toast mx-auto position-fixed fade hide start-50 translate-middle" data-bs-delay="5000" role="alert" aria-live="assertive" aria-atomic="true" style="z-index:2100000000">
    <div class="toast-body text-center">
        <p class="my-auto"><?= $msg ?></p>
    </div>
  </div>

<?php } ?>

  <main class="form-signin mt-5 bg-white border border-secondary text-center">

    <form action="" method="post">
      <h1 class="h3 mb-3 fw-normal">ログイン</h1>
      <label for="inputId" class="visually-hidden">User Name</label>
          <input type="text" name="user" class="form-control" id="inputId" placeholder="User Name" required autofocus="">
          <label for="inputPassword" class="visually-hidden">Password</label>
          <input type="password" name="pass" class="form-control" id="inputPassword" placeholder="Password" required>
          <input type="hidden" name="token" value="<?=$token?>">
      <button class="w-100 btn btn-lg btn-primary" type="submit">ログイン</button>
    </form>
  </main>



<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<script>
  $(window).on('load',function(){
  $('#toast1').toast('show');
});
  
</script>
</body>
</html>