<?php 
session_start();
if (!isset($_SESSION['unique_id'])) { 
    header("Location: ./login");
}
?>
<?php
include_once "./elements/header.php";
headertitle("Chat");
?>
<body>
   
     <div class="wrapper">
        <section class="chat-area">
          <header>
          <?php 
          
                include_once "./API/config.php";
                $user_id = mysqli_real_escape_string($conn ,$_GET['user_id']);
                $sql = mysqli_query($conn,"SELECT * from users where unique_id = '" . $user_id . "'");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
            ?>
            <a href="./menu" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            <img src="/img/<?php echo $row['u5_img']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['u5_usname']; ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
            
        </header>
        <div class="chat-box">        
                
        </div>
        
        <form action="#" class="typing-area">
            <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id'] ?>" id="" hidden>
            <input type="text" name="incoming_id" value="<?php echo $user_id ?>" id="" hidden>
            <input type="text" class="gonder" name="gonder" placeholder="Bir Şeyler Yaz...">
            <button><i class="fab fa-telegram-plane"></i></button>

        </form>
        </section>
     </div>
</body>
<script src="/js/chat.js"></script>
</html>