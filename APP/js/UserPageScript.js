function sendAddData() {
    event.preventDefault()
    var jsonData = {
        eventName: document.getElementById("eventName").value.trim(),
        eventDateTime: document.getElementById("eventDateTime").value.trim(),
        eventVenue: document.getElementById("eventVenue").value.trim(),
        orgID: document.getElementById("orgID").value.trim(),
        eventInfo: document.getElementById("eventInfo").value.trim(),
        
    };

    var jsonString = JSON.stringify(jsonData);

    console.log(jsonString);

    $.ajax({
        url: "UserPage.php",
        type: 'POST',
        data: {myData : jsonString},
        success: function(response) {
            swal({
                text: response,
            });

        },
        error: function(response){

        }

    });
}


setupCharCounter("eventName", "eventNameCounter", 50);
setupCharCounter("eventVenue", "eventVenueCounter", 50);
setupCharCounter("eventInfo", "eventInfoCounter", 250);

function setupCharCounter(inputId, counterId, maxLength) {
    const input = document.getElementById(inputId);
    const counter = document.getElementById(counterId);

    input.addEventListener("input", () => {
        const remaining = maxLength - input.value.length;
        counter.textContent = `${remaining} characters remaining`;
    });
}