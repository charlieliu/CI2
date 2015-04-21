<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SESSION MODEL
 *
 * @author Charlie Liu <liuchangli0107@gmail.com>
 */
class Html_test_model extends CI_Model {

	function __construct()
	{
		// 呼叫模型(Model)的建構函數
		parent::__construct();
		$this->load->database();
	}

	public function query_browsers()
	{
		$sql = "SELECT * FROM `user_agent` WHERE 1=1 ORDER BY `agent_name`,`agent_version` ;";
		$query = $this->db->query($sql) ;
		$data = $query->result_array() ;
		$total = $query->num_rows() ;
		$browsers = array() ;
		foreach ($data as $row)
		{
			$version = explode('.', $row['agent_version']) ;
			$browsers[] = $row['agent_name'].' '.$version[0] ;
		}
		$browsers = array_unique($browsers)  ;
		return $browsers ;
	}
}
?>