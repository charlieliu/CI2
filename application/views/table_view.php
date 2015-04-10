<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div class="content_block" style="overflow-x:scroll;width:100%;">
        <table class="mg1em" border="1" style="text-align:center;">
            <tr>
                <?php foreach ($th as $value): ?><th><?=$value?></th><?php endforeach; ?>
            </tr>
            {table_grid_view}
        </table>
    </div>

    <div class="content_block">
        <a class="prev-page btn disable" href="javascript:prev();" >prev</a>
        <span class="current-page" id="pageNow" name="pageNow">{page}</span>/<span class="current-page" id="pageCnt" name="pageCnt">{pagecnt}</span>
        <a class="next-page btn disable" href="javascript:next();" >next</a>
        <span id="pageDropdown" name="pageDropdown">{page_dropdown}</span>
    </div>

    <form id="frm1" method="post"></form>
</div>