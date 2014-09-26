<div id="body">
    <p>{current_page}/{current_fun}</p>

    <input id="fileupload" type="file">
    <div>File Size:<span id="filesize">0kb</span></div>
    <div id="err_msg"></div>
</div>

<script type="text/javascript">
    <!--
    if( $.support.leadingWhitespace )
    {
        $('#fileupload').change(function(){
            if( this.files[0]!=null && 'number'==typeof(this.files[0].size))
            {
                var filesize;
                if( this.files[0].size<1024 )
                {
                    filesize = this.files[0].size+' bytes';
                }
                else if( this.files[0].size<(1024*1024) )
                {
                    filesize = (this.files[0].size/1024).toFixed(2)+' kb';
                }
                else if( this.files[0].size<(1024*1024*1024) )
                {
                    filesize = (this.files[0].size/(1024*1024)).toFixed(2)+' MB';
                }
                else
                {
                    filesize = (this.files[0].size/(1024*1024*1024)).toFixed(2)+' GB';
                }
            }
            else
            {
                filesize = '0kb';
            }
            $('#filesize').html(filesize);
            filesize = null;// 釋放IE記憶體
        });
    }
    else
    {
        var fileobj = ['Browser do not support'], v, count=0;
        /*
        for(var n in this )
        {
            v = $('#filesize').n;
            fileobj.push('{" '+n+'" : "'+v+'"}');
            count++;
        }
        */
        $('#err_msg').html(fileobj.join('<br>'));
        fileobj = null;// 釋放IE記憶體
    }
    -->
</script>