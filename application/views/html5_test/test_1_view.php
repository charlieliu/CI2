<div id="body">
    <p>{current_page}/{current_fun}</p>

    <div style="margin:1em;">
        <video id="Video1" >
            //  Replace these with your own video files.
            <source id="Video1_source" src="demo.mp4" type="video/mp4" />
            <!--<source src="demo.ogv" type="video/ogg" />-->
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
</div>