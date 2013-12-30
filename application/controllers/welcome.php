<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

	/**
	 * Index Page for this controller.
	 *
	 * @author Charlie Liu <liuchangli0107@gmail.com>
	 */
	public function index()
	{
		// load parser
		$this->load->library('parser');

		// 取得預設SESSION資料
		$session_id = $this->session->userdata('session_id') ;
		$ip_address = $this->session->userdata('ip_address') ;
		$user_agent = $this->session->userdata('user_agent') ;
		$last_activity = $this->session->userdata('last_activity') ;
		$user_data = $this->session->userdata('user_data') ;

		// DB測試
		$test_ary = array(
           'SESSION_ID'		=> $session_id ,
           'IP_ADDRESS'		=> $ip_address ,
           'USER_AGENT'		=> $user_agent 
        );

		// 取得存在DB個數
		$test_query = $this->db->get_where('TEST_ARY', $test_ary, 1) ;
		$count_num = $test_query->num_rows() ;
        
		
		if( $count_num == 0 )
		{
			// 'NOW()' 強制CI不處理
			$this->db->set('ADDTIME', 'NOW()',false);
			// 新增
			$this->db->insert('TEST_ARY', $test_ary) ;
			// 更新目前資料庫查詢數量
			$test_query = $this->db->get_where('TEST_ARY', $test_ary, 1) ;
			$count_num = $test_query->num_rows() ;
		}
		else
		{
			$this->db->where('SESSION_ID', $session_id);
			// 'NOW()' 強制CI不處理
			$this->db->set('UPDATETIME', 'NOW()',false);
			$this->db->update('TEST_ARY');
		}

        //$this->db->_error_message();
        

		// 顯示資料
		$test_ary['COUNT_NUM'] = $count_num;
		$content = '' ;
		$content .= !empty($session_id)?'session_id : '.$session_id.'<br />':'' ;
		$content .= !empty($ip_address)?'ip_address : '.$ip_address.'<br />':'' ;
		$content .= !empty($user_agent)?'user_agent : '.$user_agent.'<br />':'' ;
		$content .= !empty($last_activity)?'last_activity : '.$last_activity.'<br />':'' ;
		$content .= !empty($user_data)?'user_data : '.$user_data.'<br />':'' ;
		$content .= 'session_test : '.print_r($test_ary,true).'<br />' ;

		// 標題 內容顯示
		$data = array(
			'title' => 'Welcome to CodeIgniter',
			'current_page' => strtolower(__CLASS__),
			'current_fun' => strtolower(__FUNCTION__),
			'content' => $content 
		);

		// Template parser class
		$this->parser->parse('welcome_view', $data);
		
	}
}