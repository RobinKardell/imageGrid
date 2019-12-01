<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class imageGrid
{

    private $realWidth;
    private $realHeight;
    private $gridWidth;
    private $gridHeight;
    private $image;

    public function __construct($realWidth, $realHeight, $gridWidth, $gridHeight)
    {
        $this->realWidth = $realWidth;
        $this->realHeight = $realHeight;
        $this->gridWidth = $gridWidth;
        $this->gridHeight = $gridHeight;

        // create destination image
        $this->image = imagecreatetruecolor($realWidth, $realHeight);
        $black = imagecolorallocate($this->image, 0, 0, 0);
        imagecolortransparent($this->image, $black);
    }

    public function __destruct()
    {
        imagedestroy($this->image);
    }

    public function display()
    {
        header("Content-type: image/png");
        imagepng($this->image);
    }

    public function putImage($img, $sizeW, $sizeH, $posX, $posY)
    {
        // Cell width
        $cellWidth = $this->realWidth / $this->gridWidth;
        $cellHeight = $this->realHeight / $this->gridHeight;

        // Conversion of our virtual sizes/positions to real ones
        $realSizeW = ceil($cellWidth * $sizeW);
        $realSizeH = ceil($cellHeight * $sizeH);
        $realPosX = ($cellWidth * $posX);
        $realPosY = ($cellHeight * $posY);

        $img = $this->resizePreservingAspectRatio($img, $realSizeW, $realSizeH);

        // Copying the image
        imagecopyresampled($this->image, $img, $realPosX, $realPosY, 0, 0, $realSizeW, $realSizeH, imagesx($img), imagesy($img));
    }

    public function resizePreservingAspectRatio($img, $targetWidth, $targetHeight)
    {
        $srcWidth = imagesx($img);
        $srcHeight = imagesy($img);

        $srcRatio = $srcWidth / $srcHeight;
        $targetRatio = $targetWidth / $targetHeight;
        if (($srcWidth <= $targetWidth) && ($srcHeight <= $targetHeight))
        {
            $imgTargetWidth = $srcWidth;
            $imgTargetHeight = $srcHeight;
        }
        else if ($targetRatio > $srcRatio)
        {
            $imgTargetWidth = (int) ($targetHeight * $srcRatio);
            $imgTargetHeight = $targetHeight;
        }
        else
        {
            $imgTargetWidth = $targetWidth;
            $imgTargetHeight = (int) ($targetWidth / $srcRatio);
        }

        $targetImg = imagecreatetruecolor($targetWidth, $targetHeight);

        imagecopyresampled(
           $targetImg,
           $img,
           ($targetWidth - $imgTargetWidth) / 2, // centered
           ($targetHeight - $imgTargetHeight) / 2, // centered
           0,
           0,
           $imgTargetWidth,
           $imgTargetHeight,
           $srcWidth,
           $srcHeight
        );

        return $targetImg;
    }

}