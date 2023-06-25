<?php 

session_start();

include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn,"SELECT * from users where NOT unique_id = $outgoing_id");
$output = "";
if(mysqli_num_rows($sql) == 0){
    $output .= "Çevrimiçi Kullanıcı Bulunamadı!";
}
else if(mysqli_num_rows($sql) > 0){
    include_once "data-api.php";
}
echo $output;
?>