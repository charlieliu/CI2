<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public $current_title = '首頁';

    public function __construct()
    {
        parent::__construct();
        header('Content-Type: text/html; charset=utf8');
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

        // 顯示資料
        $content = array();
        /*
        $content[] = array(
            'content_value' => 'welcome',
            'content_title' => '首頁',
            'content_url' => 'welcome'
        ) ;
        */
        $content[] = array(
            'content_value' => 'css_test',
            'content_title' => 'CSS效果測試',
            'content_url' => 'css_test'
        ) ;
        $content[] = array(
            'content_value' => 'svg_test',
            'content_title' => 'SVG效果測試',
            'content_url' => 'svg_test'
        ) ;
        $content[] = array(
            'content_value' => 'PHP_test',
            'content_title' => 'PHP 測試',
            'content_url' => 'php_test'
        ) ;
        $content[] = array(
            'content_value' => 'JS_test',
            'content_title' => 'JS 測試',
            'content_url' => 'js_test'
        ) ;
        $content[] = array(
            'content_value' => 'login',
            'content_title' => 'Login 測試',
            'content_url' => 'login'
        ) ;

        // 標題 內容顯示
        $data = array(
            'title' => 'Welcome to CodeIgniter',
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
}
?>