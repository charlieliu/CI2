<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div class="content_block" id="js_hide_show">又文揪櫻達買下午茶</div>
    <div class="content_block" id="js_fading">櫻達預算無上限</div>
    <div class="content_block" id="js_silde">又文熱量有上限<br><br><br></div>

    <div>
        <button id="js_hide">隱藏</button>
        <span>$(selector).hide(speed,callback);</span>
    </div>
    <div>
        <button id="js_show">顯示</button>
        <span>$(selector).show(speed,callback);</span>
    </div>
    <div>
        <button id="js_fadeIn">淡入</button>
        <span>$(selector).fadeIn(speed,callback);</span>
    </div>
    <div>
        <button id="js_fadeOut">淡出</button>
        <span>$(selector).fadeToggle(speed,callback);</span>
    </div>
    <div>
        <button id="js_fadeToggle">切換</button>
        <span>$(selector).fadeToggle(speed,callback);</span>
    </div>
    <div>
        <button id="js_fadeTo">透明度</button>
        <span>$(selector).fadeTo(speed,opacity,callback);</span>
    </div>
    <div>
        <button id="js_slideDown">滑出</button>
        <span>$(selector).slideDown(speed,callback);</span>
    </div>
    <div>
        <button id="js_slideUp">滑入</button>
        <span>$(selector).slideUp(speed,callback);</span>
    </div>
    <div>
        <button id="js_slideToggle">滑動切換</button>
        <span>$(selector).slideToggle(speed,callback);</span>
    </div>

    <script type="text/javascript">
        <!--
        $('#js_hide').click(function(){
            $('#js_hide_show').hide();
        });
        $('#js_show').click(function(){
            $('#js_hide_show').show();
        });
        $('#js_fadeIn').click(function(){
            $('#js_fading').fadeIn("slow");
        });
        $('#js_fadeOut').click(function(){
            $('#js_fading').fadeOut("slow");
        });
        $('#js_fadeToggle').click(function(){
            $('#js_fading').fadeToggle("slow");
        });
        $('#js_fadeTo').click(function(){
            $('#js_fading').fadeTo("slow",0.4);
        });
        $('#js_slideDown').click(function(){
            $('#js_slide').slideDown(3000,alert('js_slideDown'));
        });
        $('#js_slideUp').click(function(){
            $('#js_slide').slideUp(3000,alert('js_slideUp'));
        });
        $('#js_slideToggle').click(function(3000,alert('js_slideToggle')){
            $('#js_slide').slideToggle();
        });
        -->
    </script>
</div>