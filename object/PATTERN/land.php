<?php
#装饰器？？
class pic
{
	private $_url;

	public function __get($name)
	{
		return $this->$name;
	}
	
	public function __set($name,$value)
	{
		return $this->$name = $value;
	}
}
interface layer
{
	public function loadPic(pic $pic);
}

class background implements layer
{
	private $_z = 0;
	private $_pic;
	private $_width;
	private $_height;
	private $_html;
	
	public function loadPic(pic $pic)
	{
		$this->_pic = $pic;
	}
	
	public function __get($name)
	{
		return $this->$name;
	}
	
	public function __set($name,$value)
	{
		return $this->$name = $value;
	}
	
	public function generateHtml()
	{
		$this->_html = "<img src='{$this->_pic->_url}' width='{$this->_width}' height='{$this->_height}' style='z-index: {$this->_z};'>";
		return $this->_html;
	}
}

#装饰器
abstract class onLayer implements layer
{
	private $_x;
	private $_y;
	private $_z;
	private $_pic;
	private $_width;
	private $_height;
	private $_html;
	private $_downLayer;
	
	public function loadPic(pic $pic)
	{
		$this->_pic = $pic;
	}
	
	public function __get($name)
	{
		return $this->$name;
	}

	public function __set($name,$value)
	{
		return $this->$name = $value;
	}
	
	abstract public function on(layer $newLayer);
	
	public function generateHtml()
	{
		$this->_html = $this->_downLayer->_html."<img src='{$this->_pic->_url}' width='{$this->_width}' height='{$this->_height}' style='z-index: {$this->_z}; position: absolute; left: {$this->_x}px; top: {$this->_y}px;'>";
		return $this->_html;
	}
}

class island extends onLayer
{
	public function on(layer $downLayer)
	{
		$this->_width = 100;
		$this->_height = 50;
		$this->_downLayer = $downLayer;
		$this->_z = $downLayer->_z + 20;
	}
}

class bird extends onLayer
{
	public function on(layer $downLayer)
	{
		$this->_x = 20;
		$this->_y = 30;
		$this->_width = 20;
		$this->_height = 20;
		$this->_downLayer = $downLayer;
		$this->_z = $downLayer->_z + 21;
	}
}

#要被装饰的对象
class downLayer implements layer
{
	private $_pic;
	private $_html;
	
	public function loadPic(pic $pic)
	{
		$this->_pic = $pic;
	}
	
	public function __get($name)
	{
		return $this->$name;
	}

	public function __set($name,$value)
	{
		return $this->$name = $value;
	}
}
$inland_x = isset($_REQUEST['_x']) ? $_REQUEST['_x'] : 0;
$inland_y = isset($_REQUEST['_y']) ? $_REQUEST['_y'] : 0;

//No.1
//开始写代码，显示由背景、小岛和海鸥三个图片组合而成的背景图
/*
背景图片为: sea.jpg 
岛的图片为: island.jpg
鸟的图片为: bird.jpg
*/
#背景每次都不变
$seaPic = new pic();
$seaPic->url = sea.jpg;
$background = new background();
$background->loadPic($seaPic);
echo $background->generateHtml();

#原来位置的小岛
$landPic = new pic();
$landPic->url = island.jpg;
$land = new island();
$land->loadPic($landPic);
echo $land->generateHtml();

#装饰小岛


//end_code

?>

<form action="#" method="post" style="">
<input name="_x" type="text">
<input name="_y" type="text">
<input type="submit">
</form>