<?php
session_start();

if(!isset($_SESSION['user']['id']) && !isset($_SESSION['user']['name']) && !isset($_SESSION['user']['login']) && !isset($_SESSION['user']['pass'])){
  
  header('Location: login.php');
  
}

$msg = "" ;
include_once '../connect.php';

if(!empty($_POST['update_product'])){
  try{
    $sql = $pdo->prepare('update r_product set 
    product_name = ?, product_price = ?, category_id = ?, product_display = ?
    where product_id = ?');
    $sql->bindValue(1,$_POST['name'],PDO::PARAM_STR);
    $sql->bindValue(2,$_POST['price'],PDO::PARAM_INT);
    $sql->bindValue(3,$_POST['category'],PDO::PARAM_INT);
    $sql->bindValue(4,$_POST['display'],PDO::PARAM_INT);
    $sql->bindValue(5,$_POST['id'],PDO::PARAM_INT);
    $sql->execute();
    $msg = '商品情報を更新しました';
  }catch (PDOException $Exception) {
    $msg = 'エラーが発生しました｡';
  }
}

if(!empty($_POST['add_product'])){
  try{
    $sql = $pdo->prepare('insert into r_product
    (product_id,product_name,product_price,category_id,product_display)
    values (?,?,?,?,?)');
    $sql->bindValue(1,$_POST['id'],PDO::PARAM_INT);
    $sql->bindValue(2,$_POST['name'],PDO::PARAM_STR);
    $sql->bindValue(3,$_POST['price'],PDO::PARAM_INT);
    $sql->bindValue(4,$_POST['category'],PDO::PARAM_INT);
    $sql->bindValue(5,$_POST['display'],PDO::PARAM_INT);
    $sql->execute();
    $msg = '商品情報を追加しました';
  }catch (PDOException $Exception) {
    $msg = 'エラーが発生しました｡';
  }
}


if(!empty($_POST['delete_product'])){
  try{
  $sql = $pdo->prepare('delete from r_product where product_id = ?');
    $sql->bindValue(1,$_POST['id'],PDO::PARAM_INT);
    $sql->execute();
    $msg = '商品を削除しました';
  }catch (PDOException $Exception) {
    $msg = 'エラーが発生しました｡';
  }
}


$active = 'edit';
$edit = 'product';

include_once 'header.php';

?>


<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
  <ul class="edit-list">
    <li>
      <div class="row">
        <div class="col-10">
          <div class="row text-center">
            <div class="col-4">商品名</div>
            <div class="col-2">値段</div>
            <div class="col-2">カテゴリ</div>
            <div class="col-2">表示</div>
          </div>
        </div>
      </div>
    </li>

<?php 

    $category = [];
    
    $next_id=1;
    foreach ($pdo->query('select max(product_id) from r_product') as $row) {
      $next_id=$row['max(product_id)']+1;
    }

    foreach($pdo->query('select category_id,category_name from r_category') as $row){
      $category += [ $row['category_id'] => $row['category_name'] ];
    }

    foreach($pdo->query('select * from r_product') as $row){ ?>
    <?php

      $select0 = '';
      $select1 = '';
      $select2 = '';

      if($row['product_display'] == 0){
        $select0 = 'selected';
      }elseif($row['product_display'] == 1){
        $select1 = 'selected';
      }elseif($row['product_display'] == 2){
        $select2 = 'selected';
      } ?>

    <li class="pt-2 pb-1 border-bottom border-secondary">
      <div class="row text-center">
        <div class="col-10">
          <form action="" method="post">
            <div class="row">
              <input type="hidden" name="update_product" value="product">
              <input type="hidden" name="id" value="<?=$row['product_id']?>">

              <!-- 商品名 -->
              <div class="col-4">
                <input type="text" name="name" value="<?=$row['product_name']?>" required class="w-100">
              </div>

              <!-- 値段 -->
              <div class="col-2">
                <div class="row">
                  <div class="col-3" style="padding-right:0"><strong>\ </strong></div>
                  <div class="col-9" style="padding-left:0">
                    <input type="text" name="price" inputmode="numeric" pattern="[1-9][0-9]*" value="<?=$row['product_price']?>" required class="text-center w-100">
                  </div>
                </div>
              </div>
              
              <!-- カテゴリ -->
              <div class="col-2">
                <select name="category" class="w-100">
                  <?php foreach($category as $id => $name ){ ?>
              
                  <option value="<?= $id ?>" <?= $id == $row['category_id']? 'selected' : '' ?>>
                    <?= $name ?>
                  </option>

                  <?php } ?>
                </select>
              </div>

              <!-- 表示 -->
              <div class="col-2">
                <select name="display" class="w-100">
                  <option value="0" <?= $select0 ?>>非表示</option>
                  <option value="1" <?= $select1 ?>>表示</option>
                  <option value="2" <?= $select2 ?>>売り切れ</option>
                </select>
              </div>
              
              <!-- 変更 -->
              <div class="col-2 text-right">
                <input type="submit" class="btn btn-primary btn-sm" value="変更">
              </div>
            </div>

          </form>
        </div>

        <div class="col-2 text-left">
          <form action="" method="post" id="delete-product-<?=$row['product_id']?>">
            <input type="hidden" name="delete_product" value="product">
            <input type="hidden" name="id" value="<?=$row['product_id']?>">
            <input type="button" class="btn btn-primary btn-sm delete" value="削除">
          </form>
        </div>

      </div>
    </li>

    <?php } ?>



    <li class="pt-2 pb-1 border-bottom border-secondary">
      <div class="row text-center">
        <div class="col-10">
          <form action="" method="post">
            <div class="row">
              <input type="hidden" name="add_product" value="product">
              <input type="hidden" name="id" value="<?= $next_id ?>">
              
              <!-- 商品名 -->
              <div class="col-4">
                <input type="text" name="name" value="" required class="w-100">
              </div>

              <!-- 値段 -->
              <div class="col-2">
                <div class="row">
                  <div class="col-3" style="padding-right:0"><strong>\ </strong></div>
                  <div class="col-9" style="padding-left:0">
                  <input type="text" name="price" inputmode="numeric" pattern="[1-9][0-9]*" value="" required class="text-center w-100">
                  </div>
                </div>
              </div>
              
              <!-- カテゴリ -->
              <div class="col-2">
                <select name="category" class="w-100">
                  <?php foreach($category as $id => $name ){ ?>
              
                  <option value="<?= $id ?>">
                    <?= $name ?>
                  </option>

                  <?php } ?>
                </select>
              </div>

              <!-- 表示 -->
              <div class="col-2">
                <select name="display" class="w-100">
                  <option value="0" <?= $select0 ?>>非表示</option>
                  <option value="1" <?= $select1 ?>>表示</option>
                  <option value="2" <?= $select2 ?>>売り切れ</option>
                </select>
              </div>
              
              <!-- 変更 -->
              <div class="col-2 text-right">
                <input type="submit" class="btn btn-primary btn-sm" value="追加">
              </div>
            </div>

          </form>
        </div>

      </div>
    </li>

  </ul>
</main>

</div>
</div>

<?php if($msg !== ''){ ?>
  <div style="position:fixed;top:10%;left:50%;z-index:2100000000">
    <div id="toast1" class="toast position-fixed fade hide" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true" style="z-index:2100000000">
      <div class="toast-body text-center">
        <p class="my-auto fs-3" id="toast"><?=$msg?></p>
      </div>
    </div>
  </div>
<?php } ?>



  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- popper -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- bootstrap -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <script src="../js/admin.js"></script>
</body>
</html>