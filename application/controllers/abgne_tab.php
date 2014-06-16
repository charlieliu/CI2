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
        $nav[] = array(
            'content_id' => 'tab_1',
            'content_title' => '青花瓷',
        ) ;
        $content[] = array(
            'content_id' => 'tab_1',
            'content_title' => '青花瓷',
            'content_value' => '
            作詞：方文山<br>
            作曲：周杰倫<br>
            編曲：鍾興民<br>
            <br>
            素胚勾勒出青花筆鋒濃轉淡<br>
            瓶身描繪的牡丹一如妳初妝<br>
            冉冉檀香透過窗心事我了然<br>
            宣紙上走筆至此擱一半<br>
            <br>
            釉色渲染仕女圖韻味被私藏<br>
            而妳嫣然的一笑如含苞待放<br>
            妳的美一縷飄散 去到我去不了的地方<br>
            <br>
            天青色等煙雨 而我在等妳<br>
            炊煙裊裊昇起 隔江千萬里<br>
            在瓶底書漢隸仿前朝的飄逸<br>
            就當我為遇見妳伏筆<br>
            <br>
            天青色等煙雨 而我在等妳<br>
            月色被打撈起 暈開了結局<br>
            如傳世的青花瓷自顧自美麗 妳眼帶笑意<br>
            <br>
            色白花青的錦鯉躍然於碗底<br>
            臨摹宋體落款時卻惦記著妳<br>
            妳隱藏在窯燒裡千年的秘密<br>
            極細膩猶如繡花針落地<br>
            <br>
            簾外芭蕉惹驟雨門環惹銅綠<br>
            而我路過那江南小鎮惹了妳<br>
            在潑墨山水畫裡 妳從墨色深處被隱去<br>
            <br>
            天青色等煙雨 而我在等妳<br>
            炊煙裊裊昇起 隔江千萬里<br>
            在瓶底書漢隸仿前朝的飄逸<br>
            就當我為遇見妳伏筆<br>
            <br>
            天青色等煙雨 而我在等妳<br>
            月色被打撈起 暈開了結局<br>
            如傳世的青花瓷自顧自美麗 妳眼帶笑意<br>
            <br>
            天青色等煙雨 而我在等妳<br>
            炊煙裊裊昇起 隔江千萬里<br>
            在瓶底書漢隸仿前朝的飄逸<br>
            就當我為遇見妳伏筆<br>
            <br>
            天青色等煙雨 而我在等妳<br>
            月色被打撈起 暈開了結局<br>
            如傳世的青花瓷自顧自美麗 妳眼帶笑意<br>
            <br>
            更多更詳盡歌詞 在 ※ Mojim.com　魔鏡歌詞網<br>
            ',
        ) ;

        $nav[] = array(
            'content_id' => 'tab_2',
            'content_title' => '髮如雪',
        ) ;
        $content[] = array(
            'content_id' => 'tab_2',
            'content_title' => '髮如雪',
            'content_value' => '
            作詞：方文山<br>
            作曲：周杰倫<br>
            <br>
            狼牙月 伊人憔悴<br>
            我舉杯 飲盡了風雪<br>
            是誰打翻前世櫃 惹塵埃是非<br>
            緣字訣 幾番輪迴<br>
            妳鎖眉 哭紅顏喚不回<br>
            縱然青史已經成灰 我愛不滅<br>
            繁華如三千東流水 我只取一瓢愛了解<br>
            只戀妳化身的蝶<br>
            <br>
            妳髮如雪 淒美了離別<br>
            我焚香感動了誰<br>
            邀明月 讓回憶皎潔<br>
            愛在月光下完美<br>
            妳髮如雪 紛飛了眼淚<br>
            我等待蒼老了誰<br>
            紅塵醉 微醺的歲月<br>
            我用無悔 刻永世愛妳的碑<br>
            <br>
            Rap:<br>
            你髮如雪 淒美了離別<br>
            我焚香感動了誰<br>
            邀明月 讓回憶皎潔<br>
            愛在月光下完美<br>
            你髮如雪 紛飛了眼淚<br>
            我等待蒼老了誰<br>
            紅塵醉 微醺的歲月<br>
            <br>
            啦兒啦 啦兒啦 啦兒啦兒啦<br>
            啦兒啦 啦兒啦 啦兒啦兒啦<br>
            銅鏡映無邪 紮馬尾<br>
            妳若撒野 今生我把酒奉陪<br>
            <br>
            更多更詳盡歌詞 在 ※ Mojim.com　魔鏡歌詞網<br>
            ',
        ) ;

        $nav[] = array(
            'content_id' => 'tab_3',
            'content_title' => '菊花台',
        ) ;
        $content[] = array(
            'content_id' => 'tab_3',
            'content_title' => '菊花台',
            'content_value' => '
            作詞：方文山<br>
            作曲：周杰倫<br>
            編曲：鍾興民<br>
            <br>
            你的淚光　柔弱中帶傷　慘白的月彎彎勾住過往<br>
            夜太漫長　凝結成了霜　是誰在閣樓上冰冷的絕望<br>
            雨輕輕彈　朱紅色的窗　我一生在紙上被風吹亂<br>
            夢在遠方　化成一縷香　隨風飄散你的模樣<br>
            <br>
            菊花殘滿地傷　你的笑容已泛黃　花落人斷腸　我心事靜靜躺<br>
            北風亂夜未央　你的影子剪不斷　徒留我孤單　在湖面成雙<br>
            <br>
            花已向晚　飄落了燦爛　凋謝的世道上命運不堪<br>
            <br>
            愁莫渡江　秋心拆兩半　怕你上不了岸一輩子搖晃<br>
            誰的江山　馬蹄聲狂亂　我一身的戎裝呼嘯滄桑<br>
            天微微亮　你輕聲的嘆　一夜惆悵如此委婉<br>
            <br>
            菊花殘滿地傷　你的笑容已泛黃　花落人斷腸　我心事靜靜躺<br>
            北風亂夜未央　你的影子剪不斷　徒留我孤單　在湖面成雙<br>
            <br>
            菊花殘滿地傷　你的笑容已泛黃　花落人斷腸　我心事靜靜躺<br>
            北風亂夜未央　你的影子剪不斷　徒留我孤單　在湖面成雙<br>
            <br>
            更多更詳盡歌詞 在 ※ Mojim.com　魔鏡歌詞網<br>
            ',
        ) ;

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