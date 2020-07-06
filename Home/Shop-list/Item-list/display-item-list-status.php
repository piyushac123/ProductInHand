<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>CART</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../home.css">
        <link rel="stylesheet" href="../../../common/common.css">
        <link rel="stylesheet" href="../../../libraries/3.4.1-bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
            .hist-Text{
                margin-Top:20px;
            }
            .nothing{
                text-shadow: 2px 2px 5px black;
                color:#bbb;
                background-color: #eee;
                border:1px solid #eee;
                padding-left:40%;
                padding-right:40%;
                padding-top:20%;
                padding-bottom:20%;
                font-size: 35px;
                text-align: center;
            }
            @media screen and (max-width:600px){
                .nothing{
                    text-shadow: 2px 2px 3px black;
                    color:#bbb;
                    background-color: #eee;
                    border:1px solid #eee;
                    padding-left:40%;
                    padding-right:40%;
                    padding-top:20%;
                    padding-bottom:20%;
                    font-size: 25px;
                    text-align: center;
                }
            }
        </style>
        <script src="../../../libraries/3.5.1-jquery.min.js"></script>
        <script>
            setTimeout(reloadFunc,20000);
            function reloadFunc(){
                location.reload();
            }
            function showSection1(){
                document.getElementById("section0").style.display ="none";
                document.getElementById("section1").style.display ="block";
                document.getElementById("section2").style.display ="none";
                document.getElementById("section3").style.display ="none";
            }
            function hideSection1(){
                document.getElementById("section0").style.display ="none";
                document.getElementById("section1").style.display ="none";
                document.getElementById("section2").style.display ="block";
                document.getElementById("section3").style.display ="none";
            }
            function showOtp(){
                document.getElementById("section0").style.display ="none";
                document.getElementById("section1").style.display ="none";
                document.getElementById("section2").style.display ="none";
                document.getElementById("section3").style.display ="block";
            }
            function hideSection123(){
                document.getElementById("section0").style.display ="block";
                document.getElementById("section1").style.display ="none";
                document.getElementById("section2").style.display ="none";
                document.getElementById("section3").style.display ="none";
            }
            function generateOTP(){
                document.getElementById('display-otp').style.display = "block";
            }
        </script>
        <script src="../../home.js"></script>
        <script src="../../../common/common.js"></script>
    </HEAD>
    <BODY>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php" class="link2">
                    <img src="../../../images/bagLogo.jpg" alt="logo" class="logoImg">
                    <span class="logoText margin1">Product.InHand</span>
                    </a>
                </div>
<!--
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <ul class="nav nav-pills" style="float: right;z-index: 0;margin-top:50px;">
                      <li><a href="../../feedback/feedback.html" class="pills-features">FEEDBACK</a></li>
                        <?php
                            $sql = "select rid,Username from Registration where Username='".$_SESSION['Username']."'";
                            $result = mysqli_query($con,$sql);
                            $value = "";
                        
                            while($row = mysqli_fetch_array($result)){
                                $value = $row['Username'];
                                $rid = $row['rid'];
                            }
                            $sql = "select token from user_token where Username='".$_SESSION['Username']."'";
                                $result = mysqli_query($con,$sql);
                                $token = "";
                                while($row = mysqli_fetch_array($result)) {
                                   $token = $row['token'];
                                }
                            if($value == ""){
                                ?>
                                <li id="sec4" class="sec4"><a href="#register-box" class="login-window">Signup</a></li>
                                <li id="sec5" class="sec5"><a href="#login-box" class="login-window">Login</a></li>
                                <?php
                            }
                            else{
                                ?>
                                <li id="sec6" class="sec6"><a href="../../logout.php" style="text-decoration:none;"><acronym title="SIGN OUT">
                                <?php
                                //echo $value;
                                ?>
                                </acronym></a></li>
                                <?php
                            }
                            
                        ?>
                        <li><img src="../../../images/cart-clipart2.png" alt="cart" style="width:50px;height:50px;margin-top:-5px;cursor:pointer">CART</li>
                  </ul>
                </div>
