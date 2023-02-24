<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="style.css">
    <title>書籍データベース</title>
</head>
<body>
<header>
    <h1>書籍リスト</h1>
</header>
<body>
<div>
    <ul id='nav'>
        <li><a href="./">ホーム</a></li>
        <li><a href="./input.php">追加</a></li>
        <li><a href="<?=
        empty($_SESSION['login']) 
        ? './login.php">ログイン' 
        : './logout.php">ログアウト' ?></a></li>
    </ul>
</div>