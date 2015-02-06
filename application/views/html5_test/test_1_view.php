<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div class="content_block mg1em padding1em">
        <video id="Video1" width="320" controls>
            //  Replace these with your own video files.
            <source src="demo/demo.mp4" type="video/mp4" />
            <source src="demo/demo.ogv" type="video/ogg" />
            HTML5 Video is required for this example.
            <a href="demo.mp4">Download the video</a> file.
        </video>

        <div id="buttonbar">
            <button class="act_btn" id="restart" onclick="restart();">[]</button>
            <button class="act_btn" id="rew" onclick="skip(-1)">&lt;&lt;</button>
            <button class="act_btn" id="play" onclick="vidplay()">&gt;</button>
            <button class="act_btn" id="fastFwd" onclick="skip(1)">&gt;&gt;</button>
        </div>
    </div>

    <div class="content_block mg1em padding1em">
        &lt;audio controls&gt;<br>
        {space_4}&lt;source src="demo/horse.ogg" type="audio/ogg"&gt;<br>
        {space_4}&lt;source src="demo/horse.mp3" type="audio/mpeg"&gt;<br>
        {space_4}Your browser does not support the audio element.<br>
        &lt;/audio&gt;<br>
        <audio controls>
            <source src="demo/horse.ogg" type="audio/ogg">
            <source src="demo/horse.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>

    <div class="content_block mg1em padding1em">
        &lt;video controls&gt;<br>
        {space_4}&lt;source src="demo/movie.mp4" type="video/mp4"&gt;<br>
        {space_4}&lt;source src="demo/movie.ogg" type="video/ogg"&gt;<br>
        {space_4}Your browser does not support the video tag.<br>
        &lt;/video&gt;<br>
        <video controls>
            <source src="demo/movie.mp4" type="video/mp4">
            <source src="demo/movie.ogg" type="video/ogg">
            Your browser does not support the video tag.
        </video>
    </div>
</div>