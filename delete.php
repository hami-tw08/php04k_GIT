<?php
//POSTデータ取得
$id = $_GET["id"];

//DB接続
include("funcs.php");
$pdo = db_conn();

//データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id=:id");
$stmt ->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}