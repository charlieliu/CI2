<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hash_test extends CI_Controller {

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

        $hash_array = array(
            '0' => 'md2',
            '1' => 'md4',
            '2' => 'md5',
            '3' => 'sha1',
            //'4' => 'sha224',
            '5' => 'sha256',
            '6' => 'sha384',
            '7' => 'sha512',
            '8' => 'ripemd128',
            '9' => 'ripemd160',
            '10' => 'ripemd256',
            '11' => 'ripemd320',
            '12' => 'whirlpool',
            '13' => 'tiger128,3',
            '14' => 'tiger160,3',
            '15' => 'tiger192,3',
            '16' => 'tiger128,4',
            '17' => 'tiger160,4',
            '18' => 'tiger192,4',
            '19' => 'snefru',
            //'20' => 'snefru256',
            '21' => 'gost',
            '22' => 'adler32',
            '23' => 'crc32',
            '24' => 'crc32b',
            //'25' => 'salsa10',
            //'26' => 'salsa20',
            '27' => 'haval128,3',
            '28' => 'haval160,3',
            '29' => 'haval192,3',
            '30' => 'haval224,3',
            '31' => 'haval256,3',
            '32' => 'haval128,4',
            '33' => 'haval160,4',
            '34' => 'haval192,4',
            '35' => 'haval224,4',
            '36' => 'haval256,4',
            '37' => 'haval128,5',
            '38' => 'haval160,5',
            '39' => 'haval192,5',
            '40' => 'haval224,5',
            '41' => 'haval256,5',
        );

        // 顯示資料
        $content = array();
        foreach( $hash_array as $v )
        {
            $content[] = array(
                'content_title' => $v,
                'content_value' => htmlspecialchars(hash($v,'My name is Charlie', TRUE)),
            ) ;
        }

        // 標題 內容顯示
        $data = array(
            'title' => 'Hash 測試',
            'current_page' => strtolower(__CLASS__), // 當下類別
            'current_fun' => strtolower(__FUNCTION__), // 當下function
            'content' => $content,
        );

        // Template parser class
        // 中間挖掉的部分
        $content_div = $this->parser->parse('test_view', $data, true);
        // 中間部分塞入外框
        $html_date = $data ;
        $html_date['content_div'] = $content_div ;
        $this->parser->parse('index_view', $html_date ) ;
    }
}
?>