<?php
session_start();
require('dbconnect.php');

if (!empty($_POST)) {
    if ($_POST['email'] !== '' && $_POST['password'] !== '') {
        $login = $db->prepare('SELECT * FROM members WHERE email=? AND password=?');
        $login->execute(array(
            $_POST['email'],
            sha1($_POST['password'])
        ));
        $member = $login->fetch();

        if ($member) {
            $_SESSION['id'] = $member['id'];
            $_SESSION['time'] = time();
            
            header('Location: index.php');
            exit();
        } else {
            $error['login'] = 'failed';
        }
    } else {
        $error['login'] = 'blank';
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ログイン</title>

	<link rel="stylesheet" href="stylesheet.css" />
</head>
<body>
<div class="header">
        
        <div class="header-list">
            <ul>
            <li><a href="login.php">ログイン</a></li>
            <li><a href="join/index.php">会員登録</a></li>
            </ul>
        </div>
    </div>


</div>

<div id="content">
<form action="" method="post">
<h1>ログイン</h1>
	<input type="hidden" name="action" value="submit" />

    <p class="index">★メールアドレス<span>必須</span></p>
    <input type="email" name="email" style="font-size: 140%; width: 300px; border-radius: 10px;" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?> ">
    <?php if ($error['login'] == 'blank'): ?>
    <p class="error">メールアドレスとパスワードをご記入ください</p>
    <?php endif; ?>
    <?php if ($error['login'] == 'failed'): ?>
    <p class="error">ログインに失敗しました。正しくご記入ください</p>
    <?php endif; ?>


	<p class="index">★パスワード<span>必須</span></p>
    <input type="password" name="password" style="font-size: 140%; width: 300px; border-radius: 10px;" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>">
   <br><br>

   <input type="submit" value="ログインする">

</form>
</div>

</div>
</body>
</html>
