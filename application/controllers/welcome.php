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
		/*
		$content = '';

		$session_ary = $this->session->userdata() ;
		if( isset($session_ary) )
		{
			foreach ($session_ary as $key => $value)
			{
				$content .= $key.'=>'.$value.'<br />' ;
			}
		}
		*/
		$content = '' ;
		$content .= 'session_id : '.$this->session->userdata('session_id').'<br />' ;
		$content .= 'ip_address : '.$this->session->userdata('ip_address').'<br />' ;
		$content .= 'user_agent : '.$this->session->userdata('user_agent').'<br />' ;
		$content .= 'last_activity : '.$this->session->userdata('last_activity').'<br />' ;
		$content .= 'user_data : '.$this->session->userdata('user_data').'<br />' ;

		$data = array(
			'title' => 'Welcome to CodeIgniter',
			'current_page' => strtolower(__CLASS__),
			'content' => $content 
		);

		// Template parser class
		$this->parser->parse('welcome_view', $data);
	}
}