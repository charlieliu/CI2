<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div class="mg1em">
        測試日期&nbsp;:&nbsp;{test_date}
        <form method="POST" id="contact1">

            {grid_view}

            <div class="mg1em" style="height:100px;">
                <div class="mg1em float_left" style="width:100px;">range&nbsp;(<span id="range_value">null</span>)</div>
                <div class="mg1em float_left" style="text-align:center;">
                    <table border="1">
                        <tr><th>Chrome</th><th>Firefox</th><th>Safari</th><th>IE11</th><th>Opera</th></tr>
                        <tr><td>O</td><td>O</td><td>O</td><td>O</td><td>O</td></tr>
                    </table>
                </div>
                <div class="mg1em float_left">
                    <input type="range" name="range" id="range" min="0" max="100" step="5" required><br>
                    &lt;input type="range" name="range" id="range" min="0" max="100" step="5" required&gt;
                </div>
            </div>

            <div class="mg1em" style="height:100px;">
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
</div>