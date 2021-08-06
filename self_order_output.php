<?php include_once 'header.php';

    include_once 'connect.php';

    $order_id=1;
      foreach ($pdo->query('select max(order_id) from `order`') as $row) {
        $order_id=$row['max(order_id)']+1;
      }

    //トランザクション
    try{
      $pdo->beginTransaction();
      $sql=$pdo->prepare('insert into `order` (order_id,table_num,time) values(?,?,now())');
      $sql->bindValue(1,$order_id,PDO::PARAM_INT);
      $sql->bindValue(2,$_SESSION['number'],PDO::PARAM_INT);
      $sql->execute();
      foreach ($_SESSION['order'] as $id => $order) {
        $sql=$pdo->prepare('insert into order_detail values(?,?,?)');
        $sql->bindValue(1,$order_id,PDO::PARAM_INT);
        $sql->bindValue(2,intval($id),PDO::PARAM_INT);
        $sql->bindValue(3,$order['count'],PDO::PARAM_INT);
        $sql->execute();
      }
      $pdo->commit();
      $msg = '<p>注文が完了しました。ありがとうございます。</p><br><a class="btn text-white bg-primary" href="self_order.php">戻る</a>';
      unset($_SESSION['order']);

    }catch(Exception $e){
      //ロールバック
      $pdo->rollBack();
      //エラーとメッセージの表示
      die("error :".$e->getMessage());
    }
    ?>

<!-- container -->
  <div class="container">
    <?=$msg?>
  </div>
<!-- container -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>