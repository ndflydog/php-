<?php

/*
    分离组件降低耦合
*/
class RegistrationMgr {
    function register (Lesson $lesson) {
        //处理该课程

        //通知某人
        $notifier = notifier::getNotifier();

        $notifier->inform("new lesson: cost ({$lesson->cost()})");
    }
}

abstract class Notifier {

    static function getNotifier () {
        //根据配置或其他逻辑获得具体的类

        if (rand(1，2) == 1) {
            return new MailNotifier();
        } else {
            return new TextNotifier();
        }
    }

    abstract function inform($message);
}

class MailNotifier extends Notifier {
    function inform ($message) {
        print "MAIL notification: {$message}\n";
    }
}

class TextNotifier extends Notifier {
    function inform ($message) {
        print "TEXT notification: {$message}\n";
    }
}