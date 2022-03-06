'use strict'

// Get a list of vehicles in the inventory based on the classificationId
let classificationList = document.querySelector("#classificationList");

// Create an event listener to request data based on the classificationId
// and catches any errors if they exists and sends the retrieved data to the 
// buildInventoryList function for building it into HTML and then displays it into the 
// vehicle management web page
classificationList.addEventListener("change", function() {
    let classificationId = classificationList.value;
    console.log(`classificationId is: ${classificationId}`);

    // Create a URL to request inventory data from the vehicles controller
    let classIdURL = "/phpmotors/vehicles/index.php?action=getInventoryItems&classificationId=" + classificationId;

    // Create an AJAX request to fetch the data given in the url above
    fetch(classIdURL) 
    .then(function (response) { 
    if (response.ok) { 
        return response.json(); 
    } 
    throw Error("Network response was not OK"); 
    }) 
    .then(function (data) { 
    console.log(data); 
    buildInventoryList(data); 
    }) 
    .catch(function (error) { 
    console.log('There was a problem: ', error.message) 
    }) 
    })

/**
 * buildInventoryList
 * Purpose: Build inventory items into HTML table components and inject into DOM
 */
function buildInventoryList(data){
    let inventoryDisplay = document.getElementById("inventoryDisplay");
    // Set up the table labels
    let dataTable = '<thead>';
    dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
    dataTable += '</thead>';
    // Set up the table body
    dataTable += '<tbody>';
    // Iterate over all vehicles in the array and put each in a row
    data.forEach(function (element) {
        console.log(element.invId + ", " + element.invModel);
        dataTable += `<tr><td>${element.invMake} ${element.invModel}</td>`;
        dataTable += `<td><a href='/phpmotors/vehicles?action=mod&invId=${element.invId}' title='Click to modify'>Modify</a></td>`; 
        dataTable += `<td><a href='/phpmotors/vehicles?action=del&invId=${element.invId}' title='Click to delete'>Delete</a></td></tr>`; 
    })
    dataTable += '</tbody>';
    // Display the contents in the Vehicle Management view
    inventoryDisplay.innerHTML = dataTable;
}