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
        $this->load->database();
    }

    public function getUsers($input='')
    {
        if( !empty($input) )
        {
            $sql = "SELECT * FROM user  WHERE `username`='".$input."'";
            $query = $this->db->query($sql);
            return array('data'=>$query->result_array(),'total'=>$query->num_rows());
        }
        else
        {
            return array('data'=>array(),'total'=>0);
        }
    }

    public function insUsers($input=array())
    {
        if( $input['username']=='' )
        {
            return 201;
        }
        else if( $input['password']=='' )
        {
            return 202;
        }
        else if( empty($input['email']) )
        {
            return 203;
        }
        else if( empty($input['addr']) )
        {
            return 204;
        }
        else
        {
            $dt = new DateTime();
            $dt = $dt->format('U');
            $data = array(
                'username'=>$input['username'],
                'salt'=>$input['salt'],
                'password'=>$input['password'],
                'email'=>$input['email'],
                'add_date'=>$dt,
                'login_date'=>'',
                'addr'=>$input['addr'],
            );
            if( $this->db->insert('user', $data) )
            {
                return 100;
            }
            else
            {
                return 300;
            }
        }
    }

    public function updateUsers($input='')
    {
        if( empty($input) )
        {
            return 200;
        }
        else
        {
            $dt = new DateTime();
            $dt = $dt->format('U');
            $this->db->set('login_date', $dt, false);// 強制CI不處理
            $this->db->where('uid', $input);
            $result = $this->db->update('user');// CI 更新用法
            if( $result )
            {
                return 100;
            }
            else
            {
                return 300;
            }
        }
    }
}
?>