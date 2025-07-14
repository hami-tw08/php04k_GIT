<!-- !issetは何？→不適切な外部入力をはじく、安定化において重要な関数 -->
<!-- ||の意味を確認→or,またはの意味 -->
<!-- $name = $_POST['name'];、$と$_の使い分けは？ -->
<!-- ini_setとは？ -->
<!--     exit("SQL_Error::".$error[2]);の::と.$の意味を確認する -->
<?php
ini_set("display_errors",1);
include("funcs.php");

// POSTデータのチェック、POSTデータ取得
if(
    !isset($_POST['name'])|| $_POST['name'] === '' ||
    !isset($_POST['URL'])|| $_POST['URL'] === '' ||
    !isset($_POST['comment'])|| $_POST['comment'] === '' 
){
    exit('ParamError: 必要なデータがPOSTされていません。');
}

$name = $_POST['name'];
$URL = $_POST['URL'];
$comment = $_POST['comment'];

$pdo = db_conn();

//データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(name,URL,comment,datetime)VALUES(:name,:URL, :comment, sysdate());");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':URL', $URL, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();

//データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}

// funcs登場前。
// if($status==false){
//     $error = $stmt->errorInfo();
//     exit("SQL_Error::".$error[2]);
// }else{
//     header("Location: select.php");
//     exit();
// }
?>