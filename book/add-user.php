<?php
require_once __DIR__ . '/token_check.php';
require_once __DIR__ . '/inc/functions.php';
include __DIR__ . '/inc/header.php';

try {
    $dbh = db_open();
    $password = $_POST['password'] ;
		$password = password_hash( $password, PASSWORD_DEFAULT );
		$username = str2html($_POST['username']);

    $sql ="INSERT INTO users VALUES (NULL, ? , ?)";
    $stmt = $dbh->prepare($sql);
 
    $stmt->bindParam( 1, $username, PDO::PARAM_STR);
    $stmt->bindParam( 2, $password, PDO::PARAM_STR);
    $stmt->execute();

    echo "ユーザーが追加されました。<br>";
    echo "<a href='index.php'>リストへ戻る</a>";
} catch (PDOException $e) {
    echo "エラー!: " . str2html($e->getMessage()) . "<br>";
    exit;
}
?>
<?php include __DIR__ . '/inc/footer.php';

