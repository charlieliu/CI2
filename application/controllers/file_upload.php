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
        $upload_path_url = base_url() . 'uploads/';

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '10240';

        $this->load->library('upload', $config);

        $files = array();
        foreach ( $_FILES as $k=>$v ) {
            unset($this->upload->error_msg);

            if ( ! $this->upload->do_upload($k))
            {
                $error = $this->upload->display_errors();
                $error = str_replace("<p>","", $error);
                $error = str_replace("</p>","", $error);
                $info->error = $error;
                $files[] = $info;
            }
            else
            {
                $data = $this->upload->data();

                // to re-size for thumbnail images un-comment and set path here and in json array
                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $data['full_path'];
                $config['create_thumb'] = TRUE;
                $config['new_image'] = $data['file_path'] . 'thumbs/';
                $config['maintain_ratio'] = TRUE;
                $config['thumb_marker'] = '';
                $config['width'] = 75;
                $config['height'] = 50;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                //set the data for the json array
                $info->name = $data['file_name'];
                $info->size = $data['file_size'];
                $info->type = $data['file_type'];
                $info->url = $upload_path_url . $data['file_name'];
                // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
                $info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
                $info->deleteUrl = base_url() . 'file_upload/deleteImage/' . $data['file_name'];
                $info->deleteType = 'DELETE';
                $info->error = null;
                $files[] = $info;
            }
        }
        if(!empty($files))
        {
            echo json_encode(array("files" => $files));
        }
        /*
        if(IS_AJAX)
        {
            echo json_encode(array("files" => $files));
        }
        else
        {
            $this->load->view('file_upload_success_view', array('upload_data'=>$files));
        }
        */
    }

    public function deleteImage($file) {//gets the job done but you might want to add error checking and security
        $success = unlink(FCPATH . 'uploads/' . $file);
        $success = unlink(FCPATH . 'uploads/thumbs/' . $file);
        //info to see if it is doing what it is supposed to
        $info->sucess = $success;
        $info->path = base_url() . 'uploads/' . $file;
        $info->file = is_file(FCPATH . 'uploads/' . $file);

        echo json_encode(array($info));
        /*
        if (IS_AJAX) {
            //I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else {
            //here you will need to decide what you want to show for a successful delete
            $file_data['delete_data'] = $file;
            $this->load->view('uploader/delete_success.phtml', $file_data);
        }
        */
    }
}
?>