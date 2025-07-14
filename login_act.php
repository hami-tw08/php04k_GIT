<?php
session_start();

//POST値
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

//DB接続
include("funcs.php");
$pdo = db_conn();

//データ登録SQL作成。パスワードhash化
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid=:lid");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//SQL実行時にエラーがあればストップ
if($status==false){
    sql_error($stmt);
}

//抽出データ数を取得
$val = $stmt->fetch();

//該当レコードがあれば、SESSIONに値を代入
$pw = password_verify($lpw, $val["lpw"]);
if($pw){
    //LOGIN成功時
    $_SESSION["chk_ssid"]  = session_id();
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["name"]      = $val['name'];
    redirect("select.php");
}else{
    //LOGIN失敗時
    redirect("login.php");
}
exit();