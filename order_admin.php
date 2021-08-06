<?php include_once 'header.php';?>
<?php include_once 'connect.php';?>
<div>
  <table class="table">
  <tr>
    <th>テーブル</th>
    <th>商品名</th>
    <th>数量</th>
    <th>注文日時</th>
    <th>状況</th>
  </tr>

  <?php
    $sql=$pdo->prepare(
      'select table_num,name,count,time,status from
      order_detail left join `order`
      on order_detail.order_id = `order`.order_id
      left join ryouri
      on product_id = ryouri.id
      having status = ?;
      ');
    $sql->execute([0]);
    foreach ($sql as $row) {;?>

    <tr>
    
      <td><?=$row['table_num']?></td>

      <td><?=$row['name']?></td>
      
      <td><?=$row['count']?></td>

      <td><?=$row['time']?></td>
      
      <td><?=$row['status'] == '0' ? '未完了': '完了'?></td>
    </tr>
  <?php } ?>


        </table>
      </div>

      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>