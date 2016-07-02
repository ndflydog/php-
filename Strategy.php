<?php
/*使用策略模式*/
/*
    Lession类需要一个作为属性的CostStrategy对象
    Lession::cost()方法只调用CostStrategy::cost().
    Lession::chargeType()只调用CostStrategy::chargeType().
    这种显示调用另一个对象的方法来执行一个请求的方式便是所谓的“委托”
    CostStrategy对象便是Lession的委托方
*/
abstract class CostStrategy {
    abstract function cost (Lesson $lesson);
    abstract function chargeType();
}
abstract class Lesson {
    private $duration;
    private $costStrategy;

    function __construct ($duration, CostStrategy $strategy) {
        $this->duration = $duration;
        $this->costStrategy = $strategy;
    }

    function cost () {
        return $this->costStrategy->cost($this);
    }

    function chargeType () {
        return $this->costStrategy->chargeType();
    }

    function getDuration() {
        return $this->duration;
    }
}

class Lecture extends Lesson {

}

class Seminar extends Lesson {

}

class TimedCostStrategy extends CostStrategy {
    function cost (Lesson $lesson) {
        return ($lesson->getDuration() * 5);
    }
    function chargeType() {
        return "hourly rate";
    }
}

class FixedCostStrategy extends CostStrategy {
    function cost (Lesson $lesson) {
        return 30;
    }

    function chargeType() {
        return "fixed rate";
    }
}
/*
    通过传递不同的CostStrategy对象，我们可以在代码运行时改变Lesson对象计算费用的方式。
    这种方式有助于产生具有高度灵活性的代码。动态地组合及重组对象，远胜于将功能静态地建立在代码结构中。
*/
$lessons[] = new Seminar(4, new TimedCostStrategy);
$lessons[] = new Lecture(4, new FixedCostStrategy);

foreach ($lessons as $lesson) {
    print "lesson charge {$lesson->cost()}. ";
    print "CHarge type: {$lesson->chargeType()}\n";
}
/*
    此结构的效果之一便是让我们关注类的职责。CostStrategy对象独立负责计算费用，而Lesson对象则负责管理课程数据。
*/