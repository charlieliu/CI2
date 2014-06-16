<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Abgne_tab extends CI_Controller {

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
        for($i=0;$i<2;$i++)
        {
            $nav[] = array(
                'content_id' => 'tab_'.($i+1),
                'content_title' => '第'.$i.'頁',
            ) ;
            $content[] = array(
                'content_id' => 'tab_'.($i+1),
                'content_title' => '第'.$i.'頁',
                'content_value' => '第'.$i.'頁',
            ) ;
        }

        // 標題 內容顯示
        $data = array(
            'title'         => '利用 jQuery 來製作網頁頁籤(Tab)',
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'   => strtolower(__FUNCTION__), // 當下function
            'nav'           => $nav,
            'content'       => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('abgne_tab_view', $data, true);
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
}
?>