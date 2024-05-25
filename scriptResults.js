// Function to update travel time, speed, and temperature in HTML
function updateTravelData(recentData) {
    // Update travel time
    const travelTimeInMinutes = recentData.travelTime;
    const hours = Math.floor(travelTimeInMinutes / 60);
    const minutes = travelTimeInMinutes % 60;
    document.getElementById('timeHour').innerText = hours;
    document.getElementById('timeMinute').innerText = minutes;
}

// Function to update time values for each bt background
// Function to update time values for each bt background
function updateTimeValues(averages) {
    // Get keys (timestamps) from the averages object
    const keys = Object.keys(averages);

    // Loop through the first 3 keys (assuming they represent the most recent data)
    for (let i = 0; i < Math.min(keys.length, 3); i++) {
        const timestamp = keys[i];
        const value = averages[timestamp];
        const { hours, minutes } = convertToHoursMinutes(value);

        // Inject hour and minute values into corresponding HTML elements
        document.getElementById(`bt${i + 1}Hours`).innerText = hours;
        document.getElementById(`bt${i + 1}Minutes`).innerText = minutes;
    }
}

// Function to convert a value to hours and minutes
function convertToHoursMinutes(value) {
    const hours = Math.floor(value / 60);
    const minutes = value % 60;
    return { hours, minutes };
}

// Function to update wave background elements with values from averages object
function updateWaveBackgroundWidths(averages) {
    // Get keys (timestamps) from the averages object
    const keys = Object.keys(averages);

    // Loop through the first 3 keys (assuming they represent the most recent data)
    for (let i = 0; i < Math.min(keys.length, 3); i++) {
        const timestamp = keys[i];
        const value = averages[timestamp];

        // Get the wave background element with the corresponding ID
        const waveBackground = document.getElementById(`wave-background${i + 1}`);

        // Calculate width based on value (adjust as needed)
        const maxWidth = 200; // Maximum width for the wave background
        const width = (value / 80) * maxWidth; // Adjust the calculation based on your specific requirements

        // Set the width of the wave background element
        waveBackground.style.width = width + 'px';
    }
}

async function fetchData() {
    const url = 'https://568900-4.web.fhgr.ch/endpoint.php';

    try {
        // Fetch the data from the endpoint
        const response = await fetch(url);
        
        // Check if the response is ok (status 200-299)
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        // Parse the JSON from the response
        const data = await response.json();

        // Destructure the data into recentData and averages
        const { recentData, averages } = data;

        // Log the data to the console (or use it as needed)
        console.log('Recent Data:', recentData);
        console.log('Averages:', averages);

        // Update travel data in HTML
        updateTravelData(recentData);

        // Call the function to update time values
        updateTimeValues(averages);

        updateWaveBackgroundWidths(averages);

    } catch (error) {
        // Handle any errors that occurred during the fetch
        console.error('Error fetching data:', error);
    }
}

// Call the fetchData function
fetchData();


