<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div class="content_block mg1em padding1em">
        <form oninput="x.value=parseInt(a.value)+parseInt(b.value)">
            <table>
                <tr>
                    <td><input type="range" id="a" value="50"></td>
                    <td><input type="number" id="c" disabled>+<input type="number" id="b" value="50">=</td>
                    <td><output type="number" id="x" name="x" for="a b"></output></td>
                </tr>
            </table>
        </form>

        <form oninput="e.value=parseInt(d.value)">
            <table>
                <tr>
                    <td><input type="range" id="d" value="50"></td>
                    <td><output type="number" id="e" disabled></output></td>
                    <td>+<input type="number" id="f" value="50">=<input type="number" id="g" name="g"></td>
                </tr>
            </table>
        </form>

        <p><strong>Note:</strong> The output tag is not supported in Internet Explorer.</p>
    </div>

</div>