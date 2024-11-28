document.addEventListener('DOMContentLoaded', function () {
    const startBtn = document.getElementById('startBtn');
    const taskNameInput = document.getElementById('taskName');
    const counter = document.getElementById('counter');
    let taskId = null;
    let totalTime = 0;
    let intervalId = null;
    let startTimeRequest;

    // Utility functions
    const updateCounterDisplay = () => {
        counter.textContent = `Time: ${Math.floor(totalTime)} seconds`;
    };

    const toggleButton = (isRunning) => {
        startBtn.textContent = isRunning ? 'STOP' : 'START';
        startBtn.style.backgroundColor = isRunning ? '#FF0000' : '#4CAF50';
    };

    const handleError = (error) => {
        alert(error.message);
    };

    // Counter functions
    const startCounter = () => {
        intervalId = setInterval(() => {
            totalTime += 0.1;
            updateCounterDisplay();
        }, 100);
    };

    const stopCounter = () => {
        clearInterval(intervalId);
        intervalId = null;
    };

    // Task actions
    const stopTask = () => {
        const data = { end_time: new Date().toISOString() };

        stopCounter();
        fetch(`/task/${taskId}/stop`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((errData) => {
                        throw new Error(errData.error.message);
                    });
                }
                return response.json();
            })
            .then(() => {
                taskId = null;
                toggleButton(false);
                counter.style.display = 'none';
                location.reload();
            })
            .catch(handleError);
    };

    const startTask = () => {
        const taskName = taskNameInput.value.trim();
        if (!taskName) {
            alert('Please enter a task name!');
            return;
        }

        startTimeRequest = Date.now();
        const startTime = new Date().toISOString();
        const data = { name: taskName, start_time: startTime };

        startCounter();

        fetch('/task', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((errData) => {
                        throw new Error(errData.error.message);
                    });
                }
                return response.json();
            })
            .then((data) => {
                taskId = data.task_id;
                totalTime = Number(data.total_time);

                const delay = (Date.now() - startTimeRequest) / 1000;
                totalTime += delay;

                updateCounterDisplay();
                counter.style.display = 'block';
                toggleButton(true);

                if (totalTime > 0) {
                    stopCounter();
                    startCounter();
                }
            })
            .catch(handleError);
    };

    // Window unload event
    window.onbeforeunload = () => {
        if (intervalId) {
            stopTask();
            return "The task will be stopped.";
        }
    };

    // Button click event
    startBtn.addEventListener('click', () => {
        if (taskId) {
            stopTask();
        } else {
            startTask();
        }
    });
});
