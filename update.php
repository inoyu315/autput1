<?php require('dbconnect.php'); ?>
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
    if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $memos = $db->prepare('SELECT * FROM memos WHERE id=?');
    $memos->execute(array($id));
    $memo = $memos->fetch();
    }

    ?>

        <form action="update.php" method="post">
            <textarea name="memo" cols="50" rows="10"><?php print($memo['memo']); ?></textarea><br>
            <button type="submit">登録</button>
        </form>
    </main>
</body>
</html>