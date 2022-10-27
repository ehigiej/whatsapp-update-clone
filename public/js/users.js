/* STYLE THE SEARCH BAR */
let searchBar = document.querySelector(".users .search input"); //Search Input 
let searchBtn = document.querySelector(".users .search button"); //Search Icon 
usersList = document.querySelector(".users .users-list") /* PARENT DIV FOR ALL USERS INFO */
/* toggle the class name active on click of searchBar and searchBtn for visibility effect */
searchBtn.addEventListener("click", ()=>{
    searchBar.classList.toggle("active");
    searchBtn.classList.toggle("active");
    searchBar.focus(); //Focus on search Bar
    searchBar.value = ""; //reset searchBar 
})

/* HANDLE SEARCH 
add input eventListener to search */
searchBar.addEventListener("input", async()=>{
    /* FIRST CREATE A NEW FORM DATA TO HOLD SEARCH VALUE */
    let searchForm = new FormData();
    /* ADD SEARCH INPUT TO FORM DATA */
    searchForm.append("searchUser", String(searchBar.value));
    let {data} = await axios.post("/searchUser", searchForm);
    usersList.innerHTML = data;
});

/* RUN AN INTERVAL EVERY 500 SECs and Get USERS AND THEIR LAST CONVERSATION WITH CURRENT USER */
setInterval(async() => {
    let {data} = await axios.get("/getUsers");
    /* CHECK IF searchBar has a class of active,
    if search Bar has a class of active it means A user wants to do a search so don't override usersLiist 
    Only Add Users and their last CONVERSATION if searchBar doesn't have a class of active */
    if(!searchBar.classList.contains("active")) usersList.innerHTML = data;
}, 500);

// async function pp() {
//     let {data} = await axios.get("/getUsers");
//     usersList.innerHTML = data;
// }

// pp();