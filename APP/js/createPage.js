function sendJSON(){
    const username = document.querySelector('[name="username"]').value;
    const Fname = document.querySelector('[name="Fname"]').value;
    const Lname = document.querySelector('[name="Lname"]').value;
    const studentNo = document.querySelector('[name="studentNo"]').value;
    const email = document.querySelector('[name="email"]').value;
    const password = document.querySelector('[name="password"]').value;
    const confirmPassword = document.querySelector('[name="confirm_password"]').value;

    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return;
    }

    const jsonData = {
        username: username,
        Fname: Fname,
        Lname: Lname,
        studentNo: studentNo,
        email: email,
        password: password
    };


    var jsonString = JSON.stringify(jsonData);
    $.ajax({
        url: "",
        type: "POST",
        data: {myData: jsonString},
        success: function(result) {
            if (result.includes("Registration Successful")) {
                alert(result);
                // Redirect after alert
                window.location.href = "Main.php"; // your login page
            } else {
                alert(result);
            }
        },
        error: function(result){

        }
    })
}