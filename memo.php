<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板</title>
    <link rel="stylesheet" href="stylesheet.css">

</head>
<body>
    <header>
        <h1>掲示版</h1>
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
        <a href="index.php">戻る</a>
    </article>



    </main>
</body>
</html>