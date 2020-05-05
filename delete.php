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

        if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
            $id = $_REQUEST['id'];

            $statement = $db->prepare('DELETE FROM memos WHERE id=?');
            $statement->execute(array($id));
        }
        
        ?>
        <p>メモを削除しました</p>
        <a href="index.php">戻る</a>
    </main>
</body>
</html>