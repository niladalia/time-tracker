// task-timer.js
let totalTime = 0; // Track total time in seconds
let intervalId = null; // Store interval ID
const counter = document.getElementById('counter');

// Start the counter
function startCounter() {
    intervalId = setInterval(() => {
        totalTime += 0.1; // Increment totalTime in milliseconds (0.1 seconds)
        counter.textContent = `Time: ${Math.floor(totalTime)} seconds`;
    }, 100); // Update every 100ms (0.1 second)
}

// Stop the counter
function stopCounter() {
    clearInterval(intervalId); // Stop the interval
    intervalId = null;
}

// Update the counter display
function updateCounterDisplay() {
    counter.textContent = `Time: ${Math.floor(totalTime)} seconds`;
}

export { startCounter, stopCounter, updateCounterDisplay, totalTime };
