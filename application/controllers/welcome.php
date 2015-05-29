<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public $current_title = '首頁';

	public $page_list = '';

	public $UserAgent = array() ;

	public function getPageList()
	{
		echo json_encode($this->page_list);
	}

	public function __construct()
	{
		parent::__construct();
		header('Content-Type: text/html; charset=utf8');
		// load parser
		$this->load->library(array('parser','session', 'pub'));
		$this->load->helper(array('form', 'url'));
		//$this->pub->check_session($this->session->userdata('session_id'));
		$this->load->model('php_test_model','',TRUE) ;

		$this->UserAgent = $this->pub->get_UserAgent() ;
		if( isset($this->UserAgent['O']) )
		{
			$this->php_test_model->query_user_agent($this->UserAgent) ;
		}


		// 顯示資料
		$content = array();
		/*
		$content[] = array(
			'content_value' => 'welcome',
			'content_title' => '首頁',
			'content_url' => 'welcome'
		) ;
		*/
		$content[] = array(
			'content_title' => 'CSS效果測試',
			'content_url' => base_url().'css_test',
			'c'=>'css_test',
		) ;
		$content[] = array(
			'content_title' => 'SVG效果測試',
			'content_url' => base_url().'svg_test',
			'c'=>'',
		) ;
		$content[] = array(
			'content_title' => 'PHP 測試',
			'content_url' => base_url().'php_test?XDEBUG_SESSION_START=sublime.xdebug',
			'c'=>'php_test',
		) ;
		$content[] = array(
			'content_title' => 'JS 測試',
			'content_url' => base_url().'js_test?XDEBUG_SESSION_START=sublime.xdebug',
			'c'=>'js_test',
		) ;
		$content[] = array(
			'content_title' => 'HTML5 測試',
			'content_url' => base_url().'html5_test?XDEBUG_SESSION_START=sublime.xdebug',
			'c'=>'html5_test',
		) ;
		$content[] = array(
			'content_title' => 'Login 測試',
			'content_url' => base_url().'login?XDEBUG_SESSION_START=sublime.xdebug',
			'c'=>'login',
		) ;
		$content[] = array(
			'content_title' => 'Predis 測試',
			'content_url' => base_url().'predis_test?XDEBUG_SESSION_START=sublime.xdebug',
			'c'=>'predis_test',
		) ;
		$content[] = array(
			'content_title' => 'redis 測試',
			'content_url' => base_url().'redis_test?XDEBUG_SESSION_START=sublime.xdebug',
			'c'=>'redis_test',
		) ;
		$content[] = array(
			'content_title' => '動態 Hash 測試',
			'content_url' => base_url().'hash_test?XDEBUG_SESSION_START=sublime.xdebug',
			'c'=>'',
		) ;
		$content[] = array(
			'content_title' => 'phpinfo',
			'content_url' => base_url().'welcome/phpinfo',
			'c'=>'',
		) ;

		$this->page_list = $content ;
	}

	/**
	 * Index Page for this controller.
	 *
	 * @author Charlie Liu <liuchangli0107@gmail.com>
	 */
	public function index()
	{
		$content = $this->page_list;
		// 標題 內容顯示
		$data = array(
			'title' => 'Home',
			'current_title' => $this->current_title,
			'current_page' => strtolower(__CLASS__), // 當下類別
			'current_fun' => strtolower(__FUNCTION__), // 當下function
			'content' => $content,
		);

		// Template parser class
		// 中間挖掉的部分
		$content_div = $this->parser->parse('welcome_view', $data, true);
		// 中間部分塞入外框
		$html_date = $data ;
		$html_date['content_div'] = $content_div ;

		$view = $this->parser->parse('index_view', $html_date, true);
		$this->pub->remove_view_space($view);
	}

	public function phpinfo()
	{
		phpinfo();
	}
}
?>
