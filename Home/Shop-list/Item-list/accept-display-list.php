<?php
    if(isset($_POST['submit'])){
        $con = mysqli_connect('localhost','root','','Product.inhand');
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }
        
        $decision = $_POST['submit'];
        $lid = $_POST['lid'];
        $total = $_POST['Total'];
        //echo $decision." ".$lid;

        if($decision == "ACCEPT"){
            
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

                    // Non-NULL Initialization Vector for encryption 
                    $encryption_iv = $lid.$rid.$sid.'1234567051098';  


                    // Alternatively, we can use any 16 digit 
                    // characters or numeric for iv 
                    $encryption_key = openssl_digest(php_uname(), 'MD5', TRUE); 
                    //echo $encryption_iv."<br>".$encryption_key."<br>";

                    // Encryption of string process starts 
                    $otp = openssl_encrypt($otp, $ciphering,$encryption_key, $options, $encryption_iv); 
            echo "<br>".$otp;
            $sqlUpdate="UPDATE `List_of_Item` SET `acceptance`=1, `OTP`='".$otp."', `Total`=".$total." WHERE lid=".$lid;
            $result1 = mysqli_query($con,$sqlUpdate);
            
            ?>
            <script>
                alert('Order confirmed');
                window.history.back();
                </script>
            <?php
        }
        else if($decision == "DECLINE"){
            $sql = "DELETE FROM `List_of_Item` WHERE lid=".$lid;

            if ($con->query($sql) === TRUE) {
              ?>
            <script>
                alert('Order cancelled');
                location.replace("http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php");
                </script>
            <?php
            } else {
              echo "Error deleting record: " . $conn->error;
            }
        }
    }
    

?>