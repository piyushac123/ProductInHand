<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php
        

        if(isset($_POST['signup'])){
                $name= $_POST['name'];
                $username= $_POST['username'];
                $phone= $_POST['phone'];
                $password= $_POST['password'];
                //echo $phone+456,"\n";
                
                if($name && $username && $password){
                #If preg_match = false, then return NULL(1) or else, then return empty string(0)
                    //echo $fname,$mname,$lname,$password,$phone,"\n";
                    //echo preg_match('/[^a-zA-Z0-9\s\-_\.\?\@\']/',$fname)." ".preg_match('/[^a-zA-Z0-9\s\-_\.\?\@\']/',$mname)." ".preg_match('/[^a-zA-Z0-9\s\-_\.\?\@\']/',$lname)." ".preg_match('/[^a-zA-Z0-9\s\-_\.\?\@\']/',$password)."\n";
                if(preg_match('/[^a-zA-Z]/',$name) || preg_match('/[^a-zA-Z0-9\s\-_\.\?]/',$username) || preg_match('/[^a-zA-Z0-9\s\-_\.\?\@]/',$password)){
                    ?>
                    <script>
                        alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Only letter, number, dash, underscore question mark and periods are allowed.'; }else{echo 'केवल अक्षर, संख्या, डैश, अंडरस्कोर प्रश्न चिह्न और अवधि सम्मिलित की जा सकती है'; }}else{echo 'Only letter, number, dash, underscore question mark and periods are allowed.';}?>");
                        window.history.back();
                    </script>
                    <?php
                }
                else{
                    #file_put_contents('credential.txt', "hello\n", FILE_APPEND | LOCK_EX);
                    # file_put_contents(file, data, mode, context)
                    # filter_var(var, filtername, options)
                    #FILTER_SANITIZE_STRING - filter any tag in var
                    #FILE_APPEND - go to end of file
                    #LOCK_EX - lock the file
                   
                    // Store the cipher method 
                    $ciphering = "AES-128-CTR";  

                    // Use OpenSSl encryption method 
                    $iv_length = openssl_cipher_iv_length($ciphering); 
                    $options = 0; 
                    //echo $iv_length."<br>";

                    // Non-NULL Initialization Vector for encryption 
                    $encryption_iv = $phone.'051098';  
                    //echo $encryption_iv;

                    // Alternatively, we can use any 16 digit 
                    // characters or numeric for iv 
                    $encryption_key = openssl_digest(php_uname(), 'MD5', TRUE); 
                    //echo $encryption_iv."<br>".$encryption_key."<br>";

                    // Encryption of string process starts 
                    $password = openssl_encrypt($password, $ciphering, 
                            $encryption_key, $options, $encryption_iv); 

                    // Display the encrypted string 
                    //echo "Encrypted String: " . $password . "<br>";
                    file_put_contents('credential.txt',filter_var($name,FILTER_SANITIZE_STRING)."\n".filter_var($username,FILTER_SANITIZE_STRING)."\n".filter_var($phone,FILTER_SANITIZE_STRING)."\n".filter_var($password,FILTER_SANITIZE_STRING), FILE_APPEND | LOCK_EX);
                    
                    $arr = array();

            $dat = file_get_contents('credential.txt');
            #explode - split
            #FILTER_SANITIZE_FULL_SPECIAL_CHARS - remove special characters
            foreach(explode("\n",$dat) as $rec){
                array_push($arr, filter_var($rec, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            }

            unlink("credential.txt");
                
                //echo $fname.$lname.$email.$password.$channel;
        
//                $sqlupdate="UPDATE `Registration` SET `Flag`=0 WHERE 1";
//                    if ($con->query($sqlupdate) === FALSE) {
//                    echo "Error: " . $sqlupdate . "<br>" . $con->error;
//                    }

                //mysqli_select_db($con,"ajax_demo");
                $name="'".$arr[0]."'";
                $username1= "'".$arr[1]."'";
                    $username= $arr[1];
                $phone= "'".$arr[2]."'";
                $password= "'".$arr[3]."'";
                    
                    //echo $name,$username,$phone,$password,"<br>";
                
                $sql="INSERT INTO Registration (`Name`,`Username`, `Registration_date`,`Phone_number`,`Customer_type`,`Password`)
                VALUES ($name,$username1,NOW(),$phone,'C',$password)";

                if ($con->query($sql) === FALSE) {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }else{
                    
                       $token = getToken(10);
                       $_SESSION['Username'] = $username;
                       $_SESSION['token'] = $token;
                    $_SESSION['Username']." ".$_SESSION['token'];
                        // Update user token 
                        $sql_token = "select token from user_token where Username='".$username."'";
                       $result_token = mysqli_query($con, $sql_token);
                       //$row_token = mysqli_fetch_assoc($result_token);
                    $flagPresent = 0;
                    while($row = mysqli_fetch_array($result_token)){
                        $flagPresent = 1;
                       
                }
                    if($flagPresent==1){
                           //echo "a";
                        mysqli_query($con,"update user_token set token='".$token."' where Username='".$username."'");
                       }
                        else{   
                            //echo "b";
                        mysqli_query($con,"insert into user_token(Username,token) values('".$username."','".$token."')");
                       }
                   ?>
                    <script>
                        alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Created your account Successfully'; }else{echo 'आपका अकाउंट सफलतापूर्वक बनाया गया'; }}else{echo 'Created your account Successfully';}?>");
                        window.history.back();
                    </script>
                    <?php 
                }
                }
            }
            
            
            }


        if(isset($_POST['signin'])){
            $user= $_POST['username'];
            $pass= $_POST['password'];
            
            if($user && $pass){
                #If preg_match = false, then return NULL(1) or else, then return empty string(0)
                if(preg_match('/[^a-zA-Z0-9\s\-_\.\?]/',$user) || preg_match('/[^a-zA-Z0-9\s\-_\.\?\@]/',$pass)){
                    ?>
                    <script>
                        alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Only letter, number, dash, underscore question mark and periods are allowed.'; }else{echo 'केवल अक्षर, संख्या, डैश, अंडरस्कोर प्रश्न चिह्न और अवधि सम्मिलित की जा सकती है'; }}else{echo 'Only letter, number, dash, underscore question mark and periods are allowed.';}?>");
                        window.history.back();
                    </script>
                    <?php
                }
                else{
                    #file_put_contents('credential.txt', "hello\n", FILE_APPEND | LOCK_EX);
                    # file_put_contents(file, data, mode, context)
                    # filter_var(var, filtername, options)
                    #FILTER_SANITIZE_STRING - filter any tag in var
                    #FILE_APPEND - go to end of file
                    #LOCK_EX - lock the file
                    file_put_contents('credential.txt',filter_var($user,FILTER_SANITIZE_STRING)."\n".filter_var($pass,FILTER_SANITIZE_STRING), FILE_APPEND | LOCK_EX);
                }
            }
            
            $arr = array();

            $dat = file_get_contents('credential.txt');
            #explode - split
            #FILTER_SANITIZE_FULL_SPECIAL_CHARS - remove special characters
            foreach(explode("\n",$dat) as $rec){
                array_push($arr, filter_var($rec, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            }

            unlink("credential.txt");
            /*for($i=0;$i<count($arr);$i++){
                echo $arr[$i]."\n";
            }*/
            
            $sql="select Username,Password,Phone_number from Registration";
            $result = mysqli_query($con,$sql);
            $flag=0;
            while($row = mysqli_fetch_array($result)){
                
                // Store the cipher method 
                $ciphering = "AES-128-CTR";  

                // Use OpenSSl encryption method 
                $iv_length = openssl_cipher_iv_length($ciphering); 
                $options = 0;
                
                // Non-NULL Initialization Vector for encryption
                $phone = $row['Phone_number'];
                    $decryption_iv = $phone.'051098';
                //echo $decryption_iv."<br>";

                // Store the decryption key 
                $decryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

                // Descrypt the string 
                $password_dec = $row['Password'];
                $decryption = openssl_decrypt($password_dec, $ciphering, $decryption_key, $options, $decryption_iv);
                //echo $decryption;
                //echo $row['Username']." ".$arr[0]." ".$decryption." ".$arr[1]." ".$row['Password']."<br>";
                
                if($row['Username']==$arr[0] && $decryption==$arr[1]){
                    $flag=1;
                    //echo "Enter";
//                        $sql1="UPDATE `Registration` SET `Flag`=1 WHERE Username='".$arr[0]."' AND Password='".$password_dec."'";
//                     $result1 = mysqli_query($con,$sql1);
//                     $sqlupdate="UPDATE `Registration` SET `Flag`=0 WHERE Username<>'".$arr[0]."' AND Password<>'".$password_dec."'";
//                     $result2 = mysqli_query($con,$sqlupdate);
                    $result = mysqli_query($con, "SELECT token FROM user_token where Username='".$arr[0]."'");
                     if (mysqli_num_rows($result) > 0) {
                         //echo 'b';
                         $row = mysqli_fetch_array($result); 
                        $token = $row['token'];
                         //echo $_SESSION['token']," ",$token,"<br>";
                             //echo 'c';
                             $token = getToken(10);
                             $_SESSION['Username'] = $arr[0];
                            $_SESSION['token'] = $token;
                             mysqli_query($con,"update user_token set token='".$token."' where Username='".$arr[0]."'");
                     }
                    else{
                        //echo 'a';
                        $token = getToken(10);
                           $_SESSION['Username'] = $arr[0];
                           $_SESSION['token'] = $token;
                        mysqli_query($con,"insert into user_token(Username,token) values('".$arr[0]."','".$token."')");
                    }
                    ?>
                    <script>
                        alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Logged In Successfully'; }else{echo 'सफलतापूर्वक लॉग इन हो चुका है'; }}else{echo 'Logged In Successfully';}?>");
                        window.history.back();
                    </script>
                    <?php
                       break;
                    }
                }
                
            if($flag!=1&&$user!=''&&$pass!='')
                {
                ?>
                <script>
                    alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Match not found'; }else{echo 'मैच नहीं मिला'; }}else{echo 'Match not found';}?>");
                    window.history.back();
                </script>
                <?php
                }
            else if($flag!=1){
                ?>
                <script>
                    alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Match not found'; }else{echo 'मैच नहीं मिला'; }}else{echo 'Match not found';}?>");
                window.history.back();
                </script>
            <?php
            }
        }
        // Generate token
            function getToken($length){
             $token = "";
             $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
             $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
             $codeAlphabet.= "0123456789";
             $max = strlen($codeAlphabet); // edited

             for ($i=0; $i < $length; $i++) {
              $token .= $codeAlphabet[random_int(0, $max-1)];
             }

             return $token;
            }
        mysqli_close($con);
        
        ?>