<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pub extends CI_Controller {

    function check_session()
    {
        $this->load->library('session');
        $this->load->database();
        $this->load->model('session_test_model','',TRUE);
        $this->session_test_model->del_session_info();
        $SESSION_LOGS = $this->get_session_info();
        $data = !empty($SESSION_LOGS['data'][0]) ? $SESSION_LOGS['data'][0] : '' ;

        if( $SESSION_LOGS['total']<1 )
        {
            $add_session_info = $this->session_test_model->add_session_info($this->session->userdata('session_id'));
            if( $add_session_info!=100 )
            {
                exit('add_session_info :'.$add_session_info);
            }
            $SESSION_LOGS = $this->get_session_info();
            $data = !empty($SESSION_LOGS['data'][0]) ? $SESSION_LOGS['data'][0] : '' ;
        }
        else if( $SESSION_LOGS['total']>1 )
        {
            exit('get_session_info :'.$SESSION_LOGS['total']);
        }
        else if( $data->IP_ADDRESS!=$_SERVER['REMOTE_ADDR'] )
        {
            $this->session->sess_destroy();// 銷毀Session
            exit('IP_ADDRESS');
        }
        else if( $data->USER_AGENT!=$_SERVER["HTTP_USER_AGENT"] )
        {
            $this->session->sess_destroy();// 銷毀Session
            exit('USER_AGENT');
        }
        else
        {
            $mod_session_info = $this->session_test_model->mod_session_info($this->session->userdata('session_id'));
            if( $mod_session_info!=100 )
            {
                exit('mod_session_info :'.$mod_session_info);
            }
        }
        return $data;
    }

    function get_session_info()
    {
        $this->load->library('session');
        $this->load->database();
        $this->load->model('session_test_model','',TRUE);
        return $this->session_test_model->get_session_info($this->session->userdata('session_id'));
    }
}
?>