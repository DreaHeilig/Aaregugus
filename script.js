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

        // You can now use recentData and averages as needed in your application
        // For example, update the UI or perform further calculations

    } catch (error) {
        // Handle any errors that occurred during the fetch
        console.error('Error fetching data:', error);
    }
}

// Call the fetchData function
fetchData();
