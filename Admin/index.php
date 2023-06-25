<?php 
include "../API/config.php";
session_start();
if(!isset($_SESSION["unique_id"])){
    header("Location: ../hata/401");
    
}
$usid = $_SESSION["unique_id"];
$getuser = mysqli_query($conn,"SELECT yetki from users WHERE unique_id = $usid");

$userinfo = mysqli_fetch_assoc($getuser);

$yetki = $userinfo["yetki"];
if($yetki == "user"){
    header("Location: ../hata/403");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/chat.css">
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Connectopia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow-x: hidden;
            overflow-y: hidden;
            background: #212121;
        }

    .wrapper {
            background: #fff;
            width: 95%;
            height: 850px;
            flex-direction: column;
            box-shadow: 0 0 128px 0 rgba(255, 255, 255, 0.5),
                0 32px 64px -48px rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            padding: 20px;
        }

        .h1user {
            text-align: center;
            margin-bottom: 20px;
        }

        .tableuser {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .selectUser {
            width: 400px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .usermanage {
            padding: 10px;
            overflow: auto;
        }
        

    </style>

</head>
<body>
    <div id="overlay"></div>
    <div class="wrapper">
    <div class="boo">
            
            <a href="../menu"><i class="fas fa-arrow-left" id="icnmenu"></i></a>
            
            </div>
        <div class="ust">
    <div class="user">
    <?php 
    $getuser = mysqli_query($conn, "SELECT u5_usname, u5_img FROM users WHERE unique_id = $usid");
    $getq = mysqli_fetch_assoc($getuser);
    $us = $getq["u5_usname"];
    $imgtmp = $getq["u5_img"];

    if($yetki == "admin"){
        $yet = "Admin";
    }
    else if($yetki == "mod"){
        $yet ="Moderatör";
    }
    ?>
    <button class="avatar-button" href="#">
        <img class="avatar-image" src="../img/<?php echo $imgtmp?>" alt="User Image">
    </button>
    <div class="user-info">
        <h4><?php echo $us ?></h4>
        <h6><?php echo ucfirst($yet)?></h6>
    </div>
</div>

        <span class="baslik"><h1 class='h1user'>Yönetim Paneli</h1></span>
      
</div>
      
        
        <div class="popup center">
    <div class="icon" id="is">
      <i id='ic' class=""></i>
    </div>
    <div class="title" id='tic'>
    </div>
    <div class="description" id='dic'>
    </div>
    <div class="dismiss-btn">
      <button id="dismiss-popup-btn">
        Tamam
      </button hidden >
    </div>
  </div>
  <div class="bottom-right">

  </div>
        <div class="usermanage">
            <table class="tableuser" id="tableuser">
                <thead>
                    <tr>
                        <th>UID</th>
                        <th>Adı</th>
                        <th>Soyadı</th>
                        <th>Doğum Tarihi</th>
                        <th>E-Mail Adresi</th>
                        <th>Hesap Açılış Tarihi</th>
                        <th>Kullanıcı Adı</th>
                        <th>IP Adresi</th>
                        <th>Durumu</th>
                        <th>Yetki</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$yetkiOptions = array('admin', 'mod', 'user');
$sql = mysqli_query($conn, "SELECT * FROM users");

while ($row = mysqli_fetch_assoc($sql)) {
    $formattedTime = date("d/m/Y", strtotime($row['u5_registered_time']));
    $dg = date("d/m/Y", strtotime($row['u5_birthday']));
    $username = $row['u5_usname'];
    $userid = $row['unique_id'];

    echo "<tr>
            <td id='annen31'> " . $row['unique_id'] . "</td>
            <td> " . $row['u5_fname'] . "</td>
            <td> " . $row['u5_lname'] . "</td>
            <td> " . $dg . "</td>
            <td> " . $row['u5_email'] . "</td>
            <td> " . $formattedTime . "</td>
            <td> " . $row['u5_usname'] . "</td>
            <td> " . $row['u5_ipadd'] . "</td>
            <td> " . $row['status'] . "</td>
            <td>
                <select class='form-select' id='yetki' name='yetki' onchange='updateYetki(this.value,\"$userid\")'>";
    
    foreach ($yetkiOptions as $option) {
        if ($row['yetki'] == $option) {
            echo "<option value='". $option . "' selected> ".$option . " </option>";
        } else {
            echo "<option value='$option'>$option</option>";
        }
    }

    echo "</select>
        </td>
        <td>
            <button onmouseover='change31(this)' onmouseout='return31(this);' id='open-popup-btn hoverbtn' class='btn btn-outline-danger
            ' onclick='confirmDelete(\"$username\",\"$userid\")'>Sil</button>
        </td>
    </tr>";
}
?>
                </tbody>
            </table>
           
        </div>
       

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <script src="./app.js">
</script>
</body>
</html>
