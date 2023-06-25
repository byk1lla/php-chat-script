<?php 

header('Content-Type: text/html; charset=UTF-8');
while(@$row = mysqli_fetch_assoc($sql)){
    @$sql2 = "SELECT * FROM messages WHERE (msg_outgoing_id = ". $row['unique_id'] ." 
    AND msg_incoming_id = ". $outgoing_id . ") OR 
    (msg_outgoing_id = ". $outgoing_id . " AND msg_incoming_id = ". $row['unique_id'] .") ORDER BY msg_id DESC LIMIT 1 ";
    
    @$query2 = mysqli_query($conn,$sql2);
    
    
    if(mysqli_num_rows(@$query2) > 0){
        @$row2 = mysqli_fetch_assoc($query2);
        $result = $row2['msg_context'];
    }
    else{
        $result = "<b>Mesaj Kutusu Boş.</b>";
    }
    (strlen(@$result) > 28) ? @$msg = substr(@$result , 0 ,28) . '...' : @$msg = @$result;
    (@$outgoing_id == @$row2['msg_outgoing_id'] ? $you = "Siz: " : $you = "");
    ($row['status'] == "Çevrimdışı") ? $offline = "offline" : $offline = "";
    @$output .= " <a href='/chat?user_id=" . @$row['unique_id'] . "'>
    <div class='content'>
        <img src='/img/". $row['u5_img']. "' alt=''>
        <div class='details'>
            <span>".$row['u5_usname'] ."</span>
            <p>$you $msg</p>
        </div>
    </div>
    <div class='status-dot " . $offline. " '><i class='fas fa-circle'></i></div>
</a>";
}

?>