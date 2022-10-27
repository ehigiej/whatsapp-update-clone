/* HANDLE PASSWORD REVEAL */
let form = document.querySelector(".login form") //Get The Form
let passwordField = form.querySelector("input[type=password]"); //Get The Password field 
let toggleBtn = form.querySelector(".password i") //Get The Toggle Btn to toggle Password 
/* ADD EVENTLISTENER TO TOGGLE BTN */
toggleBtn.addEventListener("click", ()=>{
    //Check the type of passwordField, change it to text if type is password and vice versa
    if(passwordField.type === "password") {
        passwordField.type = "text";
        toggleBtn.classList.add("active") //change toggleBtn
    } else {
        passwordField.type = "password"; 
        toggleBtn.classList.remove("active");
    }
})


/* HANDLE SIGNUP FOR USER 
Firstname, Lastname, Email and Password field is set to required in HTML page 
so no need to validate them here, validation will be done on the backend 
Error messages will be displayed also */
let errorDiv = form.querySelector(".error-message"); //Get The Error Div 
form.addEventListener("submit", async(e)=>{
    e.preventDefault();
    /* Create FormData to hold login form informations */
    let loginForm = new FormData(form);
    let {data} = await axios.post("/login", loginForm);
    if(data === "success") {
        //If login is successful, redirect to user's page 
        location.href = "/users";
    } else {
        errorDiv.textContent = data;
        errorDiv.style.display = "block";
    }
})
