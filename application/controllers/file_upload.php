<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // load parser
        $this->load->library('parser');
        $this->load->helper(array('form', 'url'));
    }

    /**
     * Floating-point test Page for this controller.
     *
     * @author Charlie Liu <liuchangli0107@gmail.com>
     */
    public function index()
    {
        $this->index_view() ;
        //$this->demo() ;
    }

    public function index_view()
    {
        // 標題 內容顯示
        $data = array(
            'title' => 'JS file upload 測試',
            'current_page' => strtolower(__CLASS__), // 當下類別
            'current_fun' => strtolower(__FUNCTION__), // 當下function
            'content' => '',
            '_FILES'=>$_FILES,
            'base_url'=>base_url(),
        );

        // 中間挖掉的部分
        $content_div = $this->load->view('file_upload_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;

        $html_date['css'] = array() ;
        $html_date['css'][] = 'js/jQuery-File-Upload-9.7.2/css/style.css';
        $html_date['css'][] = 'js/jQuery-File-Upload-9.7.2/css/jquery.fileupload.css';
        $html_date['css'][] = 'js/jQuery-File-Upload-9.7.2/css/jquery.fileupload-ui.css';
        $html_date['css'][] = 'http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css';

        $html_date['css_ie'] = array() ;
        $html_date['css_ie'][] = 'jQuery-File-Upload-9.7.2/css/demo-ie8.css';

        $html_date['js'] = array() ;
        $html_date['js'][] = 'js/jQuery-File-Upload-9.7.2/js/vendor/jquery.ui.widget.js';
        $html_date['js'][] = 'http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js';
        $html_date['js'][] = 'http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js';
        $html_date['js'][] = 'http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js';
        $html_date['js'][] = 'http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js';
        $html_date['js'][] = 'js/jQuery-File-Upload-9.7.2/js/jquery.fileupload.js';
        $html_date['js'][] = 'js/jQuery-File-Upload-9.7.2/js/jquery.fileupload-process.js';
        $html_date['js'][] = 'js/jQuery-File-Upload-9.7.2/js/jquery.fileupload-image.js';
        $html_date['js'][] = 'js/jQuery-File-Upload-9.7.2/js/jquery.fileupload-audio.js';
        $html_date['js'][] = 'js/jQuery-File-Upload-9.7.2/js/jquery.fileupload-video.js';
        $html_date['js'][] = 'js/jQuery-File-Upload-9.7.2/js/jquery.fileupload-validate.js';
        $html_date['js'][] = 'js/jQuery-File-Upload-9.7.2/js/jquery.fileupload-ui.js';
        $html_date['js'][] = 'js/jQuery-File-Upload-9.7.2/js/main_charlie.js';

        $html_date['js_ie'] = array() ;
        $html_date['js_ie'][] = 'js/jQuery-File-Upload-9.7.2/js/cors/jquery.xdr-transport.js';

        $this->parser->parse('index_view', $html_date ) ;
    }

    public function demo()
    {
        $this->parser->parse('file_upload_2_view', array() ) ;
    }

    public function do_upload_test()
    {
        var_dump($_FILES);
    }

    public function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '1024';

        $this->load->library('upload', $config);

        $error = array();
        $result = array();
        foreach ( $_FILES as $k=>$v ) {
            unset($this->upload->error_msg);

            if( !empty($v['tmp_name']) && $v['size']>0 )
            {
                if ( ! $this->upload->do_upload($k))
                {
                    $error[] = $this->upload->display_errors();
                }
                else
                {
                    $result[] = $this->upload->data();
                }
            }
        }

        //echo json_encode(array('result'=>$result,'error'=>$error));
        $this->load->view('file_upload_success_view', array('upload_data'=>$result[0]));
    }
}
?>