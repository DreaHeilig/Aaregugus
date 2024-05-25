// Function to update travel time, speed, and temperature in HTML
function updateTravelData(recentData) {
    // Update travel time
    const travelTimeInMinutes = recentData.travelTime;
    const hours = Math.floor(travelTimeInMinutes / 60);
    const minutes = travelTimeInMinutes % 60;
    document.getElementById('timeHour').innerText = hours;
    document.getElementById('timeMinute').innerText = minutes;

    // Update speed in km/h
    const speedKmPerHour = Math.round(recentData.speed);
    document.getElementById('speedValueKm').innerText = speedKmPerHour;

    // Convert speed to knots
    const speedKnots = Math.round(speedKmPerHour / 1.852);
    document.getElementById('speedValueKnots').innerText = speedKnots;

    // Update temperature
    const temperature = recentData.temperature;
    document.getElementById('temperatureValue').innerText = temperature;
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

    } catch (error) {
        // Handle any errors that occurred during the fetch
        console.error('Error fetching data:', error);
    }
}

// Call the fetchData function
fetchData();
