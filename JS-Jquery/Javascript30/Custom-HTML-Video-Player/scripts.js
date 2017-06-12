/* Get the elements */
const player = document.querySelector(".player");
const video = document.querySelector(".viewer");
const progress = document.querySelector(".progress");
const progressBar = document.querySelector(".progress__filled");
const toogle = document.querySelector(".toggle");

var fullscreenFunc = player.requestFullscreen;
if (!fullscreenFunc) {
    ['mozRequestFullScreen',
    'msRequestFullscreen',
    'webkitRequestFullScreen'].forEach(function (req) {
        fullscreenFunc = fullscreenFunc || player[req];
    });
}

const skipButtons = document.querySelectorAll("[data-skip]");
const range = document.querySelectorAll(".player__slider");

/* Build the functions */
function tooglePlay(){
    // Verifica o método a ser invocado do vídeo dado o estado de pause do video
    const method = (video.paused ? 'play' : 'pause');
    video[method]();
}

function updateToogleButton(){
    var icon = (video.paused ? '►' : '❚ ❚');
    toogle.textContent = icon;
}

function handleSkipButtons(){
    var skipTime = this.dataset.skip;
    video.currentTime += parseFloat(skipTime);
}

function handleRangeUpdate(){
    video[this.name] = this.value;
}

function updateProgressBar(){
    percent = video.currentTime / video.duration * 100;
    progressBar.style.flexBasis = `${percent}%`;
}

function scrub(e){
    scrubTime = (e.offsetX / progress.offsetWidth) * video.duration;
    video.currentTime = scrubTime;
}

function enterFullscren(){
    fullscreenFunc.call(player);
}

/* Hook up the events */
video.addEventListener("click", tooglePlay);
video.addEventListener("play", updateToogleButton);
video.addEventListener("pause", updateToogleButton);
video.addEventListener("timeupdate", updateProgressBar);
video.addEventListener("dblclick", enterFullscren);

let mousedown = false;
progress.addEventListener("click", scrub);
progress.addEventListener("mousemove", (e) => mousedown && scrub(e));
progress.addEventListener("mousedown", () => mousedown = true);
progress.addEventListener("mouseup", () => mousedown = false);

toogle.addEventListener("click", tooglePlay);

skipButtons.forEach(b => b.addEventListener("click", handleSkipButtons));

range.forEach(r => r.addEventListener("click", handleRangeUpdate));
range.forEach(r => r.addEventListener("mousemove", handleRangeUpdate));

video.play();