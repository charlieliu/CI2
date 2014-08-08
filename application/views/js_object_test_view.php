<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div style="background-color:#CCC;">
        //最上層類別<br>
        function Grandfather() {<br>
        this.birthday = {<br>
            year: null,<br>
            month: null,<br>
            day: null<br>
        };<br>
        this.setBirthdayYear(1889);<br>
        }<br>
        <br>
        //屬性<br>
        Grandfather.prototype.birthday = {<br>
        year: null,<br>
        month: null,<br>
        day: null<br>
        };<br>

        //方法<br>
        Grandfather.prototype.setBirthdayYear = function (year)<br>
        {<br>
        this.birthday.year = year;<br>
        };<br>
        <br>
        //上層類別<br>
        function Father() {<br>
        Grandfather.call(this);<br>
        this.setBirthdayYear(1915);<br>
        }<br>
        <br>
        //Father繼承Grandfather<br>
        Father.prototype = new Grandfather();<br>
        <br>
        //子類別之一<br>
        function Son() {<br>
        Father.call(this);<br>
        this.setBirthdayYear(1943);<br>
        }<br>
        <br>
        //Son繼承Father<br>
        Son.prototype = new Father();<br>
        <br>
        //子類別之二<br>
        function Daughter() {<br>
        Father.call(this);<br>
        this.setBirthdayYear(1945);<br>
        }<br>
        <br>
        //Daughter繼承Father<br>
        Daughter.prototype = new Father();<br>
        <br>
        //輸出檢驗<br>
        var grandfather = new Grandfather();<br>
        var father = new Father();<br>
        var son = new Son();<br>
        var daughter = new Daughter();<br>
        <br>
    </div>
    <div>Grandfather : <span id="Grandfather"></span></div>
    <div>grandfather : <span id="grandfather"></span></div>
    <div>father : <span id="father"></span></div>
    <div>son : <span id="son"></span></div>
    <div>daughter : <span id="daughter"></span></div>
    <script type="text/javascript">
        //最上層類別
        function Grandfather() {
            this.birthday = {
                year: null,
                month: null,
                day: null
            };
            this.setBirthdayYear(1889);
        }

        //屬性
        Grandfather.prototype.birthday = {
            year: null,
            month: null,
            day: null
        };

        //方法
        Grandfather.prototype.setBirthdayYear = function (year)
        {
            this.birthday.year = year;
        };

        //上層類別
        function Father() {
            Grandfather.call(this);
            this.setBirthdayYear(1915);
        }

        //Father繼承Grandfather
        Father.prototype = new Grandfather();

        //子類別之一
        function Son() {
            Father.call(this);
            this.setBirthdayYear(1943);
        }

        //Son繼承Father
        Son.prototype = new Father();

        //子類別之二
        function Daughter() {
            Father.call(this);
            this.setBirthdayYear(1945);
        }

        //Daughter繼承Father
        Daughter.prototype = new Father();

        //輸出檢驗
        var son = new Son();
        var daughter = new Daughter();
        var father = new Father();
        var grandfather = new Grandfather();

        $('#Grandfather').html(typeof(Grandfather)+'/'+Grandfather);
        $('#grandfather').html(typeof(grandfather)+'/'+grandfather.birthday.year);
        $('#father').html(typeof(father)+'/'+father.birthday.year);
        $('#son').html(typeof(son)+'/'+son.birthday.year);
        $('#daughter').html(typeof(daughter)+'/'+daughter.birthday.year);
    </script>
</div>