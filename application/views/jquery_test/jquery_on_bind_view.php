<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div class="test">test div on()</div>
    <span id="locl"></span>

    <div class="test2">test div bind()</div>
    <span id="locl2"></span>

    <style>
        .test { color: #000; padding: .5em; border: 1px solid #444; }
        .test2 { color: #000; padding: .5em; border: 1px solid #444; }
        .active { color: red; }
        .inside { background-color: aqua; }
    </style>

    <script type="text/javascript">
        $(function(){
            $('div.test').on({
                click: function(event){
                    $(this).toggleClass('active');
                    $('#locl').text( "( " + event.pageX + ", " + event.pageY + " )" );
                },
                mouseenter: function(){
                    $(this).addClass('inside');
                },
                mouseleave: function(){
                    $(this).removeClass('inside');
                }
            });
            $('div.test2').bind({
                click: function(event){
                    $(this).toggleClass('active');
                    $('#locl2').text( "( " + event.pageX + ", " + event.pageY + " )" );
                },
                mouseenter: function(){
                    $(this).addClass('inside');
                },
                mouseleave: function(){
                    $(this).removeClass('inside');
                }
            });
        });
    </script>
</div>