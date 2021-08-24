<?php
include_once 'header.php';

include_once '../connect.php';

$order_id=1;
foreach ($pdo->query('select max(order_id) from r_order') as $row) {
  $order_id=$row['max(order_id)']+1;
}
//トランザクション
try{
  $pdo->beginTransaction();
  $sql=$pdo->prepare('insert into `r_order` (order_id,customer_id,time) values(?,?,now())');
  $sql->bindValue(1,$order_id,PDO::PARAM_INT);
  $sql->bindValue(2,$_SESSION['customer'],PDO::PARAM_INT);
  $sql->execute();

  foreach ($_SESSION['order'] as $id => $order) {
    $sql=$pdo->prepare('insert into r_order_detail values(?,?,?,0)');
    $sql->bindValue(1,$order_id,PDO::PARAM_INT);
    $sql->bindValue(2,intval($id),PDO::PARAM_INT);
    $sql->bindValue(3,$order['count'],PDO::PARAM_INT);
    $sql->execute();
  }
  $pdo->commit();
  $msg = '注文が完了しました。ありがとうございます。';
  unset($_SESSION['order']);

}catch(Exception $e){
  //ロールバック
  $pdo->rollBack();
  //エラーとメッセージの表示
  $msg = 'エラーが発生しました｡';
}
?>

<!-- container -->
<div class="container">
<p><?=$msg?></p><br>
<a class="btn text-white bg-primary" href="self_order.php">戻る</a>
</div>
<!-- container -->

<?php include_once 'footer.php';?>