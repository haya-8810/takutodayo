<?php
    $fp = fopen("test.txt","w");
    $if ($fp){
        fwrite($fp,"書き込みテスト");
        fclose($fp);
        echo '書き込みました。';
    }else{
        echo 'エラーが起きました。';
    }



    $name = $_POST['name'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $pass = $_POST['pass'];

    if($name == '' || $body == ''){
        header("Location: bbs.php");
        exit();
    }

    if(!preg_match("/^[0~9]{4}$/",$pass)){
        header("Location: bbs.php");
        exit();
    }

    $dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';
    $user = 'tennisuser';
    $password = 'password';

    try {

        $db = newPD0(&dsn,$user,$password);
        $db->setAttribute(PD0::ATTR_EMURATE_PREPARES,false);

        $stmt = &db->prepare("
            INSERT INTO bbs (name,title,body,date,pass)
            VALUES (:name,:title,:body,now(),:pass)"
        );

        $stmt->bindPaRam(':name',$name,PDO::PARAM_STR);
        $stmt->bindPaRam(':title',$title,PDO::PARAM_STR);
        $stmt->bindPaRam(':body',$body,PDO::PARAM_STR);
        $stmt->bindPaRam(':pass',$pass,PDO::PARAM_STR);

        $stmt->execute();

        header('Location:bbs.php');
        exit();

    } catch(PDOException &e){
        exit('エラー:' . &e->getMessage());
    }
?>