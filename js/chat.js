const formChat = document.querySelector(".typing-area"),
messgeZone = formChat.querySelector(".gonder"),
sendBtn = formChat.querySelector("button"),
chatBox = document.querySelector(".chat-box");

formChat.onsubmit = (e) => {

    e.preventDefault();
}

sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest(); 
    xhr.open("POST","../API/sendmessage-api.php");
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            let data = xhr.response;
            if(xhr.status === 200){
                messgeZone.value = "";
                scrollDwn();
            }
           
            
        }
    }
    let formData = new FormData(formChat);

    xhr.send(formData);
}
chatBox.onmouseenter = () =>{
    chatBox.classList.add("active");
};
chatBox.onmouseleave = () =>{
    chatBox.classList.remove("active");
};
setInterval(()=>{
    
    let xhr = new XMLHttpRequest(); 
    xhr.open("POST","../API/getmessage-api.php");
    
    xhr.onload = () =>{
        
        if(xhr.readyState === XMLHttpRequest.DONE){
            
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){
                    scrollDwn();
                }
            }
            
        }
    }
    let  formData = new FormData(formChat);
    xhr.send(formData);
},300);

function scrollDwn(){
    chatBox.scrollTo = chatBox.scrollHeight;
}