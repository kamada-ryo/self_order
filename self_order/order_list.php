<?php
  session_start();

  
  if(!empty($_POST['key'])){
    if(!empty($_SESSION['order'])){
      $total=0;
      foreach($_SESSION['order'] as $id => $order){ ?>
        <tr>
          <td class="menu-photo"><img src="../images/<?= $id ?>.jpg" class="img-fluid"></td>
          <td><span><?=$order['name']?><br><?=$order['count']?>個</span></td>
          <td><span>小計<br>\<?=$order['count']*$order['price']?></span></td>
          <td class="cancel"><input type="button" class="btn text-white bg-primary text-center btn-sm" data-id="<?=$id?>" value="削除"></td>
        </tr>
      <?php
        $total += $order['count']*$order['price'];
      } ?>
        
          <tr>
            <td></td>
            <td></td>
            <td><span class="text-left">合計<br>\<?=$total?></span></td>
            <td id="confirm">
              <a href="order_input.php" class="btn text-white bg-primary text-center btn-sm">確定</a>
            </td>
          </tr>
        
    <?php
    }else{ ?>
      <tr><td class="text-center">注文リストには何も入っていません</td></tr>
  <?php
    }
  }
  ?>

<?php
  $msg='';
  if(!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['count'])){
   
    //注文リスト追加処理
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
  }

  if(!empty($_POST['cancel'])){
    //キャンセル処理
    unset($_SESSION['order'][$_POST['cancel']]);
    $msg='<p>注文リストから削除しました</p>';
  }
?>