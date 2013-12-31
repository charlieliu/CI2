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

		// 時間顯示測試
		$date_test = $this->_date_test() ;

		/*
		// 增加自訂Session資料
		$newdata = array(
			'username'  => 'johndoe',
			'email'     => 'johndoe@some-site.com',
			'logged_in' => TRUE
		);
		$this->session->set_userdata($newdata);
		*/

		// 取得預設SESSION資料
		$session_id = $this->session->userdata('session_id') ; // CI session ID
		$ip_address = $this->session->userdata('ip_address') ; // 使用者IP位置
		$user_agent = $this->session->userdata('user_agent') ; // 使用者瀏覽器類型
		$last_activity = $this->session->userdata('last_activity') ; // 最後變動時間
		$user_data = $this->session->userdata('user_data') ;// 自訂資料
		//$user_data = $this->_str_replace(print_r($user_data,true)) ;
		//$user_data = $this->session->all_userdata() ;

		// ci_sessions
		$ci_sessions = array(
			'session_id' => $session_id,
			'ip_address' => $ip_address,
			'user_agent' => $user_agent,
			'last_activity' => $last_activity,
			'user_data' => $user_data,
		);


		// DB測試
		
		// 更新 SESSION_LOGS
		//$this->_delete_old_session() ;


		// 目前SESSION資料
		$SESSION_LOGS = array(
           'SESSION_ID'		=> $session_id ,
           'IP_ADDRESS'		=> $ip_address ,
           'USER_AGENT'		=> $user_agent 
        );

		// 取得存在DB個數
		$query = $this->db->get_where('SESSION_LOGS', $SESSION_LOGS) ;
		$count_num = $query->num_rows() ;
        
		
		if( $count_num == 0 )
		{
			$this->db->set('ADDTIME', 'NOW()',false);// 'NOW()' 強制CI不處理
			// CI 新增用法
			$this->db->insert('SESSION_LOGS', $SESSION_LOGS) ;
			// 更新目前資料庫查詢數量
			$query = $this->db->get_where('SESSION_LOGS', $SESSION_LOGS, 1) ;
			$count_num = $query->num_rows() ;
		}
		else
		{
			$this->db->set('UPDATETIME', 'NOW()',false);// 'NOW()' 強制CI不處理
			// CI 更新用法
			$this->db->where('SESSION_ID', $session_id);
			$this->db->update('SESSION_LOGS');
		}
        

		// SESSION_LOGS
		$SESSION_LOGS['SESSION_LOGS'] = print_r($SESSION_LOGS, true); // 最新資料筆數


		

		// 顯示資料
		$content = array();
		$content[] = array(
			'content_title' => 'ci_sessions',
			'content_value' => $this->_str_replace(print_r($ci_sessions,true))
		) ;
		$content[] = array(
			'content_title' => 'SESSION_LOGS',
			'content_value' => $this->_str_replace(print_r($SESSION_LOGS,true))
		) ;
		$content[] = array(
			'content_title' => 'Date',
			'content_value' => $this->_str_replace(print_r($date_test,true))
		) ;

		// 標題 內容顯示
		$data = array(
			'title' => 'Welcome to CodeIgniter',
			'current_page' => strtolower(__CLASS__), // 當下類別
			'current_fun' => strtolower(__FUNCTION__), // 當下function
			'content' => $content 
		);

		

		// Template parser class
		// 中間挖掉的部分
		$content_div = $this->parser->parse('welcome_view', $data, true);
		// 中間部分塞入外框
		$html_date = array( 'content_div' => $content_div ) ;
		$this->parser->parse('index_view', $html_date ) ;
		
	}

	private function _delete_old_session()
	{
		// 找出存活SESSION
		$isalive = array();
		
		$this->db->select('session_id');// 產生： SELECT session_id

		// 一分鐘前的SESSION
		$this->db->where('last_activity >', $this->session->userdata('last_activity')-60);	// 產生： WHERE last_activity > val
		
		$query = $this->db->get('ci_sessions');// 產生： SELECT session_id FROM mytable

		// 找出無用SESSION
		if( $query->num_rows() > 0 )
		{
			
			foreach ($query->result() as $v)
			{
		    	$v2 = get_object_vars($v) ;// object 轉換成 string
		    	$isalive[] = $v2['session_id'];
			}

			// 還存活的SESSION
			$query = $this->db->or_where_not_in('SESSION_ID', $isalive);	// 產生： WHERE SESSION_ID NOT IN ('val1', 'val2', 'val3') 	
			$query = $this->db->get('SESSION_LOGS');
			$delete_num = 0 ;
			if( $query->num_rows() > 0 )
			{
				// 取得 要刪除的SESSION ID
				$query_result = $query->result();
				$query_values = array();
				foreach ($query->result() as $v)
				{
					$v = get_object_vars($v);// object 轉換成 string
					$query_values[] = $v['SESSION_ID'] ;

				}
				//exit( 'LINE '.__LINE__.'<br />'.print_r($query_values, true) ) ;

				foreach ($query_values as $v)
				{
				    
			    	if( $delete_num == 0 )
			    	{
			    		//
			    		$this->db->where('SESSION_ID', $v);
			    	}
			    	else
			    	{
			    		//
			    		$this->db->or_where('SESSION_ID', $v);
			    	}
			    	$delete_num ++ ;
				    
				}
				
				$this->db->delete('SESSION_LOGS');
			}

		}
		else
		{
			$this->db->delete('SESSION_LOGS');
		}
	}

	private function _date_test()
	{
		$this->load->helper('date') ;
		$date_ary = array() ;

		$date_ary['date'] = date('Y-m-d H i s') ;

		$time = time() ;
		$date_ary['time'] = $time ;

		// eturns the current time as a Unix timestamp
		$date_ary['now'] = now() ;

		// If a timestamp is not included in the second parameter the current time will be used.
		$datestring = "Year: %Y Month: %m Day: %d - %h:%i %a" ;
		$date_ary['mdate'] = mdate($datestring, $time);

		// Lets you generate a date string in one of several standardized formats
		$date_ary['standard_date'] = array() ;
		$format = array() ;
		$format[] = 'DATE_ATOM';
		$format[] = 'DATE_COOKIE';
		$format[] = 'DATE_ISO8601';
		$format[] = 'DATE_RFC822';
		$format[] = 'DATE_RFC850';
		$format[] = 'DATE_RFC1036';
		$format[] = 'DATE_RFC1123';
		$format[] = 'DATE_RFC2822';
		$format[] = 'DATE_RSS';
		$format[] = 'DATE_W3C';
		foreach ($format as $value) {
			$date_ary['standard_date'][$value] = standard_date($value, $time) ;
		}
		

		// Takes a Unix timestamp as input and returns it as GMT
		$date_ary['local_to_gmt'] = local_to_gmt($time) ;

		// Takes a timezone reference (for a list of valid timezones，see the "Timezone Reference" below) and returns the number of hours offset from UTC.
		$date_ary['timezones'] = timezones('UM8') ;

		return $date_ary ;
	}

	private function _str_replace($str){
		$order = array("\r\n", "\n", "\r", "￼", "<br/>", "<br>");
		$str = str_replace($order,"<br />",$str);
		return $str;
	}
}