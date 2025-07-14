<?php
include("funcs.php");

//POSTデータ取得
$id = $_POST["id"];
$name = $_POST["name"];
$URL = $_POST["URL"];
$comment = $_POST["comment"];

//DB接続
$pdo = db_conn();

//データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET name=:name, URL=:URL, comment=:comment WHERE id=:id");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':URL', $URL, PDO::PARAM_STR);
$stmt->bindValue(':comment',$comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}