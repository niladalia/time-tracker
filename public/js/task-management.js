// task-management.js
import { startCounter, stopCounter, updateCounterDisplay } from './task-timer.js';

let taskId = null;
let startTimeRequest;

// Handle the task button click (start/stop task)
document.getElementById('startBtn').addEventListener('click', function () {
    const taskNameInput = document.getElementById('taskName');
    const startBtn = document.getElementById('startBtn');

    if (taskId) {
        // Stopping the task
        const data = { end_time: new Date().toISOString() };
        stopCounter();

        // Send stop task request
        fetch(`/task/${taskId}/stop`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
        })
            .then(handleResponse)
            .then(() => {
                startBtn.textContent = 'START';
                startBtn.style.backgroundColor = '#4CAF50';
                taskId = null;
                updateCounterDisplay();
                counter.style.display = 'none'; // Hide the counter
                location.reload();
            })
            .catch(handleError);
    } else {
        // Starting a new task
        const taskName = taskNameInput.value;
        if (!taskName) {
            alert('Please enter a task name!');
            return;
        }

        startTimeRequest = new Date().getTime();
        const startTime = new Date().toISOString();
        startCounter();

        const data = { name: taskName, start_time: startTime };

        // Send new task creation request
        fetch('/task', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(data => {
                taskId = data.task_id;
                totalTime = Number(data.total_time); // Initialize counter as a number

                // Adjust totalTime based on delay
                const delay = (new Date().getTime() - startTimeRequest) / 1000;
                totalTime += delay;

                updateCounterDisplay(); // Show updated time
                counter.style.display = 'block'; // Show the counter
                startBtn.textContent = 'STOP';
                startBtn.style.backgroundColor = '#FF0000';

                if (totalTime > 0) {
                    startTimeRequest = new Date().getTime();
                    stopCounter();
                    startCounter();
                }
            })
            .catch(handleError);
    }
});

// Handle fetch response
function handleResponse(response) {
    if (!response.ok) {
        return response.json().then(errData => { throw new Error(errData.error.message); });
    }
    return response.json();
}

// Handle errors
function handleError(error) {
    alert(error.message);
}
