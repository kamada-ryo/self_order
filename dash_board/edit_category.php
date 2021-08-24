<?php
session_start();

if(!isset($_SESSION['user']['id']) && !isset($_SESSION['user']['name']) && !isset($_SESSION['user']['login']) && !isset($_SESSION['user']['pass'])){

  header('Location: login.php');

}

include_once '../connect.php';

$msg = "" ;

if(!empty($_POST['update_category'])){
  try{
    $sql = $pdo->prepare('update r_category set 
    category_name = ?, category_slug = ?, category_display = ?
    where category_id = ?');
    $sql->bindValue(1,$_POST['name'],PDO::PARAM_STR);
    $sql->bindValue(2,$_POST['slug'],PDO::PARAM_STR);
    $sql->bindValue(3,$_POST['display'],PDO::PARAM_INT);
    $sql->bindValue(4,$_POST['id'],PDO::PARAM_INT);
    $sql->execute();
    $msg = 'カテゴリを更新しました';
  }catch (PDOException $Exception) {
    $msg = 'エラーが発生しました｡';
  }
}

if(!empty($_POST['add_category'])){
  try{
    $sql = $pdo->prepare('insert into r_category
    (category_id,category_name,category_slug,category_display)
    values(?,?,?,?)');
    $sql->bindValue(1,$_POST['id'],PDO::PARAM_INT);
    $sql->bindValue(2,$_POST['name'],PDO::PARAM_STR);
    $sql->bindValue(3,$_POST['slug'],PDO::PARAM_STR);
    $sql->bindValue(4,$_POST['display'],PDO::PARAM_INT);
    $sql->execute();
    $msg = 'カテゴリを追加しました';
  }catch (PDOException $Exception) {
    $msg = 'エラーが発生しました｡';
  }
}

if(!empty($_POST['delete_category'])){
  try{
    $sql = $pdo->prepare('delete from r_category where category_id = ?');
    $sql->bindValue(1,$_POST['id'],PDO::PARAM_INT);
    $sql->execute();
    $msg = 'カテゴリを削除しました';
  }catch (PDOException $Exception) {
    $msg = 'エラーが発生しました｡';
  }
}

$active = 'edit';
$edit = 'category';

include_once 'header.php';

?>

<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
  <ul class="edit-list">
    <li>
      <div class="row">
        <div class="col-10">
          <div class="row text-center">
            <div class="col-4">カテゴリ名</div>
            <div class="col-4">スラッグ</div>
            <div class="col-2">表示</div>
          </div>
        </div>
      </div>
    </li>

    
<?php 
    $display0 = '';
    $display1 = '';

    $next_id=1;

    foreach ($pdo->query('select max(category_id) from r_category') as $row) {
      $next_id=$row['max(category_id)']+1;
    }

    foreach($pdo->query('select * from r_category') as $row){

      if($row['category_display'] == '0'){
        $display0='selected';
      }else{
        $display1='selected';
      } ?>

    
        <li class="pt-2 pb-1 border-bottom border-secondary">
          <div class="row text-center">

            <div class="col-10">
              <form action="" method="post">
                <div class="row">
                  <input type="hidden" name="update_category" value="category">
                  <input type="hidden" name="id" value="<?=$row['category_id']?>">

                  <div class="col-4"><input type="text" name="name" value="<?=$row['category_name']?>" required class="w-100"></div>
                  <div class="col-4"><input type="text" name="slug" pattern="^[0-9A-Za-z]+$" value="<?=$row['category_slug']?>" required class="w-100"></div>
                  
                  
                  <div class="col-2">
                    <select name="display" class="w-100">
                      <option value="0" <?= $display0 ?>>非表示</option>
                      <option value="1" <?= $display1 ?>>表示</option>
                    </select>
                  </div>
                  
                  <div class="col-2 text-right"><input type="submit" class="btn btn-primary btn-sm" value="変更"></div>
                </div>
              </form>
            </div>

            <div class="col-2 text-left">

                  <form action="" method="post" id="delete-category-<?=$row['category_id']?>">
                    <div>
                      <input type="hidden" name="delete_category" value="category">
                      <input type="hidden" name="id" value="<?=$row['category_id']?>">
                      <input type="button" class="btn btn-primary btn-sm delete" value="削除">
                    </div>
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
                  <input type="hidden" name="add_category" value="category">
                  <input type="hidden" name="id" value="<?= $next_id ?>">

                  <div class="col-4"><input type="text" name="name" value="" class="w-100" required></div>
                  <div class="col-4"><input type="text" name="slug" pattern="^[0-9A-Za-z]+$" value="" class="w-100" required></div>
                  
                  
                  <div class="col-2">
                    <select name="display" class="w-100">
                      <option value="0">非表示</option>
                      <option value="1">>表示</option>
                    </select>
                  </div>
                  
                  <div class="col-2 text-right"><input type="submit" class="btn btn-primary btn-sm" value="追加"></div>
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