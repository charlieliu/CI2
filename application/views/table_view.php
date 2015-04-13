<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div class="content_block">
        <form id="frm1" method="post">
            <input type="text" id="hash_str" name="hash_str" style="width:80%;" value="">
            <input type="submit" id="frm1_submit" value="查詢">
            <input type="reset" id="frm1_reset" value="清除表單">
        </form>
    </div>

    <div class="content_block" style="overflow-x:scroll;width:100%;">
        <table class="mg1em" border="1" style="text-align:center;">
            {table_grid_view}
        </table>
    </div>

    <div class="content_block">
        <a class="prev-page btn disable" href="javascript:prev();" >prev</a>
        <span class="current-page" id="pageNow" name="pageNow">{page}</span>/<span class="current-page" id="pageCnt" name="pageCnt">{pagecnt}</span>
        <a class="next-page btn disable" href="javascript:next();" >next</a>
        <span id="pageDropdown" name="pageDropdown">{page_dropdown}</span>
    </div>
</div>