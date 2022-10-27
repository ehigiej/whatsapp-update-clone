/* GET THE USERS SECTION */
let userSection = document.querySelector("main .users");
let errorMessage = userSection.querySelector(".error-message") //Error Messages Div 

/* A FUNCTION THAT ADD AN EVENT LISTENER TO KNOW WHEN A USER UPLOADS A STATUS */
function uploadChanges() {
    /* GET THE USER UPLOAD FORM INPUT */
    let uploadImg = userSection.querySelector(".status-update-update .add-status #status");
    let acceptedTypes = ["image/png", "image/jpeg", "image/jpg"]; //Accepted Image Type for Status
    /* ADD EVENT LISTENER TO uploadImg to know when a user upload an image 
    FOR NOW Images are the only file type accepted for status */
    uploadImg.addEventListener("input", async()=>{
        /* Turn off error messages */
        errorMessage.style.display = "none";
        if(uploadImg.files[0]) {
            //First check the image type 
            let type = uploadImg.files[0].type;
            //Check if the image type is supported 
            if(acceptedTypes.includes(type)) {
                /* create a formData with Image Type and send to the backend */
                let imgForm = new FormData();
                imgForm.append("status", uploadImg.files[0]);
                let {data} = await axios.post("/upload-status", imgForm);
                console.log(data);
            } else {
                //Handle when user upload a file that is not supported 
                errorMessage.textContent = "Please select an Image File - jpeg, png, jpg!";
                errorMessage.style.display = "block";
            }
        } 
    })

}
uploadChanges();

/* STATUS UPDATE SECTION */
let statusSection = userSection.querySelector(".status-update-update") 
// async function pp() {
//     let {data} = await axios.get("/get-status");
//     console.log(data)
//     statusSection.innerHTML = data;
//     uploadChanges(); //Listen for new changes 
// }

// pp();

setInterval(async() => {
    let {data} = await axios.get("/get-status");
    statusSection.innerHTML = data;
    uploadChanges(); //Listen for new changes 
}, 500);