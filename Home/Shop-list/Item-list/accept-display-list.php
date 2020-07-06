<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php
    if(isset($_POST['submit'])){
        
        
        $decision = $_POST['submit'];
        $lid = $_POST['lid'];
        $total = $_POST['Total'];
        //echo $decision." ".$lid;

        if($decision == "ACCEPT" || $decision == "स्वीकार"){
            
            $sql = "select sid,rid from List_of_Item where lid =".$lid;
            $result = mysqli_query($con,$sql);
            
            
            $sid =0;
            $rid =0;
            while($row = mysqli_fetch_array($result)){
                $sid = $row['sid'];
                $rid = $row['rid'];
            }
            //echo $sid." ".$rid;
            
            $otp = rand(100000,999999);
            //echo $otp;
            
            // Store the cipher method 
                    $ciphering = "AES-128-CTR";  

                    // Use OpenSSl encryption method 
                    $iv_length = openssl_cipher_iv_length($ciphering); 
                    $options = 0; 
                    //echo $iv_length."<br>";
                    
                    $temp = 10;
                    // Non-NULL Initialization Vector for encryption 
                    $encryption_iv = fmod($lid,$temp).fmod($rid,$temp).fmod($sid,$temp).'1234567051098';  


                    // Alternatively, we can use any 16 digit 
                    // characters or numeric for iv 
                    $encryption_key = openssl_digest(php_uname(), 'MD5', TRUE); 
                    //echo $encryption_iv."<br>".$encryption_key."<br>";

                    // Encryption of string process starts 
                    $otp = openssl_encrypt($otp, $ciphering,$encryption_key, $options, $encryption_iv); 
            //echo "<br>".$otp;
            $commision =0;
            if($total>50 && $total<=1000){
                $commision = 0.02*$total;
            }
            else if($total>1000){
                $commision = 20;
            }
            $sqlUpdate="UPDATE `List_of_Item` SET `acceptance`=1, `OTP`='".$otp."', `Total`=".$total.", `Commision`=".$commision." WHERE lid=".$lid;
            $result1 = mysqli_query($con,$sqlUpdate);
            
            ?>
            <script>
                alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Order confirmed'; }else{echo 'ऑर्डर की पुष्टि की गई'; }}else{echo 'Order confirmed';}?>');
                window.history.back();
                </script>
            <?php
        }
        else if($decision == "DECLINE" || $decision == "इनकार"){
            $sql = "DELETE FROM `List_of_Item` WHERE lid=".$lid;

            if ($con->query($sql) === TRUE) {
              ?>
            <script>
                alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Order cancelled'; }else{echo 'ऑर्डर रद्द किया गया'; }}else{echo 'Order cancelled';}?>');
                location.replace("http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php");
                </script>
            <?php
            } else {
              echo "Error deleting record: " . $conn->error;
            }
        }
    }
    

?>