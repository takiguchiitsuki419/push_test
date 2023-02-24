<?php
function str2html(string $string) :string {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
function db_open() :PDO { //タイプヒントでPDO 型を指定
    $user = "itsuki0419_root";
    $password = "itsuki0419"; //P172 で生成したパスワードを入力
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
    ];
    $dbh = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=itsuki0419_root', $user, $password, $opt);
    return $dbh; //返り値を返す
}