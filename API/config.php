<?php

$conn = @mysqli_connect("localhost","root","","chat");
if(!$conn){
    echo "Bir Hata Oluştu ->" . mysqli_connect_error();
}


?>