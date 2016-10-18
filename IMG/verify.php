<?php
namespace IMG;

/**
 *2016-08-17
 *验证码类
 *功能生成验证码
 *可生成多位验证码
 *验证码长度设置
 *背景设置
 *数字字母设置
 */
class VerifyCode
{
    const CODE_TYPE_NUM = 1;

    const CODE_TYPE_CHAR = 2;

    const CODE_TYPE_MIX = 3;

    const BACKGROUND_TYPE_NORMAL = 1;

    const BACKGROUND_TYPE_DOT = 2;

    #code长度
    const LENGTH = 4;

    #图片宽度
    const WIDTH = 60;

    const HEIGHT = 30;

    protected $resource;

    protected $code;

    protected $code_length;

    protected $background_type;

    protected $code_type;

    protected $img_width;

    protected $img_height;

    public function __construct($code_type = null, $length = null, $width = null, $height = null, $background_type = null)
    {
        $this->code_type = intval($code_type) ? intval($code_type) : static::CODE_TYPE_NUM;
        $this->code_length = intval($length) ? intval($length) : static::LENGTH;
        $this->background_type = intval($background_type) ? intval($background_type) : static::BACKGROUND_TYPE_NORMAL;
        $this->img_width = intval($width) ? intval($width) : static::WIDTH;
        $this->img_height = intval($height) ? intval($height) : static::HEIGHT;
    }

    /**
     *根据配置生成验证码字符
     *return string
     */
    protected function generateCode()
    {
        $code = '';
        #普通数字
        if ($this->code_type === static::CODE_TYPE_NUM) {
            for ($i = 0; $i < $this->code_length; $i++) {
                $code .= mt_rand(0, 9);
            }
        } elseif ($this->code_type === static::CODE_TYPE_CHAR) {
            for ($i = 0; $i < $this->code_length; $i++) {
                $code .= rand(0, 1) ? chr(mt_rand(65, 89)) : chr(mt_rand(97, 122));
            }
        } elseif ($this->code_type === static::CODE_TYPE_MIX) {
            for ($i = 0; $i < $this->code_length; $i++) {
                $code .= rand(0, 1) ? (rand(0, 1) ? chr(mt_rand(65, 89)) : chr(mt_rand(97, 122))) : mt_rand(0, 9);
            }
        }

        return $code;
    }

    /**
     *根据配置生成图片背景
     */
    protected function generateBg()
    {
        try {
            $this->resource = imagecreate($this->img_width, $this->img_height);
            $bg = imagecolorallocate($this->resource, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));
        } catch (\Exception $e) {
            #记录
            echo $e->getMessage();
        }
    }

    #是否启用线条和雪花
    protected function generateLine()
    {
        for ($i=0; $i<6; $i++) {
            $color = imagecolorallocate($this->resource, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imageline($this->resource, mt_rand(0, $this->img_width), mt_rand(0, $this->img_height), mt_rand(0, $this->img_width), mt_rand(0, $this->img_height), $color);
        }

        for ($i=0; $i<50; $i++) {
            $color = imagecolorallocate($this->resource, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
            imagestring($this->resource, mt_rand(1, 5), mt_rand(0, $this->img_width), mt_rand(0, $this->img_height), '*', $color);
        }
    }

    #生成图片位置还需要再调
    protected function generateImg()
    {
        $textcolor = imagecolorallocate($this->resource, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
        $px = (imagesx($this->resource) - 7.5 * strlen($string)) / 2;
        imagestring($this->resource, 5, mt_rand(0, $this->img_width / 4), mt_rand(0, $this->img_height / 2), $this->code, $textcolor);
        return imagepng($this->resource);
    }

    public function generate()
    {
        $this->code = $this->generateCode();
        $this->generateBg();
        if ($this->background_type === static::BACKGROUND_TYPE_DOT) {
            $this->generateLine();
        }
        return $this->generateImg();
    }

    public function getCode()
    {
        return $this->code;
    }
}

header("Content-type: image/png");
echo (new verifyCode(3, 5, null, null, 2))->generate();

echo PHP_EOL;
