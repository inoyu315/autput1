<?php require('dbconnect.php'); ?>
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
    if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $memos = $db->prepare('SELECT * FROM memos WHERE id=?');
    $memos->execute(array($id));
    $memo = $memos->fetch();
    }

    ?>

        <form action="update_do.php" method="post">
            <input type="hidden" name="id" value="<?php print($id); ?>">
            <textarea name="memo" cols="50" rows="10"><?php print($memo['memo']); ?></textarea><br>
            <button type="submit">登録</button><br><br>
            <a href="memo.php?id=<?php print($memo['id']); ?>">戻る</a>
        </form>
    </main>
</body>
</html>