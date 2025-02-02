<?php
  $msg = null;
  $alert = null;

  if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])){
    $old_name = $_FILES['image']['tmp_name'];

    //$new_name = $_FILES['image']['name'];
    $new_name = date("YmdHis");//p203
    $new_name .= mt_rand();
    $size = getimagesize($_FILES['image'],['tmp_name']);
    switch ($size[2]){
      case IMAGETYPE_JPEG:
        $new_name .='.jpg';
        break;
      case IMAGETYPE_GIF:
        $new_name .='.png';
        break;
      default:
        header('Location: upload.php');
        exit();
    }//p203

    if (move_uploaded_file($old_name, 'album/'.$new_name)){
        $msg = 'アップロードしました';
        $alert = 'success';
    }else{
        $msg = 'アップロードできませんでした';
        $alert = 'danger';
    }
  }
?>
<!doctype html>
<html lang="ja">
<head>
    <title>サークルサイト</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>

    <?php include('navbar.php'); ?>

    <main role="main" class="container" style="padding:60px 15px 0">
      <div>
          <h1>画像アップロード</h1>
          <?php
            if ($msg){
                echo '<div class="alert alert-'.$alert.'" role="alert">'.$msg.'<div>';
            }
          ?>
          <form action="upload.php" method="post" enctype="multipart/form-date">