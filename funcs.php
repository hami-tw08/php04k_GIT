<!-- function db_connはdb_connの定義づけ？ -->
 <!-- try,catchの意味の確認 -->

<?php
//XSS対応
function h($str){
        return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn(){
    try {
        if($_SERVER["HTTP_HOST"] == 'localhost'){
            $db_name = "bookmark_db";
            $db_id   = "root";
            $db_pw   = "";
            $db_host = "localhost";
        }
        else{
            $db_name = "***";
            $db_id   = "***";
            $db_pw   = "***";
            $db_host = "***";
        }
        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);

    } catch (PDOException $e){
        exit('DB Connection Error:'.$e->getMessage());
    }
}

//SQLエラー
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//リダイレクト
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}
//SessionCheck
function sschk(){
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
        exit('LOGIN ERROR');
    } else {
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}