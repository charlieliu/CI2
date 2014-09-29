<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public $current_title = 'Login 測試';

    public function __construct()
    {
        parent::__construct();
        // load parser
        $this->load->library(array('parser','session'));
        $this->load->helper(array('form', 'url'));
    }

    /**
     * @author Charlie Liu <liuchangli0107@gmail.com>
     */
    public function index()
    {
        $this->login();
    }

    public function login()
    {
        // 標題 內容顯示
        $data = array(
            'title' => $this->current_title,
            'current_title' => $this->current_title,
            'current_page' => strtolower(__CLASS__), // 當下類別
            'current_fun' => strtolower(__FUNCTION__), // 當下function
            'btn_value' => 'login',
            'btn_url' => 'check_login',
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('login_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;
        //$html_date['css'][] = 'css/bootstrap-3.2.0-dist/css/bootstrap.min.css';
        $html_date['js'][] = 'css/bootstrap-3.2.0-dist/js/bootstrap.min.js';
        $this->parser->parse('index_view', $html_date ) ;
    }

    public function check_login()
    {
        $post = $this->input->post();
        $post = $this->trim_val($post);
        if( empty($post['username']) )
        {
            exit('name is empty');
        }
        if( empty($post['pwd']) )
        {
            exit('pwd is empty');
        }
        $post['password'] = $post['pwd'];
        $this->load->model('Login_model','',TRUE);
        $content = $this->Login_model->getUsers($post);
        var_dump($content);
    }

    public function register()
    {
        // 標題 內容顯示
        $data = array(
            'title' => '註冊 測試',
            'current_title' => $this->current_title,
            'current_page' => strtolower(__CLASS__), // 當下類別
            'current_fun' => strtolower(__FUNCTION__), // 當下function
            'btn_value' => 'create',
            'btn_url' => 'check_login',
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('register_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;
        $this->parser->parse('index_view', $html_date ) ;
    }

    public function trim_val($in_data)
    {
        if( !empty($in_data) )
        {
            if( is_array($in_data) )
            {
                foreach ($in_data as $key=>$value) {
                    $in_data[$key] = trim($value);
                }
                return $in_data;
            }
            else
            {
                return trim($in_data);
            }
        }
        else
        {
            return $in_data;
        }
    }
}
?>