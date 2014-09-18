<div id="body">
    <p>{current_page}/{current_fun}</p>

    <form method="POST">
        <input type="text" name="hash_str" value="{hash_str}">
        <input type="submit" value="查詢">
    </form>

    <!-- Variable Pairs -->
    <table id="table-transform" data-toolbar="#transform-buttons">
        <thead>
            <tr>
                <th>加密方式</th>
                <th>編碼</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>原文</td>
                <td>{hash_str}</td>
            </tr>
            {content}
            <tr>
                <td>{content_title}</td>
                <td>{content_value}</td>
            </tr>
            {/content}
        </tbody>
    </table>
    <!-- Variable Pairs -->
</div>