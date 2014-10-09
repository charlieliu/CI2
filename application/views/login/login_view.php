<div id="body">
    <p>{current_page}/{current_fun}</p>

    <form id="frm1" action="{base_url}login/{btn_url}" method="POST">
        <div>
            帳號 : <input type="text" id="username" name="username" placeholder="username">
        </div>
        <div>
            密碼 : <input type="password" id="pwd" name="pwd" placeholder="pwd">
        </div>
        <input id="btn_submit" class="btn btn-primary" type="submit" value="{btn_value}">
        <a class="btn btn-warning" href="{base_url}login/register">Create an new account</a>
    </form>
</div>
<script type="text/javascript">
    <!--
    $('#btn_submit').click(function(event){
        if( event.preventDefault() ) event.preventDefault(); else event.returnValue = false;
        if( $.trim($('#username').val())=='' ){
            alert('name is empty');
            $('#username').focus();
        }
        else if( !/^[\u4e00-\u9fa5|\w|\.|\-]*$/.test($('#username').val()) )
        {
            alert('name 限用中英文數字_.-');
            $('#username').focus();
        }
        else if( $.trim($('#pwd').val())=='' ){
            alert('pwd is empty');
            $('#pwd').focus();
        }
        else
        {
            $.post(
                "{base_url}login/{btn_url}",
                {
                    "username":$('#username').val(),
                    "pwd":$('#pwd').val(),
                    "repwd":$('#repwd').val(),
                    "email":$('#email').val(),
                    "addr":$('#addr').val()
                },
                function(response){
                    if(response.status!='100')
                    {
                        alert(response.status);
                    }
                    else
                    {
                        alert(response.status);
                    }
                },
                "json"
            );
        }
    });
    -->
</script>