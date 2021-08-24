<?php include_once 'header.php'; ?>
<?php include_once '../connect.php'; ?>
<?php
  $category = $pdo->query('select * from r_category where category_display=1');
?>


<!-- container -->
<div class="container">


<!-- tab-list -->
  <div class="tabcontainer">
    <ul class="nav nav-tabs bg-white" id="myTab" role="tablist">

      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="order-list-tab" data-bs-toggle="tab" href="#list-0" role="tab" aria-controls="order-list" aria-selected="true">注文リスト</a>
      </li>
  
  <?php foreach($category as $row){ ?>
  
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="<?=$row['category_slug']?>-tab" data-bs-toggle="tab" href="#list-<?=$row['category_id']?>" role="tab" aria-controls="<?=$row['category_slug']?>" aria-selected="false"><?=$row['category_name']?></a>
      </li>
  
  <?php } ?>

    </ul>
  </div>
<!-- tab-list -->
  
<!-- tab-contents -->
  <div class="tab-content" id="myTabContent">


      <div class="tab-pane fade show active" id="list-0" role="tabpanel" aria-labelledby="order-list-tab">
  
        <table class="table">
          <caption class="caption-top">注文リスト</caption>
          <tbody id="order-list">
          </tbody>
        </table>
      </div>

<!-- category-tab -->
  <?php $category = $pdo->query('select * from r_category where category_display=1'); ?>
  <?php foreach($category as $row){ ?>
    <div class="tab-pane fade" id="list-<?=$row['category_id']?>" role="tabpanel" aria-labelledby="<?=$row['category_slug']?>-tab">
      <table class="table menu">

    
        <?php
        $array_product=$pdo->prepare('select product_id,product_name,product_price,product_display from r_product where category_id=?
        and product_display >= 1');
        $array_product->execute([$row['category_id']]);
        foreach ($array_product as $product) { ?>

        <tr class="<?= $product['product_display'] == 2 ? 'stop' : '' ?>">
        
          <td class="menu-photo"><img src="../images/<?= $product['product_id'] ?>.jpg" class="img-fluid"></td>

          <td class="menu-info"><p><?= $product['product_name'] ;?></p><p>\<?= $product['product_price'];?></p></td>
          
          <td class="menu-form">
            <form>
              <input type="hidden" name="id" value="<?= $product['product_id']?>">
              <input type="hidden" name="name" value="<?= $product['product_name']?>">
              <input type="hidden" name="price" value="<?= $product['product_price']?>">

              <p>
                <select name="count">
                  <?php for ($i=1; $i <= 10; $i++) { 
                    echo '<option value ="',$i,'">',$i,'</option>';
                  } ?>
                </select>個
              </p>

              <input type="button" id="product-<?= $product['product_id']?>" class="btn text-white bg-primary btn-sm" value="リストへ追加">
            </form>
          </td>

        </tr>
      <?php } ?>

      </table>
    </div>
  <?php } ?>
<!-- category-tab -->

  </div>
<!-- tab-contents -->

</div>
<!-- container -->

    


  
  
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<script src="../js/order.js"></script>
</body>
</html>