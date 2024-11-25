document.addEventListener('DOMContentLoaded', function() {
    const startBtn = document.getElementById('startBtn');
    const taskNameInput = document.getElementById('taskName');
    const counter = document.getElementById('counter');
    let taskId = null; // Variable to track the task ID
    let totalTime = 0; // Track total time in seconds
    let intervalId = null; // Store interval ID
    let startTimeRequest;
// Start the counter
    function startCounter() {
        intervalId = setInterval(() => {
            totalTime += 0.1; // Increment totalTime in milliseconds (0.1 seconds)
            counter.textContent = `Time: ${Math.floor(totalTime)} seconds`;
        }, 100); // Update every 100ms (0.1 second)
    }


    function stopCounter() {
        clearInterval(intervalId); // Stop the interval
        intervalId = null;
    }

    window.onbeforeunload = function (event) {

        if (intervalId) { // Check if the counter is running
            alert("You need to stop the task before exit the page !");
        }
    };


    startBtn.addEventListener('click', function () {
        if (taskId) {
            const data = {
                end_time: new Date().toISOString()
            };
            stopCounter();
            console.log(data);

            // If taskId exists, handle stopping the task
            fetch(`/task/${taskId}/stop`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errData => {
                            throw new Error(errData.error.message);
                        });
                    }
                    return response.json();
                })
                .then(() => {
                    startBtn.textContent = 'START';
                    startBtn.style.backgroundColor = '#4CAF50';
                    taskId = null; // Reset the task ID
                     // Stop the counter
                    counter.style.display = 'none'; // Hide the counter
                    location.reload();
                })
                .catch(error => {
                    alert(error.message);
                });
        } else {
            // If no taskId, handle starting a new task
            const taskName = taskNameInput.value;

            if (!taskName) {
                alert('Please enter a task name!');
                return;
            }
            startTimeRequest = new Date().getTime()
            const startTime = new Date().toISOString(); // Get current time in ISO format
            console.log(startTime);
            startCounter();
            // Prepare data to send via AJAX
            const data = {
                name: taskName,
                start_time: startTime,
            };

            // Send the POST request using fetch (AJAX)
            fetch('/task', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errData => {
                            throw new Error(errData.error.message);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    taskId = data.task_id; // Store the task ID
                    totalTime = Number(data.total_time); // Initialize counter as a number

                        const delay = (new Date().getTime() - startTimeRequest) / 1000; // Calculate the delay in seconds
                    totalTime += delay; // Adjust totalTime to account for the delay

                    // Immediately update the UI to show the current total time
                    counter.textContent = `Time: ${Math.floor(totalTime)} seconds`; // Show whole seconds
                    counter.style.display = 'block'; // Show the counter
                    startBtn.textContent = 'STOP';
                    startBtn.style.backgroundColor = '#FF0000';
                    if(totalTime > 0) {
                        startTimeRequest = new Date().getTime()
                        stopCounter();
                        startCounter();
                    }

                })
                .catch(error => {
                    alert(error.message);
                });
        }

    });
});


