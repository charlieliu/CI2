<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Php_test extends CI_Controller {

    public $current_title = 'PHP 測試';

    public $page_list = '';

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
            'content_title' => 'Hash 測試',
            'content_url' => 'php_test/hash_test',
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

        $this->page_list = $content ;
    }

    /**
     * @author Charlie Liu <liuchangli0107@gmail.com>
     */
    public function index()
    {
        $this->check_session();

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
        $this->parser->parse('index_view', $html_date ) ;
    }

    public function float_test()
    {
        $this->check_session();

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
            'title'         => 'Floating-point',
            'current_title' => $this->current_title,
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'   => strtolower(__FUNCTION__), // 當下function
            'content'       => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;
        $this->parser->parse('index_view', $html_date ) ;
    }

    public function bcadd_test()
    {
        $this->check_session();

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
            'title'         => 'bcadd()',
            'current_title' => $this->current_title,
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'   => strtolower(__FUNCTION__), // 當下function
            'content'       => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;
        $this->parser->parse('index_view', $html_date ) ;
    }

    public function date_test()
    {
        $this->check_session();
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
        $this->parser->parse('index_view', $html_date ) ;
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
        $this->check_session();
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
        // $this->session_test_model->delete_old_session() ;

        // 目前SESSION資料
        // 呼叫 session_test_model
        $SESSION_LOGS = $this->get_session_info($this->session->userdata('session_id'));
        /*
        $SESSION_LOGS = array(
           'SESSION_ID'     => $session_id ,
           'IP_ADDRESS'     => $ip_address ,
           'USER_AGENT'     => $user_agent,
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
        $content[] = array(
            'content_title' => 'SESSION_LOGS',
            'content_value' => $this->_str_replace(print_r($SESSION_LOGS,true))
        ) ;
        $content[] = array(
            'content_title' => '_SERVER',
            'content_value' => $this->_str_replace(print_r($_SERVER,true))
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

    public function count_sizeof()
    {
        $this->check_session();
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
        $this->benchmark->mark('code_start');
        $test_array = array();
        for($test_i=0;$test_i<50000;$test_i++)
        {
            $test_array[] = $test_i ;
        }
        $this->benchmark->mark('code_end');
        $time_mark = $this->benchmark->elapsed_time('code_start','code_end');
        $content[] = array(
            'content_title' => 'Array()',
            'content_value' => $time_mark,
        ) ;

        // count()
        $this->benchmark->mark('code2_start');

        for($test_i=0;$test_i<100000;$test_i++)
        {
            $count_num = count($test_array) ;
        }

        $this->benchmark->mark('code2_end');
        $time_mark = $this->benchmark->elapsed_time('code2_start','code2_end');
        $content[] = array(
            'content_title' => 'count()='.$count_num.' 100000 times',
            'content_value' => $time_mark,
        ) ;

        // sizeof()
        $this->benchmark->mark('code3_start');

        for($test_i=0;$test_i<100000;$test_i++)
        {
            $sizeof_num = sizeof($test_array) ;
        }

        $this->output->enable_profiler(FALSE);//關閉效能分析器

        $this->benchmark->mark('code3_end');
        $time_mark = $this->benchmark->elapsed_time('code3_start','code3_end');
        $content[] = array(
            'content_title' => 'sizeof()='.$sizeof_num.' 100000 times',
            'content_value' => $time_mark,
        ) ;

        // 標題 內容顯示
        $data = array(
            'title'         => 'count() and sizeof()',
            'current_title' => $this->current_title,
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'   => strtolower(__FUNCTION__), // 當下function
            'content'       => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;
        $this->parser->parse('index_view', $html_date ) ;
    }

    public function hash_test()
    {
        $this->check_session();
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

        $test_str = !empty($post['hash_str']) ? $post['hash_str'] : '' ;

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

        // 標題 內容顯示
        $data = array(
            'title' => 'Hash 測試',
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
        $this->parser->parse('index_view', $html_date ) ;
    }

    public function preg_test()
    {
        $this->check_session();
        $post = $this->input->post();

        $str = !empty($post['str']) ? $post['str'] : '' ;

        // 正規表達式
        $preg_array = array();
        $preg_array[] = array(
            'fun'       => 'URL',
            'remark'    => '/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i',
            'reg'       => preg_match('/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i',$str),
            'remark2'   => '',
            'reg2'      => '',
        );
        $preg_array[] = array(
            'fun'       => '手機號碼',
            'remark'    => '/^09[0-9]{8}$/',
            'reg'       => preg_match('/^09[0-9]{8}$/',$str),
            'remark2'   => '',
            'reg2'      => '',
        );
        $preg_array[] = array(
            'fun'       => '身分證字號',
            'remark'    => '/^[A-Z]{1}[0-9]{9}$/',
            'reg'       => preg_match('/^[A-Z]{1}[0-9]{9}$/',$str),
            'remark2'   => '',
            'reg2'      => '',
        );
        $preg_array[] = array(
            'fun'       => '正整數 或 空值',
            'remark'    => '/^\d*$/',
            'reg'       => preg_match('/^\d*$/',$str),
            'remark2'   => '',
            'reg2'      => '',
        );
        $preg_array[] = array(
            'fun'       => '正整數',
            'remark'    => '/^\d+$/',
            'reg'       => preg_match('/^\d+$/',$str),
            'remark2'   => '/^[0-9]+$/',
            'reg2'      => preg_match('/^[0-9]+$/',$str),
        );
        $preg_array[] = array(
            'fun'       => '含數字',
            'remark'    => '/\d/',
            'reg'       => preg_match('/\d/',$str),
            'remark2'   => '/[0-9]/',
            'reg2'      => preg_match('/[0-9]/',$str),
        );
        $preg_array[] = array(
            'fun'       => '非數字',
            'remark'    => '/^\D+$/',
            'reg'       => preg_match('/^\D+$/',$str),
            'remark2'   => '/^[^0-9]+$/',
            'reg2'      => preg_match('/^[^0-9]+$/',$str),
        );
        $preg_array[] = array(
            'fun'       => '英文字母',
            'remark'    => '/^[a-z]+$/',
            'reg'       => preg_match('/^[a-z]+$/',$str),
            'remark2'   => '/^[A-Z]+$/',
            'reg2'      => preg_match('/^[A-Z]+$/',$str),
        );
        $preg_array[] = array(
            'fun'       => '含英文字母',
            'remark'    => '/[a-z]/',
            'reg'       => preg_match('/[a-z]/',$str),
            'remark2'   => '/[A-Z]/',
            'reg2'      => preg_match('/[A-Z]/',$str),
        );
        $preg_array[] = array(
            'fun'       => '數字字母',
            'remark'    => '/^\w+$/',
            'reg'       => preg_match('/^\w+$/',$str),
            'remark2'   => '/^[A-Za-z0-9_]+$/',
            'reg2'      => preg_match('/^[A-Za-z0-9_]+$/',$str),
        );
        $preg_array[] = array(
            'fun'       => '非數字字母',
            'remark'    => '/^\W+$/',
            'reg'       => preg_match('/^\W+$/',$str),
            'remark2'   => '/^[^A-Za-z0-9_]+$/',
            'reg2'      => preg_match('/^[^A-Za-z0-9_]+$/',$str),
        );
        $preg_array[] = array(
            'fun'       => '空白字元',
            'remark'    => '/^\s+$/',
            'reg'       => preg_match('/^\s+$/',$str),
            'remark2'   => '',
            'reg2'      => '',
        );
        $preg_array[] = array(
            'fun'       => '非空白字元',
            'remark'    => '/^\S+$/',
            'reg'       => preg_match('/^\S+$/',$str),
            'remark2'   => '',
            'reg2'      => '',
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

        // 標題 內容顯示
        $data = array(
            'title' => '正規表達式 測試',
            'current_title' => $this->current_title,
            'current_page' => strtolower(__CLASS__), // 當下類別
            'current_fun' => strtolower(__FUNCTION__), // 當下function
            'content' => $content,
            'str'=> $str,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('preg_test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;
        $this->parser->parse('index_view', $html_date ) ;
    }

    public function php_chr()
    {
        // 顯示資料
        $content = array();

        //$ascii_arr[] = array('s'=>0,'e'=>32,'t'=>'空白');
        //$ascii_arr[] = array('s'=>33,'e'=>47,'t'=>'符號');
        $ascii_arr[] = array('s'=>48,'e'=>57,'t'=>'數字');
        //$ascii_arr[] = array('s'=>58,'e'=>64,'t'=>'符號');
        $ascii_arr[] = array('s'=>65,'e'=>90,'t'=>'大寫');
        //$ascii_arr[] = array('s'=>91,'e'=>96,'t'=>'符號');
        $ascii_arr[] = array('s'=>97,'e'=>122,'t'=>'小寫');
        //$ascii_arr[] = array('s'=>123,'e'=>127,'t'=>'符號');
        //$ascii_arr[] = array('s'=>128,'e'=>256,'t'=>'字符');
        foreach ($ascii_arr as $row) {
            $content_value = '<table><tr><th>$ascii</th><th>chr($ascii)</th></tr>';
            for($i=$row['s'];$i<=$row['e'];$i++)
            {
                /*
                    chr() 参数可以是十进制、八进制或十六进制。
                    通过前置 0 来规定八进制，
                    通过前置 0x 来规定十六进制。
                */
                $content_value .= '<tr><td>'.$i.'</td><td>'.chr($i).'</td></tr>';
            }
            $content_value .= '</table>';
            $content[] = array(
                'content_title'=>$row['t'],
                'content_value'=>$content_value,
            ) ;
        }

        $content[] = array(
            'content_title'=>"ord(' ')",
            'content_value'=>ord(' '),
        ) ;
        $content[] = array(
            'content_title'=>"ord('_')",
            'content_value'=>ord('_'),
        ) ;
        $content[] = array(
            'content_title'=>"ord('-')",
            'content_value'=>ord('-'),
        ) ;


        // 標題 內容顯示
        $data = array(
            'title'         => 'php chr()',
            'current_title' => $this->current_title,
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'   => strtolower(__FUNCTION__), // 當下function
            'content'       => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;
        $this->parser->parse('index_view', $html_date ) ;
    }

    public function switch_test()
    {
        $this->check_session();
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
            'title'         => 'if else and switch',
            'current_title' => $this->current_title,
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'   => strtolower(__FUNCTION__), // 當下function
            'content'       => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;
        $this->parser->parse('index_view', $html_date ) ;
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
                        exit(__CLASS__.'/'.__FUNCTION__.'/LINE'.__LINE__.'/USER_AGENT');
                    }
                    // 更新 session
                    $data = $this->_mod_session_info($session_id);
                }
            }

            if( !empty($post['session_id']) && !empty($post['ip_address']) && !empty($post['user_agent']) )
            {
                echo json_encode($data);
            }
            else if( $data['status']!=100 )
            {
                echo json_encode($data);
            }
        }
    }

    private function _add_session_info($session_id='',$input=array())
    {
        if( empty($session_id) )
        {
            $status = 201;
            $date   = 'empty session_id';
        }
        else if( empty($input) || !is_array($input) )
        {
            $status = 202;
            $date   = 'empty input';
        }
        else
        {
            $add = $this->session_test_model->add_session_info($session_id,$input);
            if( intval($add['status'])!=100 )
            {
                $status = intval($add['status']);
                $data   = $add['data'];
            }
            else
            {
                $SESSION_LOGS = $this->get_session_info($session_id);
                $status = ( intval($SESSION_LOGS['total'])==1 ) ? 100 : 101 ;
                $data = !empty($SESSION_LOGS['data']) ? $SESSION_LOGS['data'] : array() ;
            }
        }
        return array('status'=>$status,'data'=>$data);
    }

    private function _mod_session_info($session_id='')
    {
        $data = array();
        if( empty($session_id) )
        {
            $status = 201;
        }
        else
        {
            $mod = $this->session_test_model->mod_session_info($session_id);
            if( intval($mod['status'])!=100 )
            {
                $status = intval($mod['status']);
            }
            else
            {
                $SESSION_LOGS = $this->get_session_info($session_id);
                $status = ( intval($SESSION_LOGS['total'])==1 ) ? 100 : 101 ;
                $data = !empty($SESSION_LOGS['data']) ? $SESSION_LOGS['data'] : array() ;
            }
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
}
?>