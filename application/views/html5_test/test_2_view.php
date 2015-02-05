<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div class="mg1em">
        <form  name="contact1" action="contact.php" method="POST" id="contact1">
            <div class="mg1em">
                Name&nbsp;:&nbsp;
                <input type="text" name="name" id="name" required>
            </div>
            <div class="mg1em">
                Email&nbsp;:&nbsp;
                <input type="email" name="email" id="email" required>
            </div>
            <div class="mg1em">
                Color&nbsp;:&nbsp;
                <input type="color" name="color" id="color" required>
            </div>

            <div class="mg1em">
                Date&nbsp;:&nbsp;
                <input type="date" name="date" id="date" required>
            </div>

            <div class="mg1em">
                Month&nbsp;:&nbsp;
                <input type="month" name="month" id="month" required>
            </div>

            <div class="mg1em">
                Week&nbsp;:&nbsp;
                <input type="week" name="week" id="week" required>
            </div>

            <div class="mg1em">
                Time&nbsp;:&nbsp;
                <input type="time" name="time" id="time" required>
            </div>

            <div class="mg1em">
                Datetime-local&nbsp;:&nbsp;
                <input type="datetime-local" name="datetime-local" id="datetime-local" required>
            </div>

            <div class="mg1em">
                Datetime&nbsp;:&nbsp;
                <input type="datetime" name="datetime" id="datetime" required>
            </div>
            <div class="mg1em">
                Range&nbsp;:&nbsp;<span id="range_value"></span>
                <input type="range" name="range" id="range" min="0" max="10" required>
            </div>
            <div class="mg1em">
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
</div>