<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SESSION MODEL
 *
 * @author Charlie Liu <liuchangli0107@gmail.com>
 */
class Login_model extends CI_Model {

    function __construct()
    {
        // 呼叫模型(Model)的建構函數
        parent::__construct();
    }

    public function getUsers($data='')
    {
        if( !empty($data['username']) )
        {
            $sql = 'SELECT * FROM user  WHERE `username`='.$data['username'];
            $query = $this->db->query($sql);
            return $query->result();
        }
        else
        {
            return array();
        }
    }

    public function insUsers()
    {
        $sql = "SELECT * FROM user  WHERE 1";
        $query = $this->db->query($sql);
        return $query->result();
    }
}
?>