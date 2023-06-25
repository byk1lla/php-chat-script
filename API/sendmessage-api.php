<?php

session_start();
if(isset($_SESSION['unique_id'])){
    include_once "config.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id'] ?? '');
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id'] ?? '');
    $message = strip_tags(mysqli_real_escape_string($conn, $_POST['gonder'] ?? ''));
    
    $msgdate = date("Y-m-d");
    $msgtime = date("H:m");
    
    if(!empty($message)){
        $sql = "INSERT INTO messages (msg_outgoing_id, msg_incoming_id, msg_context, msg_date, msg_time)
                VALUES ($outgoing_id, $incoming_id, '$message', '$msgdate', '$msgtime')";
        $result = mysqli_query($conn, $sql);
        
    }
    
} else {
    header("Location: ./login");
}


?>
