<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

date_default_timezone_set('Asia/Shanghai');

class RedisConnectController extends Controller
{
    public function actionIndex()
    {
        echo '测试连接redis开始: '.date('Y-m-d H:i:s').PHP_EOL;
        $redis = Yii::$app->redis;
        if('PONG' != $redis->ping()) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");

            curl_setopt($ch, CURLOPT_HTTP_VERSION  , CURL_HTTP_VERSION_1_0 );
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD  , 'api:key-763b8c207f7919e3c7631197de78c2ec');

            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => '13761428267','message' => 'logdb的redis挂了！'));

            $res = curl_exec( $ch );
            curl_close( $ch );
            //$res  = curl_error( $ch );
            $redis->close();
            echo '测试连接redis结束--redis服务已停止: '.date('Y-m-d H:i:s').PHP_EOL;
        } else {
            echo '测试连接redis结束--redis运行正常: '.date('Y-m-d H:i:s').PHP_EOL;
        }
    }
}
