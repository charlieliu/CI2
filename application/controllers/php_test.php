<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Php_test extends CI_Controller {

    public $current_title = 'PHP 測試';

    public $page_list = '';

    public $UserAgent = array() ;

    public function getPageList()
    {
        echo json_encode($this->page_list);
    }

    public function __construct()
    {
        parent::__construct();
        header('Content-Type: text/html; charset=utf8');
        // load parser
        $this->load->library(array('parser','session', 'pub'));
        $this->load->helper(array('form', 'url'));
        $this->load->model('php_test_model','',TRUE) ;

        $this->UserAgent = $this->pub->get_UserAgent() ;
        if( isset($this->UserAgent['O']) )
        {
            $this->php_test_model->query_user_agent($this->UserAgent) ;
        }

        // 顯示資料
        $content = array();
        $content[] = array(
            'content_title' => 'PHP浮點 測試',
            'content_url' => 'php_test/float_test',
        ) ;
        $content[] = array(
            'content_title' => 'PHP bcadd() 測試',
            'content_url' => 'php_test/bcadd_test',
        ) ;
        $content[] = array(
            'content_title' => '時間格式顯示',
            'content_url' => 'php_test/date_test',
        ) ;
        $content[] = array(
            'content_title' => 'CI session 測試',
            'content_url' => 'php_test/session_test',
        ) ;
        $content[] = array(
            'content_title' => 'count() sizeof() 效能比較',
            'content_url' => 'php_test/count_sizeof'
        ) ;
        $content[] = array(
            'content_title' => 'Hash encode 測試',
            'content_url' => 'php_test/hash_test',
        ) ;
        $content[] = array(
            'content_title' => 'decode 測試',
            'content_url' => 'php_test/decode_test',
        ) ;
        $content[] = array(
            'content_title' => '正規表示式 測試',
            'content_url' => 'php_test/preg_test',
        ) ;
        $content[] = array(
            'content_title' => 'php chr() -- ASCII',
            'content_url' => 'php_test/php_chr',
        ) ;
        $content[] = array(
            'content_title' => 'if else & switch 效能比較',
            'content_url' => 'php_test/switch_test',
        ) ;
        $content[] = array(
            'content_title' => 'pwds Hash list',
            'content_url' => 'php_test/get_top_500_pwd',
        ) ;

        $this->page_list = $content ;
    }

    /**
     * @author Charlie Liu <liuchangli0107@gmail.com>
     */
    public function index()
    {
        //$this->check_session();

        $content = $this->page_list ;

        // 標題 內容顯示
        $data = array(
            'title' => 'PHP 測試',
            'current_title' => $this->current_title,
            'current_page' => strtolower(__CLASS__), // 當下類別
            'current_fun' => strtolower(__FUNCTION__), // 當下function
            'content' => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('welcome_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);
    }

    public function float_test()
    {
        //$this->check_session();

        // 顯示資料
        $content = array();

        // 測試Array
        $test_i = array();
        $test_i[] = array(
            'val' => '5650175242.508133742 + 308437806.831153821478770',
            'count' => 5650175242.508133742 + 308437806.831153821478770,
        );
        $test_i[] = array(
            'val' => '1000000069.321 - 1000000000',
            'count' => 1000000069.321 - 1000000000,
        );
        $test_i[] = array(
            'val' => '100000069.321 - 100000000',
            'count' => 100000069.321 - 100000000,
        );
        $test_i[] = array(
            'val' => '10000069.321 - 10000000',
            'count' => 10000069.321 - 10000000,
        );
        $test_i[] = array(
            'val' => '1000069.321 - 1000000',
            'count' => 1000069.321 - 1000000,
        );
        $test_i[] = array(
            'val' => '100069.321 - 100000',
            'count' => 100069.321 - 100000,
        );

        $part_str = '';
        foreach( $test_i as $k=>$v )
        {
            $part_str .= '<div><b>'.$v['val'].' = </b>'.$v['count'].'</div>' ;

        }
        $content[] = array(
            'content_title' => 'Part 1',
            'content_value' => $part_str,
        ) ;

        // 測試Array
        $test_i2 = array();
        $test_i2[] = array(
            'val' => '1048576.321 - 1048576',
            'count' => 1048576.321 - 1048576,
        );
        $test_i2[] = array(
            'val' => '524288.321 - 524288',
            'count' => 524288.321 - 524288,
        );
        $test_i2[] = array(
            'val' => '262144.321 - 262144',
            'count' => 262144.321 - 262144,
        );
        $test_i2[] = array(
            'val' => '131072.321 - 131072',
            'count' => 131072.321 - 131072,
        );
        $test_i2[] = array(
            'val' => '65536.321 - 65536',
            'count' => 65536.321 - 65536,
        );
        $test_i2[] = array(
            'val' => '32768.321 - 32768',
            'count' => 32768.321 - 32768,
        );
        $test_i2[] = array(
            'val' => '16384.321 - 16384',
            'count' => 16384.321 - 16384,
        );
        $test_i2[] = array(
            'val' => '8192.321 - 8192',
            'count' => 8192.321 - 8192,
        );

        $part_str = '';
        foreach( $test_i2 as $k=>$v )
        {
            $part_str .= '<div><b>'.$v['val'].' = </b>'.$v['count'].'</div>' ;
        }
        $content[] = array(
            'content_title' => 'Part 2',
            'content_value' => $part_str,
        ) ;

        // 標題 內容顯示
        $data = array(
            'title'      => 'Floating-point',
            'current_title' => $this->current_title,
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'=> strtolower(__FUNCTION__), // 當下function
            'content'    => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);
    }

    public function bcadd_test()
    {
        //$this->check_session();

        // 顯示資料
        $content = array();

        // 測試Array
        $test_i = array();
        $test_i[] = array(
            'a' => '5650175242.508133742',
            'b' => '308437806.831153821478770',
        );
        $test_i[] = array(
            'a' => '1000000069.321',
            'b' => '-1000000000.339287563478770',
        );
        $test_i[] = array(
            'a' => '100000069.321',
            'b' => '-100000000.339287563478770',
        );
        $test_i[] = array(
            'a' => '10000069.321',
            'b' => '-10000000.339287563478770',
        );
        $test_i[] = array(
            'a' => '1000069.321',
            'b' => '-1000000.339287563478770',
        );
        $test_i[] = array(
            'a' => '100069.321',
            'b' => '-100000.339287563478770',
        );
        $test_i[] = array(
            'a' => '1048576.321',
            'b' => '-1048576',
        );
        $test_i[] = array(
            'a' => '524288.321',
            'b' => '-524288',
        );
        $test_i[] = array(
            'a' => '262144.321',
            'b' => '-262144',
        );
        $test_i[] = array(
            'a' => '131072.321',
            'b' => '-131072',
        );
        $test_i[] = array(
            'a' => '65536.321',
            'b' => '-65536',
        );
        $test_i[] = array(
            'a' => '32768.321',
            'b' => '-32768',
        );
        $test_i[] = array(
            'a' => '16384.321',
            'b' => '-16384',
        );
        $test_i[] = array(
            'a' => '8192.321',
            'b' => '-8192',
        );
        $test_i[] = array(
            'a' => '1E5',
            'b' => '2E4',
        );
        $test_i[] = array(
            'a' => '" OR 1=1 #',
            'b' => 'alert(1)',
        );

        foreach( $test_i as $k=>$v )
        {
            $part_str = '<table border=1>';
            $part_str .= '<tr><th>type</th><th>a</th><th>b</th><th>bcadd(a,b)</th></tr>';
            $part_str .= '<tr><td>(string)</td><td>'.(string)$v['a'].'</td><td>'.(string)$v['b'].' </td><td>'.bcadd((string)$v['a'], (string)$v['b'], 15).'</td></tr>';
            $part_str .= '<tr><td>(float)</td><td>'.(float)$v['a'].'</td><td>'.(float)$v['b'].' </td><td>'.bcadd((float)$v['a'], (float)$v['b'], 15).'</td></tr>';
            $part_str .= '<tr><td>(int)</td><td>'.(int)$v['a'].'</td><td>'.(int)$v['b'].' </td><td>'.bcadd((int)$v['a'], (int)$v['b'], 15).'</td></tr>';
            $part_str .= '</table><br>';
            $content[] = array(
                'content_title' => 'Part '.($k+1),
                'content_value' => $part_str,
            ) ;
        }

        // 標題 內容顯示
        $data = array(
            'title'      => 'bcadd()',
            'current_title' => $this->current_title,
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'=> strtolower(__FUNCTION__), // 當下function
            'content'    => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);
    }

    public function date_test()
    {
        //$this->check_session();
        // 時間顯示測試
        $date_test = $this->_date_test() ;

        // 顯示資料
        $content = array();
        /*
        $content[] = array(
            'content_title' => 'Date',
            'content_value' => $this->_str_replace(print_r($date_test,true))
        ) ;

        $val_str = '';
        foreach($date_test as $key=>$val )
        {
            $val_str .= $key.' : '.$val.'<br>' ;
        }
        */

        $val_str = '<table border="1">';
        foreach($date_test as $key=>$val )
        {
            $val_str .= '<tr><td>'.$key.'</td><td>'.$val.'</td></tr>' ;
        }
        $val_str .= '</table>';

        $content[] = array(
            'content_title' => '時間格式',
            'content_value' => $val_str,
        ) ;

        // 標題 內容顯示
        $data = array(
            'title' => '時間格式顯示',
            'current_title' => $this->current_title,
            'current_page' => strtolower(__CLASS__), // 當下類別
            'current_fun' => strtolower(__FUNCTION__), // 當下function
            'content' => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);
    }

    private function _date_test()
    {
        $this->load->helper('date') ;
        $date_ary = array() ;

        $date_ary['PHP_date'] = date('Y-m-d H:i:s') ;

        $time = time() ;
        $date_ary['PHP_time'] = $time ;

        // eturns the current time as a Unix timestamp
        $date_ary['PHP_now'] = now() ;

        // If a timestamp is not included in the second parameter the current time will be used.
        $datestring = "Year: %Y Month: %m Day: %d - %h:%i %a" ;
        $date_ary['PHP_mdate'] = mdate($datestring, $time);

        // Lets you generate a date string in one of several standardized formats
        //$date_ary['standard_date'] = array() ;
        $format = array() ;
        $format[] = 'DATE_ATOM';
        $format[] = 'DATE_COOKIE';
        $format[] = 'DATE_ISO8601';
        $format[] = 'DATE_RFC822';
        $format[] = 'DATE_RFC850';
        $format[] = 'DATE_RFC1036';
        $format[] = 'DATE_RFC1123';
        $format[] = 'DATE_RFC2822';
        $format[] = 'DATE_RSS';
        $format[] = 'DATE_W3C';
        foreach ($format as $value) {
            //$date_ary['standard_date']['CI_'.$value] = standard_date($value, $time) ;
            $date_ary['CI_'.$value] = standard_date($value, $time) ;
        }

        // Takes a Unix timestamp as input and returns it as GMT
        $date_ary['PHP_local_to_gmt'] = local_to_gmt($time) ;

        // Takes a timezone reference (for a list of valid timezones，see the "Timezone Reference" below) and returns the number of hours offset from UTC.
        $date_ary['PHP_timezones'] = timezones('UM8') ;


        $dt = new DateTime();

        $TPTTZ = new DateTimeZone('Asia/Taipei');
        $dt->setTimezone($TPTTZ);
        $date_ary['Asia/Taipei'] = $dt->format(DATE_RFC822);

        $MNTTZ = new DateTimeZone('America/Denver');
        $dt->setTimezone($MNTTZ);
        $date_ary['America/Denver'] = $dt->format(DATE_RFC822);

        $ESTTZ = new DateTimeZone('America/New_York');
        $dt->setTimezone($ESTTZ);
        $date_ary['America/New_York'] = $dt->format(DATE_RFC822);

        return $date_ary ;
    }

    private function _str_replace($str){
        $order = array("\r\n", "\n", "\r", "￼", "<br />", "<br/>");
        $str = str_replace($order,"<br>",$str);// HTML5 寫法
        return $str;
    }

    public function session_test()
    {
        //$this->check_session();
        /*
        // 增加自訂Session資料
        $newdata = array(
            'username'  => 'johndoe',
            'email'  => 'johndoe@some-site.com',
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
        $ip_address_1 = $this->session->userdata('HTTP_CLIENT_IP') ;// 自訂資料
        $ip_address_2_1 = $this->session->userdata('HTTP_X_FORWARDED_FOR') ;// 自訂資料
        $ip_address_2_2 = $this->session->userdata('HTTP_X_CLIENT_IP') ;// 自訂資料
        $ip_address_2_3 = $this->session->userdata('HTTP_X_CLUSTER_CLIENT_IP') ;// 自訂資料
        $ip_address_3 = $this->session->userdata('REMOTE_ADDR') ;// 自訂資料
        //$user_data = $this->_str_replace(print_r($user_data,true)) ;
        //$user_data = $this->session->all_userdata() ;
        if( !empty($this->UserAgent['M']) || !empty($this->UserAgent['S']) || !empty($this->UserAgent['A']) || !empty($this->UserAgent['AN']) )
        {
            $UserAgent_str = '('.$this->UserAgent['M'].'/'.$this->UserAgent['S'].')'.$this->UserAgent['A'].' : '.$this->UserAgent['AN'] ;
        }
        else
        {
            $UserAgent_str = '' ;
        }

        // ci_sessions
        $ci_sessions = array(
            'session_id' => $session_id,
            'ip_address' => $ip_address,
            'user_agent' => $user_agent,
            'last_activity' => $last_activity,
            'user_data' => $user_data,
            'UserAgent' => $UserAgent_str,
            'HTTP_CLIENT_IP'=>$ip_address_1,
            'HTTP_X_FORWARDED_FOR'=>$ip_address_2_1,
            'HTTP_X_CLIENT_IP'=>$ip_address_2_2,
            'HTTP_X_CLUSTER_CLIENT_IP'=>$ip_address_2_3,
            'REMOTE_ADDR'=>$ip_address_3,
        );


        // DB測試
        // 刪除1分鐘內沒反應的 SESSION_LOGS
        // $this->session_test_model->delete_old_session() ;

        // 目前SESSION資料
        // 呼叫 session_test_model
        $SESSION_LOGS = $this->get_session_info($this->session->userdata('session_id'));
        /*
        $SESSION_LOGS = array(
           'SESSION_ID'  => $session_id ,
           'IP_ADDRESS'  => $ip_address ,
           'USER_AGENT'  => $user_agent,
        );

        // 更新DB
        //$count_num = $this->session_test_model->session_test_updata($SESSION_LOGS) ;

        // SESSION_LOGS
        if( $count_num!=false )
        {
            $SESSION_LOGS['count_num'] = $count_num ; // 最新資料筆數
        }
        else
        {
            $SESSION_LOGS['count_num'] = 'false' ;
        }
        */

        // 顯示資料
        $content = array();
        $content[] = array(
            'content_title' => 'ci_sessions',
            'content_value' => $this->_str_replace(print_r($ci_sessions,true))
        ) ;
        /*
        $content[] = array(
            'content_title' => 'SESSION_LOGS',
            'content_value' => $this->_str_replace(print_r($SESSION_LOGS,true))
        ) ;
        */
       $server_copy = $_SERVER ;
       $server_copy['ip_check']['HTTP_CLIENT_IP'] = !empty($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : 'error : empty' ;
       $server_copy['ip_check']['HTTP_X_FORWARDED_FOR'] = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : 'error : empty' ;
       $server_copy['ip_check']['HTTP_X_CLIENT_IP'] = !empty($_SERVER['HTTP_X_CLIENT_IP']) ? $_SERVER['HTTP_X_CLIENT_IP'] : 'error : empty' ;
       $server_copy['ip_check']['HTTP_X_CLUSTER_CLIENT_IP'] = !empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) ? $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] : 'error : empty' ;
       $server_copy['ip_check']['REMOTE_ADDR'] = !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'error : empty' ;
        $content[] = array(
            'content_title' => '_SERVER',
            'content_value' => $this->_str_replace(print_r($server_copy,true))
        ) ;

        // 標題 內容顯示
        $data = array(
            'title' => 'CI session 測試',
            'current_title' => $this->current_title,
            'current_page' => strtolower(__CLASS__), // 當下類別
            'current_fun' => strtolower(__FUNCTION__), // 當下function
            'content' => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);
    }

    public function count_sizeof()
    {
        //$this->check_session();
        // 顯示資料
        $content = array();

        // Application 效能分析
        $this->output->enable_profiler(TRUE);//啟動效能分析器
        $sections = array(
            'config'  => TRUE,
            'queries' => TRUE
        );
        $this->output->set_profiler_sections($sections);

        // 測試用Array
        $array_size = 50000 ;
        $this->benchmark->mark('code_start');
        $test_array = array();
        for($test_i=0;$test_i<$array_size;$test_i++)
        {
            $test_array[] = $test_i ;
        }
        $this->benchmark->mark('code_end');
        $time_mark = $this->benchmark->elapsed_time('code_start','code_end');
        $content[] = array(
            'content_title' => 'Array('.$array_size.')',
            'content_value' => $time_mark,
        ) ;

        // 測試次數
        $try_num = 1000000 ;

        // for 迴圈
        $this->benchmark->mark('code1_start');
        for($test_i=0;$test_i<$try_num;$test_i++)
        {

        }
        $this->benchmark->mark('code1_end');
        $time_mark = $this->benchmark->elapsed_time('code1_start','code1_end');
        $content[] = array(
            'content_title' => 'for() '.$try_num.' times',
            'content_value' => $time_mark,
        ) ;

        // count()
        $this->benchmark->mark('code2_start');
        for($test_i=0;$test_i<$try_num;$test_i++)
        {
            $count_num = count($test_array) ;
        }
        $this->benchmark->mark('code2_end');
        $time_mark = $this->benchmark->elapsed_time('code2_start','code2_end');
        $content[] = array(
            'content_title' => 'count()='.$count_num.' '.$try_num.' times',
            'content_value' => $time_mark,
        ) ;

        // sizeof()
        $this->benchmark->mark('code3_start');
        for($test_i=0;$test_i<$try_num;$test_i++)
        {
            $sizeof_num = sizeof($test_array) ;
        }
        $this->benchmark->mark('code3_end');
        $time_mark = $this->benchmark->elapsed_time('code3_start','code3_end');
        $content[] = array(
            'content_title' => 'sizeof()='.$sizeof_num.' '.$try_num.' times',
            'content_value' => $time_mark,
        ) ;

        $this->output->enable_profiler(FALSE);//關閉效能分析器

        $content[] = array(
            'content_title' => 'Difference between sizeof() and count() in php',
            'content_value' => 'The sizeof() function is an alias for count().',
        ) ;

        // 標題 內容顯示
        $data = array(
            'title'      => 'count() and sizeof()',
            'current_title' => $this->current_title,
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'=> strtolower(__FUNCTION__), // 當下function
            'content'    => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);
    }

    public function hash_test()
    {
        //$this->check_session();
        $post = $this->input->post();

        $hash_array = array(
            '0' => 'md2',
            '1' => 'md4',
            '2' => 'md5',
            '3' => 'sha1',
            //'4' => 'sha224',
            '5' => 'sha256',
            '6' => 'sha384',
            '7' => 'sha512',
            '8' => 'ripemd128',
            '9' => 'ripemd160',
            '10' => 'ripemd256',
            '11' => 'ripemd320',
            '12' => 'whirlpool',
            '13' => 'tiger128,3',
            '14' => 'tiger160,3',
            '15' => 'tiger192,3',
            '16' => 'tiger128,4',
            '17' => 'tiger160,4',
            '18' => 'tiger192,4',
            '19' => 'snefru',
            //'20' => 'snefru256',
            '21' => 'gost',
            '22' => 'adler32',
            '23' => 'crc32',
            '24' => 'crc32b',
            //'25' => 'salsa10',
            //'26' => 'salsa20',
            '27' => 'haval128,3',
            '28' => 'haval160,3',
            '29' => 'haval192,3',
            '30' => 'haval224,3',
            '31' => 'haval256,3',
            '32' => 'haval128,4',
            '33' => 'haval160,4',
            '34' => 'haval192,4',
            '35' => 'haval224,4',
            '36' => 'haval256,4',
            '37' => 'haval128,5',
            '38' => 'haval160,5',
            '39' => 'haval192,5',
            '40' => 'haval224,5',
            '41' => 'haval256,5',
        );

        $test_str = isset($post['hash_str']) ? $post['hash_str'] : '' ;

        // 顯示資料
        $content = array();

        $content[] = array(
            'content_title' => 'base64_encode()',
            'content_value' => base64_encode($test_str),
        ) ;

        $content[] = array(
            'content_title' => 'urlencode()',
            'content_value' => urlencode($test_str),
        ) ;

        $content[] = array(
            'content_title' => 'rawurlencode()',
            'content_value' => rawurlencode($test_str),
        ) ;

        $content[] = array(
            'content_title' => 'utf8_encode()',
            'content_value' => utf8_encode($test_str),
        ) ;

        $content[] = array(
            'content_title' => 'ASCII',
            'content_value' => $this->pub->str_to_ascii($test_str),
        ) ;

        $content[] = array(
            'content_title' => 'serialize()',
            'content_value' => serialize($test_str),
        ) ;

        foreach( $hash_array as $v )
        {
            $content[] = array(
                'content_title' => $v,
                'content_value' => hash($v,$test_str),
            ) ;
            if($v=='md5')
            {
                $content[] = array(
                    'content_title' => 'md5()',
                    'content_value' => md5($test_str),
                ) ;
            }
            else if($v=='sha1')
            {
                $content[] = array(
                    'content_title' => 'sha1()',
                    'content_value' => sha1($test_str),
                ) ;
            }
        }

        if( $test_str!='' )
        {
            $this->load->model('php_test_model','',TRUE);
            $this->php_test_model->query_hash_test($test_str);
        }

        // 標題 內容顯示
        $data = array(
            'title' => 'Hash encode 測試',
            'current_title' => $this->current_title,
            'current_page' => strtolower(__CLASS__), // 當下類別
            'current_fun' => strtolower(__FUNCTION__), // 當下function
            'content' => $content,
            'hash_str'=> $test_str,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('hash_test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);
    }

    public function decode_test()
    {
        //$this->check_session();
        $post = $this->input->post();

        $test_str = isset($post['hash_str']) ? $post['hash_str'] : '' ;

        // 顯示資料
        $content = array();

        $content[] = array(
            'content_title' => 'base64_decode()',
            'content_value' => base64_decode($test_str),
        ) ;

        $content[] = array(
            'content_title' => 'urldecode()',
            'content_value' => urldecode($test_str),
        ) ;

        $content[] = array(
            'content_title' => 'rawurldecode()',
            'content_value' => rawurldecode($test_str),
        ) ;

        $content[] = array(
            'content_title' => 'utf8_decode()',
            'content_value' => utf8_decode($test_str),
        ) ;

        $chr_str = chr($test_str) ;
        $chr_str = ($chr_str==' ') ? '&nbsp;' : $chr_str ;
        $content[] = array(
            'content_title' => 'chr()',
            'content_value' => $chr_str,
        ) ;

        $chr = base_convert($test_str,16,10) ;
        $chr_str = chr($chr) ;
        $chr_str = ($chr_str==' ') ? '&nbsp;' : $chr_str ;
        $content[] = array(
            'content_title' => 'chr(16)',
            'content_value' => $chr_str.'('.$chr.')',
        ) ;
/*
        var_dump(base_convert('\x{00e6}',16,10));
        echo '====================================';
        var_dump(chr(base_convert('\x{00e6}',16,10)));
*/
        // 標題 內容顯示
        $data = array(
            'title' => 'decode 測試',
            'current_title' => $this->current_title,
            'current_page' => strtolower(__CLASS__), // 當下類別
            'current_fun' => strtolower(__FUNCTION__), // 當下function
            'content' => $content,
            'hash_str'=> $test_str,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('hash_test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);

        //echo '<script type="text/javascript">alert("'.$test_str.'");</script>';
    }

    public function preg_test()
    {
        //$this->check_session();
        $post = $this->input->post();

        $str = isset($post['str']) ? $post['str'] : '' ;

        // 正規表達式
        $preg_array = array();
        $preg_array[] = array(
            'fun'    => 'URL',
            'remark' => '/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i',
            'reg'    => preg_match('/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i',$str),
            'remark2'=> '/^(http?:\/\/+[\w\-]+\.[\w\-]+)/i',
            'reg2'   => preg_match('/^(http?:\/\/+[\w\-]+\.[\w\-]+)/i',$str),
        );
        $preg_array[] = array(
            'fun'    => '手機號碼',
            'remark' => '/^09[0-9]{8}$/',
            'reg'    => preg_match('/^09[0-9]{8}$/',$str),
            'remark2'=> '',
            'reg2'   => '',
        );
        $preg_array[] = array(
            'fun'    => '身分證字號',
            'remark' => '/^[A-Z]{1}[0-9]{9}$/',
            'reg'    => preg_match('/^[A-Z]{1}[0-9]{9}$/',$str),
            'remark2'=> '',
            'reg2'   => '',
        );
        $preg_array[] = array(
            'fun'    => '正整數 或 空值',
            'remark' => '/^\d*$/',
            'reg'    => preg_match('/^\d*$/',$str),
            'remark2'=> '',
            'reg2'   => '',
        );
        $preg_array[] = array(
            'fun'    => '全部是正整數',
            'remark' => '/^\d+$/',
            'reg'    => preg_match('/^\d+$/',$str),
            'remark2'=> '/^[0-9]+$/',
            'reg2'   => preg_match('/^[0-9]+$/',$str),
        );
        $preg_array[] = array(
            'fun'    => '含數字',
            'remark' => '/\d/',
            'reg'    => preg_match('/\d/',$str),
            'remark2'=> '/[0-9]/',
            'reg2'   => preg_match('/[0-9]/',$str),
        );
        $preg_array[] = array(
            'fun'    => '全部非數字',
            'remark' => '/^\D+$/',
            'reg'    => preg_match('/^\D+$/',$str),
            'remark2'=> '/^[^0-9]+$/',
            'reg2'   => preg_match('/^[^0-9]+$/',$str),
        );
        $preg_array[] = array(
            'fun'    => '全部是英文字母(小寫 | 大寫)',
            'remark' => '/^[a-z]+$/',
            'reg'    => preg_match('/^[a-z]+$/',$str),
            'remark2'=> '/^[A-Z]+$/',
            'reg2'   => preg_match('/^[A-Z]+$/',$str),
        );
        $preg_array[] = array(
            'fun'    => '含英文字母(小寫 | 大寫)',
            'remark' => '/[a-z]/',
            'reg'    => preg_match('/[a-z]/',$str),
            'remark2'=> '/[A-Z]/',
            'reg2'   => preg_match('/[A-Z]/',$str),
        );
        $preg_array[] = array(
            'fun'    => '含數字或英文字母或_',
            'remark' => '/^\w+$/',
            'reg'    => preg_match('/^\w+$/',$str),
            'remark2'=> '/^[A-Za-z0-9_]+$/',
            'reg2'   => preg_match('/^[A-Za-z0-9_]+$/',$str),
        );
        $preg_array[] = array(
            'fun'    => '全部非數字或英文字母或_',
            'remark' => '/^\W+$/',
            'reg'    => preg_match('/^\W+$/',$str),
            'remark2'=> '/^[^A-Za-z0-9_]+$/',
            'reg2'   => preg_match('/^[^A-Za-z0-9_]+$/',$str),
        );
        $preg_array[] = array(
            'fun'    => '全部是空白字元',
            'remark' => '/^\s+$/',
            'reg'    => preg_match('/^\s+$/',$str),
            'remark2'=> '/^[\x{0020}]+$/u',
            'reg2'   => preg_match('/^[\x{0020}]+$/u',$str),
        );
        $preg_array[] = array(
            'fun'    => '全部非空白字元',
            'remark' => '/^\S+$/',
            'reg'    => preg_match('/^\S+$/',$str),
            'remark2'=> '/^[^\x{0020}]+$/u',
            'reg2'   => preg_match('/^[^\x{0020}]+$/u',$str),
        );
        $preg_array[] = array(
            'fun'    => '全部中文 | 含中文',
            'remark' => '/^[\x{4e00}-\x{9fa5}]+$/u',
            'reg'    => preg_match('/^[\x{4e00}-\x{9fa5}]+$/u',$str),
            'remark2'=> '/^[\x{4e00}-\x{9fa5}]+$/u',
            'reg2'   => preg_match('/[\x{4e00}-\x{9fa5}]/u',$str),
        );
        $preg_array[] = array(
            'fun'    => '全部文字 | 含文字',
            'remark' => '/^[\x{0080}-\x{FFFF}]+$/u',
            'reg'    => preg_match('/^[\x{0080}-\x{FFFF}]+$/u',$str),
            'remark2'=> '/^[\x{0080}-\x{FFFF}]+$/u',
            'reg2'   => preg_match('/[\x{4e00}-\x{9fa5}]/u',$str),
        );
        $preg_array[] = array(
            'fun'    => '全部符號 | 含符號',
            'remark' => '/^[\x{0021}-\x{002f}]+$/u',
            'reg'    => preg_match('/^[\x{0021}-\x{002f}]+$/u',$str),
            'remark2'=> '/[\x{0021}-\x{002f}]/u',
            'reg2'   => preg_match('/[\x{0021}-\x{002f}]/u',$str),
        );
        $preg_array[] = array(
            'fun'    => '全部數字 | 含數字',
            'remark' => '/^[\x{0030}-\x{0039}]+$/u',
            'reg'    => preg_match('/^[\x{0030}-\x{0039}]+$/u',$str),
            'remark2'=> '/[\x{0030}-\x{0039}]/u',
            'reg2'   => preg_match('/[\x{0030}-\x{0039}]/u',$str),
        );
        $preg_array[] = array(
            'fun'    => '全部符號 | 含符號',
            'remark' => '/^[\x{003a}-\x{0040}\x{005b}-\x{0060}\x{007b}-\x{007f}]+$/u',
            'reg'    => preg_match('/^[\x{003a}-\x{0040}\x{005b}-\x{0060}\x{007b}-\x{007f}]+$/u',$str),
            'remark2'=> '/[\x{003a}-\x{0040}\x{005b}-\x{0060}\x{007b}-\x{007f}]/u',
            'reg2'   => preg_match('/[\x{003a}-\x{0040}\x{005b}-\x{0060}\x{007b}-\x{007f}]/u',$str),
        );
        $preg_array[] = array(
            'fun'    => '全部大寫英文 | 含大寫英文',
            'remark' => '/^[\x{0041}-\x{005a}]+$/u',
            'reg'    => preg_match('/^[\x{0041}-\x{005a}]+$/u',$str),
            'remark2'=> '/[\x{0041}-\x{005a}]/u',
            'reg2'   => preg_match('/[\x{0041}-\x{005a}]/u',$str),
        );
        $preg_array[] = array(
            'fun'    => '全部小寫英文 | 含小寫英文',
            'remark' => '/^[\x{0061}-\x{007a}]+$/u',
            'reg'    => preg_match('/^[\x{0061}-\x{007a}]+$/u',$str),
            'remark2'=> '/[\x{0061}-\x{007a}]/u',
            'reg2'   => preg_match('/[\x{0061}-\x{007a}]/u',$str),
        );


        // 顯示資料
        $content = array();

        foreach( $preg_array as $v )
        {
            $content[] = array(
                'content_name'  => $v['fun'],
                'content_title' => $v['remark'],
                'content_value' => $v['reg'],
                'content_title2'=> $v['remark2'],
                'content_value2'=> $v['reg2'],
            ) ;
        }

        // tbody
        $grid_view = $this->parser->parse('preg_test_grid_view', array('content'=>$content), true);

        if( !isset($post['str']) )
        {

            // 標題 內容顯示
            $data = array(
                'title' => '正規表達式 測試',
                'current_title' => $this->current_title,
                'current_page' => strtolower(__CLASS__), // 當下類別
                'current_fun' => strtolower(__FUNCTION__), // 當下function
                'grid_view' => $grid_view,
                'str'=> $str,
            );
            // Template parser class
            // 中間挖掉的部分
            $content_div = $this->parser->parse('preg_test_outer_view', $data, true);

            // 中間部分塞入外框
            $html_date = $data ;
            $html_date['content_div'] = $content_div ;
            $html_date['js'][] = 'js/preg_test.js';
            $this->parser->parse('index_view', $html_date ) ;
        }
        else
        {
            echo json_encode(array('grid_view'=>$grid_view)) ;
        }
    }

    public function php_chr()
    {
        // 顯示資料
        $content = array();

        $ascii_arr[] = array('s'=>0,'e'=>32,'t'=>'空白');
        $ascii_arr[] = array('s'=>33,'e'=>47,'t'=>'符號');
        $ascii_arr[] = array('s'=>48,'e'=>57,'t'=>'數字');
        $ascii_arr[] = array('s'=>58,'e'=>64,'t'=>'符號');
        $ascii_arr[] = array('s'=>65,'e'=>90,'t'=>'大寫');
        $ascii_arr[] = array('s'=>91,'e'=>96,'t'=>'符號');
        $ascii_arr[] = array('s'=>97,'e'=>122,'t'=>'小寫');
        $ascii_arr[] = array('s'=>123,'e'=>127,'t'=>'符號');
        $ascii_arr[] = array('s'=>128,'e'=>255,'t'=>'字符');
        // 256 以上重複循環 33=>! 289=>!
        foreach ($ascii_arr as $row) {
            $content_value = '<table><tr><th>$ascii(10)</th><th>$ascii(8)</th><th>$ascii(16)</th><th>chr($ascii)</th></tr>';
            for($i=$row['s'];$i<=$row['e'];$i++)
            {
                /*
                    chr() 参数可以是十进制、八进制或十六进制。
                    通过前置 0 来规定八进制，
                    通过前置 0x 来规定十六进制。
                */
                $content_value .= '<tr><td>'.$i.'</td><td>'.base_convert($i,10,8).'</td><td>'.base_convert($i,10,16).'</td><td>'.chr($i).'</td></tr>';
            }
            $content_value .= '</table>';
            $content[] = array(
                'content_title'=>$row['t'],
                'content_value'=>$content_value,
            ) ;
        }

        $content[] = array(
            'content_title'=>'ASCII 字碼表 1',
            'content_value'=>'https://msdn.microsoft.com/zh-tw/library/60ecse8t(v=vs.80).aspx',
        ) ;
        $content[] = array(
            'content_title'=>'ASCII 字碼表 2',
            'content_value'=>'https://msdn.microsoft.com/zh-tw/library/9hxt0028(v=vs.80).aspx',
        ) ;

        $content[] = array(
            'content_title'=>'256 以上重複循環 ex: chr(33) chr(289)',
            'content_value'=>'chr(33)='.chr(33).' chr(289)='.chr(289),
        ) ;
        $content[] = array(
            'content_title'=>'10進位chr(52) 8進位chr(052) 16進位chr(0x52)',
            'content_value'=>chr(52).' '.chr(052).' '.chr(0x52),
        ) ;

        $ord_arr[] = ' ' ;
        $ord_arr[] = '.' ;
        $ord_arr[] = '-' ;
        $ord_arr[] = '_' ;
        foreach ($ord_arr as $value) {
            $ord = ord($value);
            $content[] = array(
                'content_title'=>"ord('".$value."')",
                'content_value'=>$ord.'(10) '.base_convert($ord,10,8).'(8) '.base_convert($ord,10,16).'(16)',
            ) ;
        }

        // 標題 內容顯示
        $data = array(
            'title'      => 'php chr()',
            'current_title' => $this->current_title,
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'=> strtolower(__FUNCTION__), // 當下function
            'content'    => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);
    }

    public function switch_test()
    {
        //$this->check_session();
        // 顯示資料
        $content = array();

        // Application 效能分析
        $this->output->enable_profiler(TRUE);//啟動效能分析器
        $sections = array(
            'config'  => TRUE,
            'queries' => TRUE
        );
        $this->output->set_profiler_sections($sections);

        // 測試用Array
        $test_array = array();
        $arr_size = 25000;
        for($test_i=0;$test_i<$arr_size;$test_i++)
        {
            $test_array[] = $test_i%10 ;
        }
        $time_if = 0 ;
        $time_sw = 0 ;
        $time_mark_if = 0 ;
        $time_mark_sw = 0 ;
        $test_size = 200;
        for($test_j=0;$test_j<$test_size;$test_j++)
        {
            $time_mark_if += $this->_if_loop_test($test_array) ;
            $time_mark_sw += $this->_switch_loop_test($test_array) ;
        }
        $str = $test_j.'('.$arr_size.') : '.$time_mark_if.' - '.$time_mark_sw.' = '.($time_mark_if-$time_mark_sw) ;
        $content[] = array(
            'content_title' => '第N個迴圈(判斷M個值) : if(時間) - switch(時間) = 時間差',
            'content_value' => $str,
        ) ;

        $this->output->enable_profiler(FALSE);//關閉效能分析器

        // 標題 內容顯示
        $data = array(
            'title'      => 'if else and switch',
            'current_title' => $this->current_title,
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'=> strtolower(__FUNCTION__), // 當下function
            'content'    => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);
    }

    private function _switch_loop_test($test_array)
    {
        // switch
        $this->benchmark->mark('code3_start');
        foreach($test_array as $v)
        {
            switch($v)
            {
                case 0:
                    $this->_get_test_str() ;
                    break;
                case 1:
                    $this->_get_test_str() ;
                    break;
                case 2:
                    $this->_get_test_str() ;
                    break;
                case 3:
                    $this->_get_test_str() ;
                    break;
                case 4:
                    $this->_get_test_str() ;
                    break;
                case 5:
                    $this->_get_test_str() ;
                    break;
                case 6:
                    $this->_get_test_str() ;
                    break;
                case 7:
                    $this->_get_test_str() ;
                    break;
                case 8:
                    $this->_get_test_str() ;
                    break;
                case 9:
                    $this->_get_test_str() ;
                    break;
            }
        }
        $this->benchmark->mark('code3_end');
        $time_mark = $this->benchmark->elapsed_time('code3_start','code3_end');
        return $time_mark ;
    }

    private function _if_loop_test($test_array)
    {
        // if else
        $this->benchmark->mark('code2_start');
        foreach($test_array as $v)
        {
            if($v==1)
            {
                $this->_get_test_str() ;
            }
            else if($v==2)
            {
                $this->_get_test_str() ;
            }
            else if($v==3)
            {
                $this->_get_test_str() ;
            }
            else if($v==4)
            {
                $this->_get_test_str() ;
            }
            else if($v==5)
            {
                $this->_get_test_str() ;
            }
            else if($v==6)
            {
                $this->_get_test_str() ;
            }
            else if($v==7)
            {
                $this->_get_test_str() ;
            }
            else if($v==8)
            {
                $this->_get_test_str() ;
            }
            else if($v==9)
            {
                $this->_get_test_str() ;
            }
            else if($v==0)
            {
                $this->_get_test_str() ;
            }
        }
        $this->benchmark->mark('code2_end');
        $time_mark = $this->benchmark->elapsed_time('code2_start','code2_end');
        return $time_mark ;
    }

    private function _get_test_str()
    {
        return FALSE ;
    }

    public function check_session()
    {
        $post = $this->input->post();
        $post = $this->pub->trim_val($post);
        $session_id = !empty($post['session_id']) ? $post['session_id'] : $this->session->userdata('session_id') ;
        $ip_address = !empty($post['ip_address']) ? $post['ip_address'] : $_SERVER['REMOTE_ADDR'] ;
        $user_agent = !empty($post['user_agent']) ? $post['user_agent'] : $_SERVER['HTTP_USER_AGENT'] ;

        // check points
        if( empty($session_id) )
        {
            exit(__CLASS__.'/'.__FUNCTION__.'/LINE'.__LINE__.'/HTTP_USER_AGENT');// session id
        }
        else if( empty($user_agent) )
        {
            exit(__CLASS__.'/'.__FUNCTION__.'/LINE'.__LINE__.'/HTTP_USER_AGENT');// browser info
        }
        else if( empty($ip_address) )
        {
            exit(__CLASS__.'/'.__FUNCTION__.'/LINE'.__LINE__.'/REMOTE_ADDR');// ip address
        }
        else
        {
            $this->load->model('session_test_model','',TRUE);

            // 2分鐘內 session 失效
            $del = $this->session_test_model->del_session_info();
            if( $del['status']!=100 )
            {
                exit('del_session_info :'.$del['status']);
            }
            else
            {
                //echo "LINE : ".__LINE__." del session error<br>";
            }

            // 取得 session 資訊
            $SESSION_LOGS = $this->get_session_info($session_id);
            $total = intval($SESSION_LOGS['total']);
            $data = !empty($SESSION_LOGS['data']) ? $SESSION_LOGS['data'] : '' ;

            if( $total>1 )
            {
                exit(__CLASS__.'/'.__FUNCTION__.'/LINE'.__LINE__.'/get_session_info :'.$SESSION_LOGS['total']);
            }
            else if( $total<1 )
            {
                if( empty($session_id) )
                {
                    exit(__CLASS__.'/'.__FUNCTION__.'/LINE'.__LINE__.'/$session_id = '.json_encode($session_id));
                }
                // 新增 session
                $data = $this->_add_session_info($session_id,$post);
            }
            else
            {
                if( empty($data) )
                {
                    exit(__CLASS__.'/'.__FUNCTION__.'/LINE'.__LINE__.'/data empty');
                }
                else
                {
                    if( empty($data['IP_ADDRESS']) )
                    {
                        $this->session->sess_destroy();// 銷毀Session
                        exit(__CLASS__.'/'.__FUNCTION__.'/LINE'.__LINE__.'/IP_ADDRESS empty');
                    }
                    else if( $data['IP_ADDRESS']!=$ip_address )
                    {
                        $this->session->sess_destroy();// 銷毀Session
                        exit(__CLASS__.'/'.__FUNCTION__.'/LINE'.__LINE__.'/IP_ADDRESS');
                    }
                    else if( empty($data['USER_AGENT']) )
                    {
                        $this->session->sess_destroy();// 銷毀Session
                        exit(__CLASS__.'/'.__FUNCTION__.'/LINE'.__LINE__.'/USER_AGENT empty');
                    }
                    else if( $data['USER_AGENT']!=$user_agent )
                    {
                        $this->session->sess_destroy();// 銷毀Session
                        exit(__CLASS__.'/'.__FUNCTION__.'/LINE'.__LINE__.'<br>/USER_AGENT : '.$data['USER_AGENT'].'<br>/POST user_agent : '.$user_agent);
                    }
                    // 更新 session
                    $data = $this->_mod_session_info($session_id);

                    if( $data['status']!=100 )
                    {
                        exit(__CLASS__.'/'.__FUNCTION__.'/LINE'.__LINE__.'/data = '.json_encode($data));
                    }
                }
            }

            if( !empty($post['session_id']) || !empty($post['ip_address']) || !empty($post['user_agent']) )
            {
                echo json_encode($data);
            }
            else if( $data['status']!=100 )
            {
                $data['data'] = __FUNCTION__.'/LINE'.__LINE__.' '.$data['data'] ;
                echo json_encode($data);
            }
            else
            {
                //echo json_encode($data);
            }
        }
    }

    private function _add_session_info($session_id='',$input=array())
    {
        if( empty($session_id) )
        {
            $status = 201;
            $data = __FUNCTION__.'/LINE '.__LINE__.' empty session_id';
        }
        else if( empty($input) || !is_array($input) )
        {
            $status = 202;
            $data = __FUNCTION__.'/LINE '.__LINE__.' empty input';
        }
        else
        {
            $add = $this->session_test_model->add_session_info($session_id,$input);
            if( intval($add['status'])!=100 )
            {
                $status = intval($add['status']);
                $data = $add['data'];
            }
            else
            {
                $SESSION_LOGS = $this->get_session_info($session_id);
                $status = ( intval($SESSION_LOGS['total'])==1 ) ? 100 : 101 ;
                $data = !empty($SESSION_LOGS['data']) ? $SESSION_LOGS['data'] : array() ;
            }
        }

        if( empty($data) )
        {
            $data = __FUNCTION__.'/LINE '.__LINE__.' empty data';
        }

        return array('status'=>$status,'data'=>$data);
    }

    private function _mod_session_info($session_id='')
    {
        if( empty($session_id) )
        {
            $status = 201;
            $data = __FUNCTION__.'/LINE '.__LINE__.' empty session_id';
        }
        else
        {
            $mod = $this->session_test_model->mod_session_info($session_id);
            if( intval($mod['status'])!=100 )
            {
                $status = intval($mod['status']);
                $data = $mod['data'];
            }
            else
            {
                $SESSION_LOGS = $this->get_session_info($session_id);
                $status = ( intval($SESSION_LOGS['total'])==1 ) ? 100 : 101 ;
                $data = !empty($SESSION_LOGS['data']) ? $SESSION_LOGS['data'] : array() ;
            }
        }
        if( empty($data) )
        {
            $data = __FUNCTION__.'/LINE '.__LINE__.' empty data';
        }
        return array('status'=>$status,'data'=>$data);
    }

    public function sess_destroy()
    {
        $this->session->sess_destroy();// 銷毀Session
    }

    public function get_session_info($session_id)
    {
        $this->load->model('session_test_model','',TRUE);
        $info = $this->session_test_model->get_session_info($session_id);
        if( $info['total']<1 )
        {
            $data = array();
        }
        else
        {
            //$data = $this->pub->o2a($info['data'][0]);
            $data = $info['data'][0];
        }
        return array('data'=>$data,'total'=>$info['total']);
    }

    public function get_top_500_pwd()
    {
        $hash_array = array('md5', 'sha1', 'sha256', 'sha512', );

        $post = $this->input->post() ;
        $post = $this->pub->trim_val($post) ;
        $page_max = 20 ;
        $page = intval($post['page']) ;
        $total = $this->php_test_model->get_hash_test_num() ;// for WIN8's apache
        $total = isset($total[0]['total']) ? intval($total[0]['total']) : (isset($total['total']) ? intval($total['total']) : intval($total) ) ;
        //echo 'LINE : '.__LINE__.'total='.$total.'<br>' ;
        if( $total<500 )
        {
            /* add lib */
            $this->_add_top_500_pwds();
        }
        $pagecnt = ceil( $total/$page_max ) ;
        $page = ($page<1) ? 1 : ( ($page>$pagecnt ) ? $pagecnt : $page ) ;

        if( !isset($post['hash_str']) || $post['hash_str']=='' )
        {
            $reports = $this->php_test_model->query_hash_test('',$page,$page_max) ;
            $pwd_data = $reports['data'];
            $total = intval($reports['total']) ;
            //echo 'LINE : '.__LINE__.'total='.$total.'<br>' ;
            //$reports['data'] = '';
            //var_dump($reports);
            //echo '<br>' ;
            /*
            if( $total<(62*62*62*62) )
            {
                $this->_add_hash_lib(4);
                $reports = $this->php_test_model->query_hash_test('',$page,$page_max) ;
                $pwd_data = $reports['data'];
                $total = intval($reports['total']) ;
            }
            */
        }
        else
        {
            $reports = $this->php_test_model->query_hash_test($post['hash_str'],$page,$page_max,false);
            $pwd_data = $reports['data'];
            $total = intval($reports['total']) ;
            /* query hash value */
            if( $total==0 )
            {
                $reports = $this->php_test_model->query_hash_val($post['hash_str']) ;
                $pwd_data = $reports['data'];
                $total = intval($reports['total']) ;
            }
            /* add value */
            if( $total==0 )
            {
                $reports = $this->php_test_model->add_hash_test($post['hash_str']);
                $pwd_data = $reports['data'];
                $total = intval($reports['total']) ;
            }
            //var_dump($reports);
        }

        //echo 'LINE : '.__LINE__.'total='.$total.'<br>' ;
        $pagecnt = ceil( $total/$page_max ) ;

        $page_dropdown = '' ;
        if( $pagecnt>1 )
        {
            $options = array() ;
            if( $pagecnt>10 )
            {
                /*
                $options_25 =  ceil($pagecnt/4) ;
                $options_50 =  ceil($pagecnt/2) ;
                $options_75 =  ceil((3*$pagecnt)/4) ;
                $options[$options_25] = 'page '.$options_25.'(25%)' ;
                $options[$options_75] = 'page '.$options_75.'(50%)' ;
                $options[$options_50] = 'page '.$options_50.'(75%)' ;
                */
                for( $i=1; $i<=5; $i++ )
                {
                        $options[$i] = 'page '.$i ;
                }
                for( $i=($pagecnt-4); $i<=$pagecnt; $i++ )
                {
                        $options[$i] = 'page '.$i ;
                }
                //ksort($options);
            }
            else
            {
                for( $i=1; $i<=$pagecnt; $i++ )
                {
                        $options[$i] = 'page '.$i ;
                }
            }
            $page_dropdown = form_dropdown('page', $options, $page);
        }

        // title
        $th = array();
        $th[] = 'index';
        $th[] = 'passwords';
        foreach ( $hash_array as $hash_type )
        {
            $th[] = $hash_type ;
        }

        // content
        //$pwd_row = ($page-1)*$page_max;
        $td = array();
        foreach ( $pwd_data as $row )
        {
            $td_row = array() ;
            if( !empty($row['hash_key']) )
            {
                //$pwd_row++ ;
                //$td_row['index'] = $pwd_row ;
                $td_row['index'] = $row['hash_id'] ;
                $td_row['passwords'] = $row['hash_key'] ;
                foreach ( $hash_array as $hash_type )
                {
                    $td_row[$hash_type.'_var'] = $row[$hash_type.'_var'] ;
                }
                $td[] = $td_row ;
            }
            else
            {
                var_dump($row);
            }
        }

        $table_grid_view = $this->parser->parse('table_grid_view', array('td'=>$td,'th'=>$th,), true);

        if( !empty($post) )
        {
            $result = array(
                'status'=>'100',
                'pg'=>$page,
                'pageCnt'=>$pagecnt,
                'dropdown'=>$page_dropdown,
                'output'=>$table_grid_view,
                'post'=>$post,
            );
            echo json_encode($result);
        }
        else
        {
            // 標題 內容顯示
            $data = array(
                'title' => 'pwds Hash list',
                'current_title' => $this->current_title,
                'current_page' => strtolower(__CLASS__), // 當下類別
                'current_fun' => strtolower(__FUNCTION__), // 當下function
                'table_grid_view'=>$table_grid_view,
                'page'=>$page,
                'pagecnt'=>$pagecnt,
                'page_dropdown'=>$page_dropdown,
            );

            // 中間挖掉的部分
            $content_div = $this->parser->parse('table_view', $data, true);
            // 中間部分塞入外框
            $html_date = $data ;
            $html_date['content_div'] = $content_div ;
            $html_date['js'][] = 'js/page_nav.js';
            $html_date['js'][] = 'js/get_top_500_pwd.js';

            $view = $this->parser->parse('index_view', $html_date, true);
            $this->pub->remove_view_space($view);
        }
    }

    private function _add_top_500_pwds()
    {
        $top_500_pwd = array(
            '123456','pa#sword','12345678','1234','p#ssy','12345','dragon','qwerty','696969','mustang',
            'letmein','baseball','master','michael','football','shadow','monkey','abc123','pa#s','f#ckme',
            '6969','jordan','harley','ranger','iwantu','jennifer','hunter','f#ck','2000','test',
            'batman','trustno1','thomas','tigger','robert','access','love','buster','1234567','soccer',
            'hockey','killer','george','sexy','andrew','charlie','superman','a#shole','f#ckyou','dallas',
            'jessica','panties','pepper','1111','austin','william','daniel','golfer','summer','heather',
            'hammer','yankees','joshua','maggie','biteme','enter','ashley','thunder','cowboy','silver',
            'richard','f#cker','orange','merlin','michelle','corvette','bigdog','cheese','matthew','121212',
            'patrick','martin','freedom','ginger','bl#wjob','nicole','sparky','yellow','camaro','secret',
            'dick','falcon','taylor','111111','131313','123123','bitch','hello','scooter','please',
            'porsche','guitar','chelsea','black','diamond','nascar','jackson','cameron','654321','computer',
            'amanda','wizard','xxxxxxxx','money','phoenix','mickey','bailey','knight','iceman','tigers',
            'purple','andrea','horny','dakota','aaaaaa','player','sunshine','morgan','starwars','boomer',
            'cowboys','edward','charles','girls','booboo','coffee','xxxxxx','bulldog','ncc1701','rabbit',
            'peanut','john','johnny','gandalf','spanky','winter','brandy','compaq','carlos','tennis',
            'james','mike','brandon','fender','anthony','blowme','ferrari','cookie','chicken','maverick',
            'chicago','joseph','diablo','sexsex','hardcore','666666','willie','welcome','chris','panther',
            'yamaha','justin','banana','driver','marine','angels','fishing','david','maddog','hooters',
            'wilson','butthead','dennis','f#cking','captain','bigdick','chester','smokey','xavier','steven',
            'viking','snoopy','blue','eagles','winner','samantha','house','miller','flower','jack',
            'firebird','butter','united','turtle','steelers','tiffany','zxcvbn','tomcat','golf','bond007',
            'bear','tiger','doctor','gateway','gators','angel','junior','thx1138','porno','badboy',
            'debbie','spider','melissa','booger','1212','flyers','fish','porn','matrix','teens',
            'scooby','jason','walter','c#mshot','boston','braves','yankee','lover','barney','victor',
            'tucker','princess','mercedes','5150','doggie','zzzzzz','gunner','horney','bubba','2112',
            'fred','johnson','xxxxx','tits','member','boobs','donald','bigdaddy','bronco','penis',
            'voyager','rangers','birdie','trouble','white','topgun','bigtits','bitches','green','super',
            'qazwsx','magic','lakers','rachel','slayer','scott','2222','asdf','video','london',
            '7777','marlboro','srinivas','internet','action','carter','jasper','monster','teresa','jeremy',
            '11111111','bill','crystal','peter','p#ssies','c#ck','beer','rocket','theman','oliver',
            'prince','beach','amateur','7777777','muffin','redsox','star','testing','shannon','murphy',
            'frank','hannah','dave','eagle1','11111','mother','nathan','raiders','steve',
            'forever','angela','viper','ou812','jake','lovers','suckit','gregory','buddy','whatever',
            'young','nicholas','lucky','helpme','jackie','monica','midnight','college','baby','c#nt',
            'brian','mark','startrek','sierra','leather','232323','4444','beavis','bigc#ck','happy',
            'sophie','ladies','naughty','giants','booty','blonde','f#cked','golden','0000','fire',
            'sandra','pookie','packers','einstein','dolphins','0','chevy','winston','warrior','sammy',
            'slut','8675309','zxcvbnm','nipples','power','victoria','asdfgh','vagina','toyota','travis',
            'hotdog','paris','rock','xxxx','extreme','redskins','erotic','dirty','ford','freddy',
            'arsenal','access14','wolf','nipple','iloveyou','alex','florida','eric','legend','movie',
            'success','rosebud','jaguar','great','cool','cooper','1313','scorpio','mountain','madison',
            '987654','brazil','lauren','japan','naked','squirt','stars','apple','alexis','aaaa',
            'bonnie','peaches','jasmine','kevin','matt','qwertyui','danielle','beaver','4321','4128',
            'runner','swimming','dolphin','gordon','casper','stupid','shit','saturn','gemini','apples',
            'august','3333','canada','blazer','c#mming','hunting','kitty','rainbow','112233','arthur',
            'cream','calvin','shaved','surfer','samson','kelly','paul','mine','king','racing','5555',
            'eagle','hentai','newyork','little','redwings','smith','sticky','cocacola','animal','broncos',
            'private','skippy','marvin','blondes','enjoy','girl','apollo','parker','qwert','time',
            'sydney','women','voodoo','magnum','juice','abgrtyu','777777','dreams','maxwell','music',
            'rush2112','russia','scorpion','rebecca','tester','mistress','phantom','billy','6666','albert',
        );
        foreach ( $top_500_pwd as $val )
        {
            $this->php_test_model->query_hash_test($val);
        };

        $top_500_ios = array(
            'Password1','Destiny1','Pa$$w0rd','Vanessa1','August12','Fuckoff1','Password11',' Kennedy1','Jordan12','Princess15',
            'Princess1','Brianna1','Forever1','Steelers1','z,iyd86I','Freddie1','Password1!',' Jesusis#1','Jordan01','Princess08',
            'P@ssw0rd','Trustno1','iydgTvmujl6f','Slipknot1','l6fkiy9oN','Forever21','November15',' Jehovah1','Jesus143','PoohBear1',
            'Passw0rd','1qazZAQ!','Zachary1','Princess13',' Sweetie1','Death666','Music123','Isabelle1','Jessica7','Peanut11',
            'Michael1','Precious1','Yankees1','Princess12',' November1','Chopper1','Monkeys1','Hawaii50','Internet1','Peanut01',
            'Blink182','Freedom1','Stephen1','Midnight1','Love4ever','Arianna1','Matthew2','Grandma1','Goddess1','Password7',
            '!QAZ2wsx','Christian1',' Shannon1','Marines1','Ireland1','Allison1','Marie123','Godislove1',' Friends2','Password21',
            'Charlie1','Brooklyn1','John3:16','M1chelle','Iloveme2','Yankees2','Madonna1','Giggles1','Falcons7','Passw0rd1',
            'Anthony1','!QAZxsw2','Gerrard8','Lampard8','Christine1',' TrustNo1','Kristen1','Friday13','Derrick1','October22',
            '1qaz!QAZ','Password2','Fuckyou2','Jesus123','Buttons1','Tiger123','Kimberly1','Formula1','December21',' October13',
            'Brandon1','Football1','ZAQ!1qaz','Frankie1','Babyboy1','Summer05','Justin23','England1','Daisy123','November16',
            'Jordan23','ABCabc123','Pebbles1','Elizabeth2',' Angel101','September1',' Justin11','Cutiepie1','Colombia1','Montana1',
            '1qaz@WSX','Samantha1','Monster1','Douglas1','Vincent1','Sebastian1',' Jesus4me','Cricket1','Clayton1','Michael2',
            'Jessica1','Charmed1','Chicken1','Devil666','Spartan117',' Sabrina1','Jeremiah1','Catherine1',' Cheyenne1','Michael07',
            'Jasmine1','Trinity1','zaq1!QAZ','Christina1',' Soccer12','Princess07',' Jennifer2','Brownie1','Brittney1','Makayla1',
            'Michelle1','Chocolate1',' Spencer1','Bradley1','Princess2','Popcorn1','Jazmine1','Boricua1','Blink-182','Madison01',
            'Diamond1','America1','Savannah1','zaq1@WSX','Penguin1','Pokemon1','FuckYou2','Beckham7','August22','Lucky123',
            'Babygirl1','Password01',' Jesusis1','Tigger01','Password5','Omarion1','Colorado1','Awesome1','Asshole1','Longhorns1',
            'Iloveyou2','Natalie1','Jeffrey1','Summer08','Password3','Nursing1','Christmas1',' Annabelle1',' Ashley12','Kathryn1',
            'Matthew1','Superman1','Houston1','Princess21',' Panthers1','Miranda1','Bella123','Anderson1','Arsenal12','Katelyn1',
            'Rangers1','Scooter1','Florida1','Playboy1','Nirvana1','Melanie1','Bailey12','Alabama1','Addison1','Justin21',
            'Pa55word','Mustang1','Crystal1','October1','Nicole12','Maxwell1','August20','1941.Salembbb.41','Abcd1234','Jesus1st',
            'Iverson3','Brittany1','Tristan1','Katrina1','Nichole1','Lindsay1','3edc#EDC','123qweASD','@WSX2wsx','January29',
            'Sunshine1','Angel123','Thunder1','Iloveme1','Molly123','Joshua01','2wsx@WSX','abcABC123','!Qaz2wsx','ILoveYou2',
            'Madison1','Jonathan1','Thumper1','Chris123','Metallica1',' Hollywood1',' 12qw!@QW','Twilight1','zaq1ZAQ!','Hunter01',
            'William1','Friends1','Special1','Chicago1','Mercedes1','Hershey1','#EDC4rfv','Thirteen13',' ZAQ!xsw2','Honey123',
            'Elizabeth1',' Courtney1','Pr1ncess','Charlotte1',' Mackenzie1',' Hello123','Winter06','Taylor13','Whitney1','Holiday1',
            'Password123',' Aaliyah1','Password12',' Broncos1','Kenneth1','Gordon24','Welcome123',' Superstar1',' Welcome2','Harry123',
            'Liverpool1',' Rebecca1','Justice1','BabyGirl1','Jackson5','Gateway1','Unicorn1','Summer99','Vampire1','Falcons1',
            'Cameron1','Timothy1','Cowboys1','Abigail1','Genesis1','Garrett1','Tigger12','Soccer14','Valerie1','December1',
            'Butterfly1',' Scotland1','Charles1','Tinkerbell1',' Diamonds1','David123','Soccer13','Robert01','Titanic1','Dan1elle',
            'Beautiful1',' Raymond1','Blondie1','Rockstar1','Buttercup1',' Daniela1','Senior06','Prototype1',' Tigger123','Dallas22',
            '!QAZ1qaz','Inuyasha1','Softball1','RockYou1','Brandon7','Butterfly7',' Scrappy1','Princess5','Teddybear1',' College1',
            'Patrick1','Tiffany1','Orlando1','Michelle2','Whatever1','Buddy123','Scorpio1','Princess24',' Tbfkiy9oN','Classof08',
            'Welcome1','Pa55w0rd','Greenday1','Georgia1','TheSims2','Brandon2','Santana1','Pr1nc3ss','Sweetpea1','Chelsea123',
            'Iloveyou1','Nicholas1','Dominic1','Computer1','Summer06','Bethany1','Rocky123','Phantom1','Start123','Chargers1',
            'Bubbles1','Melissa1','!QAZzaq1','Breanna1','Starwars1','Austin316','Ricardo1','Patricia1','Soccer17','Cassandra1',
            'Chelsea1','Isabella1','abc123ABC','Babygurl1','Spiderman1',' Atlanta1','Princess123',' Password13',' Smokey01','Carolina1',
            'ZAQ!2wsx','Summer07','Snickers1','Trinity3','Soccer11','Angelina1','Password9','Passion1','Shopping1','Candy123',
            'Blessed1','Rainbow1','Patches1','Pumpkin1','Skittles1','Alexandra1',' Password4','P4ssword','Serenity1','Brayden1',
            'Richard1','Poohbear1','P@$$w0rd','Princess7','Princess01',' Airforce1','P@55w0rd','Nathan06','Senior07','Bigdaddy1',
            'Danielle1','Peaches1','Natasha1','Preston1','Phoenix1','Winston1','Monkey12','Monkey13','Sail2Boat3',' Bentley1',
            'Raiders1','Gabriel1','Myspace1','Newyork1','Pass1234','Veronica1','Michele1','Monkey01','Rusty123','Batista1',
            'Jackson1','Arsenal1','Monique1','Marissa1','Panther1','Vanilla1','Micheal1','Liverpool123','Russell1','Barcelona1',
            'Jesus777','Antonio1','Letmein1','Liberty1','November11',' Trouble1','Michael7','Liverp00l','Redskins1','Australia1',
            'Jennifer1','Victoria1','James123','Lebron23','Lindsey1','Summer01','Michael01','Laura123','Rebelde1','Austin02',
            'Alexander1',' Stephanie1',' Celtic1888',' Jamaica1','Katherine1',' Snowball1','Matthew3','Ladybug1','Princess4','August10',
            'Ronaldo7','Dolphins1','Benjamin1','Fuckyou1','JohnCena1','Rockyou1','Marshall1','Kristin1','Princess23',' August08',
            'Heather1','ABC123abc','Baseball1','Chester1','January1','Qwerty123','Loveyou2','Kendall1','Princess19',' Arsenal123',
            'Dolphin1','Spongebob1',' 1qazXSW@','Braxton1','Gangsta1','Pickles1','Lakers24','Justin01','Princess18',' Anthony11',
        );
         foreach ( $top_500_ios as $val )
        {
            $this->php_test_model->query_hash_test($val);
        };
    }

    private function _add_hash_lib($level=0,$arr_add='')
    {
        // lib
        /*
        $level_1 = array(
            '`','1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '-', '=',
            '~','!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+',
            'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', '[', ']', '\\',
            'Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', '{', '}', '|',
            'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', ';', "'",
            'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', ':', '"',
            'z', 'x', 'c', 'v', 'b', 'n', 'm',',', '.', '/',' ',
            'Z', 'X', 'C', 'V', 'B', 'N', 'M', '<', '>', '?',
        );
        */
        $level_1 = array(
            '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
            'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p',
            'Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P',
            'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l',
            'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L',
            'z', 'x', 'c', 'v', 'b', 'n', 'm',
            'Z', 'X', 'C', 'V', 'B', 'N', 'M',
        );

        $arr_1 = (is_array($arr_add) && !empty($arr_add) ) ? $arr_add : $level_1;
        $arr_2 = $level_1;

        $loop = intval($level);
        if( $loop==1 )
        {
            if(is_array($arr_add) && !empty($arr_add) )
            {
                $arr_2 = $this->_add_hash_lib_loop($arr_1,$arr_2);
            }
            else
            {
                foreach ( $arr_2 as $val_2 )
                {
                    $this->php_test_model->query_hash_test($val_2);
                }
            }
        }
        else if( $loop>1 )
        {
            if(is_array($arr_add) && !empty($arr_add) )
            {
                for ($i=0; $i<=$loop; $i++)
                {
                    $arr_2 = $this->_add_hash_lib_loop($arr_1,$arr_2);
                }
            }
            else
            {
                for ($i=0; $i<$loop; $i++)
                {
                    $arr_2 = $this->_add_hash_lib_loop($arr_1,$arr_2);
                }
            }
        }
    }

    private function _add_hash_lib_loop($arr_1,$arr_2)
    {
        $output = array();
        foreach ( $arr_1 as $val_1 )
        {
            foreach ( $arr_2 as $val_2 )
            {
                $this->php_test_model->query_hash_test($val_1.$val_2);
                $output[] = $val_1.$val_2;
            }
        }
        return $output ;
    }
}
?>
