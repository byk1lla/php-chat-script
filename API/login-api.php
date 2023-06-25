<?php

    session_start();
    include_once "config.php";
    @$kadi = mysqli_real_escape_string($conn,$_POST['inp']);
    @$paswd = mysqli_real_escape_string($conn,$_POST['password']);

    
    if(!empty($kadi) && !empty($paswd)){
        $decryptpasswd = md5($paswd);
        $get = mysqli_query($conn,"SELECT  * from users where u5_passwd = '$decryptpasswd' and  u5_email = '$kadi' OR u5_usname = '$kadi'");
        if(mysqli_num_rows($get) > 0){
            $row = mysqli_fetch_assoc($get);
            $status = "Çevrimiçi";
            
            $sql2 = mysqli_query($conn,"UPDATE users SET status = '$status' WHERE unique_id = ". $row['unique_id'] ." ");
            if($sql2){
                $_SESSION['unique_id'] = $row['unique_id'];
                echo "başarılı";
            } 
        }
        else{
            echo "Girilen Bilgiler Hatalı!";
            
        }
    }
    else{
        echo "Lütfen Bu Alanları Doldurun.";
    }
    
?>