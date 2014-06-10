<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Switch_test extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    /**
     * Floating-point test Page for this controller.
     *
     * @author Charlie Liu <liuchangli0107@gmail.com>
     */
    public function index()
    {
        // load parser
        $this->load->library('parser');

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
        for($test_i=0;$test_i<75000;$test_i++)
        {
            $test_array[] = $test_i%10 ;
        }
        $time_if = 0 ;
        $time_sw = 0 ;
        for($test_j=1;$test_j<11;$test_j++)
        {
            $time_mark_if = $this->_if_loop_test($test_array) ;
            $time_mark_sw = $this->_switch_loop_test($test_array) ;
            if($time_mark_if>$time_mark_sw)
            {
                $time_mark = $time_mark_if.'>'.$time_mark_sw ;
                $time_if++ ;
            }
            else
            {
                $time_mark = $time_mark_if.'>'.$time_mark_sw ;
                $time_sw++ ;
            }
            $content[] = array(
                'content_title' => $test_j.' if('.$time_if.') & switch('.$time_sw.')',
                'content_value' => $time_mark,
            ) ;
        }

        $this->output->enable_profiler(FALSE);//關閉效能分析器

        // 標題 內容顯示
        $data = array(
            'title'         => 'if else and switch',
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
                    $this->_get_test_str($v) ;
                    break;
                case 1:
                    $this->_get_test_str($v) ;
                    break;
                case 2:
                    $this->_get_test_str($v) ;
                    break;
                case 3:
                    $this->_get_test_str($v) ;
                    break;
                case 4:
                    $this->_get_test_str($v) ;
                    break;
                case 5:
                    $this->_get_test_str($v) ;
                    break;
                case 6:
                    $this->_get_test_str($v) ;
                    break;
                case 7:
                    $this->_get_test_str($v) ;
                    break;
                case 8:
                    $this->_get_test_str($v) ;
                    break;
                case 9:
                    $this->_get_test_str($v) ;
                    break;
            }
        }
        $this->benchmark->mark('code3_end');
        $time_mark = $this->benchmark->elapsed_time('code3_start','code3_end');
        return $time_mark*1000 ;
    }

    private function _if_loop_test($test_array)
    {
        // if else
        $this->benchmark->mark('code2_start');
        foreach($test_array as $v)
        {
            if($v==1)
            {
                $this->_get_test_str($v) ;
            }
            else if($v==2)
            {
                $this->_get_test_str($v) ;
            }
            else if($v==3)
            {
                $this->_get_test_str($v) ;
            }
            else if($v==4)
            {
                $this->_get_test_str($v) ;
            }
            else if($v==5)
            {
                $this->_get_test_str($v) ;
            }
            else if($v==6)
            {
                $this->_get_test_str($v) ;
            }
            else if($v==7)
            {
                $this->_get_test_str($v) ;
            }
            else if($v==8)
            {
                $this->_get_test_str($v) ;
            }
            else if($v==9)
            {
                $this->_get_test_str($v) ;
            }
            else if($v==0)
            {
                $this->_get_test_str($v) ;
            }
        }
        $this->benchmark->mark('code2_end');
        $time_mark = $this->benchmark->elapsed_time('code2_start','code2_end');
        return $time_mark*1000 ;
    }

    private function _get_test_str($v)
    {
        $test_str = 0 ;
        for($test_i=0;$test_i<100;$test_i++)
        {
            $test_str += $test_i ;
        }
    }
}
?>