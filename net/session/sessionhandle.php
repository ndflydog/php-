<?php
class TestSessionHandler implements SessionHandlerInterface
{
    private $savePath;

    public function __construct()
    {
        echo '构造函数调用<br>';                
        $this->savePath = '/home/session';
    }

    public function open($savePath, $sessionName)
    {
        echo 'open函数调用<br>';        
        $this->savePath = $savePath;
        if (!is_dir($this->savePath)) {
            mkdir($this->savePath, 0777);
        }

        return true;
    }

    public function close()
    {
        echo 'close函数调用<br>';
        return true;
    }

    #需要读取session中内容时调用
    public function read($id)
    {
        echo 'read函数调用<br>';
        return (string)@file_get_contents("$this->savePath/sess_$id");
    }

    #设置session值时调用
    public function write($id, $data)
    {
        var_dump($data);
        echo 'write函数调用<br>';        
        return file_put_contents("$this->savePath/sess_$id", $data) === false ? false : true;
    }

    public function destroy($id)
    {
        echo 'destroy函数调用<br>';                
        $file = "$this->savePath/sess_$id";
        if (file_exists($file)) {
            unlink($file);
        }

        return true;
    }

    public function gc($maxlifetime)
    {
        echo 'gc函数调用<br>';                
        foreach (glob("$this->savePath/sess_*") as $file) {
            if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
                unlink($file);
            }
        }

        return true;
    }
}

//@ini_set('session.gc_maxlifetime', 1);
$handler = new TestSessionHandler();
session_set_save_handler($handler, true);
//sleep(10);
session_start();
//$_SESSION['test'] = 12;
echo $_SESSION['test'].'<br>';
#脚本结束后会自动调用write close函数
$lifetime=3600;
setcookie(session_name(),session_id(),time()+$lifetime);