<?php
include_once '../connect.php';
  if(isset($_POST['status'])){
  $sql=$pdo->prepare('
  select table_num,product_name,count,r_order.`time`,
  r_order_detail.order_id,r_order_detail.product_id,r_order_detail.status from r_customer
  left join r_order on r_customer.customer_id = r_order.customer_id
  left join r_order_detail on r_order.order_id = r_order_detail.order_id
  left join r_product on r_order_detail.product_id = r_product.product_id
  where r_order_detail.status = ? order by r_order.time');
  $sql->bindValue(1,$_POST['status'],PDO::PARAM_INT);
  $sql->execute();

  foreach ($sql as $key) { ?>
    <tr>
      <td><?=$key['table_num']?></td>
      <td><?=$key['product_name']?></td>
      <td><?=$key['count']?></td>
      <td><?=$key['time']?></td>
      <td><?=$key['status'] == '0' ? '未提供': '提供済'?></td>
      <td><input type="button" class="btn btn-primary change-btn" data-order="<?=$key['order_id']?>" data-product="<?=$key['product_id']?>" data-status="<?=$key['status']?>" value="変更する"></td>
    </tr>
  <?php }

}?>


<?php
if(isset($_POST['order']) && isset($_POST['product']) && isset($_POST['change'])){
  $sql = $pdo->prepare('update r_order_detail set status = ? where order_id = ? and product_id = ?');
  $sql->bindValue(1,$_POST['change'],PDO::PARAM_INT);
  $sql->bindValue(2,$_POST['order'],PDO::PARAM_INT);
  $sql->bindValue(3,$_POST['product'],PDO::PARAM_INT);
  $sql->execute();
  echo '変更しました｡';
}
?>