<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div style="margin:1em;">
        <div id="show_info"></div>
        <script type="text/javascript">
            $(document).ready(function(){
                var arr = ['1','2','3'], str = '';

                function show_arr(){
                    str += 'var arr = [';
                    var num = 0;
                    for(var n in arr){
                        if( num!=0 ) str += ',';
                        str += '\''+arr[n]+'\'';
                        num++;
                    }
                    str += '];<br>';
                }

                show_arr();
                str += '<br>// push 從後面添加新元素 回傳元素個數<br>';
                str += 'arr.push(\'push\') === '+arr.push('push')+'<br>';
                show_arr();
                str += 'arr.push(\'push\') === '+arr.push('push')+'<br>';
                show_arr();
                str += '<br>// pop 從後面拿掉元素 回傳拿掉元素<br>';
                str += 'arr.pop() === '+arr.pop()+'<br>';
                show_arr();
                str += 'arr.pop() === '+arr.pop()+'<br>';
                show_arr();
                str += '<br>// unshift 從前面添加新元素 回傳元素個數<br>';
                str += 'arr.unshift(\'unshift\') === '+arr.unshift('unshift')+'<br>';
                show_arr();
                str += 'arr.unshift(\'unshift\') === '+arr.unshift('unshift')+'<br>';
                show_arr();
                str += '<br>// shift 從前面拿掉元素 回傳拿掉元素<br>';
                str += 'arr.shift() === '+arr.shift()+'<br>';
                show_arr();
                str += 'arr.shift() === '+arr.shift()+'<br>';
                show_arr();

                $('#show_info').html(str);
            });
        </script>
    </div>
</div>