<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div class="content_block mg1em padding1em">
        &lt;input list="browsers" name="browser"&gt;<br>
        &lt;datalist id="browsers"&gt;<br>
        {space_4}&lt;option value="Internet Explorer"&gt;<br>
        {space_4}&lt;option value="Firefox"&gt;<br>
        {space_4}&lt;option value="Chrome"&gt;<br>
        {space_4}&lt;option value="Opera"&gt;<br>
        {space_4}&lt;option value="Safari"&gt;<br>
        &lt;/datalist&gt;<br>
        &lt;input type="submit"&gt;<br>
        <form id="contact1">
            <input list="browsers" name="browser">
            <datalist id="browsers">
                <option value="Internet Explorer">
                <option value="Firefox">
                <option value="Chrome">
                <option value="Opera">
                <option value="Safari">
            </datalist>
            <input type="submit">
        </form>

        <p><strong>Note:</strong> The datalist tag is not supported in Internet Explorer 9 and earlier versions, or in Safari.</p>
    </div>

    <div id="results" class="mg1em"></div>

</div>