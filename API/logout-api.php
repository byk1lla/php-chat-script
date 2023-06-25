<?php

    session_start();
    include "config.php";
    if(isset($_SESSION['unique_id'])){
        $status = "Çevrimdışı";
        $logout_id =  mysqli_real_escape_string($conn,$_GET['id']);
        if(isset($logout_id)){
            $sql = "UPDATE users SET status = '$status' WHERE unique_id = $logout_id";
            mysqli_query($conn,$sql);
            if($sql){
                session_unset();
                session_destroy();
                header("Location: ./login");
            }
            else{
                header("Location: ./menu");
            }
        }
        else{
            header("Location: ./menu");
        }
        
    }
    else{
        header("Location: ./login");
    }
?>