<div id="body">
    <p>{current_page}/{current_fun}</p>

    <form method="POST">
        <input type="text" name="str" value="{str}">
        <input type="submit" value="查詢">
    </form>

    <!-- Variable Pairs -->
    <table id="table-transform" data-toolbar="#transform-buttons" border="1" style="margin:1em;">
        <thead>
            <tr>
                <th>說明</th>
                <th>正規表達式</th>
                <th>測試結果</th>
                <th>正規表達式</th>
                <th>測試結果</th>
            </tr>
        </thead>
        <tbody>
            {content}
            <tr>
                <td>{content_name}</td>
                <td>{content_title}</td>
                <td>{content_value}</td>
                <td>{content_title2}</td>
                <td>{content_value2}</td>
            </tr>
            {/content}
        </tbody>
    </table>
    <!-- Variable Pairs -->
</div>