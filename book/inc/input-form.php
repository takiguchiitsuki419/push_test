<form action="<?=$title ? 'update' :'add' ?>.php" method='post'>

<?php
    // ここでgetパラメータのidを取得します(あれば)
    // hidden 隠しフィールドにidをvalue値として入れる
    if( isset($_GET['id'])){
        echo "<input type='hidden' name='id' value='$_GET[id]'>" ;
       // この場合 "" '' で[]の中身を囲めない=囲まなくていい 
    // echo "<input type='hidden' value='{$_GET['id']}'>" ;
    }
?>

  <p>
      <label for='title'> タイトル（必須・200 文字まで）:</label>
      <input type='text' name='title' value="<?=$title ?? '' ?>">
  </p>
  <p>
      <label for='isbn'>ISBN（13 桁までの数字）:</label>
      <input type='text' name='isbn' value="<?=$isbn ?? '' ?>">
  </p>
  <p>
      <label for='price'> 定価（6 桁までの数字）:</label>
      <input type='text' name='price' value="<?=$price ?? '' ?>">
  </p>
  <p>
      <label for='published'> 出版日（YYYY-MM-DD 形式）:</label>
      <input type='text' name='publish' value="<?=$publish ?? '' ?>">
  </p>
  <p>
      <label for='author'> 著者（80 文字まで）:</label>
      <input type='text' name='author' value="<?=$author ?? '' ?>">
  </p>
      <p class='button'>
      <input type='submit' value=' 送信する'>
  </p>