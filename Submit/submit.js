// Show the modal with a message
function showMessage(message) {
    const modal = document.getElementById('messageModal');
    const modalMessage = document.getElementById('modalMessage');
    const span = document.getElementsByClassName('close')[0];
    

    modalMessage.textContent = message;
    modal.style.display = 'block';

    // Close the modal when clicking on (x)
    span.onclick = function() {
        modal.style.display = 'none';
    }

    // Close the modal when clicking outside of the modal
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }
}

// Show the image name after selection
function showImageName() {
    const imageInput = document.getElementById('imageUpload');
    const imageName = document.getElementById('imageName');
    imageName.textContent = `Selected Image: ${imageInput.files[0].name}`;
}

// Get user's current location and update the map
function getLocation() {
    const locationInfo = document.getElementById('locationInfo');
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            locationInfo.textContent = `Latitude: ${lat}, Longitude: ${lng}`;

            // Update the map with the user's location
            map.setView([lat, lng], 13);

            // Add or update the marker for user's location
            if (userMarker) {
                userMarker.setLatLng([lat, lng]).bindPopup("You are here").openPopup();
            } else {
                userMarker = L.marker([lat, lng]).addTo(map).bindPopup("You are here").openPopup();
            }

            // Add latitude and longitude to hidden form fields
            document.getElementById('latitude').value = lat;    // Correct assignment
            document.getElementById('longitude').value = lng;   // Correct assignment
        }, function (error) {
            locationInfo.textContent = "Unable to retrieve location.";
        });
    } else {
        locationInfo.textContent = "Geolocation is not supported by this browser.";
    }
}


// Add latitude and longitude to the form
function addLocationToForm(latitude, longitude) {
    document.getElementById('latitude').value = latitude;
    document.getElementById('longitude').value = longitude;
}

// Handle form submission
function submitForm(event) {
    event.preventDefault();
    
    const description = document.getElementById('description').value;
    const landmark = document.getElementById('landmark').value;
    const latitude = document.getElementById('latitude').value;
    const longitude = document.getElementById('longitude').value;
    const image = document.getElementById('imageUpload').files[0];

    if (!image || !description || !landmark || !latitude || !longitude) {
        showMessage("Please complete all fields before submitting.");
        return;
    }

    // Create FormData object for AJAX submission
    const formData = new FormData(document.getElementById('submissionForm'));

    // AJAX request to submit the form
    fetch('path_to_your_php_script.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        showMessage("Submission successful!");
    })
    .catch(error => {
        showMessage("Error: " + error.message);
    });
}

// Initialize the map
var map = L.map('map').setView([51.505, -0.09], 13);

// Add OpenStreetMap tiles
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// Marker for the user's location
var userMarker = null;

// Add a popup when clicking on the map
var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(map);
}

map.on('click', onMapClick);

console.log("Latitude: " + latitude);
console.log("Longitude: " + longitude);
console.log([...formData]); // Will log all key-value pairs being sent in the FormData object
