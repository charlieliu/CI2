<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Autocomplete</a></li>
            <li><a href="#tabs-2">Datepicker</a></li>
            <li><a href="#tabs-3">Spinner</a></li>
        </ul>
        <div id="tabs-1">
            <h3>Autocomplete</h3>
            <div class="ui-widget">
                <label for="tags">label:
                    <input type="text" id="tags">
                </label>
            </div>
        </div>
        <div id="tabs-2">
            <h3>Datepicker</h3>
            <p>Date: <input type="text" id="datepicker"></p>
        </div>
        <div id="tabs-3">
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
        </div>
    </div>
</div>