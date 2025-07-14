<!-- newをAIにはかせる-->
<!-- (->)の理解 -->
<!-- PDOExceptionとは？ -->
<!-- コメントアウトする$stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY id DESC"); -->
<!-- <thead>とは -->

<?php
//session開始
session_start();

//関数群の読み込み
include("funcs.php");
sschk();

//データ登録SQL作成
$pdo = db_conn();
$sql = "SELECT * FROM gs_bm_table";
// $stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY id DESC");
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

$view = "";
if ($status == false) {
  $error = $stmt->errorInfo();
  exit("SQL_Error: " . $error[2]);
} else {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= "<tr>";
    $view .= "<td>" . htmlspecialchars($row["name"], ENT_QUOTES) . "</td>";
    $view .= "<td><a href='" . htmlspecialchars($row["URL"], ENT_QUOTES) . "' target='_blank'>リンク</a></td>";
    $view .= "<td>" . htmlspecialchars($row["comment"], ENT_QUOTES) . "</td>";
    $view .= "<td>" . htmlspecialchars($row["datetime"], ENT_QUOTES) . "</td>";
    $view .="<td><a href='detail.php?id=" . $row["id"] . "'class='btn btn-primary btn-sm'>編集</a></td>";
    $view .="<td><a href='delete.php?id=" . $row["id"] . "' onclick=\"return confirm('本当に削除しますか？');\" class='btn btn-danger btn-sm'>削除</a></td>";
    $view .= "</tr>";
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登録ブックマーク一覧</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>div{padding: 10px;font-size: 16px;}</style>
</head>
<body id="main">
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
            <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
            </div>
            </div>
        </nav>
    </header>

    <div>
        <div class="container jumotron">
            <h2>登録済みブックマーク一覧</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>書籍名</th>
                        <th>url</th>
                        <th>コメント</th>
                        <th>登録日時</th>
                        <th>編集</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $view ?>
                </tbody>
            </table>
        </div>
    </div>    

</body>
</html>