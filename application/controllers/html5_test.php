<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author Charlie Liu <liuchangli0107@gmail.com>
*/
class Html5_test extends CI_Controller {

	private $current_title = 'HTML5 測試';
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
		//$this->pub->check_session($this->session->userdata('session_id'));
		$this->load->model('php_test_model','',TRUE) ;

		$this->UserAgent = $this->pub->get_UserAgent() ;
		if( isset($this->UserAgent['O']) )
		{
			$this->php_test_model->query_user_agent($this->UserAgent) ;
		}

		$content[] = array(
			'content_title' => '控制 HTML5 視訊播放程式',
			'content_url' => base_url().'html5_test/test/1',
		) ;
		$content[] = array(
			'content_title' => 'Form',
			'content_url' => base_url().'html5_test/test/2',
		) ;
		$content[] = array(
			'content_title' => 'datalist',
			'content_url' => base_url().'html5_test/test/3',
		) ;
		$content[] = array(
			'content_title' => 'output',
			'content_url' => base_url().'html5_test/test/4',
		) ;
		$content[] = array(
			'content_title' => 'data-* Attributes',
			'content_url' => base_url().'html5_test/test/5',
		) ;
		$content[] = array(
			'content_title' => 'drap / drop',
			'content_url' => base_url().'html5_test/test/6',
		) ;

