<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SESSION MODEL
 *
 * @author Charlie Liu <liuchangli0107@gmail.com>
 */
class Session_test_model extends CI_Model {

    function __construct()
    {
        // 呼叫模型(Model)的建構函數
        parent::__construct();
        $this->load->database();
    }

    public function get_session_num($SESSION_LOGS=null)
    {
        // 取得存在DB個數
        $query = $this->db->get_where('SESSION_LOGS', $SESSION_LOGS) ;
        $count_num = $query->num_rows() ;
        return $count_num ;
    }

    public function session_test_updata($SESSION_LOGS=null)
    {
        /*
        $SESSION_LOGS = !is_null($SESSION_LOGS) ? $SESSION_LOGS : '' ;
        if( empty($SESSION_LOGS) )
        {
            return false ;
        }
        else
        {
            $count_num = $this->get_session_num($SESSION_LOGS) ;
            if( $count_num == 0 )
            {
                $this->db->set('ADDTIME', 'NOW()',false);// 'NOW()' 強制CI不處理
                // CI 新增用法
                $this->db->insert('SESSION_LOGS', $SESSION_LOGS) ;
            }
            else
            {
                $this->db->set('UPDATETIME', 'NOW()',false);// 'NOW()' 強制CI不處理
                // CI 更新用法
                $this->db->where('SESSION_ID', $SESSION_LOGS['SESSION_ID']);
                $this->db->update('SESSION_LOGS');
            }

            $count_num = $this->get_session_num($SESSION_LOGS) ;
            return $count_num ;
        }
        */
    }

    public function delete_old_session()
    {
        /*
        // 找出存活SESSION
        $isalive = array();

        $this->db->select('session_id');// 產生： SELECT session_id

        // 一分鐘前的SESSION
        $this->db->where('last_activity >', $this->session->userdata('last_activity')-60);  // 產生： WHERE last_activity > val

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
            $query = $this->db->or_where_not_in('SESSION_ID', $isalive);    // 產生： WHERE SESSION_ID NOT IN ('val1', 'val2', 'val3')
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
            //$this->db->delete('SESSION_LOGS');
        }
        */
    }

    public function get_session_info($session_id='')
    {
        if( !empty($session_id) )
        {
            $sql = "SELECT * FROM `SESSION_LOGS`  WHERE `SESSION_ID`='".$session_id."';";
            $query = $this->db->query($sql);
            return array('data'=>$query->result(),'total'=>$query->num_rows());
        }
        else
        {
            return array('data'=>array(),'total'=>0);
        }
    }

    public function add_session_info($session_id='')
    {
        if( empty($session_id) )
        {
            return 200;
        }
        else
        {
            $dt = new DateTime();
            $dt = $dt->format('U');
            $data = array(
                'SESSION_ID'=>$session_id,
                'IP_ADDRESS'=>$_SERVER['REMOTE_ADDR'],
                'USER_AGENT'=>$_SERVER["HTTP_USER_AGENT"],
                'ADDTIME'   =>$dt,
                'UPDATETIME'=>'',
                'IS_ALIVE'  =>1,
            );
            $result = $this->db->insert('SESSION_LOGS', $data);
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

    public function mod_session_info($session_id='')
    {
        if( empty($session_id) )
        {
            return 200;
        }
        else
        {
            $dt = new DateTime();
            $dt = $dt->format('U');
            $this->db->set('IS_ALIVE', 1, false);// 強制CI不處理
            $this->db->set('UPDATETIME', $dt, false);// 強制CI不處理
            // CI 更新用法
            $this->db->where('SESSION_ID', $session_id);
            $result = $this->db->update('SESSION_LOGS');
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

    public function del_session_info()
    {
        $dt = new DateTime();
        $dt = $dt->format('U');
        $sql = 'UPDATE `SESSION_LOGS` SET `IS_ALIVE`=0 WHERE `UPDATETIME`<'.($dt-120).' AND `IS_ALIVE`=1;';
        $query = $this->db->query($sql);
        if( $query )
        {
            return 100;
        }
        else
        {
            return 300;
        }
    }
}
?>