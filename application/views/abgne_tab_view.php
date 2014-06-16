<div class="abgne_tab">
    <ul class="tabs">
        {nav}
        <li><a href="#{content_id}">{content_title}</a></li>
        {/nav}
    </ul>

    <div class="tab_container">
        {content}
        <div id="{content_id}" class="tab_content">
            <h2>{content_title}</h2>
            <p>{content_value}</p>
        </div>
        {/content}
    </div>
</div>
<style type="text/css">
    ul, li {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .abgne_tab {
        clear: left;
        width: 98%;
        margin: 10px 1%;
    }
    ul.tabs {
        width: 100%;
        height: 32px;
        border-bottom: 1px solid #999;
        border-left: 1px solid #999;
    }
    ul.tabs li {
        float: left;
        height: 31px;
        line-height: 31px;
        overflow: hidden;
        position: relative;
        margin-bottom: -1px;    /* 讓 li 往下移來遮住 ul 的部份 border-bottom */
        border: 1px solid #999;
        border-left: none;
        background: #e1e1e1;
    }
    ul.tabs li a {
        display: block;
        padding: 0 20px;
        color: #000;
        border: 1px solid #fff;
        text-decoration: none;
    }
    ul.tabs li a:hover {
        background: #ccc;
    }
    ul.tabs li.active  {
        background: #fff;
        border-bottom: 1px solid#fff;
    }
    ul.tabs li.active a:hover {
        background: #fff;
    }
    div.tab_container {
        clear: left;
        width: 100%;
        border: 1px solid #999;
        border-top: none;
        background: #fff;
    }
    div.tab_container .tab_content {
        padding: 20px;
    }
    div.tab_container .tab_content h2 {
        margin: 0 0 20px;
    }
</style>
<script type="text/javascript">
    $(function(){
        // 預設顯示第一個 Tab
        var _showTab = 0;
        $('.abgne_tab').each(function(){
            // 目前的頁籤區塊
            var $tab = $(this);

            var $defaultLi = $('ul.tabs li', $tab).eq(_showTab).addClass('active');
            $($defaultLi.find('a').attr('href')).siblings().hide();

            // 當 li 頁籤被點擊時...
            // 若要改成滑鼠移到 li 頁籤就切換時, 把 click 改成 mouseover
            $('ul.tabs li', $tab).mouseover(function() {
                // 找出 li 中的超連結 href(#id)
                var $this = $(this),
                    _clickTab = $this.find('a').attr('href');
                // 把目前點擊到的 li 頁籤加上 .active
                // 並把兄弟元素中有 .active 的都移除 class
                $this.addClass('active').siblings('.active').removeClass('active');
                // 淡入相對應的內容並隱藏兄弟元素
                $(_clickTab).stop(false, true).fadeIn().siblings().hide();

                return false;
            }).find('a').focus(function(){
                this.blur();
            });
        });
    });
</script>