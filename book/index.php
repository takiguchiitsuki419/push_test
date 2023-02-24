<?php 
// require_once __DIR__ . '/login_check.php'; 
   if(!isset($_SESSION)) session_start();
 
require_once __DIR__ . '/inc/functions.php';
include __DIR__ . '/inc/header.php';


$get =[];
if(!empty($_GET))
    foreach ($_GET as $key => $value) {
        $get[$key] = htmlspecialchars( $value , ENT_QUOTES);
    }

try {
    $dbh = db_open();

    $sql = 'SELECT count(*) as cnt FROM books'; //データ件数を数える
    $page = $dbh->prepare($sql);
    $page->execute();
    $max = $page->fetch()['cnt'] ;
 

    $sql = 'SELECT * FROM books WHERE 1 '; // 本を検索する
    $sql .= array_key_exists('title', $get) && !empty(  $get['title']) ? "AND title LIKE '%$get[title]%' " : ''; //タイトルの部分一致
    $sql .= array_key_exists('isbn', $get)  && !empty(  $get['isbn']) ? "AND isbn = $get[isbn] " : '';//ISBN 
    $sql .= array_key_exists('price', $get) && !empty(  $get['price']) ? "AND price = $get[price] " : '';//値段
    $sql .= array_key_exists('publish', $get) && !empty($get['publish']) 
    ? "AND DATE_FORMAT(publish , '%Y-%m') = DATE_FORMAT('$get[publish]', '%Y-%m') " : ''; //出版日
    $sql .= array_key_exists('author', $get) && !empty( $get['author']) ? "AND author LIKE '%$get[author]%' " : '';  //著者
    $sql .= " ORDER BY id ";
    $sql .= empty($_GET['p']) ? " LIMIT 0,5" : " LIMIT $_GET[p],5";
    

    $statement = $dbh->prepare($sql);
    $statement->execute();
?>

<div>
    <h2>本を検索できます</h2>
    <form action="" method="get">
        <label>タイトル</label><input type="text" name="title" value="<?=!empty( $get['title']  ) ? $get['title']   :'' ?>" >
        <label>ISBN</label><input type="text" name="isbn"      value="<?=!empty( $get['isbn']  ) ?  $get['isbn']  :'' ?>">
        <label>値段</label><input type="text" name="price"     value="<?=!empty( $get['price']  ) ? $get['price']   :'' ?>" >
        <label>出版日</label><input type="text" name="publish" value="<?=!empty( $get['publish']) ? $get['publish'] :'' ?>" >
        <label>著者</label><input type="text" name="author"    value="<?=!empty( $get['author'] ) ? $get['author']  :'' ?>" >
        <label></label><input type="submit" value="検索">
    </form>
</div>
<table>
<tr><th>更新</th><th>書籍名</th><th>ISBN</th><th>価格</th><th>出版日</th><th>著者名</th></tr>
    <?php while ($row = $statement->fetch()): ?>
    <tr>
        <td><a href="edit.php?id=<?php echo (int) $row['id']; ?>">更新</a></td>
        <td><?php echo str2html($row['title']) ?></td>
        <td><?php echo str2html($row['isbn']) ?></td>
        <td><?php echo str2html($row['price']) ?></td>
        <td><?php echo str2html($row['publish']) ?></td>
        <td><?php echo str2html($row['author']) ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php
} catch (PDOException $e) {
    echo "エラー!: " . str2html($e->getMessage());
    exit;
}

    $pagein = 5;  //ipageに表示する件数  ↓5増やす
    for( $i=0 ; $i <= $max ; $i += $pagein )
        echo "<a class='btn' href='./?p=$i'>" , $i/$pagein +1,"</a>";
                            //          
 
 
?>





<?php include __DIR__ . '/inc/footer.php';