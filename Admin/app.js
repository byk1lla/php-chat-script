const errtitle = document.getElementById("tic"),
errdesc = document.getElementById("dic"),
icon = document.getElementById("ic"),
ica = document.getElementById("is"),
user = document.getElementById("annen31");
$(document).ready(function () {
    $('.tableuser').DataTable();
});
var button = document.getElementById("hoverbtn");


function change31(element){
    element.classList.remove("btn-outline-danger");
    element.classList.add("btn-danger");
}
function return31(element){
    element.classList.remove("btn-danger");
    element.classList.add("btn-outline-danger");
}

document.getElementById("dismiss-popup-btn").addEventListener("click",function(){
    document.getElementsByClassName("popup")[0].classList.remove("active");
    document.getElementById("overlay").style.display = "none";
    location.reload();
  });
 
function confirmDelete(username,userid) {
    
    var result = confirm(username + " Adlı Kullanıcı Kaydını silmek istiyor musunuz?");
    if (result) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../API/deleteuser.php?id=" + userid, true);
        xhr.onload = function() {
            let data = xhr.response;
            if (xhr.status === 200) {
                if(data === "deleted"){
                    icon.classList.add("fa","fa-check");
                    errtitle.innerText = "Başarılı!";
                    errdesc.innerText = username+" Adlı Kullanıcının Kaydı Başarıyla Silindi";
                    document.getElementById("overlay").style.display = "block";
                    document.getElementsByClassName("popup")[0].classList.add("active"); 
                }
                else{
                    ica.classList.add("not");
                    icon.classList.add("fa","fa-xmark","not");
                    errtitle.innerText = "Bir Hata Oluştu!";
                    errdesc.innerText = "Hata:" + data;
                    document.getElementById("overlay").style.display = "block";
                    document.getElementsByClassName("popup")[0].classList.add("active"); 
                }
            } else {
                ica.classList.add("not");
                    icon.classList.add("fa","fa-xmark","not");
                    errtitle.innerText = "Bir Hata Oluştu!";
                    errdesc.innerText = "Hata:" + xhr.status.toString();
                    document.getElementById("overlay").style.display = "block";
                    document.getElementsByClassName("popup")[0].classList.add("active"); 
            }
        };
        xhr.send();
    }
}
function confirmBan(username,userid) {
    
    var result = confirm(username + " Adlı Kullanıcıyı Yasaklamak istiyor musunuz?");
    if (result) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../API/banuser.php?id=" + userid, true);
        xhr.onload = function() {
            let data = xhr.response;
            if (xhr.status === 200) {
                
                console.log("id=" + userid)
                if(data === "banned"){
                    icon.classList.add("fa","fa-check");
                    errtitle.innerText = "Başarılı!";
                    errdesc.innerText = username+" Adlı Kullanıcının Kaydı Başarıyla Silindi";
                    document.getElementById("open-popup-btn").style.display = "none";
                    document.getElementById("overlay").style.display = "block";

                    document.getElementsByClassName("popup")[0].classList.add("active"); 
                }
                else{
                    ica.classList.add("not");
                    icon.classList.add("fa","fa-xmark","not");
                    errtitle.innerText = "Bir Hata Oluştu!";
                    if(data == ""){
                        errdesc.innerText = "API'ye Ulaşılamıyor!";
                    }
                    
                    else{
                        errdesc.innerText = data;
                    }
                    
                    document.getElementById("overlay").style.display = "block";
                    document.getElementsByClassName("popup")[0].classList.add("active"); 
                }
                
            } else {
                
                ica.classList.add("not");
                    icon.classList.add("fa","fa-xmark","not");
                    errtitle.innerText = "Bir Hata Oluştu!";
                    if(data == ""){
                        errdesc.innerText = "API'ye Ulaşılamıyor!";
                    }
                    else{
                        errdesc.innerText = data;
                    }
                    document.getElementById("overlay").style.display = "block";
                    document.getElementsByClassName("popup")[0].classList.add("active"); 
            }
        };
        xhr.send();
        
    }
}


function updateYetki(yetkiValue,userid) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../API/updateYetki.php?userid=" + userid, true);
    console.log("../API/updateYetki.php?userid=" + userid)
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if  (xhr.status === 200) {
            var response = xhr.response;
            if (response == 'başarılı') {
                ica.classList.remove("not");
                icon.classList.remove("not");
                icon.classList.add("fa","fa-check");
                    errtitle.innerText = "Başarılı!";
                    errdesc.innerText ="Yetki "+yetkiValue +" Olarak Güncellendi!" ;    
                    document.getElementById("overlay").style.display = "block";
                    document.getElementsByClassName("popup")[0].classList.add("active"); 

                
            } else {
                ica.classList.add("not");
                icon.classList.add("fa","fa-xmark","not");
                errtitle.innerText = "Bir Hata Oluştu!";
                errdesc.innerText = response;
                document.getElementById("overlay").style.display = "block";
                document.getElementsByClassName("popup")[0].classList.add("active"); 
            }
        }
    };
    xhr.send("yetki=" + yetkiValue);
}

