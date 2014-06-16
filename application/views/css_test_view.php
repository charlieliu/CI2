<div id="body">
    <p>{current_page}/{current_fun}</p>

    <!-- 轉圈圈 -->
    <div class="content_block">
        <h3>小圈圈</h3>
        <div class="loading"></div>

        <h3>大圈圈+字</h3>
        <div class="abgne-loading-20140104-2">
            <div class="loading"></div>
            <div class="word">男</div>
        </div>
        <link rel="stylesheet" type="text/css" href="css/css_test_1.css" />
    </div>
    <!-- 轉圈圈 -->

    <!-- 反轉 -->
    <div class="content_block">
        <h3>用CSS反轉</h3>
        <div>transform:rotate(180deg)</div>
        <ol class="ul_rotate">
            {content}
            <li class="li_rotate">{ol_li}</li>
            {/content}
        </ol>
        <link rel="stylesheet" type="text/css" href="css/css_test_2.css" />
    </div>
    <!-- 反轉 -->

    <!-- 用 CSS3 做表單 - 自訂單/多選框樣式 -->
    <div class="content_block">
        <h3>性別(單選)</h3>
        <ul class="abgne-menu-20140109-1">
            <li>
                <input type="radio" id="male" name="sex">
                <label for="male">我是男生</label>
            </li>
            <li>
                <input type="radio" id="female" name="sex">
                <label for="female">我是女生</label>
            </li>
            <li>
                <input type="radio" id="other" name="sex">
                <label for="other">我不想說</label>
            </li>
        </ul>

        <h3>專長(多選)</h3>
        <ul class="abgne-menu-20140109-2">
            <li>
                <input type="checkbox" id="jquery" name="skill" checked>
                <label for="jquery">jQuery</label>
            </li>
            <li>
                <input type="checkbox" id="css3" name="skill">
                <label for="css3">CSS3</label>
            </li>
            <li>
                <input type="checkbox" id="html5" name="skill">
                <label for="html5">HTML5</label>
                </li>
            <li>
                <input type="checkbox" id="angularjs" name="skill">
                <label for="angularjs">AngularJS</label>
            </li>
        </ul>

        <link rel="stylesheet" type="text/css" href="css/css_test_3.css" />
    </div>
    <!-- 用 CSS3 做表單 - 自訂單/多選框樣式 -->

    <!-- 用 CSS3 做畫廊 - 滑入滑出時偽原地縮放圖片 -->
    <div class="content_block">
        <ul id="abgne-block-20140105">
            <li><a href="#"><img src="images/j.jpg"/></a></li>
            <li><a href="#"><img src="images/q.jpg"/></a></li>
            <li><a href="#"><img src="images/u.jpg"/></a></li>
            <li><a href="#"><img src="images/e.jpg"/></a></li>
            <li><a href="#"><img src="images/r.jpg"/></a></li>
            <li><a href="#"><img src="images/y.jpg"/></a></li>
        </ul>
        <link rel="stylesheet" type="text/css" href="css/css_test_4.css" />
    </div>
    <!-- 用 CSS3 做畫廊 - 滑入滑出時偽原地縮放圖片 -->
</div>