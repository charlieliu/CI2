<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session_test extends CI_Controller {

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
        // 呼叫 session_test_model
        $this->load->model('session_test_model','',TRUE);
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
        $UserAgent = $this->_get_UserAgent() ;
        $UserAgent_str = $UserAgent['A'].' : '.$UserAgent['AN'] ;

        // ci_sessions
        $ci_sessions = array(
            'session_id' => $session_id,
            'ip_address' => $ip_address,
            'user_agent' => $user_agent,
            'last_activity' => $last_activity,
            'user_data' => $user_data,
            'UserAgent' => $UserAgent_str,
        );


        // DB測試
        // 刪除1分鐘內沒反應的 SESSION_LOGS
        //$this->session_test_model->delete_old_session() ;

        // 目前SESSION資料
        $SESSION_LOGS = array(
           'SESSION_ID'     => $session_id ,
           'IP_ADDRESS'     => $ip_address ,
           'USER_AGENT'     => $user_agent,
        );

        // 更新DB
        $count_num = $this->session_test_model->session_test_updata($SESSION_LOGS) ;

        // SESSION_LOGS
        if( $count_num!=false )
        {
            $SESSION_LOGS['count_num'] = $count_num ; // 最新資料筆數
        }
        else
        {
            $SESSION_LOGS['count_num'] = 'false' ;
        }

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

        // 標題 內容顯示
        $data = array(
            'title' => 'CI session 測試',
            'current_page' => strtolower(__CLASS__), // 當下類別
            'current_fun' => strtolower(__FUNCTION__), // 當下function
            'content' => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('session_test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;
        $this->parser->parse('index_view', $html_date ) ;
    }

    private function _get_UserAgent(){
        // IE請參考
        // http://msdn.microsoft.com/en-us/library/ie/hh869301(v=vs.85).aspx

        $str = $_SERVER["HTTP_USER_AGENT"] ;
        $output = array(
            "O" => $str,// 原始 HTTP_USER_AGENT
            "A" => '',  // 瀏覽器 種類 IE/Firefox/Chrome/Safari/Opera
            "AN" => '', // 瀏覽器 版本
            "M" => '',  // 作業系統 Mobile/Desktop
            "S" => '',  // 作業系統
        );
        // 作業系統
        if( strpos($str,'Android') ){
            $output['M'] = 'Mobile';
            $output['S'] = 'Android';
        }
        else if( strpos($str,'BlackBerry')!==false )
        {
            $output['M'] = 'Mobile';
            $output['S'] = 'BlackBerry';
        }
        else if( strpos($str,'iPhone')!==false )
        {
            $output['M'] = 'Mobile';
            $output['S'] = 'iPhone';
        }
        else if( strpos($str,'ipod')!==false )
        {
            $output['M'] = 'Mobile';
            $output['S'] = 'ipod';
        }
        else if( strpos($str,'ipad')!==false )
        {
            $output['M'] = 'Mobile';
            $output['S'] = 'ipad';
        }
        else if( strpos($str,'Palm')!==false )
        {
            $output['M'] = 'Mobile';
            $output['S'] = 'Palm';
        }
        else if( strpos($str,'Linux')!==false )
        {
            $output['M'] = 'Desktop';
            $output['S'] = 'Linux';
        }
        else if( strpos($str,'Macintosh')!==false )
        {
            $output['M'] = 'Desktop';
            $output['S'] = 'Macintosh';
        }
        else if( strpos($str,'Windows')!==false )
        {
            $output['M'] = 'Desktop';
            $output['S'] = 'Windows';

        }

        // 瀏覽器
        if( strpos($str,"MSIE")!== false )
        {
            $output['A'] = "Internet Explorer";
        }
        else if( strpos($str,"Firefox")!== false )
        {
            $output['A'] = "Firefox";
        }
        else if
        (
            strpos($str,"Opera")!== false ||
            strpos($str,"OPR")!== false
        )
        {
            $output['A'] = "Opera";
        }
        else if( strpos($str,"Chrome")!== false )
        {
            $output['A'] = "Chrome";
        }
        else if( strpos($str,"Safari")!== false )
        {
            $output['A'] = "Safari";
        }
        else if
        (
            strpos($str,"rv:")!== false &&
            strpos($str,"Trident/")!== false
        )
        {
            $output['A'] = "Internet Explorer";
            $sit_0 = stripos($str,'rv:') + 3;
            $str = substr($str,$sit_0) ;
            $sit_1 = stripos($str,')') ;
            $output['AN'] = substr($str,0,$sit_1) ;
        }

        // 版本判斷
        if( $output['AN']=='' )
        {
            switch($output['A']){
                case 'Firefox':
                    $sit_0 = stripos($str,'Firefox/') + 8;
                    break;
                case 'Chrome':
                    $sit_0 = stripos($str,'Chrome/') + 7; ;
                    break;
                case 'Safari':
                    $sit_0 = stripos($str,'Version/') + 8;
                    break;
                case 'Opera':
                    $sit_0 = stripos($str,'OPR/') + 4;
                    break;
                case 'Internet Explorer':
                    $sit_0 = stripos($str,'MSIE ') + 5;
                    break;
            }
            $str = substr($str,$sit_0) ;
            if($output['A']=='Internet Explorer')
            {
                $sit_1 = stripos($str,';') ;
            }
            else
            {
                $sit_1 = stripos($str,' ') ;
            }
            if($sit_1!==false)
            {
                $output['AN'] = substr($str,0,$sit_1) ;
            }
            else
            {
                $output['AN'] = $str ;
            }
        }
        return $output;
    }

    private function _str_replace($str){
        $order = array("\r\n", "\n", "\r", "￼", "<br/>", "<br>");
        $str = str_replace($order,"<br />",$str);
        return $str;
    }
}
?>