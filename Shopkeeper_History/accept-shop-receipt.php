<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php
    
    $lid = $_POST['Lid'];
    
    //echo $lid;

            
            $sql = "select sid,rid,Item_info,OTP from List_of_Item where lid=".$lid;
            $result = mysqli_query($con,$sql);
            $value = "";
            $flag = 0;
             
            while($row = mysqli_fetch_array($result)){
                $flag =1;
                $sid = $row['sid'];
                $rid = $row['rid'];
                $value = $row['Item_info'];
                $value1 = $row['OTP'];
            }
    $value = json_decode($value);
    //echo $value[0]." ".count($value);
    if($flag == 1){
        if(isset($_POST['submitOtp'])){
            $otp = $_POST['otp']; 
            //echo $otp." ".$value1;
            // Store the cipher method 
                $ciphering = "AES-128-CTR";  

                // Use OpenSSl encryption method 
                $iv_length = openssl_cipher_iv_length($ciphering); 
                $options = 0;
                
                $temp=10;
                // Non-NULL Initialization Vector for encryption
                    $decryption_iv = fmod($lid,$temp).fmod($rid,$temp).fmod($sid,$temp).'1234567051098';
                //echo $decryption_iv."<br>";

                // Store the decryption key 
                $decryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

                // Descrypt the string 
                $OTP = openssl_decrypt ($value1, $ciphering, 
                            $decryption_key, $options, $decryption_iv);
                //echo "<br>".$OTP;
            if($otp == $OTP){
                $sqlUpdate="UPDATE `List_of_Item` SET `completion`=1 WHERE lid=".$lid;
                $result1 = mysqli_query($con,$sqlUpdate);
                ?>
                <script>
                    alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Transaction completed'; }else{echo 'लेन-देन पूरा हुआ'; }}else{echo 'Transaction completed';}?>');
                    location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Shopkeeper_History/shop-history.php');
                </script>
            <?php
            }
            else{
                ?>
                <script>
                alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Incorrect OTP'; }else{echo 'गलत OTP'; }}else{echo 'Incorrect OTP';}?>');
                    window.history.back();
                    </script>
                <?php
            }
        }
        else if(isset($_POST['submit'])){
            //echo count($value);
            $arrAvailable = array_fill(0,count($value),"0");
            $arrCount = array_fill(0,count($value),"0");
//            for($i=0;$i<count($arrAvailable);$i++){
//                echo $arrAvailable[$i]." ".$arrCount[$i]."<br>";
//            }

             //echo count($_POST['check'])." ".count($_POST['count']);
            for($i=0;$i<count($_POST['check']);$i++){
                    //echo $_POST['check'][$i]." ".$_POST['count'][$i]." ";
                    $arrAvailable[$_POST['check'][$i]-1] = "1";
                    $arrCount[$_POST['check'][$i]-1] = $_POST['count'][$_POST['check'][$i]-1];
            }
        //    for($i=0;$i<count($arrCount);$i++){
        //        echo $arrAvailable[$i]." ".$arrCount[$i]."<br>";
        //    }
            $arrive = "'".$_POST['arrive']." mins'";
            $available = json_encode($arrAvailable);
            $count = json_encode($arrCount);
            //echo $available." ".$count;

            $sqlUpdate="UPDATE `List_of_Item` SET `available_quantity`='".$count."', `availability`='".$available."', `Arrival_span`=".$arrive.", `Status`=1 WHERE lid=".$lid;
            $result1 = mysqli_query($con,$sqlUpdate);
            ?>
                <script>
                    alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Informed Customer'; }else{echo 'ग्राहक को सूचित किया'; }}else{echo 'Informed Customer';}?>');
                    location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Shopkeeper_History/shop-history.php');
                </script>
            <?php
        }
        
    }
    else{
        ?>
        <script>alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Current Entry was Deleted'; }else{echo 'वर्तमान एंट्री डिलीट कर दी गई'; }}else{echo 'Current Entry was Deleted';}?>');window.history.go(-2);</script>
        <?php
    }

?>