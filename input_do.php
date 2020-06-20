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
        //input.htmlから飛んできた瞬間にこの処理が実行される(データベースに接続・memosに内容をSET)(created_at..登録ボタンをクリックした時刻が刻まれる)
        require('dbconnect.php');
        $statement = $db->prepare('INSERT INTO memos SET memo=?, created_at=NOW()');
        $statement->execute(array($_POST['memo']));
        echo 'メッセージが登録されました';
        ?>
       <br><br><a href="input.html">新しいメモを登録する</a>
       <a href="index.php">ホームに戻る</a>
    </main>
</body>
</html>