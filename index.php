<?php
require_once 'imageGrid.php';

function getPixelsFromCm($cm){
    $onecminpixel = 37.795276;
    return $onecminpixel * $cm;
}

$bred = 15;
$hojd = 10;

$imageGrid = new imageGrid(getPixelsFromCm($bred), getPixelsFromCm($hojd), 12, 2);

$blue = imagecreatefrompng("bild.png");
$imageGrid->putImage($blue, 6, 2, 0, 0);
imagedestroy($blue);

$green = imagecreatefrompng("bild.png");
$imageGrid->putImage($green, 2, 1, 6, 0);
imagedestroy($green);

$red = imagecreatefrompng("bild.png");
$imageGrid->putImage($red, 2, 1, 8, 0);
imagedestroy($red);

$yellow = imagecreatefrompng("bild.png");
$imageGrid->putImage($yellow, 2, 1, 10, 0);
imagedestroy($yellow);

$purple = imagecreatefrompng("bild.png");
$imageGrid->putImage($purple, 3, 1, 6, 1);
imagedestroy($purple);

$cyan = imagecreatefrompng("bild.png");
$imageGrid->putImage($cyan, 3, 1, 9, 1);
imagedestroy($cyan);

$imageGrid->display();
?>