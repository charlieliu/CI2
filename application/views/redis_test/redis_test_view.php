<div id="body">
    <p>{current_page}/{current_fun}</p>

    {grid_view}

    <div class="content_block">
        <p>MULTI</p>
        <ol>
            <li>MULTI</li>
            <li>SADD user:1:following 2</li>
            <li>SADD user:2:followers 1</li>
            <li>EXEC</li>
        </ol>
        <form class="redis_test" >
            <input type="hidden" name="redis_act" value="MULTI">
            <input type="hidden" name="{csrf_name}" value="{csrf_value}">
            <input type="submit" value="MULTI TEST">
        </form>
    </div>

    <div id="redis_log">{redis_log}</div>

    <script type="text/javascript" src="{base_url}redis_test/get_url/redis_get"></script>
</div>