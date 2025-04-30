let timerInterval = null;
let startTime = null;
let sessionDuration = 25 * 60; // default 25 minutes
let isBreak = false;
let breakDuration = 5 * 60; // default 5 minutes
let timerStatus = 'Ready';

function updateTimerDisplay(secondsRemaining) {
    const minutes = Math.floor(secondsRemaining / 60);
    const seconds = secondsRemaining % 60;
    document.getElementById("timer").innerText =
        String(minutes).padStart(2, '0') + ":" + String(seconds).padStart(2, '0');
}

function startTimer() {
    if (timerInterval) return; // already running

    const now = Date.now();
    const totalDuration = isBreak ? breakDuration : sessionDuration;
    startTime = now;
    const targetEndTime = startTime + totalDuration * 1000;

    timerInterval = setInterval(() => {
        const currentTime = Date.now();
        const secondsPassed = Math.floor((currentTime - startTime) / 1000);
        const secondsRemaining = totalDuration - secondsPassed;

        if (secondsRemaining >= 0) {
            updateTimerDisplay(secondsRemaining);
        } else {
            clearInterval(timerInterval);
            timerInterval = null;
            if (!isBreak) {
                isBreak = true;
                timerStatus = 'Break Time!';
                alert("Work session completed! Time for a short break.");
                startTimer(); // Auto-start break
            } else {
                isBreak = false;
                timerStatus = 'Ready';
                alert("Break over! Ready for next Pomodoro.");
                updateTimerDisplay(sessionDuration);
            }
        }
    }, 1000);

    timerStatus = isBreak ? "Break Running" : "Work Running";
    document.getElementById("status").innerText = timerStatus;
}

function resetTimer() {
    clearInterval(timerInterval);
    timerInterval = null;
    startTime = null;
    isBreak = false;
    timerStatus = 'Ready';
    updateTimerDisplay(sessionDuration);
    document.getElementById("status").innerText = timerStatus;
}

updateTimerDisplay(sessionDuration);

