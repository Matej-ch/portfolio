<?php

namespace App\Service;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;

class ImageOptimizer
{
    private const MAX_WIDTH = 400;

    private const MAX_HEIGHT = 300;

    private Imagine $imagine;

    public function __construct()
    {
        $this->imagine = new Imagine();
    }

    public function resize(string $filename): void
    {
        [$iWidth, $iHeight] = getimagesize($filename);

        $ratio = $iWidth / $iHeight;
        $width = self::MAX_WIDTH;
        $height = self::MAX_HEIGHT;

        if($width / $height > $ratio) {
            $width = $height * $ratio;
        } else {
            $height = $width / $ratio;
        }

        $photo =$this->imagine->open($filename);
        $photo->resize(new Box($width,$height))->save($filename);
    }


}