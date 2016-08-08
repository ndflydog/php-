<?php




/**
厂模式
 * 工厂模式把创建者类与要生产的产品类分离开来。
 * 创建者是一个工厂类，其中定义了用于生成产品对象的类方法。
 * 一般情况下，就是创建者类的每个子类实例化一个相应的产品子类。
 */



/**
么时候该使用工厂模式
 * 1:有一组类似的对象需要创建
 * 2:在编码时不能预见需要创建哪种类的实例
 * 3:系统需要考虑扩展性，不应依赖于产品类实例如何被创建、组合和表达的细节。
 */



/**
代码运行时我们才知道要生成的对象类型
 * 我们需要能够相对轻松地加入一些新的产品类型
 * 每一个产品类型都可定制的功能
 */

//抽象产品类
abstract class ApptEncoder {
	abstract function encode (){
	}
}

//一个产品
class BloggsApptEncoder extends ApptEncoder {
	function encode() {
		return "Appointment data encode in BloggsCal format\n";
	}
}
//另一个产品
class MegaApptEncoder extends ApptEncoder {
	function encode() {
		return "Appointment data enc  in Mega format\n";
	}
}

//抽象工厂类
abstract class CommsManager {
	abstract function getHeaderText();
	abstract function getApptEncoder();
	abstract function getFooterText();
}

//BloggsComms的工厂类
class BloggsCommsManager extends CommsManager {
	function getHeaderText() {
		//定		制功能
		return "BloggsCal header\n";
	}
	
	function getApptEncoder() {
		return new BloggsApptEncoder();
	}
	
	function getFooterText() {
		return "BloggsCal footer\n";
	}
}
//Mega的工厂类
class MegaCommsManager extends CommsManager {
	function getHeaderText() {
		return "Mega header\n";
	}
	
	function getApptEncoder() {
		return new MegaApptEncoder();
	}
	
	function getFooterText() {
		return "Mega footer\n";
	}
}



/*有些缺陷的工厂模式*/
class CommsManager {
	const BLOGGS = 1;
	const MEGA = 2;
	private $mode;
	
	function __construct($mode) {
		$this->mode = $mode;
	}
	
	//每	添加一个功能模块就要加一些条件判断
			    function getHeaderText() {
		switch ($this->mode) {
			case self::MEGA:
				return "MegaCal header\n";
			break;
			
			default:
				return "BloggsCal header\n";
			break;
		}
	}
	
	function getApptEncoder() {
		switch ($this->mode) {
			case self::MEGA:
									                return new MegaApptEncoder();
			break;
			
			default:
									                return new BloggsApptEncoder();
			break;
		}
	}
}
