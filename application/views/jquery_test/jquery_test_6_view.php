<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div>
        <ul id="menu" class="ul_1">
            <li class="li_1">level 1</li>
            <li class="li_1">
                <ul class="ul_2">
                    <li class="li_2">level 2</li>
                </ul>
            </li>
             <li class="li_1">
                <ul class="ul_2">
                    <li class="li_2">
                        <ul class="ul_3">
                            <li class="li_3">level 3</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="li_1">
                <ul class="ul_2">
                    <li class="li_2">level 2</li>
                    <li class="li_2">
                        <ul class="ul_3">
                            <li>level 3</li>
                            <li>javascript : <label><input type="checkbox" id="parent">$(this).parent("label").parent("li").parent("ul").css("background", "yellow");</label></li>
                            <li>level 3</li>
                        </ul>
                    </li>
                    <li class="li_2">level 2</li>
                    <li class="li_2">
                        <ul class="ul_3">
                            <li class="li_3">level 3</li>
                            <li class="li_3">javascript : <label><input type="checkbox" id="parents">$(this).parents("ul").css("background", "blue");</label></li>
                            <li class="li_3">level 3</li>
                        </ul>
                    </li>
                    <li class="li_2">
                        <ul class="ul_3">
                            <li class="li_3">level 3</li>
                            <li class="li_3">javascript : <label><input type="checkbox" id="closest">$(this).closest("ul").css("background", "red");</label></li>
                            <li class="li_3">level 3</li>
                        </ul>
                    </li>
                    <li class="li_2">level 2</li>
                    <li class="li_2">javascript : <label><input type="checkbox" id="parents2">$(this).parents("ul").css("background", "green");</label></li>
                    <li class="li_2">level 2</li>
                </ul>
            </li>
        </ul>
    </div>

    <div id="showobj_info"></div>

    <script type="text/javascript">

        function showobj(obj){
            var str = '';
            for(var n in obj)
            {
                if( obj.n!=undefined )
                    str += '{' + n + ':' + obj.n + '}<br>' ;
            }
            $('#showobj_info').html(str);
        }

        $("#parent").change(function(){
            var tag = $(this).parent("label").parent("li").parent("ul");
            tag.addClass('parent');
            showobj(tag);
            if( $(this).prop('checked') )
               tag.css("background", "yellow");
            else
                tag.css("background", "white");
        });
        $("#parents").click(function(){
            var tag = $(this).parents("ul");
            tag.addClass('parents');
            showobj(tag);
            if( $(this).prop('checked') )
                tag.css("background", "blue");
            else
                tag.css("background", "white");
        });
        $("#parents2").click(function(){
            var tag = $(this).parents("ul");
            tag.addClass('parents2');
            showobj(tag);
            if( $(this).prop('checked') )
                tag.css("background", "green");
            else
                tag.css("background", "white");
        });
        $("#closest").click(function(){
            var tag = $(this).closest("ul");
            tag.addClass('closest');
            showobj(tag);
            if( $(this).prop('checked') )
               tag.css("background", "red");
            else
                tag.css("background", "white");
        });
    </script>
</div>