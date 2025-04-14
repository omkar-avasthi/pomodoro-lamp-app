// Load durations and preferences from localStorage (or use defaults)
let workDuration = (localStorage.getItem('workDuration') || 25) * 60;
let shortBreak = (localStorage.getItem('shortBreak') || 5) * 60;
let longBreak = (localStorage.getItem('longBreak') || 15) * 60;
let autoStart = JSON.parse(localStorage.getItem('autoStart') || false);
let soundOn = JSON.parse(localStorage.getItem('soundOn') || true);

// Timer state variables
let time = workDuration;
let interval = null;
let isWork = true;
let cycles = 0;

// Update the timer display
function updateDisplay() {
    const m = Math.floor(time / 60).toString().padStart(2, '0');
    const s = (time % 60).toString().padStart(2, '0');
    document.getElementById("timer").innerText = `${m}:${s}`;
}

// Update the session status text
function updateStatus(text) {
    document.getElementById("status").innerText = text;
}

// Start the timer
function startTimer() {
    if (interval) return; // Prevent multiple intervals
    updateStatus(isWork ? "Work Session" : "Break Time");
    interval = setInterval(() => {
        time--;
        updateDisplay();
        if (time <= 0) {
            clearInterval(interval);
            interval = null;

            // Play notification
            playNotification();

            if (isWork) {
                cycles++;
                logSession();

                // Decide break type
                if (cycles % 4 === 0) {
                    time = longBreak;
                    updateStatus("Long Break!");
                } else {
                    time = shortBreak;
                    updateStatus("Short Break!");
                }
            } else {
                // After break, go back to work session
                time = workDuration;
                updateStatus("Work Session");
            }

            isWork = !isWork;

            // Auto-start next session if enabled
            if (autoStart) {
                startTimer();
            }
        }
    }, 1000);
}

// Reset the timer
function resetTimer() {
    clearInterval(interval);
    interval = null;
    isWork = true;
    cycles = 0;
    time = workDuration;
    updateStatus("Ready");
    updateDisplay();
}

// Play sound notification
function playNotification() {
    if (soundOn) {
        let audio = new Audio("assets/audio/notification.mp3"); // Make sure this file exists
        audio.play();
    }
}

// Log a completed work session to the server
function logSession() {
    const sessionName = document.getElementById("sessionName").value || "Unnamed";
    fetch('log_session.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'name=' + encodeURIComponent(sessionName)
    });
}

// Initialize the display when page loads
updateDisplay();
