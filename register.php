<?php 
session_start();
if(isset($_SESSION['unique_id'])){
    header("Location: ./menu");
}
include_once "./elements/header.php";
headertitle("Kayıt Ol");

?>

<body>
<div id="overlay"></div>
     <div class="wrapper">
     <div class="popup center">
    <div class="icon" id="is">
      <i id='ic' class="otuzbir"></i>
    </div>
    <div class="title" id='tic'>
    </div>
    <div class="description" id='dic'>
    </div>
    <div class="dismiss-btn">
      <button id="dismiss-popup-btn">
        Tamam
      </button>
    </div>
  </div>
        <section class="form signup">
            <header>Kayıt Ol - Connectopia</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="success-txt"></div>
                <div class="name-details">
                <div class="field input">
                <label for="ad">Ad</label>
                <input type="text" name="ad"  placeholder="Adınız" required>
            </div>
            <div class="field input">
                <label for="soyad">Soyad</label>
                <input type="text" name="soyad"  placeholder="Soydınız" required>
            </div></div>
            <div class="field input">
                <label for="dg">Doğum Tarihiniz</label>
                <input type="text" name="dg" placeholder="Örneğin 01.02.2003" required maxlength="10" pattern="\d{2}\.\d{2}\.\d{4}"title="Lütfen Buraya Bir Tarih Girin">

            </div>
            <div class="field input">
                <label for="mail">E-Posta</label>
                <input type="email" name="mail"  placeholder="Örneğin connectopia@connectopia.com" required>
            </div>
            <div class="field input">
                <label for="kadi">Kullanıcı Adı</label>
                <input type="text" name="kadi"  placeholder="Örneğin: proÖrdek2005" required>
            </div>
            <div class="field input">
                <label for="passwd">Şifre</label>
                <input type="password" name="passwd"  placeholder="Şifre" required>
                <i class="fas fa-eye"></i>
            </div>
            
            <div class="field image">
                <label for="getFile">Profil Fotoğrafı Seçin</label>
                <input type='file'class="custom-file-input" id="getFile"  name="image" required>
            </div>
            <div class="field button">
                <input type="submit" value="Kayıt Ol">
            </div>
            
            </form>
            <div class="link">Zaten Kayıtlı Mısın? <a href="./login">Giriş Yap</a>.</div>
        </section>
     </div>
</body>
<script src="./js/signup.js"></script>
<script src="./js/sifre-goster-gizle.js"></script>
</html>