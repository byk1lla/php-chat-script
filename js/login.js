const form = document.querySelector(".login form"),
continueBtn = document.querySelector(".button input"),
errtitle = document.getElementById("tic"),
errdesc = document.getElementById("dic"),
icon = document.getElementById("ic"),
ica = document.getElementById("is");

form.onsubmit = (e) => {

    e.preventDefault();
}
document.getElementById("dismiss-popup-btn").addEventListener("click",function(){
    document.getElementsByClassName("popup")[0].classList.remove("active");
});
continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest(); 
    xhr.open("POST","../API/login-api.php");
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "başarılı"){
                    location.href = "./menu";
                }
                else{
                    ica.classList.add("not");
                    icon.classList.add("fa","fa-xmark","not");
                    errtitle.innerText = "Bir Hata Oluştu!";
                    errdesc.innerText = data;
                    document.getElementsByClassName("popup")[0].classList.add("active"); 
                }
            }
        }
    }
    let formData = new FormData(form);
    
    xhr.send(formData);
}