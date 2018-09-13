@section('screensave')
<style>
    .screensave {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%; 
        min-height: 100%;
    }
</style>
<div id="screensave_{{$field['name']}}" class="hidden" >
    <video controls id="{{$field['name']}}" class="screensave" width="screen.width;" height="screen.height;" >
        <source src="{{$field['value']}}" loop="true" autoplay preload="auto" type="video/mp4"></source>
    </video>
</div>
@endsection
@section('after_scripts')
<script>
    var elem = document.getElementById("{{$field['name']}}");
    var divElem = document.querySelector("#screensave_{{$field['name']}}");
    var bodyElem = document.querySelector("#screensave_page");
    var timeSleep = setInterval(() => {
        clearInterval(timeSleep);
        PlayFullScreen();
    }, 300000);
    
    document.addEventListener("mousemove", e => {
        StopFullScreen();
        clearInterval(timeSleep);
        timeSleep = setInterval(() => {
            clearInterval(timeSleep);
            PlayFullScreen();
            elem.play();
        }, 300000);
    });

    function PlayFullScreen() {
        divElem.setAttribute("class", "screensave");
        bodyElem.setAttribute("class", "hidden");
        if (elem.requestFullscreen) elem.requestFullscreen();
        else if (elem.mozRequestFullScreen) elem.mozRequestFullScreen();
        //else if (elem.webkitRequestFullscreen) elem.webkitRequestFullscreen();
        else if (elem.msRequestFullscreen) elem.msRequestFullscreen();

        elem.pause();
        elem.currentTime = 0;
        elem.load();
        elem.play(true);
    }

    function StopFullScreen() {
        divElem.setAttribute("class", "hidden");
        bodyElem.setAttribute("class", "wrapper");
        if (elem.exitFullScreen) elem.exitFullScreen();
        //else if (elem.webkitExitFullScreen) elem.webkitExitFullScreen();
        else if (elem.mozExitFullScreen) elem.mozExitFullScreen();
        //else if (elem.oExitFullScreen) elem.oExitFullScreen();
        else if (elem.msExitFullScreen) elem.msExitFullScreen();

        elem.pause();
        elem.currentTime = 0;
    }

    function NewIntervalSleep() {
        timeSleep = setInterval(() => {
            PlayFullScreen();
            clearInterval(timeSleep);
        }, 300000);
    }
</script>

@endsection