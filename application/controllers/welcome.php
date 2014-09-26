<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
            'content_value' => 'float_test',
            'content_title' => 'PHP浮點 測試',
            'content_url' => 'float_test'
        ) ;
        $content[] = array(
            'content_value' => 'date_test',
            'content_title' => '時間格式顯示',
            'content_url' => 'date_test'
        ) ;
        $content[] = array(
            'content_value' => 'session_test',
            'content_title' => 'CI session 測試',
            'content_url' => 'session_test'
        ) ;
        $content[] = array(
            'content_value' => 'css_test',
            'content_title' => 'CSS效果測試',
            'content_url' => 'css_test'
        ) ;
        $content[] = array(
            'content_value' => 'count_sizeof',
            'content_title' => 'count() sizeof() 效能比較',
            'content_url' => 'count_sizeof'
        ) ;
        $content[] = array(
            'content_value' => 'hash_test',
            'content_title' => 'Hash 測試',
            'content_url' => 'hash_test'
        ) ;
        $content[] = array(
            'content_value' => 'switch_test',
            'content_title' => 'if else & switch 效能比較',
            'content_url' => 'switch_test'
        ) ;
        $content[] = array(
            'content_value' => 'abgne_tab',
            'content_title' => '利用 jQuery 來製作網頁頁籤(Tab)',
            'content_url' => 'abgne_tab'
        ) ;
        $content[] = array(
            'content_value' => 'svg_test',
            'content_title' => 'SVG效果測試',
            'content_url' => 'svg_test'
        ) ;
        $content[] = array(
            'content_value' => 'JS_object_test',
            'content_title' => 'JS object 測試',
            'content_url' => 'js_object_test'
        ) ;
        $content[] = array(
            'content_value' => 'JS_object_test2',
            'content_title' => 'JS object 測試2',
            'content_url' => 'js_object_test2'
        ) ;
        $content[] = array(
            'content_value' => 'JS_file_upload',
            'content_title' => 'JS file_upload 測試',
            'content_url' => 'file_upload'
        ) ;
        $content[] = array(
            'content_value' => 'get_filesize',
            'content_title' => '檔案大小',
            'content_url' => 'get_filesize'
        ) ;

        // 標題 內容顯示
        $data = array(
            'title' => 'Welcome to CodeIgniter',
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