		$this->page_list = $content ;
	}

	// 取得標題
	public function getPageList()
	{
		echo json_encode($this->page_list);
	}

	// 測試分類畫面
	public function index()
	{
		$content = $this->page_list ;
		// 標題 內容顯示
		$data = array(
			'title' => $this->current_title,
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

	// VIEW
	public function test($in='1')
	{
		$this->load->model('html_test_model','',TRUE) ;

		$post = $this->input->post();
		$post = $this->pub->trim_val($post);
		if( !empty($post) )
		{
			if( $in=='3' && !empty($post['browser']) )
			{
				$query_ary = explode(' ', $post['browser']) ;
				if( isset($query_ary[1]) )
				{
					$browsers = $this->html_test_model->query_browsers($query_ary[0],$query_ary[1]);
				}
				else if( !empty($query_ary[0]) )
				{
					$browsers = $this->html_test_model->query_browsers($query_ary[0]);
				}
				//$browsers = array_merge($post,$browsers) ;
				//$browsers = array_merge($query_ary,$browsers) ;
				exit( json_encode($browsers) ) ;
			}
			if( isset($_FILES) )
			{
				foreach ($_FILES as $key => $value)
				{
					$post['FILES'][$key] = $value;
				}
			}
			echo json_encode($post);
		}
		else
		{
			// 標題 內容顯示
			$data = array(
				'title' => $this->current_title,
				'current_title' => $this->current_title,
				'current_page' => strtolower(__CLASS__), // 當下類別
				'current_fun' => strtolower(__FUNCTION__), // 當下function
				'content' => '',
				'base_url'=>base_url(),
				'space_4'=>$this->pub->n2nbsp(4),
			);

			switch ($in) {
				case '1':
					$data['title'] .= ' -- HTML Media' ;
					break;
				case '2':
					$data['title'] .= ' -- Form / Input' ;
					$type_arr = array();
					$type_arr[] = array(
						'type'=>'text',
						'browser_support'=>array(
							'Arora'=>0,
							'Chrome'=>1,
							'Dillo'=>0,
							'Elinks'=>0,
							'Epiphany'=>0,
							'Firefox'=>1,
							'IE11'=>1,
							'Midori'=>0,
							'Opera'=>1,
							'QupZilla'=>0,
							'Safari'=>0,
						),
					);
					$type_arr[] = array(
						'type'=>'email',
						'browser_support'=>array(
							'Arora'=>0,
							'Chrome'=>1,
							'Dillo'=>0,
							'Elinks'=>0,
							'Epiphany'=>0,
							'Firefox'=>1,
							'IE11'=>1,
							'Midori'=>0,
							'Opera'=>1,
							'QupZilla'=>0,
							'Safari'=>0,
						),
					);
					$type_arr[] = array(
						'type'=>'color',
						'browser_support'=>array(
							'Arora'=>1,
							'Chrome'=>1,
							'Dillo'=>0,
							'Elinks'=>0,
							'Epiphany'=>0,
							'Firefox'=>1,
							'IE11'=>0,
							'Midori'=>0,
							'Opera'=>1,
							'QupZilla'=>1,
							'Safari'=>0,
						),
					);
					$type_arr[] = array(
						'type'=>'number',
						'browser_support'=>array(
							'Arora'=>0,
							'Chrome'=>1,
							'Dillo'=>0,
							'Elinks'=>0,
							'Epiphany'=>0,
							'Firefox'=>1,
							'IE11'=>0,
							'Midori'=>0,
							'Opera'=>1,
							'QupZilla'=>0,
							'Safari'=>1,
						),
					);
					$type_arr[] = array(
						'type'=>'tel',
						'browser_support'=>array(
							'Arora'=>0,
							'Chrome'=>0,
							'Dillo'=>0,
							'Elinks'=>0,
							'Epiphany'=>0,
							'Firefox'=>0,
							'IE11'=>0,
							'Midori'=>0,
							'Opera'=>0,
							'QupZilla'=>0,
							'Safari'=>0,
						),
					);
					$type_arr[] = array(
						'type'=>'date',
						'browser_support'=>array(
							'Arora'=>0,
							'Chrome'=>1,
							'Dillo'=>0,
							'Elinks'=>0,
							'Epiphany'=>0,
							'Firefox'=>0,
							'IE11'=>0,
							'Midori'=>0,
							'Opera'=>1,
							'QupZilla'=>0,
							'Safari'=>1,
						),
					);
					$type_arr[] = array(
						'type'=>'month',
						'browser_support'=>array(
							'Arora'=>0,
							'Chrome'=>1,
							'Dillo'=>0,
							'Elinks'=>0,
							'Epiphany'=>0,
							'Firefox'=>0,
							'IE11'=>0,
							'Midori'=>0,
							'Opera'=>1,
							'QupZilla'=>0,
							'Safari'=>1,
						),
					);
					$type_arr[] = array(
						'type'=>'week',
						'browser_support'=>array(
							'Arora'=>0,
							'Chrome'=>1,
							'Dillo'=>0,
							'Elinks'=>0,
							'Epiphany'=>0,
							'Firefox'=>0,
							'IE11'=>0,
							'Midori'=>0,
							'Opera'=>1,
							'QupZilla'=>0,
							'Safari'=>1,
						),
					);
					$type_arr[] = array(
						'type'=>'time',
						'browser_support'=>array(
							'Arora'=>0,
							'Chrome'=>1,
							'Dillo'=>0,
							'Elinks'=>0,
							'Epiphany'=>0,
							'Firefox'=>0,
							'IE11'=>0,
							'Midori'=>0,
							'Opera'=>1,
							'QupZilla'=>0,
							'Safari'=>1,
						),
					);
					$type_arr[] = array(
						'type'=>'datetime-local',
						'browser_support'=>array(
							'Arora'=>0,
							'Chrome'=>1,
							'Dillo'=>0,
							'Elinks'=>0,
							'Epiphany'=>0,
							'Firefox'=>0,
							'IE11'=>0,
							'Midori'=>0,
							'Opera'=>1,
							'QupZilla'=>0,
							'Safari'=>1,
						),
					);
					$type_arr[] = array(
						'type'=>'datetime',
						'browser_support'=>array(
							'Arora'=>0,
							'Chrome'=>0,
							'Dillo'=>0,
							'Elinks'=>0,
							'Epiphany'=>0,
							'Firefox'=>0,
							'IE11'=>0,
							'Midori'=>0,
							'Opera'=>0,
							'QupZilla'=>0,
							'Safari'=>1,
						),
					);
					$data['test_date'] = '18Mar2015' ;
					$data['grid_view'] = $this->parser->parse('html5_test/test_'.$in.'_grid_view', array('type_arr'=>$type_arr), true);
					break;
				case '3':
					$data['title'] .= ' -- &lt;datalist&gt;' ;
					$browsers = $this->html_test_model->query_browsers();
					$data['browsers'] = array() ;
					foreach ($browsers['data'] as $row)
					{
						$version = explode('.', $row['agent_version']) ;
						$data['browsers'][] = $row['agent_name'].' '.$version[0] ;
					}
					$data['browsers'] = array_unique($data['browsers'])  ;
					break;
				case '4':
					$data['title'] .= ' -- &lt;output&gt;' ;
					break;
				case '5':
					$data['title'] .= ' -- data-* Attributes' ;
					break;
				case '6':
					$data['title'] .= ' -- drap / drop' ;
					break;
				default:
					$in = '' ;
					break;
			}
			if( !empty($in) )
			{
				$data['js'][] = 'js/html5_test/test_'.$in.'.js';
			}

			// 中間挖掉的部分
			$data = array_merge($data,$this->_csrf);
			$content_div = empty($in) ? '' : $this->parser->parse('html5_test/test_'.$in.'_view', $data, true);

			// 中間部分塞入外框
			$html_date = $data ;
			$html_date['content_div'] = $content_div ;

			$view = $this->parser->parse('index_view', $html_date, true);
			$this->pub->remove_view_space($view);
		}
	}

	public function get_url($in='')
	{
		header('content-type: application/javascript') ;
		if( $in=='3' )
		{
			echo 'var URLs = "'.base_url().'html5_test/test/3";' ;
		}
	}
}
?>