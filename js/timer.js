var Timer;
var TotalSeconds;
var Function = null;
var TimerId;
var Time;

function CreateTimer(TimerID, time, func) {
    Timer = document.getElementById(TimerID);
    TotalSeconds = time;
    Time = time;
    Function = func;
    UpdateTimer()
    TimerId = window.setTimeout("Tick()", 1000);
}

function Tick() {
    if (TotalSeconds <= 0) {
        if( Function != null ){
            Function();
        }
        return;
    }
    
    TotalSeconds -= 1;
    UpdateTimer()
    TimerId = window.setTimeout("Tick()", 1000);
}

function UpdateTimer() {
    var Seconds = TotalSeconds;
    
    var Minutes = Math.floor(Seconds / 60);
    Seconds -= Minutes * (60);

    var TimeStr = "Time left: " + LeadingZero(Minutes) + ":" + LeadingZero(Seconds)

    Timer.innerHTML = TimeStr;
}

function LeadingZero(Time) {
    return (Time < 10) ? "0" + Time : + Time;
}

function stopTimer(){
    clearTimeout(TimerId);
}

function resetTimer(){
    TotalSeconds = Time;
}