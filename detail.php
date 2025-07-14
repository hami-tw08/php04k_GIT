<?php
include("funcs.php");
//php
$id = $_GET['id'];
$pdo = db_conn();

//データ取得SQL作成
$sql = "SELECT * FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt ->bindvalue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
$values = "";
if($status==false) {
    sql_error($stmt);
}
$row = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>データ修正</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>div{padding: 10px;font-size: 16px;}</style>
</head>

<body>
<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand" href="select.php">入力情報更新欄</a></div>
        </div>
    </nav>
</header>

<form method="POST" action="insert.php">
    <div class="jumbotron">
        <fieldset>
            <legend>入力情報の更新</legend>
            <label>書籍名：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
            <label>URL:<input type="text" name="URL" value="<?=$row["name"]?>"></label><br>
            <label><textArea name="comment" rows="4" cols="40"><?=$row["comment"]?></textArea></label><br>
            <input type="hidden" name="id" value="<?=$row["id"]?>">
            <input type="submit" value="更新">
        </fieldset>
    </div>
</form>

</body>
</html>