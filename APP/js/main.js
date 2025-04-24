function sendJSON(){
    var jsonData = {
        username: document.getElementById("username").value.trim(),
        password: document.getElementById("password").value.trim(),
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
                window.location.href = "Userpage.php";
            } else {
                alert(result);
            }
        },
        error: function(result){

        }
    })
}