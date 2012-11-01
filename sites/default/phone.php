<?php
header ("Content-type: image/png");
$image = imagecreate(150,15);

/*$orange = imagecolorallocate($image, 255, 128, 0); // Le fond est orange (car c'est la première couleur)
$bleu = imagecolorallocate($image, 0, 0, 255);
$bleuclair = imagecolorallocate($image, 156, 227, 254);*/

$blanc = imagecolorallocate($image, 255, 255, 255);
$noir = imagecolorallocate($image, 39, 39, 39);



imagestring($image, 4, 0, 0, base64_decode($_GET['phone']), $noir);
//imagecolortransparent($image, $orange); // On rend le fond orange transparent

$t = imagepng($image);
