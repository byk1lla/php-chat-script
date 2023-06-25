const passWordField = document.querySelector(".form .field input[type='password']");
toggleBtn = document.querySelector(".form .field i");

toggleBtn.onclick = () =>{
    if(passWordField.type == "password"){
        passWordField.type = "text";
        toggleBtn.classList.add("active"); 
        }
        else{
            passWordField.type = "password";
            toggleBtn.classList.remove("active"); 
        }       
    }
    
