<?php
session_start();
include "config.php";
@$userid = $_GET['userid'];
if($userid == "undefined"){
    echo "Lütfen Bir UserID tanımlayın.";
}
else{
    if (isset($_POST['yetki'])) {
        @$newYetki = $_POST['yetki'];
    
        $updateQuery = mysqli_query($conn,"UPDATE users SET yetki = '$newYetki' WHERE unique_id = $userid");
        if($updateQuery){
            echo "başarılı";
        }
        else{
            echo "başarısız";
        }
    
    }
}