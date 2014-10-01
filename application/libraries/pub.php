<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pub extends CI_Controller {

    function check_session()
    {
        $this->load->library('session');
        $this->load->database();
        $this->load->model('session_test_model','',TRUE);
        $SESSION_LOGS = $this->session_test_model->get_session_info($this->session->userdata('session_id'));
        $data = $SESSION_LOGS['data'][0] ;

        if( $SESSION_LOGS['total']<1 )
        {
            $add_session_info = $this->session_test_model->add_session_info($this->session->userdata('session_id'));
            if( $add_session_info!=100 )
            {
                exit('add_session_info :'.$add_session_info);
            }
        }
        else if( $SESSION_LOGS['total']>1 )
        {
            exit('get_session_info :'.$SESSION_LOGS['total']);
        }
        else if( $data->IP_ADDRESS!=$_SERVER['REMOTE_ADDR'] )
        {
            exit('IP_ADDRESS');
        }
        else if( $data->USER_AGENT!=$_SERVER["HTTP_USER_AGENT"] )
        {
            exit('USER_AGENT');
        }
    }
}
?>