-->
            </div>
        </div>
        <?php if($_SESSION['token']==$token){?>
        <form method="post" action="accept-display-list.php">
        <div class="container">
            <div id="section0" style="display:block;">
                <div class="row">
                    <div class="nothing">
                        
                        <?php 
                            if(isset($_SESSION['Language'])){
                                if($_SESSION['Language']=='English'){
                                        echo "No transaction "; 
                                }else{
                                 echo "कोई व्यवहार नहीं"; 
                                    }
                                    }
                                    else{
                                        echo "No transaction"; 
                                    }
                        ?>
                    </div>
                </div>
            </div>
            <div id="section1" style="display:block;">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8" style="font-family:'Aclonica'; ">
                    <img src="../../../images/loading.gif" alt="loading" align="center">
                    <h2 style="margin:10px;">
                        <?php 
                            $flagLang = 0;
                            if(isset($_SESSION['Language'])){
                                if($_SESSION['Language']=='English'){
                                        echo "Processing Input ..."; 
                                }else{
                                 echo "दुकानदार से संवाद करने की कोशिश कर रहा है ..."; 
                                 $flagLang=1;
                                    }
                                    }
                                    else{
                                        echo "Processing Input ..."; 
                                    }
                        ?>
                    </h2>
                    <h4 style="margin:10px;"><?php if(!$flagLang){echo "It will take few minutes to gain Shopkeeper's response";}?></h4>
                    <h4 style="margin:10px;"><?php if(!$flagLang){echo "Stay on same Page";}else{echo "इसी पेज पर बने रहें";}?></h4>
                </div>
            </div>
            <div class="row">
                    <?php
                            $sql1 = "select * from List_of_Item where rid=".$rid." AND ratingStatus=0";
                            $result1 = mysqli_query($con,$sql1);
                            $flagList =0;
                            $arr = array();
                            while($row1 = mysqli_fetch_array($result1)){
                                $flagList = 1;
                                $arr1 = array();
                                
                                array_push($arr1,$row1['Item_quantity']);
                                array_push($arr1,$row1['Status']);
                                array_push($arr1,$row1['lid']);
                                array_push($arr1,$row1['Total']);
                                array_push($arr1,$row1['acceptance']);
                                array_push($arr1,$row1['completion']);
                                array_push($arr1,$row1['OTP']);
                                array_push($arr1,$row1['sid']);
                                array_push($arr1,$row1['ratingStatus']);
                                array_push($arr1,$row1['Arrival_span']);
                                array_push($arr1,$row1['Item_info']);
                                
                                array_push($arr,$arr1);
                            }
//                for($i=0;$i<count($arr);$i++){
//                    echo $arr[$i]." ";
//                }
                //for($j=0;$i<count($arr);$j++){
                    $arrName = array();
                    $arrPrice = array();
                    $arrWeight = array();
                    $arrCount = json_decode($arr[0][0]);
                    $arrStatus = $arr[0][1];
                    $arrLid = $arr[0][2];
                    $arrTotal = $arr[0][3];
                    $arrAcceptance = $arr[0][4];
                    $arrCompletion = $arr[0][5];
                    $arrOTP = $arr[0][6];
                    $arrSid = $arr[0][7];
                    $rating = $arr[0][8];
                $arrive = $arr[0][9];
                    $arrItem = json_decode($arr[0][10]);
                $arrCommodity = array();
                for($i=0;$i<count($arrItem);$i++){
                    $temp = 0;
                    //echo $arrItem[$i]."<br>";
                    foreach(explode("-",$arrItem[$i]) as $rec){
                        //echo strpos($rec,"->");
                        $temp = $rec; 
                    }
                    array_push($arrCommodity,$temp);
                }
                $cid = '';
                for($i=0;$i<count($arrCommodity);$i++){
                    $sql1 = "select * from Commodity where commodity_id = ".$arrCommodity[$i];
                            $result1 = mysqli_query($con,$sql1);
                            while($row1 = mysqli_fetch_array($result1)){
                                if($flagLang){
                                    array_push($arrName,$row1['hcommodity_name']);
                                    }
                                    else{
                                        array_push($arrName,$row1['commodity_name']);
                                    }
                                
                                array_push($arrWeight,$row1['commodity_size']);
                                array_push($arrPrice,$row1['commodity_price']);
                            }
                }
                
                        
                
//               for($i=0;$i<count($arrName);$i++){
//                   echo $arrName[$i]." ".$arrWeight[$i]." ".$arrPrice[$i]."<br>";
//               }
                
                //echo $arrLid;
                    if($flagLang){$name="नाम";$weight="वजन";$quantity="मात्रा";$price="कीमत";$total="टोटल";$arrival="तक आ जाना";}else{$name="Name";$weight="Weight";$quantity="Quantity";$price="Price";$total="Total";$arrival="Arrive by";}
                    
                    echo "<table class='table table-striped' style='margin-top:20px;'><h4>";
                    if($flagLang){echo "ऑर्डर की जानकारी";}else{echo "Order details";}
                    echo "</h4><tr><th>".$name."</th><th>".$weight."</th><th>".$quantity."</th><th>".$price."</th></tr>";
                    for($i=0;$i<count($arrName);$i++){
                        echo "<tr><td>".$arrName[$i]."</td>";
                        $arrTemp = array();
                        foreach(explode("_",$arrWeight[$i]) as $rec){
                           array_push($arrTemp,$rec);
                        }
                        echo "<td>".$arrTemp[0]." ".$arrTemp[1]."</td>";
                        echo "<td>".$arrCount[$i]."</td><td>Rs. ".$arrPrice[$i]."</td></tr>";
                    }
                echo "<tr><th>".$total."</th><th></th><th></th><th>Rs. ".$arrTotal."</th></tr></table>";
                    ?>
                </div>
            </div>
            <div id="section2" style="display:block;">
                <?php
                
                    echo "<table class='table table-striped' style='margin-top:20px;'><h4>";
                    if($flagLang){echo "ऑर्डर की जानकारी";}else{echo "Order details";}
                    echo "</h4><tr><th>".$name."</th><th>".$weight."</th><th>".$quantity."</th><th>".$price."</th></tr>";
                    for($i=0;$i<count($arrName);$i++){
                        echo "<tr><td>".    $arrName[$i]."</td>";
                        $arrTemp = array();
                        foreach(explode("_",$arrWeight[$i]) as $rec){
                           array_push($arrTemp,$rec);
                        }
                        echo "<td>".$arrTemp[0]." ".$arrTemp[1]."</td>";
                        echo "<td>".$arrCount[$i]."</td><td>Rs. ".$arrPrice[$i]."</td></tr>";
                    }
                echo "<tr><th>".$total."</th><th></th><th></th><th>Rs. ".$arrTotal."</th></tr></table>";
                
                    $sql1 = "select available_quantity,availability from List_of_Item where lid=".$arrLid;
                            $result1 = mysqli_query($con,$sql1);
                            $flag1 =0;
                            while($row1 = mysqli_fetch_array($result1)){
                                $flag1=1;
                                $arr1 = array();
                                array_push($arr1,$row1['available_quantity']);
                                array_push($arr1,$row1['availability']);
                            }
                        if($flag1 == 1){
                            $arravail_quant = $arr1[0];
                            $arrAvailable = $arr1[1];
                            
                            //echo $arravail_quant.' '.$arrAvailable;  
                        }
                $arravail_quant = json_decode($arravail_quant);
                $arrAvailable = json_decode($arrAvailable);
//                for($i=0;$i<count($arrAvailable);$i++){
//                    echo $arrAvailable[$i]." ".$arravail_quant[$i]."<br>";
//                }
                $newarrTotal = 0;
                echo "<table class='table table-striped' style='margin-top:20px;'><h4>";
                if($flagLang){echo "दुकानदार की प्रतिक्रिया";$aq = "उपलब्ध मात्रा";$av = "उपलब्धता";}else{echo "Shopkeeper response";$aq = "Available Quantity";$av = "Availability";}
                echo "</h4><tr><th>".$name."</th><th>".$av."</th><th>".$aq."</th><th>".$price."</th></tr>";
                    for($i=0;$i<count($arrName);$i++){
                        echo "<tr><td>".    $arrName[$i]."</td>";
                        if($arrAvailable[$i] == 1){
                            echo "<td><img src='../../../images/tick-clipart.png' style='height:30px;width:30px;'></td>";
                        }
                        else{
                            echo "<td><img src='../../../images/cross-clipart.jpeg' style='height:30px;width:30px;'></td>";
                        }
                        echo "<td>".$arravail_quant[$i]."</td><td>Rs. ".$arrPrice[$i]."</td></tr>";
                        $newarrTotal += ($arravail_quant[$i]*$arrPrice[$i]);
                    }
                echo "<tr><th>".$total."</th><th></th><th></th><th>Rs. ".$newarrTotal."</th></tr></table><b>".$arrival." : </b>".$arrive;
                ?>
                <div class="row">
                    <center>
                        <input type="number" name="Total" value="<?php echo $newarrTotal;?>" style="display:none;">
                        <input type="number" name="lid" value="<?php echo $arrLid;?>" style="display:none;">
                        <input type="submit" name="submit" value="<?php if($flagLang){echo 'इनकार';}else{echo 'DECLINE';}?>">
                        <input type="submit" name="submit" value="<?php if($flagLang){echo 'स्वीकार';}else{echo 'ACCEPT';}?>">
                    </center>
                </div>
            </div>
            <div id="section3" style="display:block;">
                <div class="row">
                <?php
                    //echo $arrCompletion." ".$arrOTP;
                // Store the cipher method 
                $ciphering = "AES-128-CTR";  

                // Use OpenSSl encryption method 
                $iv_length = openssl_cipher_iv_length($ciphering); 
                $options = 0;
                
                $temp = 10;
//                $ecryptLid = fmod(123,$temp);
//                $ecryptRid = fmod($rid,$temp);
//                $ecryptSid = fmod($arrSid,$temp);
                //echo fmod($arrLid,$temp).fmod($rid,$temp).fmod($arrSid,$temp).$arrLid.$rid.$arrSid;
                // Non-NULL Initialization Vector for encryption
                    $decryption_iv = fmod($arrLid,$temp).fmod($rid,$temp).fmod($arrSid,$temp).'1234567051098';
                //echo $encryptLid.$encryptRid.$encryptSid;
                //echo $decryption_iv."<br>";

                // Store the decryption key 
                $decryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

                // Descrypt the string 
                $OTP = openssl_decrypt ($arrOTP, $ciphering, 
                            $decryption_key, $options, $decryption_iv);
                //echo "<br>".$OTP;
                
                $newarrTotal = 0;
                echo "<table class='table table-striped' style='margin-top:20px;'><h4>";
                if($flagLang){echo "ऑर्डर की पुष्टि";}else{echo "Order confirmed";}
                echo "</h4><tr><th>".$name."</th><th>".$weight."</th><th>".$quantity."</th><th>".$price."</th></tr>";
                    for($i=0;$i<count($arrName);$i++){
                        echo "<tr><td>".    $arrName[$i]."</td>";
                        $arrTemp = array();
                        foreach(explode("_",$arrWeight[$i]) as $rec){
                           array_push($arrTemp,$rec);
                        }
                        echo "<td>".$arrTemp[0]." ".$arrTemp[1]."</td>";
                        echo "<td>".$arravail_quant[$i]."</td><td>Rs. ".$arrPrice[$i]."</td></tr>";
                        $newarrTotal += ($arravail_quant[$i]*$arrPrice[$i]);
                    }
                echo "<tr><th>".$total."</th><th></th><th></th><th>Rs. ".$newarrTotal."</th></tr></table><b>".$arrival." : </b>".$arrive;
                ?>
                    <center style="margin-top:20px;margin-bottom:20px;"><button type="button" onclick="generateOTP()">
                        <?php if(!$flagLang){echo "Generate OTP";}else{echo "OTP देखें";} ?>
                    </button>
                    <div id="display-otp" style="display:none;"><h2><b><?php echo $OTP;?></b></h2>
                        <i>
                             <?php if(!$flagLang){echo "Provide OTP to Shopkeeper";}else{echo "दुकानदार को ओटीपी प्रदान करें";} ?>
                        </i>
                        </div>
                        </center>
                        
                </div>
            </div>
            
            <?php
            //echo $arrLid;
            if($arrStatus == 1 && $flagList == 1 && $arrAcceptance==0){
                ?>
                <script>
                    hideSection1();
                </script>
                <?php
            }
            else if($arrStatus == 0 && $flagList == 1){
                ?>
                <script>
                    showSection1();
                </script>
                
                <?php
            }
            else if($flagList == 1 && $arrAcceptance==1 && $arrCompletion==0){
                ?>
                <script>
                    showOtp();
                </script>
                <?php
            }
            else if($arrCompletion==1 && $rating == 0){
                ?>
                <script>
                    hideSection123();
                    location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Rating/rating.php?lid=<?php echo $arrLid;?>');
                </script>
                <?php
            }
            else{
                ?>
                <script>
                    hideSection123();
                </script>
                <?php
            }
            ?>
        </div>
        </form>
        <?php } 
        include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/footer.php');
        ?>
        
        <!--Start For Login-->   
