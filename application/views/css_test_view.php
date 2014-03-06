<div id="body">
	<p>{current_page}/{current_fun}</p>

	<!-- Variable Pairs -->
	{content}
	<div class="content_block">
		<b>{content_title} : </b>
		<div>{content_value}</div>
	</div>
	{/content}
	<!-- Variable Pairs -->

	<div class="loading"></div>

	<div class="abgne-loading-20140104-2">
		<div class="loading"></div>
		<div class="word">男</div>
	</div>

	<style type="text/css">
		/* 小圈圈 */
		.loading {
		    border: 3px solid #3a3;
		    border-right: 3px solid #fff;
		    border-bottom: 3px solid #fff;
		    height: 50px;
		    width: 50px;
		    border-radius: 50%;
		    /*
			animation-name: 動畫腳本名稱;
			animation-duration: 動畫播放時間(速度);
			animation-iteration-count: 動畫播放次數;
			animation-timing-function: 播放速度的效果
		    */
		    -webkit-animation: loading 1s infinite linear;
		    -moz-animation: loading 1s infinite linear;
		    -o-animation: loading 1s infinite linear;
		    animation: loading 1s infinite linear;
		}
		/* 大圈圈 加 字 */
		.abgne-loading-20140104-2 {
		    position: relative;
		    height: 100px;
		    width: 100px;
		}
		.abgne-loading-20140104-2 .loading {
		    border: 6px solid #168;
		    border-right: 6px solid #fff;
		    border-bottom: 6px solid #fff;
		    height: 100%;
		    width: 100%;
		    border-radius: 50%;
		    -webkit-animation: loading 1s infinite linear;
		    -moz-animation: loading 1s infinite linear;
		    -ms-animation: loading 1s infinite linear;
		    -o-animation: loading 1s infinite linear;
		    animation: loading 1s infinite linear;
		}
		.abgne-loading-20140104-2 .word {
		    color: #168;
		    position: absolute;
		    top: 0;
		    left: 0;
		    display: inline-block;
		    text-align: center;
		    font-size: 72px;
		    line-height: 72px;
		    font-family: 微軟正黑體, arial;
		    margin: 18px 0 0 20px;
		    padding: 0;
		}
		/*
		浏览器支持
		目前浏览器都不支持 @keyframes 规则。
		Firefox 支持替代的 @-moz-keyframes 规则。
		Opera 支持替代的 @-o-keyframes 规则。
		Safari 和 Chrome 支持替代的 @-webkit-keyframes 规则。

		@keyframes animationname {
			keyframes-selector {css-styles;}
		}
		*/
		/* Safari 和 Chrome */
		@-webkit-keyframes loading {
		    from
		    {
		        -webkit-transform: rotate(0deg);
		    }
		    to
		    {
		        -webkit-transform: rotate(360deg);
		    }
		}
		/* Firefox */
		@-moz-keyframes loading {
		    from
		    {
		        -moz-transform: rotate(0deg);
		    }
		    to
		    {
		        -moz-transform: rotate(360deg);
		    }
		}
		/* Opera */
		@-o-keyframes loading {
		    from
		    {
		        -o-transform: rotate(0deg);
		    }
		    to
		    {
		        -o-transform: rotate(360deg);
		    }
		}
		/* 其他 */
		@keyframes loading {
		    from
		    {
		        transform: rotate(0deg);
		    }
		    to
		    {
		        transform: rotate(360deg);
		    }
		}
	</style>
</div>