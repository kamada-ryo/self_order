<?php
include_once 'header.php';

include_once '../connect.php';

if(!empty($_SESSION['customer'])){
  $sql = $pdo->prepare('select r_product.product_id,product_name,product_price,count,status
  from r_order left join r_order_detail on r_order.order_id = r_order_detail.order_id
  left join r_product on r_order_detail.product_id = r_product.product_id
  where customer_id = ?');
  $sql->bindValue(1,$_SESSION['customer'],PDO::PARAM_INT);
  $sql->execute();

  $array = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

  <div>
    <table class="table">
      <thead>
        <tr>
          <td></td>
          <td>商品名</td>
          <td>価格</td>
          <td>個数</td>
          <td>提供状況</td>
        </tr>
      </thead>

      <tbody>
        
        <?php foreach($array as $key => $row){ ?>
        <tr>
          <td class="menu-photo"><img src="../images/<?= $row['product_id'] ?>.jpg" class="img-fluid"></td>
          <td><?= $row['product_name'] ?></td>
          <td><?= $row['product_price'] ?></td>
          <td><?= $row['count'] ?></td>
          <td><?= $row['status'] == 0 ? '未提供' : '提供済' ?></td>
        </tr>
        <?php } ?>
        
      </tbody>
    </table>
  </div>

<?php
}
include_once 'footer.php';
?>