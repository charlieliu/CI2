<div id="body">
    <p>{current_page}/{current_fun}</p>

    {grid_view}

    <div class="content_block">
        <form class="redis_test" >
            <input type="hidden" name="redis_act" value="MULTI">
            <input type="hidden" name="{csrf_name}" value="{csrf_value}">
            <input type="submit" value="MULTI TEST">
        </form>
    </div>

    <script type="text/javascript" src="{base_url}redis_test/get_url/redis_get"></script>
</div>