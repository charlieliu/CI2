<div id="body">
    <p>{current_page}/{current_fun}</p>

    <form id="frm1" action="{base_url}login/{btn_url}" method="POST">
        <div>
            帳號&nbsp;:&nbsp;<input type="text" id="username" name="username" placeholder="username">
        </div>
        <div>
            密碼&nbsp;:&nbsp;<input type="password" id="pwd" name="pwd" placeholder="pwd">
        </div>
        <input id="btn_submit" class="btn btn-primary" type="submit" value="{btn_value}">
        <a class="btn btn-warning" href="{base_url}login/register">Create an new account</a>
    </form>
</div>