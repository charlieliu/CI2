<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div style="margin:1em;">
    <h3>call([thisObj[, arg1[, arg2[,  [, argN]]]]])</h3>
        <div style="color:blue;">
            thisObj 選擇項。 為目前的使用物件。<br>
            arg1, arg2, , argN 選擇項。 要傳遞給方法的引數清單。<br>
            call 方法是用來代替另一個物件呼叫方法。 此方法可讓您將函式的 this 物件從原始內容變成由 thisObj 所指定的新物件。<br>
            如果未提供 thisObj 的話，將使用 global 物件做為 thisObj。<br>
        </div>
        <div style="color:red;">
            call()與apply()用途相同，唯一的差別在於，call()必須一一明列出參數，例如funcName.call(thisArg, arg1, arg2, ...)。
        </dvi>
    </div>

    <!--<a id="link" href="<?=base_url()?>js_test/jquery_test/5">call / apply</a>-->
    <div style="margin:1em;">
        <h3>3 functions call / apply</h3>
        <div>
            function TestApply1(){
                alert(this.attr('href'));
            };
        </div>
        <div>
            <button id="TestApply1" style="margin:1em;">TestApply1</button>
            <button id="TestCall1" style="margin:1em;">TestCall1</button>
        </div>
        <div>
            function TestApply2(){
                alert(this.pig);
            };
        </div>
        <div>
            <button id="TestApply2" style="margin:1em;">TestApply2</button>
            <button id="TestCall2" style="margin:1em;">TestCall2</button>
        </div>
        <div>
            function TestApply3(arg1, arg2){
                alert(this.myName + arg1 + arg2);
            };
        </div>
        <div>
            <button id="TestApply3" style="margin:1em;">TestApply3</button>
            <button id="TestCall3" style="margin:1em;">TestCall3</button>
        </div>
        <script type="text/javascript">
            //定義一個全域變數pig
            var pig = "我是豬";
            $(function(){
                //範例1:丟進去一個jQuery物件，因此funciton裡面的this就代表jQuery物件。
                // 接著就可用jQuery.attr()叫出物件屬性
                function TestApply1(){
                    alert(this.attr('href'));
                };
                $("#TestApply1").click(function(){
                   TestApply1.apply($('#link'));
                });
                $("#TestCall1").click(function(){
                   TestApply1.call($('#link'));
                });
                //-----------------------------------------------------------

                //範例2:丟進去一個windows物件，因此function裡面的this代表window
                //  因為我增加了一個全域變數叫pig，所以用this.pig得到的值就是"我是豬"
                function TestApply2(){
                    alert(this.pig);
                };
                $("#TestApply2").click(function(){
                   TestApply2.apply(window);
                });
                $("#TestCall2").click(function(){
                   TestApply2.call(window);
                });
                // 結論：吃什麼拉什麼，丟進去什麼，裡面的this就是什麼
                //----------------------------------------------------------

                //範例3:順便介紹一下第二個參數的用法
                //  我新增了一個物件叫obj，他內含一個屬性叫myName
                //  當我new 一個 obj丟進去，this就代表obj這個物件，
                //  因此可以用this.myName點出obj的屬性。
                //  第二個參數傳一個陣列進去。
                //  TestApply3這個function有兩個參數，所以我丟進一個有兩個值的陣列進去。
                function obj() {this.myName = "部落";};
                function TestApply3(arg1, arg2){
                    alert(this.myName + arg1 + arg2);
                };
                $("#TestApply3").click(function(){
                    TestApply3.apply(new obj(), ['是個', '好地方']);
                });
                $("#TestCall3").click(function(){
                    TestApply3.call(new obj(), ['是個', '好地方']);
                });
                //----------------------------------------------------------
                /*
                $('#link').off('click').on('click',function(){
                    //alert($(this).attr('id'));
                    //$.TestApply1.apply($(this));
                    alert(window);
                });
                */
            });
        </script>
    </div>

    <div style="margin:1em;">
        <h3>a function call / apply</h3>
        <div>
            function AlertValue() {
                alert(this.value);
                if( arguments.length>0 )
                {
                    for (var i = 0; i < arguments.length; i++) {
                        if (typeof (arguments[i]) != "object") alert(arguments[i]);
                    }
                }
            };
        </div>
        <div><button id="A" style="margin:1em;">AlertValue</button></div>
        <div>
            <button id="B" style="margin:1em;">AlertValue.apply(this, ["1", "2", "3"]);</button>
            <button id="C" style="margin:1em;">AlertValue.call(this, ["1", "2", "3"]);</button>
        </div>
        <div>
            <button id="D" style="margin:1em;">AlertValue.apply(this);</button>
            <button id="E" style="margin:1em;">AlertValue.call(this);</button>
        </div>
        <div>
            <button id="F" style="margin:1em;">AlertValue.apply({value:'0'});</button>
            <button id="G" style="margin:1em;">AlertValue.call({value:'0'});</button>
        </div>
        <script type="text/javascript">
            $(function(){
                //彈出按鈕的value，並判斷如果有參數的話彈出參數值。
                function AlertValue(){
                    var str = '';
                    //str += 'this.value('+typeof(this.value)+')'+this.value+'\n';
                    for(var n in this){
                        str += 'this.'+n+'('+typeof(this.n)+')'+this.n+'\n';
                    }
                    if( arguments.length>0 )
                    {
                        for (var i = 0; i < arguments.length; i++){
                            str += 'arguments['+i+']('+typeof(arguments[i])+')'+arguments[i]+'\n' ;
                        }
                    }
                    alert(str);
                };

                //當A按鈕click時，執行AlertValue這個function，跳出按鈕的value
                $("#A").click(AlertValue);

                //當B按鈕click時，一樣執行AlertValue，執行時function內部的this
                //會變成B按鈕，並且可用一個陣列傳入參數。
                $("#B").click(function(){
                    AlertValue.apply(this, ["1", "2", "3"]);
                });
                $("#C").click(function(){
                    AlertValue.call(this, ["1", "2", "3"]);
                });
                $("#D").click(function(){
                    AlertValue.apply(this);
                });
                $("#E").click(function(){
                    AlertValue.call(this);
                });
                $("#F").click(function(){
                    AlertValue.apply({value:'0'});
                });
                $("#G").click(function(){
                    AlertValue.call({value:'0'});
                });
            });

        </script>
    </div>

    <div style="margin:1em;">
        <h3>object call / apply</h3>
        <div><button id="Animal" style="margin:1em;">Animal</button></div>
        <div><button id="Cat_call" style="margin:1em;">Cat_call</button><button id="Cat_apply" style="margin:1em;">Cat_apply</button></div>
        <div><button id="Dog_call" style="margin:1em;">Dog_call</button><button id="Dog_apply" style="margin:1em;">Dog_apply</button></div>
        <div id="showobj_info"></div>
        <script type="text/javascript">
            $(function () {

                function showobj(obj){
                    var str = '';
                    str += '{ name : ' + obj.name + ' }<br>' ;
                    str += '{ showName : ' + obj.showName + ' }<br>' ;
                    str += '{ setName : ' + obj.setName + ' }<br>' ;
                    str += '{ prototype_parent : ' + obj.prototype_parent + ' }<br>' ;
                    $('#showobj_info').html(str);
                }
                showobj('');

                function Animal(){
                    this.name = 'Animal';
                    this.showName = function(){ showobj(this) };
                    this.setName = function(str){ this.name = str ; };
                }
                //Animal.prototype.name = 'Animal';
                //Animal.prototype.setName = function(str){ this.name = str ; };
                /*Animal.prototype = {
                    name : 'Animal',
                    setName : function(str){ this.name = str ; }
                };*/
                var animal = new Animal();

                $('#Animal').click(function(){
                    showobj(animal);
                    animal.showName();
                });

                // 不繼承
                function Cat(){
                    this.name = 'Cat';
                }
                var cat = new Cat();
                $('#Cat_call').click(function(){
                    showobj(cat);
                    animal.showName.call(cat);
                });
                $('#Cat_apply').click(function(){
                    showobj(cat);
                    animal.showName.apply(cat);
                });

                // 繼承
                function Dog_call(){
                    Animal.call(this);
                    //this.name = 'Dog';
                    //this.setName(this.name);
                    this.setName('Dog');
                }
                Dog_call.prototype = { prototype_parent : 'Animal' };
                var dog_call = new Dog_call();

                function Dog_apply(){
                    //this.name = 'Dog';
                    Animal.apply(this);
                    this.setName('Dog');
                }
                Dog_apply.prototype = { prototype_parent : 'Animal' };
                var dog_apply = new Dog_apply();
                //dog_apply.prototype = { name : 'Dog' };
                //dog_apply.name = 'Dog';

                $('#Dog_call').click(function(){
                    dog_call.showName();
                });
                $('#Dog_apply').click(function(){
                    dog_apply.showName();
                });

            });
        </script>
    </div>
</div>