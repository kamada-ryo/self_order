<?php
session_start();

  if(!empty($_GET['number'])){

    if(!isset($_SESSION['number'])){
    $_SESSION['number'] = $_GET['number'];
    }
    
    include_once '../connect.php';
    
    //GETパラメータから卓番取得
    //r_customerテーブルから同じ卓番の最新の情報を取得
    $sql = $pdo->prepare('select * from r_customer where table_num = ? order by customer_id desc limit 1');
    $sql->execute([$_GET['number']]);
    $array = $sql->fetch(PDO::FETCH_ASSOC);

    $id = 0;
    //同じ卓番の最新の客の状態が1=支払い済み､あるいは存在しないとき
    if($array['status'] == 1 || empty($array)){
      //新しいcustomerをinsertする
      $new = $pdo->prepare('insert into r_customer(table_num,time,status) values(?,now(),0)');
      $new->execute([$_GET['number']]);

      $sql = $pdo->prepare('select * from r_customer where table_num = ? order by customer_id desc limit 1');
      $sql->bindValue(1,$_GET['number'],PDO::PARAM_INT);
      $sql->execute();
      $array = $sql->fetch(PDO::FETCH_ASSOC);
      //sessionに新しく作ったcustomer_idを入れておく
      $id = $array['customer_id'];

      //同じ卓番の最新の客の状態が0=未支払い､つまり別の端末からの再入場､
      //あるいはウィンドウ､アプリを閉じて再入場などのとき
    }elseif($array['status'] == 0){
      //そのまま同じ卓番の最新の客のcustomer_idを入れる
      $id=$array['customer_id'];
    }

    //sessionにcustomer_idを登録
    $_SESSION['customer'] = $id;
    
    //self_order.phpへリダイレクト
    header('Location: self_order.php');
    
  }elseif(isset($_SESSION['customer'])){
    header('Location: self_order.php');
  }else{ ?>

  <script>
  
    window.alert('エラーが発生しました｡QRコードの読み取りをやりなおしてください｡');
  
  </script>

  <?php } ?>



<?php include_once 'footer.php'; ?>