<!--
        <div id="login-box" class="login-popup">
            <a href="#" class="close"><i style="font-size:24px" class="fa btn_close">&#xf00d;</i></a>
            <h3 class="titlelog">Login Page</h3>
            <form method="post" class="signin" action="../../login.php">
                <fieldset>
                    <span><input type="text" name="username" class="input1" placeholder="Enter username"></span>
                    <span><input type="password" name="password" class="input1" placeholder="Enter password"></span><br>
                    <input type="reset" value="RESET" class="button1">
                    <input type="submit" value="SUBMIT" name="signin" class="button1"><br>
                <a class="forgot" href="../../forgotPassword.php">Forgot your password?</a>
                </fieldset>
            </form>
        </div>
-->
        <!--End For SignUp-->
                <!--Start For Login-->   
<!--
        <div id="register-box" class="login-popup">
            <a href="#" class="close"><i style="font-size:24px" class="fa btn_close">&#xf00d;</i></a>
            <h3 class="titlelog">Create New Account</h3>
            <form method="post" class="signin" action="../../signup.php">
                <fieldset>
                    <input type="text" placeholder="Enter Full Name" class="input1" name="name">
                    <input type="number" placeholder="Enter Phone number" class="input1" name="phone">
                    <input type="text" placeholder="Enter Username" class="input1" name="username">
                    <input type="password" placeholder="Enter Password" class="input1" name="password">
                    <input type="password" placeholder="Re-enter Password" class="input1" name="rpassword">
                    <input type="reset" value="RESET">
                    <input type="submit" value="SUBMIT" name="signup">
                </fieldset>
            </form>
        </div>
-->
        <!--End For SignUp-->
        
        
    </BODY>
</HTML>