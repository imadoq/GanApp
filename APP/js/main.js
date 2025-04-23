function sendJSON(){
    var jsonData = {
        username: document.getElementById("username").value,
        password: document.getElementById("password").value,
    }

    var jsonString = JSON.stringify(jsonData);
    $.ajax({
        url: "",
        type: "POST",
        data: {myData: jsonString},
        success: function(result) {
            if (result.includes("Login Successful")) {
                alert(result);
                // Redirect after alert
                window.location.href = "Userpage.php"; // your login page
            } else {
                alert(result);
            }
        },
        error: function(result){
            alert("An error occurred. Please try again.");
        }
    })
}