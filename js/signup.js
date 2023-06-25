const form = document.querySelector(".signup form"),
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
    location.href="../menu";
});
continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest(); 
    xhr.open("POST","../API/signup-api.php");
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "başarılı"){
                    icon.classList.add("fa","fa-check");
                    errtitle.innerText = "Başarılı!";
                    errdesc.innerText = "Kaydınız Başarıyla Oluşturuldu!";
                    document.getElementsByClassName("popup")[0].classList.add("active"); 
                    setTimeout(4000);

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