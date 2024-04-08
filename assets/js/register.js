document.addEventListener('DOMContentLoaded', function(e) {
    let password = document.querySelector("#password");
    let confirmPassword=document.querySelector("#confirmpassword");
    let form = document.querySelector("#form");
    form.addEventListener("submit",(e)=>{
        if (password.value !== confirmPassword.value) {
            confirmPassword.style.backgroundColor = "red";
            e.preventDefault();
            alert("Please make the passwords match.");
        }
    })

})