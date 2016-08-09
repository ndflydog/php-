<?php

/** 
 *分页类
 */
class Page
{
    protected $count;

    protected $pageSize;

    protected $offset;

    protected $limit;

    protected $current;

    protected $prevPage;

    protected $nextPage;

    protected $url;

    #初始化分页信息
    public function __construct($count = null, $pageSize = 30, $current = 1, $url = null)
    {
        if(!$count) {
            throw new \Exception ('pages count not set');
        }
        $this->count = $count;
        $this->pageSize = $pageSize;
        $this->limit = ($current - 1) * $pageSize;
        $this->offset = $pageSize;
        $this->current = $current;
        if(!$url) {
            #默认是当前路径
        }else {
            $this->url = $url;
        }
    }

    #获取分页信息
    public function __get($name)
    {
        if($this->$name) {
            return $this->$name;
        }else {
            throw new \Exception("$name property not exists");
        }       
    }

    #设置分页信息
    public function __set($name, $value)
    {
        if(property_exists($this, $name)) {
            $this->$name = $value;
        }else {
            throw new \Exception("$name property not be set");
        }
    }

    #生成页数
    public function getPages()
    {
        return ceil($this->count/$this->pageSize);
    }

    #生成分页链接 页码数最多只有十个
    public function generatePagination()
    {
        $this->prevPage = ($this->current - 1 == 0) ? 1 : ($this->current - 1) ;
        $this->nextPage = ($this->current + 1 > $this->getPages()) ? $this->getPages : ($this->current + 1);
        $page = '';
        $i = ($this->current > 5) ? ($this->current - 5) : 1;
        $length = ($this->getPages() < 10) ? $this->getPages() : (10 - 1 + $i);

        for($i; $i <= $length; $i++) {
            $active = ($this->current == $i) ? 'active' : '';    
            $url = "$this->url?current=$i&pageSize=$this->pageSize";
            $page .= <<<EOT
<li><a href="$url" class="$active">$i</a></li>
EOT;
        }
        $prevPage = '<li><a href="'.$this->url.'?current='.$this->prevPage.'">上一页</a></li>';
        $nextPage = '<li><a href="'.$this->url.'?current='.$this->nextPage.'">下一页</a></li>';
        $page = $prevPage.$nextPage.'<ul class="pagination">'.$page.'</ul>';
        return $page;
    }

    #每页显示
    public function generatePerPage()
    {
        $select = <<<EOT
<select onchange="window.location=this.value>
    <option value="{$this->url}?current={$this->current}&pageSize=20">20</option>
    <option value="{$this->url}?current={$this->current}&pageSize=50">50</option>
    <option value="{$this->url}?current={$this->current}&pageSize=100">100</option>
</select>
EOT;
        return $select;
    }

    #跳页
    public function generatePageSkit()
    {
        $length = $this->getPages();
        $skit = '';
        for($i = 1; $i <= $length; $i++) {
            $skit .= <<<EOT
<option value="{$this->url}?current=$i&pageSize={$this->pageSize}">$i</option>
EOT;
        }
        return '<select onchange="window.location=this.value">'.$skit.'</select>';
    }
}

$page = new Page(1000);
$page->pageSize = 30;
$page->url = 'index';
$page->current = 8;

echo $page->generatePagination();