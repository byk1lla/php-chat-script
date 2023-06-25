<?php

session_start();
if(isset($_SESSION['unique_id'])){
    include_once "config.php";
    @$outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id'] ?? '');
    @$incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id'] ?? '');
    $output = "";
    $sql = "SELECT * FROM messages WHERE msg_outgoing_id = $outgoing_id AND msg_incoming_id = $incoming_id OR msg_outgoing_id = $incoming_id  AND msg_incoming_id = $outgoing_id ORDER BY msg_id ";
    @$query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query)){
        while($row = mysqli_fetch_assoc($query)){
            if($row['msg_outgoing_id'] === $outgoing_id){
                $msg_time = date("H:i", strtotime($row['msg_time'])); 
                $output .= '<div class="chat outgoing">
                <div class="details">
                    
                    <p>'. $row['msg_context'] .'
                    <br/>
                    <span class="time">' . $msg_time . '</span>
                    </p>

                    </div>
            </div>';
            }
            else
            {
                $msg_time = date("H:i", strtotime($row['msg_time'])); 
                $output .= '<div class="chat incoming">
                <div class="details">
                    
                    <p>'. $row['msg_context'] .'
                    <br/>
                    <span class="time">' . $msg_time . '</span>
                    </p>

                    </div>
            </div>';
            }
        }
    }
    echo $output;
}
else{
    header("Location: ./login");
}
?>
