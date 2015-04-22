<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author Charlie Liu <liuchangli0107@gmail.com>
*/
class Redis_test extends CI_Controller {

	private $current_title = 'Redis 測試';
	private $page_list = '';
	private $_csrf = null ;

	public $UserAgent = array() ;

	// 建構子
	public function __construct()
	{
		parent::__construct();
		header('Content-Type: text/html; charset=utf8');

		// for CSRF
		$this->_csrf = array(
			'csrf_name' => $this->security->get_csrf_token_name(),
			'csrf_value' => $this->security->get_csrf_hash(),
		);

		// load parser
		$this->load->library(array('parser','session', 'pub'));
		$this->load->helper(array('form', 'url'));

		$this->UserAgent = $this->pub->get_UserAgent() ;
		if( isset($this->UserAgent['O']) )
		{
			$this->load->model('php_test_model','',TRUE) ;
			$this->php_test_model->query_user_agent($this->UserAgent) ;
		}
	}

	// 取得標題
	public function getPageList()
	{
		echo json_encode($this->page_list);
	}

	// 測試分類畫面
	public function index()
	{
		$grid_data['redis_act']= array('get','set','del','incr','incrby','incrbyfloat','decr','decrby') ;
		$grid_data = array_merge($grid_data,$this->_csrf);
		$grid_view = $this->parser->parse('redis_test/redis_test_grid_view', $grid_data, true) ;

		// 標題 內容顯示
		$data = array(
			'title' 		=> $this->current_title,
			'current_title' 	=> $this->current_title,
			'current_page' 	=> strtolower(__CLASS__), // 當下類別
			'current_fun' 	=> strtolower(__FUNCTION__), // 當下function
			'base_url'	=> base_url(),
			'grid_view'	=> $grid_view,
		);

		// 中間挖掉的部分
		$data = array_merge($data,$this->_csrf);
		$content_div = $this->parser->parse('redis_test/redis_test_view', $data, true) ;

		// 中間部分塞入外框
		$html_date = $data ;
		$html_date['content_div'] = $content_div ;
		$html_date['js'][] = 'js/redis_test.js';

		$view = $this->parser->parse('index_view', $html_date, true);
		$this->pub->remove_view_space($view);
	}

	public function do_redis()
	{
		$this->load->library('redis') ;
		if( $this->redis->command('PING')!='PONG' )
		{
			exit('LINE:'.__LINE__);
		}

		$post = $this->input->post();
		$post = $this->pub->trim_val($post);

		$result = '' ;
		if( !empty($post) )
		{
			$redis_act = isset($post['redis_act']) ? $post['redis_act'] : '' ;
			$key_str = isset($post['key_str']) ? $post['key_str'] : '' ;
			$val_str = isset($post['val_str']) ? $post['val_str'] : '' ;
			switch($redis_act)
			{
				case 'get':
					$result = $this->redis->get($key_str) ;
					break;
				case 'set':
					$result = $this->redis->set($key_str, $val_str) ;
					break;
				case 'del':
					$result = $this->redis->del($key_str) ;
					break;
				case 'incr':
					$result = $this->redis->incr($key_str) ;
					break;
				case 'incrby':
					$val_str = intval($val_str) ;
					$result = $this->redis->incrby($key_str, $val_str) ;
					break;
				case 'incrbyfloat':
					//$val_str = floatval($val_str) ;
					$result = $this->redis->incrbyfloat($key_str, $val_str) ;
					break;
				case 'decr':
					$result = $this->redis->decr($key_str) ;
					break;
				case 'decrby':
					$val_str = intval($val_str) ;
					$result = $this->redis->decrby($key_str, $val_str) ;
					break;
			}
		}
		$result = is_null($result) ? 'nil' : $result ;
		$result = is_bool($result) ? ($result ? 'true' : 'false') : $result ;
		echo json_encode(array('result'=>(string)$result,'key_str'=>$key_str,'val_str'=>$val_str,)) ;
	}

	public function get_url()
	{
		header('content-type: application/javascript') ;
		echo 'var URLs = "'.base_url().'redis_test/do_redis";' ;
	}
}
?>