<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author Charlie Liu <liuchangli0107@gmail.com>
*/
class Html5_test extends CI_Controller {

    private $current_title = 'HTML5 測試';
    private $page_list = '';

    // 建構子
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: text/html; charset=utf8');
        // load parser
        $this->load->library(array('parser','session', 'pub'));
        $this->load->helper(array('form', 'url'));
        $this->pub->check_session($this->session->userdata('session_id'));

        $content[] = array(
            'content_title' => '控制 HTML5 視訊播放程式',
            'content_url' => base_url().'html5_test/test/1',
        ) ;

        $this->page_list = $content ;
    }

    // 取得標題
    public function getPageList()
    {
        echo json_encode($this->page_list);
    }

    // 測試分類畫面
    public function index()
    {
        $content = $this->page_list ;
        // 標題 內容顯示
        $data = array(
            'title' => $this->current_title,
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

    // VIEW
    public function test($in='1')
    {
        // 標題 內容顯示
        $data = array(
            'title' => $this->current_title,
            'current_title' => $this->current_title,
            'current_page' => strtolower(__CLASS__), // 當下類別
            'current_fun' => strtolower(__FUNCTION__), // 當下function
            'content' => '',
            'base_url'=>base_url(),
            'space_4'=>$this->pub->n2nbsp(4),
        );

        switch ($in) {
            case '1':
                $data['title'] .= ' -- 控制 HTML5 視訊播放程式' ;
                break;
            default:
                $in = '' ;
                break;
        }
        if( !empty($in) )
        {
            $data['js'][] = 'js/html5_test/test_'.$in.'.js';
        }

        // 中間挖掉的部分
        $content_div = empty($in) ? '' : $this->parser->parse('html5_test/test_'.$in.'_view', $data, true);

        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);
    }
}
?>