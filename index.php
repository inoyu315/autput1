<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    $_SESSION['time'] = time();

    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
} else {
    header('Location: login.php');
    exit();
}
?>
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
        <a href="input.html">メモを登録する</a><br>
        <a href="logout.php">ログアウト</a>
        <p>ようこそ、<?php print(htmlspecialchars($member['name'], ENT_QUOTES)); ?>さん</p>
    </header>
    <main>
    <?php
    require('dbconnect.php');

    //数字が指定された場合はそのページへ　数字ではない場合は強制的に１ページへ
    if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
        $page = $_REQUEST['page'];
    } else {
        $page = 1;
    }
    
    $start = 5 * ($page - 1);

//$_REQUEST...idの部分を置き換えるパラメーター
    $memos = $db->prepare('SELECT * FROM memos ORDER BY id DESC LIMIT ?,5');
    $memos->bindParam(1, $start, PDO::PARAM_INT);
    $memos->execute();
    ?>

    <!--DBの「memo」を全て表示-->
    <article>
        <?php while($memo = $memos->fetch()): ?>
            <p><a href="memo.php?id=<?php print($memo['id']); ?>"><?php print(mb_substr($memo['memo'], 0, 50)); ?></a></p>
            <time><?php print($memo['created_at']); ?></time>
            <hr>
        <?php endwhile; ?>

        <!--ページの移動-->
        <?php if ($page >= 2): ?>
        <a href="index.php?page=<?php print($page-1); ?>"><?php print($page-1); ?>ページ目へ</a>
        <?php endif; ?>
        |
        <?php
        //ceilで５件ごとに切り上げ
        $counts = $db->query('SELECT COUNT(*) as cnt FROM memos');
        $count = $counts->fetch();
        $max_page = ceil($count['cnt'] / 5);

        //max_pageより小さい時にリンクを表示する
        if ($page < $max_page):
        ?>
        <a href="index.php?page=<?php print($page+1); ?>"><?php print($page+1); ?>ページ目へ</a>
        <?php endif; ?>
    </article>

    </main>
</body>
</html>