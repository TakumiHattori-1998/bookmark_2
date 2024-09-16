<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$url  = $_POST["url"];
$price = $_POST["price"];
$impression    = $_POST["impression"];


//2. DB接続します
//*** function化する！  *****************
include('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO books(name,url,price,impression,indate)VALUES(:name,:url,:price,:impression,sysdate())");
$stmt->bindValue(':name',   $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url',  $url,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':price',    $price,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':impression', $impression, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect('index.php');
}

