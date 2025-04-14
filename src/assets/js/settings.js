document.addEventListener('DOMContentLoaded', function () {
    loadSettings();

    document.getElementById('settingsForm').addEventListener('submit', function (e) {
        e.preventDefault();
        saveSettings();
        alert("Settings Saved!");
    });
});

function loadSettings() {
    document.getElementById('workDuration').value = localStorage.getItem('workDuration') || 25;
    document.getElementById('shortBreak').value = localStorage.getItem('shortBreak') || 5;
    document.getElementById('longBreak').value = localStorage.getItem('longBreak') || 15;
    document.getElementById('autoStart').checked = JSON.parse(localStorage.getItem('autoStart') || false);
    document.getElementById('soundOn').checked = JSON.parse(localStorage.getItem('soundOn') || true);
}

function saveSettings() {
    localStorage.setItem('workDuration', document.getElementById('workDuration').value);
    localStorage.setItem('shortBreak', document.getElementById('shortBreak').value);
    localStorage.setItem('longBreak', document.getElementById('longBreak').value);
    localStorage.setItem('autoStart', document.getElementById('autoStart').checked);
    localStorage.setItem('soundOn', document.getElementById('soundOn').checked);
}