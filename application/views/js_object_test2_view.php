<div id="body">
    <p>{current_page}/{current_fun}</p>
    <style type="text/css">
        .my-class{background-color: #CCC;}
    </style>
    <div>
        <ul>
            <li>1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
        </ul>
        <span class="more">more</span>
    </div>
    <script type="text/javascript">
    $('.more').click(function(){
        $(this).parents('div').find('ul').addClass('my-class');
    });
    </script>
</div>