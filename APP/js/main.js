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
            const trimmedResult = result.trim();
        if (trimmedResult === "Login Successful - Redirecting to Admin Page") {
        window.location.href = 'adminPage.php';
        } else if (trimmedResult === "Login Successful - Redirecting to User Page") {
        window.location.href = 'userPage.php';
        } else {
        alert(result);
    }
        },
        error: function(result){
            console.error("Error:", result);
            alert("An error occurred during login.");
        }
    })
}

$(document).ready(function() {
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).prev("input"));
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
});