<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"><!--HTML5-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="{title}">
    <meta name="description" content="{title}">
    <meta property="og:image" content="<?=base_url()?>images/joba.jpg">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->

    <title>{title}</title>
    <?php
    // 載入helper/test_helper.php
    $this->load->helper('test');
    // 小圖
    $link = array(
        'type'  => "image/x-icon",
        'rel'   => "shortcut icon",
        'href'  => base_url()."images/joba.jpg",
        'ver'   => date('YmdHis')
    );
    echo load_html_file($link);
    // CSS
    $css_link = array();
    $css_link[] = 'css/welcome.css';
    $css_link[] = 'css/bootstrap-3.2.0-dist/css/bootstrap.min.css';
    $css_link[] = 'css/bootstrap-3.2.0-dist/css/bootstrap-theme.min.css';
    $css_link = (!empty($css)&&is_array($css)&&count($css)) ? array_merge($css_link, $css) : $css_link ;

    foreach( $css_link as $val )
    {
        if( preg_match('/^http/i', $val) )
        {
            $link = array(
                'type'  => "text/css",
                'rel'   => "stylesheet",
                'href'  => $val,
                'ver'   => ''
            );
            echo load_html_file($link);
        }
        else if( file_exists($val) )
        {
            $link = array(
                'type'  => "text/css",
                'rel'   => "stylesheet",
                'href'  => base_url().$val,
                'ver'   => ''
            );
            echo load_html_file($link);
        }
    }

    if( !empty($css_ie) && is_array($css_ie) && count($css_ie) )
    {
        echo '<!--[if lte IE 8]>';
        foreach($css_ie as $val)
        {
            $link = array(
                'type'  => "text/css",
                'rel'   => "stylesheet",
                'href'  => $val,
                'ver'   => ''
            );
            echo load_html_file($link);
        }
        echo '<![endif]-->';
    }

    $js_link = array();
    $js_link[] = 'js/jquery-1.11.js';
    $js_link[] = 'css/bootstrap-3.2.0-dist/js/bootstrap.min.js';
    $js_link = (!empty($js)&&is_array($js)&&count($js)) ? array_merge($js_link,$js) : $js_link ;

    foreach( $js_link as $val )
    {
        if( preg_match('/^http/i', $val) )
        {
            $link = array(
                'type'  => "text/javascript",
                'rel'   => "stylesheet",
                'href'  => $val,
                'ver'   => ''
            );
            echo load_html_file($link);
        }
        else if( file_exists($val) )
        {
            $link = array(
                'type'  => "text/javascript",
                'rel'   => "stylesheet",
                'href'  => base_url().$val,
                'ver'   => ''
            );
            echo load_html_file($link);
        }
    }

    if( !empty($js_ie) && is_array($js_ie) && count($js_ie) )
    {
        echo '<!--[if (gte IE 8)&(lt IE 10)]>';
        foreach($js_ie as $val)
        {
            $link = array(
                'type'  => "text/javascript",
                'rel'   => "stylesheet",
                'href'  => $val,
                'ver'   => ''
            );
            echo load_html_file($link);
        }
        echo '<![endif]-->';
    }
    ?>
</head>
<body>
    <div id="container">
        <?PHP if( $current_page!='welcome' && $current_page!='index'): ?>
            <div class="breadcrumb">
                <a href="<?=base_url()?>" title="首頁"><span>首頁</span></a>
                <?PHP if( $current_fun!='index' && $current_fun!=$current_page ): ?>&nbsp;>>>&nbsp;<a href="<?=base_url()?>{current_page}" title="{current_title}"><span>{current_title}</span></a><?PHP endif; ?>
                &nbsp;>>>&nbsp;{title}
            </div>
        <?PHP endif; ?>

        <h1>{title}</h1>
        {content_div}
        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>

        <?PHP if( $current_page=='session_test'): ?><div>COOKIE :<?PHP print_r($_COOKIE); ?></div><?PHP endif; ?>
    </div>

    <?PHP if( $current_page=='welcome' || $current_page=='index'): ?>
        <embed width="1" height="1" src="http://www.youtube.com/v/P2QrLuMq2Ow?autoplay=0&loop=1">
    <?PHP else: ?>
        <a href="http://www.youtube.com/v/P2QrLuMq2Ow" target="_blank">bgsound</a>
    <?PHP endif; ?>

    <div id="gotop">˄</div>
    <style type="text/css">
        #gotop {
            display: none;
            position: fixed;
            right: 20px;
            bottom: 20px;
            padding: 10px 15px;
            font-size: 20px;
            background: #777;
            color: white;
            cursor: pointer;
        }
    </style>
    <script type="text/javascript">
        $(function(){
            $("#gotop").click(function(){
                jQuery("html,body").animate({
                    scrollTop:0
                },500);
            });
            $(window).scroll(function() {
                if ( $(this).scrollTop() > 300){
                    $('#gotop').fadeIn("fast");
                } else {
                    $('#gotop').stop().fadeOut("fast");
                }
            });
        });
    </script>
</body>
</html>