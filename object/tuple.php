<?php
/**
 * 返回元组 有时后返回就可以把错误信息放入到元组中返回
 */
class tuple
{
    public $result;

    public $msg;
    
    public function __contruct($result, $msg)
    {
        $this->result = $result;
        $this->msg = $msg;
    }
}