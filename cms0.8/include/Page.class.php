<?php 
//分页类
class Page {	
	private $total;		//总记录
	private $pagesize;	//每页显示的条数
	private $limit;		//limit
	private $page;		//当前页码
	private $pagenum;	//总页码
	private $url;		//地址
	private $bothnum;	//两边保持分页的页码数

	//构造方法，初始化
	public function __construct($_total, $_pagesize) {
		$this->total = $_total;
		$this->pagesize = $_pagesize;
		$this->pagenum = ceil($this->total/$this->pagesize);
		$this->page = $this->setPage();
		$this->limit = "LIMIT ".($this->page-1)*$this->pagesize.", $this->pagesize";
		$this->url = $this->setUrl();
		$this->bothnum = 2;
	}
	//拦截器
	public function __get($_key) {
		return $this->$_key;
	}
	//获取当前页码
	private function setPage() {
		if(!empty($_GET['page'])) {
			if($_GET['page'] > 0) {
				if($_GET['page'] > $this->pagenum) {
					return $this->pagenum;
				}
				else {
					return $_GET['page'];
				}
			}
			else {
				return 1;
			}
		}
		else {
			return 1;
		}
	}
	//获取页面地址
	private function setUrl() {
		$_url = $_SERVER['REQUEST_URI'];
		$_par = parse_url($_url);
		if(isset($_par['query'])) {
			parse_str($_par['query'], $_query);
			unset($_query['page']);
			$_url = $_par['path'].'?'.http_build_query($_query);
		}
		return $_url;
	}
	//数值页
	private function listPage() {
		$_listpage = null;
		for($i=$this->bothnum; $i>=1; $i--) {
			$_page = $this->page-$i;
			if($_page < 1) continue;
			$_listpage .= '<a href="'.$this->url.'&page='.$_page.'">'.$_page.'</a>';
		}
		$_listpage .= '<span class="me">'.$this->page.'</span>';
		for($i=1; $i<=$this->bothnum; $i++) {
			$_page = $this->page+$i;
			if($_page > $this->pagenum) break;
			$_listpage .= '<a href="'.$this->url.'&page='.$_page.'">'.$_page.'</a>';
		}
		return $_listpage;
	}
	//首页
	private function homePage() {
		if($this->page > $this->bothnum+1) {
			return '&nbsp;<a href="'.$this->url.'">1</a>&nbsp;.&nbsp;.&nbsp;.&nbsp;&nbsp;';
		}
	}
	//末页
	private function lastPage() {
		if(($this->pagenum-$this->page) > $this->bothnum) {
			return '&nbsp;&nbsp;.&nbsp;.&nbsp;.&nbsp;<a href="'.$this->url.'&page='.$this->pagenum.'">'.$this->pagenum.'</a>&nbsp;';
		}
	}
	//上一页
	private function previousPage() {
		if($this->page == 1) {
			return '<span class="disabled">上一页</span>';
		}
		return '&nbsp;<a href="'.$this->url.'&page='.($this->page-1).'">上一页</a>&nbsp;';
	}
	//下一页
	private function nextPage() {
		if($this->page == $this->pagenum) {
			return '<span class="disabled">下一页</span>';
		}
		return '&nbsp;<a href="'.$this->url.'&page='.($this->page+1).'">下一页</a>&nbsp;';
	}
	//分页信息
	public function showPage() {
		$_page = null;
		$_page .= $this->homePage();
		$_page .= $this->listPage();
		$_page .= $this->lastPage();
		$_page .= $this->previousPage();
		$_page .= $this->nextPage();
		return $_page;
	}
}
