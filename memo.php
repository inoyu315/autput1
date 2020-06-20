<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メモアプリ</title>
    <link rel="stylesheet" href="stylesheet.css">

</head>
<body>
    <header>
        <h1>メモアプリ</h1>
    </header>
    <main>
    <?php
   require('dbconnect.php');

    //idが数字ではない時・0以下の数字の時の処理
    $id = $_REQUEST['id'];
    if (!is_numeric($id) || $id <= 0) {
        print '１以上の数字で指定してください';
        exit();
    }

    //URLパラメーターを処理し、SQLにURLパラメーターの値を入れる(memoを表示させるため)
    $memos = $db->prepare('SELECT * FROM memos WHERE id=?');
    $memos->execute(array($id));
    //($_REQUEST...idの部分を置き換えるパラメーター)
    $memo = $memos->fetch();
    ?>

    <article>
        <?php print($memo['memo']); ?><br><br>
        <a href="update.php?id=<?php print($memo['id']); ?>">編集する</a>
        |
        <a href="delete.php?id=<?php print($memo['id']); ?>">削除する</a>
        |
        <a href="index.php">一覧に戻る</a>
    </article>



    </main>
</body>
</html>