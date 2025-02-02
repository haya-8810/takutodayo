<?php

    $name = $_POST['name'];

    $gender = $_POST['gender'];
    if($gender =="man"){
        $gender = "男性";
    }else if ($gender == "woman"){
        $gender = "女性";
    }

    $tmp_star = $_POST['star'];
    $star = '';
    for ($1 = 0; $i < $tmp_star; $i++){
        $star .= '★';
    }

    for (; $i < 5; $i++){
        $star .= '☆';
    }

    $other = $_POST['other'];
    ?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>アンケート結果</title>
    </head>
    <body>
        <h1>アンケート結果<h1>
        <p>お名前：<?php echo $name; ?></p>
        <p>性別：<?php echo $gender; ?></p>
        <p>評価：<?php echo $star; ?></p>
        <p>ご意見：<?php echo nl2br($other); ?></p>
    </body>
<html>
        