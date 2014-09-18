<div id="body">
    <p>{current_page}/{current_fun}</p>

    <form method="POST">
        <input type="text" name="hash_str" value="{hash_str}">
        <input type="submit" value="查詢">
    </form>

    <!-- Variable Pairs -->
    {content}
    <div class="content_block">
        <b>{content_title} : </b>
        <div>{content_value}</div>
    </div>
    {/content}
    <!-- Variable Pairs -->
</div>