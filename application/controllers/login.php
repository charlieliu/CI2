<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public $current_title = 'Login 測試';

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
        //$this->pub->check_session($this->session->userdata('session_id'));
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
            'title'         => $this->current_title,
            'current_title' => $this->current_title,
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'   => strtolower(__FUNCTION__), // 當下function
            'btn_value'     => 'login',
            'btn_url'       => 'check_login',
            'base_url'      => base_url(),
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('login/login_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;
        //$html_date['css'][] = 'css/bootstrap-3.2.0-dist/css/bootstrap.min.css';
        $html_date['js'][] = 'css/bootstrap-3.2.0-dist/js/bootstrap.min.js';
        $html_date['js'][] = 'js/login.js';

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);
    }

    public function check_login()
    {
        $post = $this->input->post();
        $post = $this->pub->trim_val($post);
        $status = '' ;
        if( empty($post['username']) )
        {
            $status =  'name is empty';
        }
        if( empty($post['pwd']) )
        {
            $status = 'pwd is empty' ;
        }
        $post['password'] = $post['pwd'];
        $this->load->model('Login_model','',TRUE);
        $users = $this->Login_model->getUsers($post['username']);
        if( intval($users['total'])!=1 )
        {
            $status = 'users total'.intval($users['total']) ;
        }
        else
        {
            $userdata = array(
                'uid'=>$users['data'][0]['uid'],
                'username'=>$users['data'][0]['username'],
            );
            $this->session->set_userdata($userdata);
            $status = 100;
        }
        echo json_encode(array('status'=>$status,));
    }

    public function register()
    {
        // 標題 內容顯示
        $data = array(
            'title' => '註冊 測試',
            'current_title' => $this->current_title,
            'current_page'  => strtolower(__CLASS__), // 當下類別
            'current_fun'   => strtolower(__FUNCTION__), // 當下function
            'btn_value'     => 'create',
            'btn_url'       => 'do_register',
            'base_url'      => base_url(),
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('login/register_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;
        $html_date['js'][] = 'js/jquery.form.js';
        $html_date['js'][] = 'js/register.js';

        $view = $this->parser->parse('index_view', $html_date, true);
        $this->pub->remove_view_space($view);
    }

    public function do_register()
    {
        $post = $this->input->post();
        $post = $this->pub->trim_val($post);
        if( empty($post['username']) )
        {
            $status = 'name is empty';
        }
        else if( !preg_match("/^[\x{4e00}-\x{9fa5}|\w|\.|\-]*$/", $post['username']) )
        {
            $status = 'name 限用中英文數字_.-';
        }
        else if( empty($post['pwd']) )
        {
            $status = 'pwd is empty';
        }
        else if( empty($post['repwd']) )
        {
            $status = 'repwd is empty';
        }
        else if( empty($post['email']) )
        {
            $status = 'email is empty';
        }
        else if( !preg_match("/^(\w|\.|\+|\-)+@(\w|\-)+\.(\w|\.|\-)+$/", $post['email']) )
        {
            $status = 'email address error';
        }
        else if( empty($post['addr']) )
        {
            $status = 'address is empty';
        }
        else if( $post['pwd']!=$post['repwd'] )
        {
            $status = 'pwd and repwd is different';
        }
        else
        {
            $this->load->model('Login_model','',TRUE);
            $content = $this->Login_model->getUsers($post['username']);
            if( $content['total']>0 )
            {
                $status = 'username has be used';
            }
            else
            {
                $salt = rand(101,999);
                $data = array(
                    'username'=>$post['username'],
                    'salt'=>$salt,
                    'password'=>md5($salt.$post['pwd']),
                    'email'=>$post['email'],
                    'addr'=>$post['addr'],
                );
                $status = $this->Login_model->insUsers($data);
            }
        }
        echo json_encode(array('status'=>$status,));
    }
}
?>
