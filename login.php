<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/main.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>div{padding: 10px;font-size: 16px;}</style>
    <title>ログイン</title>
</head>
<body>
    
<header>
    <nav class="navbar navbar-default">LOGIN</nav>
</header>

<!-- login_act.php（認証処理用php）との接続 -->
<form name="form1" action="login_act.php" method="post">
    ID:<input type="text" name="lid">
    PW:<input type="password" name="lpw">
    <input type="submit" value="ログイン"> 
</form>

<div style="margin-top: 20px;">
    <p>ユーザー登録はこちらから</p>
    <a href="user.php" class="btn btn-primary">ユーザー登録</a>
</div>
</body>
</html>