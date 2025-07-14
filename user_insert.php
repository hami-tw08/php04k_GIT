<?php
// session_start();
include "funcs.php";
// sschk();

//POSTデータ取得
$name      = filter_input( INPUT_POST, "name");
$lid       = filter_input( INPUT_POST, "lid");
$lpw       = filter_input( INPUT_POST, "lpw");
$kanri_flg = filter_input( INPUT_POST, "kanri_flg");
    if ($kanri_flg === null || $kanri_flg === '') {
        $kanri_flg = 0; // 一般ユーザーにする
        }
$lpw       = password_hash($lpw, PASSWORD_DEFAULT);

//DB接続
$pdo = db_conn();

//データ登録SQL作成
$sql = "INSERT INTO gs_user_table(name,lid,lpw,kanri_flg,life_flg)VALUES(:name,:lid,:lpw,:kanri_flg,0)";
$stmt = $pdo->prepare($sql);
$stmt ->bindValue(':name', $name, PDO::PARAM_STR);
$stmt ->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt ->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt ->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$status = $stmt->execute();

//データ登録処理後
if($status == false){
    sql_error($stmt);
}else{
    redirect("login.php");
}