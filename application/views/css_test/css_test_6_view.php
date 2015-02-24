<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div class="demonstrate">
        <table>
            <tr>
                <td>
                    <div class="description">
                        <div class="demo">
                            <span class="front"><img title="翻轉" alt="图片" src="images/j.jpg" ></span>
                            <span class="behind"><img title="翻轉" alt="图片" src="images/joba.jpg" ></span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="description">
                        <div class="demo">
                            <span class="front"><img title="翻轉" alt="图片" src="images/q.jpg" ></span>
                            <span class="behind"><img title="翻轉" alt="图片" src="images/joba.jpg" ></span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="description">
                        <div class="demo">
                            <span class="front"><img title="翻轉" alt="图片" src="images/u.jpg" ></span>
                            <span class="behind"><img title="翻轉" alt="图片" src="images/joba.jpg" ></span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="description">
                        <div class="demo">
                            <span class="front"><img title="翻轉" alt="图片" src="images/e.jpg" ></span>
                            <span class="behind"><img title="翻轉" alt="图片" src="images/joba.jpg" ></span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="description">
                        <div class="demo">
                            <span class="front"><img title="翻轉" alt="图片" src="images/r.jpg" ></span>
                            <span class="behind"><img title="翻轉" alt="图片" src="images/joba.jpg" ></span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="description">
                        <div class="demo">
                            <span class="front"><img title="翻轉" alt="图片" src="images/y.jpg" ></span>
                            <span class="behind"><img title="翻轉" alt="图片" src="images/joba.jpg" ></span>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".description").click(function(){
                var tag_front = $(this).find('.front'), tag_behind = $(this).find('.behind');
                if( !tag_front.hasClass('hover') )
                {
                    tag_front.addClass('hover');
                    tag_behind.addClass('hover');
                }
                else
                {
                    tag_front.removeClass('hover');
                    tag_behind.removeClass('hover');
                }
                /* for old IE */
                if( /msie/.test(navigator.userAgent.toLowerCase()) )
                {
                    tag_front.fadeToggle();
                    tag_behind.fadeToggle();
                }
            });
            console.log(navigator.userAgent.toLowerCase());
        });
    </script>

</div>