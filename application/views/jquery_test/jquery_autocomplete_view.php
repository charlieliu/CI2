<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div class="ui-widget">
        <label for="tags">label:
            <input type="text" id="tags">
        </label>

        <label for="tags">value:
            <input type="text" id="tags_val" readonly>
        </label>
    </div>

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
            $( "#tags" ).autocomplete({
                source:availableTags,
                select:function( event, ui ){
                    $(this).val(ui.item.label);
                    $('#tags_val').val(ui.item.value);
                    return false;
                },
                focus:function( event, ui ) {
                    $(this).val(ui.item.label);
                    $('#tags_val').val(ui.item.value);
                    return false;
                },
                response: function( event, ui ) {
                    $('#tags_val').val('');
                    return false;
                },
                minLength:1,
                catche:false
            });
        });
    </script>
</div>