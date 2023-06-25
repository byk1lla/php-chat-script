const searchBar = document.querySelector(".users .search input"),
searchBtn =  document.querySelector(".users .search button"),
usersList =  document.querySelector(".users .users-list");


searchBtn.onclick = () =>{

    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
}
searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    if(searchTerm != ""){
        searchBar.classList.add("active");
        searchBtn.classList.add("active");

    }
    else{
        searchBar.classList.remove("active");
        searchBtn.classList.remove("active");
    }
    let xhr = new XMLHttpRequest(); 
    xhr.open("POST","../API/search-api.php");
    
    xhr.onload = () =>{
        
        if(xhr.readyState === XMLHttpRequest.DONE){
            
            if(xhr.status === 200){
                let data = xhr.response;
                usersList.innerHTML = data;
            }
            
        }
    }
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

setInterval(()=>{
    
    let xhr = new XMLHttpRequest(); 
    xhr.open("POST","../API/users-api.php");
    
    xhr.onload = () =>{
        
        if(xhr.readyState === XMLHttpRequest.DONE){
            
            if(xhr.status === 200){
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){
                    usersList.innerHTML = data;
                }
               
            }
            
        }
    }
    xhr.send();
},300);