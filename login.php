<?php 
if(isset($_SESSION['unique_id'])){
    header("Location: ./menu");
}
include_once "./elements/header.php";
headertitle("Giriş Yap");
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
        <section class="form login">
            <header>Giriş Yap - Connectopia</header>
            <form action="#">
                <div class="error-txt"></div>
                
            
            
            <div class="field input">
                <label for="giris">Kullanıcı Adı</label>
                <input type="text" name="inp" id="gir" placeholder="Kullanıcı Adı" required>
            </div>
            <div class="field input">
                <label for="passwd">Şifre</label>
                <input type="password" name="password" id="sif" placeholder="Şifre" required>
                <i class="fas fa-eye"></i>
            </div>
            
            <div class="field button">
                <input type="submit" value="Giriş Yap">
            </div>
            
            </form>
            <div class="link">Hesabın Yok mu? <a href="./register">Kayıt Ol</a>.</div>
        </section>
     </div>
     <script src="/js/sifre-goster-gizle.js"></script>
     <script src="/js/login.js"></script>
</body>
</html>