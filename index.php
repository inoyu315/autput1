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