<?php
session_start();
require('../dbconnect.php');

if (!isset($_SESSION['join'])) {
    header('Location: index.php');
    exit();
}

if (!empty($_POST)) {
    $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, created=NOW()');
    echo $statement->execute(array(
        $_SESSION['join']['name'],
        $_SESSION['join']['email'],
        sha1($_SESSION['join']['password'])
    ));
    unset($_SESSION['join']);

    header('Location: thanks.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>会員登録</title>

	<link rel="stylesheet" href="../stylesheet.css" />
</head>
<body>
<div class="header">
        
        <div class="header-list">
            <ul>
            <li><a href="../login.php">ログイン</a></li>
            <li><a href="index.php">会員登録</a></li>
            </ul>
        </div>
    </div>


</div>

<div id="content">
<form action="" method="post">
<h1>会員登録</h1>
	<input type="hidden" name="action" value="submit" />

		<p class="check">★ニックネーム</p>
        <?php print(htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)); ?>

		<p class="check">★メールアドレス</p>
        <?php print(htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?>

		<p class="check">★パスワード</p>
		【パスワードは表示されません】
        <br><br>
		

	<div><a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="登録する" /></div>
</form>
</div>

</div>
</body>
</html>
