// Open the Popup Form
document.getElementById("openPopupBtn").addEventListener("click", function() {
    document.getElementById("popupForm").style.display = "block";
  });
  
  // Close the Popup Form
  function closePopupForm() {
    document.getElementById("popupForm").style.display = "none";
  }
  
  // Save data to the database (Assuming you have a server-side script for this, e.g., save_data.php)
  function saveData() {
    // Get the data from the input field
    var inputData = document.getElementById("dataInput").value;
  
    // Perform an AJAX request to send data to the server
    // Example using Fetch API
    fetch('save_data.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ data: inputData }),
    })
    .then(response => response.json())
    .then(data => {
      // Handle the response from the server (if needed)
      console.log('Data saved:', data);
      closePopupForm();
    })
    .catch((error) => {
      console.error('Error:', error);
    });
  }
  