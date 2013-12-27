<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
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

		$session_id = $this->session->userdata('session_id');

		$data = array(
			'title' => 'Welcome to CodeIgniter',
			'current_page' => strtolower(__CLASS__),
			'content' => $session_id
		);

		// Template parser class
		$this->parser->parse('welcome_view', $data);
	}
}