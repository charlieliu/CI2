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
        for($i=0;$i<4;$i++)
        {
            $nav[] = array(
                'content_id' => 'tab_'.($i+1),
                'content_title' => '第'.($i+1).'頁',
            ) ;
            $content[] = array(
                'content_id' => 'tab_'.($i+1),
                'content_title' => '第'.($i+1).'頁',
                'content_value' => '第'.($i+1).'頁',
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
}
?>