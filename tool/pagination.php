<?php
/**
 * 生成分页链接
 */

class Pagination
{
    protected $url;

    protected $current = 1;

    protected $count;

    protected $search;

    protected $pageSize = 30;

    public $maxButtonCount = 10;

    protected $param = [];

    const PAGE_PARAM = 'page';

    const PAGESIZE_PARAM = 'pageSize';

    public function __construct(array $opts = [], array $search = [])
    {
        foreach ($opts as $k => $v) {
            $this->$k = $v;
        }
        if (!$this->count) throw new \Exception('count miss');
        $this->init();
    }


    protected function init()
    {
        $searchUrlOrigin = $this->getSearch();
        $searchUrl = '&'.static::PAGESIZE_PARAM.'='.$this->pageSize.'&'.$searchUrlOrigin;

        $allPages = $this->getAllPages();
        $last= $this->current - 1;
        $next = $this->current + 1;

        $this->searchUrl = $searchUrl;
        $this->allPages = $allPages;
        $this->firstHref = $this->url.'?'.static::PAGE_PARAM.'=1'.$searchUrl;
        $this->lastHref = $this->url.'?'.static::PAGE_PARAM.'='.$allPages.$searchUrl;
        $this->startHidden = $this->current > 1 ? 'false' : 'true';
        $this->endHidden = $this->current < $allPages ? 'false' : 'true';
        $this->startHref = $last > 0 ? $this->url.'?'.static::PAGE_PARAM.'='.($this->current - 1).$searchUrl : 'javascript:;';
        $this->endHref = $next < $allPages ? $this->url.'?'.static::PAGE_PARAM.'='.($this->current + 1).$searchUrl : 'javascript:;';
        $this->select = $this->url.'?'.static::PAGE_PARAM.'=1'.$searchUrlOrigin;

        $this->selected();
        $loop = $this->getLoop();
        $this->loop = $loop;

    }
    protected function getAllPages()
    {
        $allPages = ceil($this->count / $this->pageSize);
        if ($allPages < $this->page) {
            $this->page = $allPages;
        }
        return $allPages;
    }

    protected function selected()
    {
        switch ($this->pageSize){
            case 30:
                $this->isSelect30 = 'selected="true"';
                $this->isSelect50 = '';
                $this->isSelect100 = '';
                break;
            case 50:
                $this->isSelect30 = '';
                $this->isSelect50 = 'selected="true"';
                $this->isSelect100 = '';
                break;
            case 100:
                $this->isSelect30 = '';
                $this->isSelect50 = '';
                $this->isSelect100 = 'selected="true"';
                break;
        }
    }

    protected function getSearch()
    {
        $str = '';
        foreach ($this->search as $k => $v) {
            $str .= '&'.$k.'='.$v;
        }
        return $str;
    }


    protected function getLoop()
    {
        $str = '';
        $loop = <<<EOL
<li class="{:active}"><a href="{:href}">{:current}<span class="sr-only">(current)</span></a></li>
EOL;
        list($beginPage, $endPage) = $this->getPageRange();
        for($i = $beginPage + 1; $i <= $endPage + 1; $i++) {
            $str .= strtr($loop, [
                '{:active}' => $this->current == $i ? 'active' : '',
                '{:href}' => $this->url.'?'.static::PAGE_PARAM.'='.$i.$this->searchUrl,
                '{:current}' => $i,
            ]);
        }
        return $str;
    }

    public function template()
    {
        $template = <<<EOL
<div style="margin:20px 20px 0 0;">
  <ul class="pagination" style="float: right; margin: 0;">
    <li>
        <a href="{:firstHref}" aria-label="Previous">
            <span>&laquo;&laquo;</span>
        </a>
    </li>
    <li class="">
        <a href="{:startHref}" aria-label="Previous">
            <span aria-hidden="{:startHidden}">&laquo;</span>
        </a>
    </li>
    {:loop}
    <li>
        <a href="{:endHref}" aria-label="Previous">        
            <span aria-hidden="{:endHidden}">&raquo;</span>
        </a>
    </li>
    <li>
        <a href="{:lastHref}" aria-label="Previous">
            <span>&raquo;&raquo;</span>
        </a>
    </li>
  </ul>
  <div style="float: right;width: 100px;">
     <select name="" id="" onchange="window.location=this.value" class="form-control">
        <option value="{:select}&pageSize=30" {:isSelect30}>每页30</option>
        <option value="{:select}&pageSize=50" {:isSelect50}>每页50</option>
        <option value="{:select}&pageSize=100" {:isSelect100}>每页100</option>
     </select>
  </div>
</div>
EOL;
        return $template;
    }

    public function generate()
    {
        $template = $this->template();
        return strtr($template, [
            '{:firstHref}' => $this->firstHref,
            '{:lastHref}' => $this->lastHref,
            '{:startHref}' => $this->startHref,
            '{:endHref}' => $this->endHref,
            '{:startHidden}' => $this->startHidden,
            '{:endHidden}' => $this->endHidden,
            '{:loop}' => $this->loop,
            '{:select}' => $this->select,
            '{:isSelect30}' => $this->isSelect30,
            '{:isSelect50}' => $this->isSelect50,
            '{:isSelect100}' => $this->isSelect100,
        ]);
    }

    /**
     * @return array the begin and end pages that need to be displayed.
     */
    protected function getPageRange()
    {
        $currentPage = $this->current;
        $pageCount = $this->allPages;

        $beginPage = max(0, $currentPage - (int) ($this->maxButtonCount / 2));
        if (($endPage = $beginPage + $this->maxButtonCount - 1) >= $pageCount) {
            $endPage = $pageCount - 1;
            $beginPage = max(0, $endPage - $this->maxButtonCount + 1);
        }

        return [$beginPage, $endPage];
    }

    public function __set($key, $value)
    {
        if (!isset($this->$key)) {
            $this->param[$key] = $value;
        }
    }

    public function __get($key)
    {
        $value = isset($this->$key) ? $this->$key : isset($this->param[$key]) ? $this->param[$key] : null;
        return $value;
    }


    public static function get(array $opts = [], array $search = [])
    {
        $pagination = new static($opts, $search);
        $result = $pagination->generate();
        return $result;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <title>Document</title>
</head>
<body>
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 30;
echo Pagination::get(['count' => 1000, 'current' => $page, 'pageSize' => $pageSize]);
?>
</body>
</html>
