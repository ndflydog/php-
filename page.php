<?php

/** 
 *分页类
 */
class Page
{
    protected $pageSize;

    protected $offset;

    protected $limit;

    protected $current;

    protected $perPage;

    protected $nextPage;

    #初始化分页信息
    public function __construct($count = null, $pageSize = 30, $current = 1)
    {
        if(!$count) {
            throw new \Exception ('分页总数未设置');
        }
        $this->count = $count;
        $this->pageSize = $pageSize;
        $this->limit = ($current - 1) * $pageSize;
        $this->offset = $pageSize;
        $this->current = $current;
        $this->perPage = $current - 1;
        $this->nextPage = $current + 1;
    }

    #获取分页信息
    public function __get($name)
    {
        if($this->$name) {
            return $this->$name;
        }else {
            throw new \Exception("$name 属性不存在!");
        }       
    }

    #设置分页信息
    public function __set($name, $value)
    {
        if($this->$name) {
            $this->$name = $value;
        }
    }

    #生成页数
    public function getPages()
    {
        return ceil($this->count/$this->pageSize);
    }
}

(new Page(10))->pageSize;