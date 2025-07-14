<?php
session_start();

//SESSIONを初期化
$_SESSION = array();

//cookieに保存しているsessionIDの保存期間を過去にして破棄
if (isset($_COOKIE[session_name()])){
    setcookie(session_name(),'',time()-42000,'/');
}

//サーバー側でのsessionIDの破棄
session_destroy();

//処理後、rogin.phpへリダイレクト
header("Location: login.php");
exit();
?>