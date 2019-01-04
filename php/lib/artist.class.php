<?php
/**
 * 封装GD库
 *
 *
 */


class artist
{
    /**
     * 新建一个页面
     * 将他设置为纯黑色
     * 输出
     */

    public $dg = null;

    public $width = 0;

    public $height = 0;

    public $source = null;

    public $color = null;

    const IMG_TYPE = [
        'png',
        'bmp',
        'jpeg',
        'gif',
    ];

    public function __construct()
    {

    }

    public function init($width, $height)
    {
        $this->width = $width;
        $this->height = $height;

        $this->dg = imagecreatetruecolor($width, $height);

        if ($this->dg === false) {
            return false;
        }
    }

    public function chooseColor($red, $green, $blue)
    {
        $this->color = imagecolorallocate($this->bg, $red, $green, $blue);
    }

    public function text($string, $x, $y)
    {
        imagestring($this->bg, 1, $x, $y, $string, $this->color);
    }

    public function output($path, $type = 'png')
    {
        if (!in_array($type, self::IMG_TYPE)) {
            return false;
        }

        $func = "image{$type}";

        if (!function_exists($func)) {
            return false;
        }

        $func($this->dg, $path);

        imagedestroy($this->dg);
        $this->dg = null;
    }
}