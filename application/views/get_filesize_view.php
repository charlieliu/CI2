<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div style="margin:1em;">
        <input class="fileupload" type="file">
        <div>File Size:<span>0 bytes</span></div>
    </div>

    <div style="margin:1em;">
        <input class="fileupload" type="file">
        <div>File Size:<span>0 bytes</span></div>
    </div>

    <div style="margin:1em;">
        <input class="fileupload" type="file">
        <div>File Size:<span>0 bytes</span></div>
    </div>

    <div style="margin:1em;">
        <div>Total Size:<span id="totalsize">0 bytes</span></div>
    </div>
</div>

<script type="text/javascript">
    <!--
    if( $.support.leadingWhitespace )
    {
        function getFileSize(obj)
        {
            if( obj.files[0]!=null && 'number'==typeof(obj.files[0].size))
                return obj.files[0].size;
            else
                return 0;
        }
        function getFormate(bytes)
        {
            if( bytes<1024 )
            {
                return bytes + ' bytes';
            }
            else if( bytes<(1024*1024) )
            {
                return (bytes/1024).toFixed(2) + ' kb';
            }
            else if( bytes<(1024*1024*1024) )
            {
                return (bytes/(1024*1024)).toFixed(2) + ' MB';
            }
            else
            {
                return (bytes/(1024*1024*1024)).toFixed(2) + ' GB';
            }
        }
        function getTotalSize()
        {
            var totalsize = 0;
            $('.fileupload').each(function(){
                totalsize += getFileSize(this);
            });
            $('#totalsize').html(getFormate(totalsize));
        }
        $('.fileupload').change(function(){
            $(this).siblings('div').find('span').html(getFormate(getFileSize(this)));
            getTotalSize();
        });
    }
    else
    {
        /*
        var fileobj = ['Browser do not support'], v, count=0;
        for(var n in this )
        {
            v = $('#filesize').n;
            fileobj.push('{" '+n+'" : "'+v+'"}');
            count++;
        }
        $('#err_msg').html(fileobj.join('<br>'));
        fileobj = null;// 釋放IE記憶體
        */
        $(this).siblings('div').find('span').html('Browser do not support');
    }
    -->
</script>