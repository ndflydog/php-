<?php
class gifImages 
{

    public static $fileName = null;
    public static $desName = null;
    public static $fileType = 'gif';

    public static function isExistFile($file) 
    {
        if (is_file($file)) {
            return self::$fileName = & $file;
        }
        print_r(error_get_last());
        exit;
    }

    /**
     * 向图片上写文字
     * @param $fileNmae 目标文件地址
     * @param $text     要写的文字
     * @param $desName  生成后的图像地址
     * @param $font     字体
     * @param $size     字的大小
     * @param $color    要写字的颜色
     * @param $x        要写字的x坐标
     * @param $y        要写字的y坐标
     */
    public function writeText($fileName, $text, $desName='', $font, $size, $weight=100, $color, $x, $y) 
    {
        self::isFile($fileName);
        $desName = self::getDesName($desName);
        $image = new Imagick();
        $draw = new ImagickDraw();

        $draw->setTextEncoding('UTF-8');
        $draw->setFont($font); //  '/usr/share/fonts/bitstream-vera/VeraBd.ttf'
        $draw->setFontWeight($weight);
        $draw->setFillColor($color);
        $draw->setFontSize($size); //12
        $draw->setGravity(1);
        $draw->setFillAlpha(1);

        $image->readImage($fileName);

        $image->resetIterator();

        do {
            $image->annotateImage($draw, $x, $y, 0, $text);
        } while ($image->nextImage());

        $image->setFormat(self::$fileType);

        $image->writeImages($desName, true);
        $draw->clear();

        $image->clear();

        $draw->destroy();
        $image->destroy();
        return $desName;
    }

    /**
     * 合并多个图片（可以是把一个图片当作LOGO写到图片上 ，也可以把多个图片做成动态的GIF动画）
     * @param $fileNmae     原图片 可以是多个
     * @param $desName      生成生的图片地址
     * @param $delay        如果是生成gif动画  这个是每帧的时间 100=1s
     */
    public function mergeImage($fileName, $desName, $delay=1) 
    {

    }

    /**
     * 改变图片大小
     * @param $fileNmae     原图片地址
     * @param $width        要生成的宽度
     * @param $height       要生成的高度
     * @param $desName      生成生的图片地址
     */
    public function resizeImages($fileName, $width, $height, $desName='') 
    {
        self::isFile($fileName);
        self::getDesName($desName);
        $image = new Imagick();
        $image->readImage($fileName);
        $image->resetIterator();
        do {
            $iw = $image->getImageWidth();
            $ih = $image->getImageHeight();
            $ratio = doubleval($iw) / doubleval($width);
            if ($height * $ratio < $ih) {
                $ratio = doubleval($ih) / doubleval($height);
            }
            $arrSize = array(floor($iw / $ratio), floor($ih / $ratio));
            $image->resizeImage($arrSize[0], $arrSize[1], 1, 1);
        } while ($image->nextImage());
        $image->setFormat("gif");
        $image->writeImages(self::$desName, true);
        $image->destroy();
        return self::$desName;
    }

    public static function getDesName($desName) 
    {
        self::getType(self::$fileName);
        if (empty($desName)) {
            $desName = md5(time() . rand(0, 100)) . '.' . self::$fileType;
        } else {
            if (stripos(strtolower($desName), '.') === false) {
                $desName .= "." . self::$fileType;
            }
        }
        return self::$desName = $desName;
    }

    public static function getType($fileName) 
    {
        $size = getimagesize($fileName);
        $type = null;
        switch ($size['mime']) {
            case "image/gif":
                $type = "gif";
                break;
            case "image/jpeg":
                $type = "jpeg";
                break;
            case "image/png":
                $type = "png";
                break;
            case "image/bmp":
                $type = "bmp";
                break;
            default :
                $type = false;
        }
        unset($size);
        return self::$fileType = $type;
    }

}