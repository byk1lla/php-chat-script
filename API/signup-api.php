<?php
    
    include_once "config.php";
    include_once "functions.php";
    @$ad = mysqli_real_escape_string($conn,$_POST['ad']);
    @$soyad = mysqli_real_escape_string($conn,$_POST['soyad']);
    @$mail = mysqli_real_escape_string($conn,$_POST['mail']);
    @$kadi = mysqli_real_escape_string($conn,$_POST['kadi']);
    @$paswd = mysqli_real_escape_string($conn,$_POST['passwd']);
    @$dg = mysqli_real_escape_string($conn,$_POST['dg']);
    
    $dg_components = explode('.', $dg);
    @$year = $dg_components[2];

    if(!empty($ad) && !empty($soyad) && !empty($mail) && !empty($paswd) && !empty($kadi)){
        if(filter_var($mail,FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn,"SELECT u5_email	 FROM  users WHERE u5_email	= '$mail'");
            if(mysqli_num_rows($sql) > 0){
                echo "$mail - Böyle Bir Mail Adresi Zaten Mevcut!";
            }
            
            else{
                $sqlkadi = mysqli_query($conn,"SELECT u5_usname	 FROM  users WHERE u5_usname= '$kadi'");

                if(mysqli_num_rows($sqlkadi) > 0){
                    echo "$kadi - Böyle Bir Kullanıcı Zaten Mevcut.\nLütfen Tekrar Deneyin.";
                }
                else
                {
                if($year > 2005){
                    echo "Platformu Kullanabilmek İçin 18 Yaşında Olmalısınız!";
                }
                else if($year < 1960) {
                    echo "Platformu Kullanmak İçin Biraz Fazla Yaşlı Değil Misiniz?";
                }
                else{   
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $img_explode = explode(".",$img_name);
                    $img_ext = end($img_explode);
                    $extentions = ['png','jpeg','jpg','gif'];
                    $user_id = rand(19999,1999);
                    if(in_array($img_ext,$extentions) === true){
                        $time = date("Y-m-d");
                        $hashedpasswd =md5($paswd);
                        $img_new_name = $time."-". $user_id . "-".$img_name;
                       
                        if(move_uploaded_file($tmp_name,"../img/".$img_new_name)){
                            $status = "Çevrimiçi";
                            $userd = genereateID();
                            $registered_time = date("Y-m-d");
                            $ipadd = $_SERVER['REMOTE_ADDR'];
                            $addusersql = mysqli_query($conn,"INSERT INTO users (unique_id,u5_fname,u5_lname, u5_birthday	, u5_email ,u5_registered_time , u5_usname, u5_passwd, u5_img, u5_ipadd, status)
                                                            VALUES($userd,'$ad','$soyad','$dg','$mail','$registered_time','$kadi','$hashedpasswd','$img_new_name','$ipadd','$status')");
                        
                        if($addusersql){
                            $getuserinfo = mysqli_query($conn,"SELECT * from users Where u5_email = '$mail'");
                            if($getuserinfo){
                                
                                $row = mysqli_fetch_assoc($getuserinfo);
                                $_SESSION['unique_id'] = $row['unique_id'];
                                
                                echo "başarılı";
                                
                            }
                        }else{
                            echo "Bir Hata Oluştu!";
                        }
                        
                    }                     
                    }
                    
                    else{
                        echo "Lütfen png,gif,jpeg veya jpg Uzantılı Bir Dosya Yükleyin.";
                    }
                }
                else{
                    echo "Lütfen Bir Profil Fotoğrafı Yükleyin.";
                }
            }}
            }
        }
        else{
            echo "$mail - Bu Bir Mail Adresi Değil!";
        }
    }
    else{
        echo "Lütfen Alanları Doldurun.";
    }
    
?>