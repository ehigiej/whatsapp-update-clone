/* GET THE CHAT PARENT DIV, Message Form AND THE message Input */
const chatDiv = document.querySelector(".chat-area .chat-box");
const msgForm = document.querySelector(".chat-area form");
const msgInput = msgForm.querySelector(".text-input");


/* A FUNCTION TO SCROLL chat DIv to the last message */
function scrollToBottom() {
    chatDiv.scrollTo({
        left: 0,
        top: chatDiv.clientHeight,    
    })
};

scrollToBottom();

/* HANDLE SENDING OF MESSAGES */
msgForm.addEventListener("submit", async(e)=>{
    e.preventDefault();
    /* if message input is not empty send message */
    if(msgInput.value.length > 0) {
        /* Create a new formData to hold msgForm */
        let messageForm = new FormData(msgForm);
        let {data} = await axios.post("/send-user-messages", messageForm);
        if(data === "success") {
            //Meaning Message was successfully sent 
            msgInput.value = ""; //set input to null 
            //Wait, then scroll to bottom
            setTimeout(() => {
                scrollToBottom();
            }, 500);
        }
    } 
})

/* GET THE LATEST MESSAGES */
setInterval(async() => {
    /* Create a new formData to hold msgForm */
    let messageForm = new FormData(msgForm);
    let {data} = await axios.post("/getChat", messageForm);
    chatDiv.innerHTML = data;
    /* SCROLL TO THE BOTTOM OF CHAT AFTER MESSAGES HAVE BEEN RECEIVED ONCE 
    TO DO THAT ADD A CLASSLIST OF scrolled */
    if(!chatDiv.classList.contains("scrolled")) {
        scrollToBottom();
        chatDiv.classList.add("scrolled");
    };
}, 500);
