<?php 

session_start();
include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];
$term = mysqli_real_escape_string($conn ,$_POST['searchTerm']);
$output = "";
$sql = mysqli_query($conn,"SELECT * from users where NOT unique_id = $outgoing_id AND u5_usname LIKE '%$term%' ");
if(mysqli_num_rows($sql) > 0){
    include_once "data-api.php";
}
else{
    $output .= "Aradığınız Kullanıcı Bulunamadı."; 
}
echo $output;

?>