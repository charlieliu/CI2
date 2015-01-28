<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div>
        <h3>
            call([thisObj[, arg1[, arg2[,  [, argN]]]]])<br>
            apply( thisArg, argArray );
        </h3>
        <div style="color:blue;">
            thisObj 選擇項。 為目前的使用物件。<br>
            arg1, arg2, , argN 選擇項。 要傳遞給方法的引數清單。<br>
            call 方法是用來代替另一個物件呼叫方法。 此方法可讓您將函式的 this 物件從原始內容變成由 thisObj 所指定的新物件。<br>
            如果未提供 thisObj 的話，將使用 global 物件做為 thisObj。<br>
        </div>
        <div style="color:red;">
            call()與apply()用途相同，唯一的差別在於，call()必須一一明列出參數，例如funcName.call(thisArg, arg1, arg2, ...)。
            apply()第二個參數必須是個Array，否則會產生參數型態錯誤的Error
        </dvi>
    </div>

    <!--<a id="link" href="<?=base_url()?>js_test/jquery_test/5">call / apply</a>-->
    <div class="content_block">
        <h3>3 functions call / apply</h3>
        <div>
            function TestApply1(){
                alert(this.attr('href'));
            };
        </div>
        <div>
            <button id="TestApply1" style="margin:1em;">TestApply1.apply($('#link'));</button>
            <button id="TestCall1" style="margin:1em;">TestApply1.call($('#link'));</button>
        </div>
        <div>
            function TestApply2(){
                alert(this.pig);
            };
        </div>
        <div>
            <button id="TestApply2" style="margin:1em;">TestApply2.apply(window);</button>
            <button id="TestCall2" style="margin:1em;">TestApply2.call(window);</button>
        </div>
        <div>
            function TestApply3(arg1, arg2){
                alert(this.myName+' '+arg1+' '+arg2);
            };
        </div>
        <div>
            <button id="TestApply3" style="margin:1em;">TestApply3.apply(new obj(), ['是個', '好地方']);</button>
            <button id="TestCall3" style="margin:1em;">TestApply3.call(new obj(), ['是個', '好地方']);</button>
        </div>
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
                alert(this.myName+' '+arg1+' '+arg2);
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

    <div class="content_block">
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
    </div>
    <script type="text/javascript">
        $(function(){
            //彈出按鈕的value，並判斷如果有參數的話彈出參數值。
            function AlertValue(){
                var str = '';
                str += 'this.value('+typeof(this.value)+')'+this.value+'\n';
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

    <div class="content_block">
        <h3>object call / apply</h3>
        <div class="showobj_info" style="color:green;"></div>
        <div>
            <div>
                function Animal(){
                    this.name = 'Animal';
                    this.category = 'Creature';
                    this.showName = function(){showobj(this)};
                    this.setName = function(str){this.name=str;};
                };<br>
                var animal = new Animal();
            </div>
            <button id="Animal" style="margin:1em;">animal.showName();</button>
            <button id="showobj" style="margin:1em;">showobj('');</button>
        </div>
        <div>
            <div>
                // Cat不繼承Animal<br>
                function Cat(){
                    this.name = 'Cat';
                };<br>
            </div>
            <button id="Cat_call" style="margin:1em;">animal.showName.call(cat);</button>
            <button id="Cat_apply" style="margin:1em;">animal.showName.apply(cat);</button>
            <button id="showobj_cat" style="margin:1em;">showobj(cat);</button>
        </div>
        <div>
            <div>
                // Dog繼承Animal<br>
                function Dog_call(){
                    <span style="color:green;">Animal.call(this);</span>
                    <span style="color:blue;">this.setName('Dog');</span>
                };<br>
                Dog_call.prototype = { <span style="color:blue;">prototype_parent : 'Animal'</span> };<br>
                var dog_call = new Dog_call();<br>
                <br>
                function Dog_apply(){
                    <span style="color:green;">Animal.apply(this);</span>
                    <span style="color:blue;">this.setName('Dog');</span>
                };<br>
                Dog_apply.prototype = { <span style="color:blue;">prototype_parent : 'Animal'</span> };<br>
                var dog_apply = new Dog_apply();<br>
            </div>
            <button id="Dog_call" style="margin:1em;">dog_call.showName();</button>
            <button id="Dog_apply" style="margin:1em;">dog_apply.showName();</button>
        </div>
    </div>

    <div class="content_block">
        <h3>繼承延伸測試</h3>
        <div style="overflow:auto;" >
            <table border='1' style="min-width:1420px;width:100%;">
                <thead>
                    <tr>
                        <th></th>
                        <th>animal</th>
                        <th>birds</th>
                        <th>duck</th>
                        <th>ostrich</th>
                        <th>chicken</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>繼承</td>
                        <td>無</td>
                        <td>Birds繼承Animal</td>
                        <td>Duck繼承Birds</td>
                        <td>Ostrich繼承Birds</td>
                        <td>Chicken繼承Birds</td>
                    </tr>
                    <tr>
                        <td>code</td>
                        <td>
                            function Animal(){<br>
                            &nbsp;&nbsp;this.name = 'Animal';<br>
                            &nbsp;&nbsp;this.category = 'Creature';<br>
                            &nbsp;&nbsp;this.showName = function(){showobj(this)};<br>
                            &nbsp;&nbsp;this.setName = function(str){this.name=str;};<br>
                            };<br>
                            <br>
                            var animal = new Animal();<br>
                        </td>
                        <td>
                            function Birds(){<br>
                            &nbsp;&nbsp;<span style="color:red;">this.name = 'Birds';</span><br>
                            &nbsp;&nbsp;Animal.call(this);<br>
                            };<br>
                            <br>
                            Birds.prototype = {<br>
                            &nbsp;&nbsp;<span style="color:red;">name : 'Birds',</span><br>
                            &nbsp;&nbsp;<span style="color:blue;">skills : 'fly'</span><br>
                            };<br>
                            <br>
                            var birds = new Birds;<br>
                        </td>
                        <td>
                            function Duck(){<br>
                            &nbsp;&nbsp;Birds.call(this);<br>
                            &nbsp;&nbsp;this.setName('Duck');<br>
                            };<br>
                            <br>
                            var duck = new Duck;<br>
                        </td>
                        <td>
                            function Ostrich(){<br>
                            &nbsp;&nbsp;Birds.call(this);<br>
                            &nbsp;&nbsp;<span style="color:blue;">this.setName('Ostrich');</span><br>
                            &nbsp;&nbsp;<span style="color:blue;">this.skills = 'run';</span><br>
                            };<br>
                            <br>
                            var ostrich = new Ostrich;<br>
                        </td>
                        <td>
                            function Chicken(){<br>
                            &nbsp;&nbsp;Birds.call(this);<br>
                            &nbsp;&nbsp;<span style="color:blue;">this.name = 'Chicken';</span><br>
                            };<br>
                            <br>
                            Chicken.prototype = {<br>
                            &nbsp;&nbsp;<span style="color:blue;">skills : 'run',</span><br>
                            };<br>
                            <br>
                            var chicken = new Chicken;<br>
                        </td>
                    </tr>
                    <tr style="color:red;">
                        <td>錯誤</td>
                        <td></td>
                        <td>
                            Birds.name 被 Animal.mane 覆蓋<br>
                            Birds.prototype.name 未作用
                        </td>
                        <td>Birds.prototype.skills 未繼承到 Duck</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr style="color:blue;">
                        <td>注意</td>
                        <td>
                            this.name = this.name || 'Animal';<br>
                            可修正 this.name覆蓋問題
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Chicken.prototype.skills 需再綁定一次</td>
                    </tr>
                    <tr style="color:green;">
                        <td>output</td>
                        <td id="animal"></td>
                        <td id="birds"></td>
                        <td id="duck"></td>
                        <td id="ostrich"></td>
                        <td id="chicken"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {

            function showobj(obj){
                var str = '';
                str += '{ name : ' + obj.name + ' }<br>' ;
                str += '{ category : ' + obj.category + ' }<br>' ;
                str += '{ showName : ' + obj.showName + ' }<br>' ;
                str += '{ setName : ' + obj.setName + ' }<br>' ;
                str += '{ prototype_parent : ' + obj.prototype_parent + ' }<br>' ;
                str += '{ skills : ' + obj.skills + ' }<br>' ;
                $('.showobj_info').html(str);
            };
            $('#showobj').click(function(){
                showobj('');
            });
            showobj('');

            function return_info(obj){
                var str = '';
                str += 'name : ' + obj.name + '<br>' ;
                str += 'category : ' + obj.category + '<br>' ;
                str += 'showName : ' + obj.showName + '<br>' ;
                str += 'setName : ' + obj.setName + '<br>' ;
                str += 'skills : ' + obj.skills + '<br>' ;
                return str;
            };

            function Animal(){
                this.name = 'Animal';
                // this.name = this.name || 'Animal';
                this.category = 'Creature';
                this.showName = function(){showobj(this);};
                this.setName = function(str){this.name=str;};
            };
            var animal = new Animal();

            $('#Animal').click(function(){
                animal.showName();
            });

            // 不繼承
            function Cat(){
                this.name = 'Cat';
            };
            var cat = new Cat();
            $('#Cat_call').click(function(){
                animal.showName.call(cat);
            });
            $('#Cat_apply').click(function(){
                animal.showName.apply(cat);
            });
            $('#showobj_cat').click(function(){
                showobj(cat);
            });

            // 繼承
            function Dog_call(){
                Animal.call(this);
                this.setName('Dog');
            };
            Dog_call.prototype = { prototype_parent : 'Animal' };
            var dog_call = new Dog_call();

            function Dog_apply(){
                Animal.apply(this);
                this.setName('Dog');
            };
            Dog_apply.prototype = { prototype_parent : 'Animal' };
            var dog_apply = new Dog_apply();

            $('#Dog_call').click(function(){
                dog_call.showName();
            });
            $('#Dog_apply').click(function(){
                dog_apply.showName();
            });

            // 繼承
            function Birds(){
                this.name = 'Birds';
                Animal.call(this);
            };
            Birds.prototype = {
                name : 'Birds',
                skills : 'fly'
            };
            var birds = new Birds;

            function Duck(){
                Birds.call(this);
                this.setName('Duck');
            };
            var duck = new Duck;


            function Ostrich(){
                Birds.call(this);
                this.setName('Ostrich');
                this.skills = 'run';
            };
            var ostrich = new Ostrich;

            function Chicken(){
                Birds.call(this);
                this.name = 'Chicken';
            };
            Chicken.prototype = {
                skills : 'run',
            };
            var chicken = new Chicken;

            function show_return_info(){
                $('#animal').html(return_info(animal));
                $('#birds').html(return_info(birds));
                $('#duck').html(return_info(duck));
                $('#ostrich').html(return_info(ostrich));
                $('#chicken').html(return_info(chicken));
            }
            show_return_info();

        });
    </script>

    <div class="content_block">
        <h3>Array.prototype.slice.call(arguments)</h3>
        <div>
            arguments : 可用來取得function傳入的實際變數Array。這個變數特別適合用在撰寫”多形”(Polymorphism)函式上，即可以根據不同的傳入參數做不同的處理。<br>
            P.S. arguments, caller, callee, this都是用在函式(function)內的特殊內定物件。而apply()及call()則是用來呼叫函式的不同作法。<br>
            <br>
            function list(){<br>
            &nbsp;&nbsp;&nbsp;&nbsp;var show_str = '';<br>
            &nbsp;&nbsp;&nbsp;&nbsp;show_str += ......<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;$('#list_info').css("background", "#C8C8C8").html(show_str);<br>
            }<br>
            <br>
            var list1 = list(1, 2, 3);<br>
            var leadingZeroList = list.bind(undefined, 37);<br>
            var list2 = leadingZeroList();<br>
            var list3 = leadingZeroList('X', 'Y', 'Z');<br>
        </div>
        <div id="list_info"></div>
    </div>
    <script type="text/javascript">
        function list(){
            var row = $('<tr></tr>').append($('<td></td>').html(''))
                                    .append($('<td></td>').html('typeof'))
                                    .append($('<td></td>').html('length'))
                                    .append($('<td></td>').html('object'));
            var table = $('<table border="1"></table>').css('margin','1em').append(row) ;
            function str_maker(tag,title){
                row = $('<tr></tr>').append($('<td></td>').html(title))
                                    .append($('<td></td>').html(typeof(tag)))
                                    .append($('<td></td>').html(tag.length))
                                    .append('<td>'+tag+'</td>');// $('<td></td>').html(tag)會有問題tag是object;
                table.append(row);
            }
            str_maker(arguments,'arguments');
            str_maker(Array.prototype.slice.call(arguments),'Array.prototype.slice.call(arguments)');
            str_maker(Array.prototype.slice.call(arguments, 0, 2),'Array.prototype.slice.call(arguments, 0, 2)');
            str_maker(Array.prototype.slice.call(arguments, 1),'Array.prototype.slice.call(arguments, 1)');
            str_maker(Array.prototype.slice.call(arguments, 2),'Array.prototype.slice.call(arguments, 2)');
            $('#list_info').append(table);
        }

        var list1 = list(1, 2, 3);

        //  Create a function with a preset leading argument
        var leadingZeroList = list.bind(undefined, 37);

        var list2 = leadingZeroList();
        var list3 = leadingZeroList('X', 'Y', 'Z');
    </script>

</div>