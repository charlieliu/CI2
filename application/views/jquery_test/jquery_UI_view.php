<div id="body">
    <p>{current_page}/{current_fun}</p>

    <h3>Autocomplete</h3>
    <div class="ui-widget">
        <label for="tags">label:
            <input type="text" id="tags">
        </label>
    </div>

    <h3>Datepicker</h3>
    <p>Date: <input type="text" id="datepicker"></p>

    <h3>Spinner</h3>
    <p>
        <label for="spinner">Select a value:
            <input id="spinner" name="value">
        </label>
    </p>
    <p>
        <button id="disable">Toggle disable/enable</button>
        <button id="destroy">Toggle widget</button>
        <button id="getvalue">Get value</button>
        <button id="setvalue">Set value to 5</button>
    </p>

    <script type="text/javascript">
        $(function() {
            var availableTags = [
                { label: "ActionScript", value: "1" },
                { label: "AppleScript", value: "2" },
                { label: "Asp", value: "3" },
                { label: "BASIC", value: "4" },
                { label: "C", value: "5" },
                { label: "C++", value: "6" },
                { label: "Clojure", value: "7" },
                { label: "COBOL", value: "8" },
                { label: "ColdFusion", value: "9" },
                { label: "Erlang", value: "10" },
                { label: "Fortran", value: "11" },
                { label: "Groovy", value: "12" },
                { label: "Haskell", value: "13" },
                { label: "Java", value: "14" },
                { label: "JavaScript", value: "15" },
                { label: "Lisp", value: "16" },
                { label: "Perl", value: "17" },
                { label: "PHP", value: "18" },
                { label: "Python", value: "19" },
                { label: "Ruby", value: "20" },
                { label: "Scala", value: "21" },
                { label: "Scheme", value: "22" }
            ];
            $('#tags').autocomplete({
                source:availableTags,
                select:function( event, ui ){
                    $(this).val(ui.item.label);
                    $('#spinner').val(ui.item.value);
                    return false;
                },
                focus:function( event, ui ) {
                    $(this).val(ui.item.label);
                    $('#spinner').val(ui.item.value);
                    return false;
                },
                response: function( event, ui ) {
                    $('#spinner').val('');
                    return false;
                },
                minLength:1,
                catche:false
            });

            $('#datepicker').datepicker({
                dateFormat: "yy/mm/dd"
            });

            $('#spinner').spinner({
                max:22,
                min:1,
                change: function( event, ui ){
                    if( availableTags[$(this).spinner("value")-1]!=undefined )
                        $('#tags').val(availableTags[$(this).spinner('value')-1].label);
                    else
                        $('#tags').val('');
                },
                stop: function( event, ui ) {
                    if( availableTags[$(this).spinner('value')-1]!=undefined )
                        $('#tags').val(availableTags[$(this).spinner('value')-1].label);
                    else
                        $('#tags').val('');
                }
            });

            $('#disable').click(function() {
                if( $('#spinner').spinner("option", "disabled") )
                    $('#spinner').spinner("enable");
                else
                    $('#spinner').spinner("disable");
            }).button({
                icons: { primary: "ui-icon-alert", secondary: null }
            });

            $('#destroy').click(function(){
                if( $('#spinner').spinner("instance") )
                {
                    $('#spinner').spinner("destroy");
                    $('#getvalue').prop('disabled',true);
                    $('#setvalue').prop('disabled',true);
                    $('#disable').prop('disabled',true);
                }
                else
                {
                    $('#spinner').spinner({
                        max:22,
                        min:1,
                        change: function( event, ui ){
                            if( availableTags[$(this).spinner("value")-1]!=undefined )
                                $('#tags').val(availableTags[$(this).spinner('value')-1].label);
                            else
                                $('#tags').val('');
                        },
                        stop: function( event, ui ) {
                            if( availableTags[$(this).spinner('value')-1]!=undefined )
                                $('#tags').val(availableTags[$(this).spinner('value')-1].label);
                            else
                                $('#tags').val('');
                        }
                    });
                    $('#getvalue').prop('disabled',false);
                    $('#setvalue').prop('disabled',false);
                    $('#disable').prop('disabled',false);
                }
            }).button({
                icons: { primary: "ui-icon-circle-minus", secondary: null }
            });

            $('#getvalue').click(function(){
                alert( $('#spinner').spinner("value") );
            }).button({
                icons: { primary: "ui-icon-comment", secondary: null }
            });

            $('#setvalue').click(function(){
                $('#spinner').spinner("value", 5);
            }).button({
                icons: { primary: "ui-icon-wrench", secondary: null }
            });
        });
    </script>
</div>