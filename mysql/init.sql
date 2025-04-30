CREATE DATABASE IF NOT EXISTS pomodoro_db;
USE pomodoro_db;
CREATE TABLE IF NOT EXISTS sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_name VARCHAR(255),
    session_time DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS task_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255),
    start_time DATETIME,
    end_time DATETIME,
    duration INT, -- in seconds
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



