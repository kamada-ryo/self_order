<?php
$dbname="";
$host="";
$user="";
$pass="";
$mydb='mysql:dbname='.$dbname.';host='.$host.';charset=utf8';

try{
  
  $pdo=new PDO($mydb,$user,$pass);
  //データベースへ接続

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //PDOのエラーモードの追加

  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  // 構文チェックと実行を分離したままにする 必須

  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  // メモリ効率がいい

} catch (PDOException $e) {
  die('ConneCt Error: ' .$e->getCode());
  //DB接続エラー時の処理
}
