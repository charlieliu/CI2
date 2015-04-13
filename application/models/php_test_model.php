<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SESSION MODEL
 *
 * @author Charlie Liu <liuchangli0107@gmail.com>
 */
class Php_test_model extends CI_Model {

    function __construct()
    {
        // 呼叫模型(Model)的建構函數
        parent::__construct();
        $this->load->database();
    }

    public function query_hash_test($hash_key='',$page=1,$limit=20)
    {
        $limit = intval($limit);
        $offset = (intval($page)-1)*$limit ;
        $offset = ($offset <0) ? 0 : $offset ;
        if( $hash_key!='' )
        {
            $sql = "SELECT * FROM `hash_test`  WHERE `hash_key`=?";
            $query = $this->db->query($sql,array($hash_key));
        }
        else if( !empty($offset) && $limit>=0 )
        {
            $sql = "SELECT * FROM `hash_test` LIMIT ".$offset.",".$limit." ;";
            $query = $this->db->query($sql);
        }
        else
        {
            $sql = "SELECT * FROM `hash_test` LIMIT 20 ;";
            $query = $this->db->query($sql);
        }
        if( $hash_key!='' && $query->num_rows()==0 )
        {
            $this->add_hash_test($hash_key);
        }
        else
        {
            return array('data'=>$query->result_array());
        }
    }

    public function get_hash_test_num()
    {
        $sql = "SELECT count(`hash_key`) AS total  FROM `hash_test` ;";
        $query = $this->db->query($sql);
        return $query->result_array() ;
    }

    public function add_hash_test($hash_key='')
    {
        $data = array();
        if( $hash_key!='' )
        {
            $input = array(
                'hash_key'=>$hash_key,
                'md5_var'=>md5($hash_key),
                'sha1_var'=>sha1($hash_key),
                'sha256_var'=>hash('sha256',$hash_key),
                'sha512_var'=>hash('sha512',$hash_key),
            );
            $result = $this->db->insert('hash_test', $input);
            if($result)
            {
                $status = 100 ;
                $data = $input;
            }
            else
            {
                $status = 300 ;
            }
        }
        else
        {
            $status = 200;
        }
        return array('status'=>$status,'data'=>$data);
    }
}
?>