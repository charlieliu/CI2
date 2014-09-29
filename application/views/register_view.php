<div id="body">
    <p>{current_page}/{current_fun}</p>

    <form id="frm1" action="<?=base_url()?>login/{btn_url}" method="POST">
        <table>
            <tr>
                <th>帳號 : </th>
                <td><input type="text" id="username" name="username" placeholder="username"></td>
            </tr>
            <tr>
                <th>密碼 : </th>
                <td><input type="password" id="pwd" name="pwd" placeholder="pwd"></td>
            </tr>
            <tr>
                <th>確認密碼 : </th>
                <td><input type="password" id="repwd" name="repwd" placeholder="pwd"></td>
            </tr>
            <tr>
                <th>Enail : </th>
                <td><input type="text" id="email" name="email" placeholder="email"></td>
            </tr>
            <tr>
                <th>地址 : </th>
                <td><textarea id="addr" name="addr" placeholder="address"></textarea></td>
            </tr>
            <tr>
                <th></th>
                <td></td>
            </tr>
        </table>
        <input id="btn_submit" type="submit" value="{btn_value}">
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
        else if( $.trim($('#pwd').val())=='' ){
            alert('pwd is empty');
            $('#pwd').focus();
        }
        else if( $.trim($('#repwd').val())=='' ){
            alert('repwd is empty');
            $('#repwd').focus();
        }
        else if( $.trim($('#email').val())=='' ){
            alert('email is empty');
            $('#email').focus();
        }
        else if( $.trim($('#addr').val())=='' ){
            alert('addr is empty');
            $('#addr').focus();
        }
        else if( $('#pwd').val()!=$('#repwd').val() )
        {
            alert('pwd and repwd is different');
            $('#pwd').focus();
        }
        else
        {
            $('#frm1').submit();
        }
    });
    $('#addr').css('width',$('#email').css('width'));
    -->
</script>