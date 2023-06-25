<?php 
session_start();
if (!isset($_SESSION['unique_id'])) { 
    header("Location: ./login");
    
}
include_once "./elements/header.php";
headertitle("Ana Sayfa");
?>
<style src="./css/main.css"></style>
<body>
     <div class="wrapper">
        <section class="users">
          <header>
          <?php 
                include_once "./API/config.php";
                $sql = mysqli_query($conn,"SELECT * from users where unique_id = '" . $_SESSION['unique_id'] . "'");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
                $getyetki = mysqli_query($conn,"SELECT yetki FROM users where unique_id = ". $_SESSION["unique_id"] ."");
                if(mysqli_num_rows($getyetki)){
                    $ytki = mysqli_fetch_assoc($getyetki);
                    $yet = $ytki["yetki"];
                }
            ?>
            <div class="content">
                <img src="/img/<?php echo $row['u5_img']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['u5_usname']; ?></span>
                    <p><?php echo $row['status']; ?></p>
                    <?php if($yet == "admin"){
                        echo "<p>". "Admin" ."</p>";
                    }
                    else if($yet == "mod"){
                        echo "<p>". "Moderatör" ."</p>";
                    }
                    else{
                        echo "Standart Kullanıcı";
                    }
                    ?>
                    
                </div>
            </div>
            
        <?php 
        if($yet == "admin" || $yet == "mod"){
            ?>
            <a title="Çıkış Yap" href="./logout?id=<?php echo $_SESSION['unique_id'];?>" class="logout"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #ffffff;"></i></a>
                <a title="Yönetim Paneli" class='admn' href='./Admin'><i class='fa-solid fa-user-group' style='color: #ffffff;'></i></a>
            <?php 
        }
        else{
        ?>
        <a title="Çıkış Yap" href="./logout?id=<?php echo $_SESSION['unique_id'];?>" class="logout"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #ffffff;"></i></a>
            <?php }?>
    </header>
        <div class="search">
            <span class="text">Sohbete Başlamak İçin Bir Kullanıcı Arat!</span>
            <input type="text" name="search" id="" placeholder="Kullanıcı Ara...">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list">
    </div>
    </section>
     
<script src="/js/user.js"></script>
    </body>
</html>