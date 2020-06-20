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

        $statement = $db->prepare('UPDATE memos SET memo=? WHERE id=?');
        $statement->execute(array($_POST['memo'], $_POST['id']));
        ?>
        <p>メモを変更しました</p>
        <a href="index.php">戻る</a>
    </main>
</body>
</html>