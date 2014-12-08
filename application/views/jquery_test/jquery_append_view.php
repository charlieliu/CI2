<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div id="test_div" class="test">
        <div>test div</div>
    </div>

    <style type="text/css">
        div.test {
            border:2px solid #bbb;
            background-color:#eee;
            padding:10px;
            margin:10px auto;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#test_div')
                .append('<div class="test">1. Append</div>')
                .prepend('<div class="test">2. Prepend</div>')
                .before('<div class="test">3. Before</div>')
                .after('<div class="test">4. After</div>');
        });
    </script>
</div>