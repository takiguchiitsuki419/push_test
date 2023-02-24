<?php
  session_start();
  $token = bin2hex(random_bytes(20));
  $_SESSION['token'] = $token;
?>
<!-- Bootstrapを読み込んでください -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

<form action='add-user.php' method='post'>
    <p>
        <label for=''>ユーザー名:</label>
        <input type='text' id="username" name='username'>
    </p>
    <p>
        <label for=''>パスワード:</label>
        <input type='text' name='password'>
    </p>

    <p class='button'>
      <input type='hidden' name='token' value='<?php echo $token ?>'>
      <input type='submit' value=' 送信する'>
    </p>
</form>

<script src="https://code.jquery.com/jquery-3.6.3.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
		$(function() {
			$("#username").change(function() {
				$.ajax({
						url: "select-user.php",         //行き先のURL
						type: "POST",                //HTTP送信メソッド
						data: {username : $("#username").val()}, // 送る値
						dataType: "html",            // 受け取るデータの型
						timeout: 2000,              // 応答時間のタイムアウト
					})
					.done(function( res ) {
							console.log(res ); // 成功した場合,phpから受け取った値がコンソールにでる
              $("#username").after(res);
					})
					.fail(function(jqXHR, textStatus, errorThrown) {
						console.log(jqXHR.status); // 失敗した場合 例：404
						console.log(textStatus); //例：error
						console.log(errorThrown); //例：NOT FOUND
					})
					// .always(function() {
					// 	console.log("complete"); // complete
					// });
			});
		});
	</script>
<?php include __DIR__ . '/inc/footer.php'; ?>

