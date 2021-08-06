<?php include_once 'header.php';

    $msg='';
    //注文リスト追加処理
    if(!empty($_POST['name']) && !empty($_POST['id']) && !empty($_POST['count'] &&!empty($_POST['price']))){
      $id=$_POST['id'];

      //オーダーがないときセッションデータにオーダーを保存する配列を定義
      if(!isset($_SESSION['order'])){
        $_SESSION['order']=[];
      }

      $count=0;
      if(isset($_SESSION['order'][$id])){
        $count=$_SESSION['order'][$id]['count'];
      }
      
      $_SESSION['order'][$id]=[
        'name'=>$_POST['name'],'count'=>$count+$_POST['count'],'price'=>$_POST['price']
      ];
      
      $msg='<p>注文リストに追加しました</p>';

    }elseif(!empty($_GET['cancel'])){
      //キャンセル処理
      unset($_SESSION['order'][$_GET['cancel']]);
      $msg='<p>注文リストから削除しました</p>';
    }
    ?>

  <?php include_once 'connect.php';?>


<!-- container -->
  <div class="container">

  <!-- tab-list -->
    <div class="tabcontainer" style="background-color: white;width: 100%;height: 60px;position: fixed;top: 56px;">
      <ul class="nav nav-tabs bg-white" id="myTab" role="tablist" style="position:fixed">

        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#list-1" role="tab" aria-controls="home" aria-selected="true">前菜</a>
        </li>
    
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#list-2" role="tab" aria-controls="profile" aria-selected="false">一品料理</a>
        </li>
    
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#list-3" role="tab" aria-controls="contact" aria-selected="false">デザート</a>
        </li>
    
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#list-4" role="tab" aria-controls="profile" aria-selected="false">ドリンク</a>
        </li>
    
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#list-5" role="tab" aria-controls="contact" aria-selected="false">注文リスト</a>
        </li>
    
      </ul>
    </div>
  <!-- tab-list -->
    
  <!-- tab-contents -->
    <div class="tab-content mt-5 pt-5" id="myTabContent">

    <!-- リストへの追加･削除のメッセージ -->
      <div>
          <?=$msg?>
      </div>

    <!-- list-1 -->
      <div class="tab-pane fade show active" id="list-1" role="tabpanel" aria-labelledby="home-tab">
        
        <table class="table menu">

      
          <?php
          $sql=$pdo->prepare('select id,name,price from ryouri where category=?');
          $sql->execute(['Appetizer']);
          foreach ($sql as $row) {;?>

          <tr>
          
            <td class="menu-photo"><p><img src="images/<?= $row['id'] ?>.jpg" class="img-fluid"></p></td>

            <td class="menu-info"><p><?= $row['name'] ;?></p><p>\<?= $row['price'];?></p></td>
            
            <td class="menu-form">
              <form action="" method="post">
                <p>
                  <select name="count">
                    <?php for ($i=1; $i <= 10; $i++) { 
                      echo '<option value ="',$i,'">',$i,'</option>';
                    } ?>
                  </select>個
                </p>
                <input type="hidden" name="id" value="<?= $row['id']?>">
                <input type="hidden" name="name" value="<?= $row['name']?>">
                <input type="hidden" name="price" value="<?= $row['price']?>">
              
                <input type="submit" value="リストへ追加" class="btn text-white bg-primary">
              </form>
            </td>

          </tr>
        <?php } ?>

        </table>
      </div>
    <!-- list-1 -->

    <!-- list-2 -->
      <div class="tab-pane fade" id="list-2" role="tabpanel" aria-labelledby="contact-tab">
        <table class="table menu">
          <?php
          $sql=$pdo->prepare('select id,name,price from ryouri where category=?');
          $sql->execute(['Dish']);
          foreach ($sql as $row) {;?>

          <tr>

            <td class="menu-photo"><p><img src="images/<?= $row['id'] ?>.jpg" class="img-fluid"></p></td>

            <td class="menu-info"><p><?= $row['name'] ;?></p><p>\<?= $row['price'];?></p></td>
            
            <td class="menu-form">
              <form action="" method="post">
                <p><select name="count">
                  <?php for ($i=1; $i <= 10; $i++) { 
                    echo '<option value ="',$i,'">',$i,'</option>';
                  } ?>
                </select>個</p>
                <input type="hidden" name="id" value="<?= $row['id']?>">
                <input type="hidden" name="name" value="<?= $row['name']?>">
                <input type="hidden" name="price" value="<?= $row['price']?>">
              
                <input type="submit" value="リストへ追加" class="btn text-white bg-primary">
              </form>
            </td>

          </tr>
          <?php } ?>

        </table>
      </div>
    <!-- list-2 -->

    <!-- list-3 -->
      <div class="tab-pane fade" id="list-3" role="tabpanel" aria-labelledby="contact-tab">
      <table class="table menu">
      <?php
      $sql=$pdo->prepare('select id,name,price from ryouri where category=?');
      $sql->execute(['Dessert']);
      foreach ($sql as $row) {;?>

        <tr>

          <td class="menu-photo"><p><img src="images/<?= $row['id'] ?>.jpg" class="img-fluid"></p></td>

          <td class="menu-info"><p><?= $row['name'] ;?></p><p>\<?= $row['price'];?></p></td>
          
          <td class="menu-form">
            <form action="" method="post">
              <p><select name="count">
                <?php for ($i=1; $i <= 10; $i++) { 
                  echo '<option value ="',$i,'">',$i,'</option>';
                } ?>
              </select>個</p>
              <input type="hidden" name="id" value="<?= $row['id']?>">
              <input type="hidden" name="name" value="<?= $row['name']?>">
              <input type="hidden" name="price" value="<?= $row['price']?>">
            
              <input type="submit" value="リストへ追加" class="btn text-white bg-primary">
            </form>
          </td>

        </tr>
      <?php } ?>

        </table>
      </div>
    <!-- list-3 -->
    
    <!-- list-4 -->
      <div class="tab-pane fade" id="list-4" role="tabpanel" aria-labelledby="contact-tab">
      <table class="table menu">
      <?php
      $sql=$pdo->prepare('select id,name,price from ryouri where category=?');
      $sql->execute(['Drink']);
      foreach ($sql as $row) {;?>

        <tr>

          <td class="menu-photo"><p><img src="images/<?= $row['id'] ?>.jpg" class="img-fluid"></p></td>

          <td class="menu-info"><p><?= $row['name'] ;?></p><p>\<?= $row['price'];?></p></td>
          
          <td class="menu-form">
            <form action="" method="post">
              <p><select name="count">
                <?php for ($i=1; $i <= 10; $i++) { 
                  echo '<option value ="',$i,'">',$i,'</option>';
                } ?>
              </select>個</p>
              <input type="hidden" name="id" value="<?= $row['id']?>">
              <input type="hidden" name="name" value="<?= $row['name']?>">
              <input type="hidden" name="price" value="<?= $row['price']?>">
            
              <input type="submit" value="リストへ追加" class="btn text-white bg-primary">
            </form>
          </td>

        </tr>
      <?php } ?>

        </table>
      </div>
    <!-- list-4 -->

    <!-- list-5 -->
      <div class="tab-pane fade" id="list-5" role="tabpanel" aria-labelledby="profile-tab">

        <table class="table">
          <tr><th><h5>注文リスト</h5></th></tr>

          <?php
          if(!empty($_SESSION['order'])){
            $total=0;
            foreach($_SESSION['order'] as $id => $order){ ?>
              <tr>
                <td><?=$order['name']?></td>
                <td><?=$order['count']?>個</td>
                <td>小計 <span>\<?=$order['count']*$order['price']?></span></td>
                <td> <a href="?cancel=<?=$id?>" class="btn text-white bg-primary">キャンセル</a> </td>
              </tr>
            <?php
              $total += $order['count']*$order['price'];
            } ?>
              <caption>
                <tr>
                  <td></td>
                  <td></td>
                  <td><span class="text-left">合計 \ <?=$total?></span></td>
                  <td><a href="self_order_output.php" class="btn text-white bg-primary text-center">確定する</a></td>
                </tr>
              </caption>
          <?php }else{ ?>
            <caption>注文リストには何も入っていません</caption>
          <?php } ?>

        </table>
      </div>
    <!-- list-5 -->



    </div>
  <!-- tab-contents -->
  </div>
<!-- container -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>