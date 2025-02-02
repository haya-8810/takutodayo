<?php
    $new_width=200;

    list ($width,$height)=getimagesize($_FILES['file']['tmp_name']);

    $rate = $new_width/$width;
    $new_height = $rate*$height;

    $canvas = imagecreatetruecolor($new_width,$new_height);

    switch (exif_imagetype($_FILES['file']['tmp_name'])){

        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($_FILES['file']['tmp_name']);
            imagecopyresampled($canvas,$image,0,0,0,0,$new_width,$width,$height);
            imagejpeg($canvas,'images/new_image.jpeg');
            break;

        case IMAGETYPE_GIF:
            $image=imagecreatefromgif($_FILES['file']['tmp_name']);
            imagecopyresampled($canvas,$image,0,0,0,0,$new_width,$width,$height);
            imagegif($canvas,'images/new_image.gif');
            break;

        case IMAGETYPE_PNG:
            $image=imagecreatefrompng($_FILES['file']['tmp_name']);
            imagecopyresampled($canvas,$image,0,0,0,0,$new_width,$width,$height);
            imagepng($canvas,'images/new_image.png');
            break;

            default:
                exit();
    }
    imagedestroy($image);
    imagedestroy($canvas);