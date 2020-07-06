<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>SHOP DETAILS</TITLE>
        <link rel="stylesheet" href="shop-detail.css">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="../libraries/3.4.1-bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
            .time{
                width:50px;
            }
            
        </style>
        
        <script src="../libraries/3.5.1-jquery.min.js"></script>
        <script src="shop-detail.js"></script>
        <script src="../common/common.js"></script>
        
    </HEAD>
    <BODY>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/header.php');?>
        <script>
            function validateCheckbox(){
            if($('div.checkbox-group-payment.required :checkbox:checked').length == 0 || $('div.checkbox-group-day.required :checkbox:checked').length == 0){
                    alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Fill input in Checkbox'; }else{echo 'चेकबॉक्स में इनपुट भरें'; }}else{echo 'Fill input in Checkbox';}?>');
                    return false;
            }
            else if(flag==0){
                alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Login as a user before Shopkeeper Registration !'; }else{echo 'दुकानदार पंजीकरण से पहले एक उपयोगकर्ता के रूप में लॉगिन करें!'; }}else{echo 'Login as a user before Shopkeeper Registration !';}?>');
                return false;
            }
                return true;
            }
            
        </script>
<!--
        <div id="Log"></div>
        <button onclick="document.getElementById('Log').innerHTML='<h1>'+flag+'</h1>'">Button</button>
-->
        <?php 
        
        ?>  
        
        <?php if(isset($_SESSION['Username'])){
        if($_SESSION['token'] == $token){
            
            $flagToken = 0;
        $flagShop = 0;
        $arrShop = array();
        if(isset($_SESSION['Username'])){
        if($_SESSION['token'] == $token){
            $flagToken = 1;
            $sql = "select * from Shopkeeper where rid=".$rid;
            $result = mysqli_query($con,$sql);
             
            
            
            while($row = mysqli_fetch_array($result)){
                $flagShop = 1;
                array_push($arrShop,$row['sid']);array_push($arrShop,$row['Shop_name']);array_push($arrShop,$row['Shop_type']);array_push($arrShop,$row['Shop_photo']);array_push($arrShop,$row['Shop_certificate']);array_push($arrShop,$row['Email']);array_push($arrShop,$row['rating']);array_push($arrShop,$row['opening_time']);array_push($arrShop,$row['closing_time']);array_push($arrShop,$row['open_days']);array_push($arrShop,$row['current_open_status']);array_push($arrShop,$row['mode_of_payments']);array_push($arrShop,$row['Address']);array_push($arrShop,$row['Area']);array_push($arrShop,$row['Landmark']);array_push($arrShop,$row['City']);array_push($arrShop,$row['State']);array_push($arrShop,$row['Country']);array_push($arrShop,$row['Pincode']);array_push($arrShop,$row['Activation']);
            }
        
//        for($i=0;$i<count($arrShop);$i++){
//            echo $arrShop[$i]." ";
//        }
            if($flagShop){
        $ohr = substr($arrShop[7],0,2);
        if($ohr>12){
            $ohr-=12;
            $oam = "PM";
        }
        else{
            $oam = "AM";
        }
        $omin = substr($arrShop[7],3,2);
        $chr = substr($arrShop[8],0,2);
        if($chr>12){
            $chr-=12;
            $cam = "PM";
        }
        else{
            $cam = "AM";
        }
        $cmin = substr($arrShop[8],3,2);
        //echo $arrShop[3]." ".$arrShop[4];
            }
        }
        }
        if($flagToken==0 || $flagShop==0){
            for($i=0;$i<20;$i++){
                $arrShop[] = NULL;
            }
        }
        ?>
        <form method="post" action="accept-shop-detail.php" enctype="multipart/form-data" onsubmit="return validateCheckbox()">
        <div class="container">
            <div class="row">
                <div class="col-20"></div>
                <div class="col-60">
                    <h1 style="font-weight:bold;"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo "Shopkeeper's Registration"; }else{echo "दुकानदार का पंजीकरण"; }}else{echo "Shopkeeper's Registration";}?></h1>
                </div>
            </div>
            <div id="section1">
                <div class="row">
                <h4><i><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo '* fields are mandatory'; }else{echo '* फ़ील्ड अनिवार्य हैं'; }}else{echo '* fields are mandatory';}?></i></h4><br>
                    </div>
            <div class="row">
                <div class="col-lg-6">
                    <label style="margin-top:25px;"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Shop Name'; }else{echo 'दुकान का नाम'; }}else{echo 'Shop Name';}?>*</label><br>
                    <input type="text" name="name" class="input1" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Shop Name'; }else{echo 'दुकान का नाम'; }}else{echo 'Shop Name';}?>" value="<?php echo $arrShop[1];?>" required><br>
                    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Business type'; }else{echo 'व्यापार के प्रकार'; }}else{echo 'Business type';}?>*</label><br>
                    <input type="radio" name="business" class="business" id="grocery" value="grocery and essentials" <?php if($arrShop[2]=='grocery and essentials'){echo " checked ";}?>required>
                    <label for="grocery"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Grocery and Essentials'; }else{echo 'किराने और आवश्यक वस्तुएं'; }}else{echo 'Grocery and Essentials';}?></label><br>
                    <input type="radio" name="business" class="business" id="medicine" value="medicine" <?php if($arrShop[2]=='medicine'){echo " checked ";}?>>
                    <label for="medicine"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Medicine'; }else{echo 'दवाइयाँ'; }}else{echo 'Medicine';}?></label><br>
                    <input type="radio" name="business" class="business" id="book" value="books and stationary" <?php if($arrShop[2]=='books and stationary'){echo " checked ";}?>>
                    <label for="book"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Books and stationary'; }else{echo 'पुस्तकें और स्टेशनरी'; }}else{echo 'Books and stationary';}?></label><br>
                    <input type="radio" name="business" class="business" id="gift" value="gift and lifestyle" <?php if($arrShop[2]=='gift and lifestyle'){echo " checked ";}?>>
                    <label for="gift"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Gift and Lifestyle'; }else{echo 'उपहार और जीवन शैली'; }}else{echo 'Gift and Lifestyle';}?></label><br>
                    </form>
                    
                    <label style="margin-top:25px;"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Email ID'; }else{echo 'ईमेल आईडी'; }}else{echo 'Email ID';}?></label><br>
                    <input type="email" name="email" class="input1" placeholder="abc@xyz.com" value="<?php echo $arrShop[5];?>"><br>
                    
                    <div class="checkbox-group-day required">
                        <label><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Open days'; }else{echo 'सक्रिय होने वाले दिन'; }}else{echo 'Open days';}?>*</label><br>
                        <input type="checkbox" id="day1" name="day1" value="Monday" <?php if(strpos($arrShop[9],'1')!== false){echo " checked ";}?>>
                        <label for="day1"> <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Monday'; }else{echo 'सोमवार'; }}else{echo 'Monday';}?></label><br>
                        <input type="checkbox" id="day2" name="day2" value="Tuesday" <?php if(strpos($arrShop[9],'2')!== false){echo " checked ";}?>>
                        <label for="day2"> <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Tuesday'; }else{echo 'मंगलवार'; }}else{echo 'Tuesday';}?></label><br>
                        <input type="checkbox" id="day3" name="day3" value="Wednesday" <?php if(strpos($arrShop[9],'3')!== false){echo " checked ";}?>>
                        <label for="day3"> <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Wednesday'; }else{echo 'बुधवार'; }}else{echo 'Wednesday';}?></label><br>
                        <input type="checkbox" id="day4" name="day4" value="Thursday" <?php if(strpos($arrShop[9],'4')!== false){echo " checked ";}?>>
                        <label for="day4"> <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Thursday'; }else{echo 'गुरूवार'; }}else{echo 'Thursday';}?></label><br>
                        <input type="checkbox" id="day5" name="day5" value="Friday" <?php if(strpos($arrShop[9],'5')!== false){echo " checked ";}?>>
                        <label for="day5"> <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Friday'; }else{echo 'शुक्रवार'; }}else{echo 'Friday';}?></label><br>
                        <input type="checkbox" id="day6" name="day6" value="Saturday" <?php if(strpos($arrShop[9],'6')!== false){echo " checked ";}?>>
                        <label for="day6"> <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Saturday'; }else{echo 'शनिवार'; }}else{echo 'Saturday';}?></label><br>
                        <input type="checkbox" id="day7" name="day7" value="Sunday" <?php if(strpos($arrShop[9],'7')!== false){echo " checked ";}?>>
                        <label for="day7"> <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Sunday'; }else{echo 'रविवार'; }}else{echo 'Sunday';}?></label><br>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <?php if($arrShop[3]==NULL){?>
                    <label style="margin-top:25px;"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Shop Photo'; }else{echo 'दुकान की फोटो'; }}else{echo 'Shop Photo';}?>*</label><br>
                    <input type="file" name="photo"><br>
                    <i><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Only jpeg,png,jpg images allowed of upto 2MB'; }else{echo 'केवल jpeg, png, jpg और 2MB तक की छवियों की अनुमति है'; }}else{echo 'Only jpeg,png,jpg images allowed of upto 2MB';}?></i>
                    <div style="margin-bottom:25px;"></div>
                    <?php }if($arrShop[4]==NULL){?>
                    <label><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Shop Certificate'; }else{echo 'दुकान का प्रमाण पत्र'; }}else{echo 'Shop Certificate';}?>*</label><br>
                    <input type="file" name="certificate"><br>
                    <i><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Only jpeg,png,jpg images allowed of upto 2MB'; }else{echo 'केवल jpeg, png, jpg और 2MB तक की छवियों की अनुमति है'; }}else{echo 'Only jpeg,png,jpg images allowed of upto 2MB';}?></i>
                    <div style="margin-bottom:25px;"></div>
                    <?php }?>
                    <label><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Opening time'; }else{echo 'खुलने का समय'; }}else{echo 'Opening time';}?>*</label><br>
                    <i class='far fa-clock'></i>
                    
                    <input type="number" max="12" min="1" name="otime1" value="<?php echo $ohr;?>" class="time" required><b> :</b>
                    <input type="number" max="60" min="0" name="otime2" value="<?php echo $omin;?>" class="time" required>
                    <select id="12-hour-clock" name="am1" required>
                        <?php
                            if($oam == 'AM'){
                                ?>
                                <option value="AM" selected="selected">AM</option>
                                <option value="PM">PM</option>
                                <?php
                            }
                            else{
                                ?>
                                <option value="AM">AM</option>
                                <option value="PM" selected="selected">PM</option>
                                <?php
                            }
                        ?>
                      
                    </select>
                    
                    <div style="margin-bottom:25px;"></div>
                    
                    <label><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Closing time'; }else{echo 'बंद करने का समय'; }}else{echo 'Closing time';}?>*</label><br>
                    <i class='far fa-clock'></i>
                    <input type="number" max="12" min="1" name="ctime1" value="<?php echo $chr;?>" class="time" required><b> :</b>
                    <input type="number" max="60" min="0" name="ctime2" value="<?php echo $cmin;?>" class="time" required>
                    <select id="12-hour-clock" name="am2" required>
                      <?php
                            if($cam == 'AM'){
                                ?>
                                <option value="AM" selected="selected">AM</option>
                                <option value="PM">PM</option>
                                <?php
                            }
                            else{
                                ?>
                                <option value="AM">AM</option>
                                <option value="PM" selected="selected">PM</option>
                                <?php
                            }
                        ?>
                    </select>
                    
                    <div style="margin-bottom:25px;"></div>
                    
                    <div class="checkbox-group-payment required">
                        <label><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Payment options'; }else{echo 'भुगतान विकल्प'; }}else{echo 'Payment options';}?>*</label><br>
                        <input type="checkbox" id="payment1" name="payment1" value="Cash" <?php if(strpos($arrShop[11],'1')!== false){echo " checked ";}?>>
                        <label for="payment1"> <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Cash payment'; }else{echo 'नकद भुगतान'; }}else{echo 'Cash payment';}?></label><br>
                        <input type="checkbox" id="payment2" name="payment2" value="Card" <?php if(strpos($arrShop[11],'2')!== false){echo " checked ";}?>>
                        <label for="payment2"> <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Debit/Credit Card'; }else{echo 'डेबिट / क्रेडिट कार्ड'; }}else{echo 'Debit/Credit Card';}?></label><br>
                        <input type="checkbox" id="payment3" name="payment3" value="UPI" <?php if(strpos($arrShop[11],'3')!== false){echo " checked ";}?>>
                        <label for="payment3"> <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'UPI Payment'; }else{echo 'UPI भुगतान'; }}else{echo 'UPI Payment';}?></label><br>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3"><h3><b><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Address details'; }else{echo 'पते का विवरण'; }}else{echo 'Address details';}?></b></h3></div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label style="margin-top:25px;"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Address Line 1'; }else{echo 'पता लाइन 1'; }}else{echo 'Address Line 1';}?>*</label><br>
                    <input type="text" name="address1" class="input2" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Plot number, Colony or Street name'; }else{echo 'प्लॉट नंबर, कॉलोनी या सड़क का नाम'; }}else{echo 'Plot number, Colony or Street name';}?>"  value="<?php echo $arrShop[12];?>" required><br>
                    <label><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Address Line 2'; }else{echo 'पता लाइन 2'; }}else{echo 'Address Line 2';}?>*</label><br>
                    <input type="text" name="address2" class="input2" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Area'; }else{echo 'क्षेत्र'; }}else{echo 'Area';}?>"  value="<?php echo $arrShop[13];?>" required><br>
                    <label><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Landmark'; }else{echo 'सीमा चिन्ह'; }}else{echo 'Landmark';}?>*</label><br>
                    <input type="text" name="landmark" class="input2" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Nearby famous spot'; }else{echo 'निकट का प्रसिद्ध स्थान'; }}else{echo 'Nearby famous spot';}?>"  value="<?php echo $arrShop[14];?>" required><br>
                    <label><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'City'; }else{echo 'शहर'; }}else{echo 'City';}?>*</label><br>
                    <input type="text" name="city" class="input2" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Enter City'; }else{echo 'शहर का नाम'; }}else{echo 'Enter City';}?>"  value="<?php echo $arrShop[15];?>" required><br>
                </div>
                <div class="col-lg-6">
                    <label style="margin-top:25px;"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'State'; }else{echo 'राज्य'; }}else{echo 'State';}?>*</label><br>
                    <input type="text" name="state" class="input2" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Enter State'; }else{echo 'राज्य का नाम'; }}else{echo 'Enter State';}?>"  value="<?php echo $arrShop[16];?>" required><br>
                    <label><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Country'; }else{echo 'देश'; }}else{echo 'Country';}?>*</label><br>
                    <input type="text" name="country" class ="input2" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Enter Country'; }else{echo 'देश का नाम'; }}else{echo 'Enter Country';}?>"  value="<?php echo $arrShop[17];?>" required><br>
                    <label><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Pincode/Zipcode'; }else{echo 'पिनकोड / ज़िपकोड'; }}else{echo 'Pincode/Zipcode';}?>*</label><br>
                    <input type="number" min="100000" max="999999" name="pincode" class="input2 hide-spinner" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Pincode or Zipcode'; }else{echo 'पिनकोड या ज़िपकोड'; }}else{echo 'Pincode or Zipcode';}?>"  value="<?php echo $arrShop[18];?>" required><br>
                </div>

            </div>
<!--
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <center style="font-size:20px;">
                        <span><b>Step 1 of 3</b></span>
                        <span id="step1"><span class="glyphicon glyphicon-chevron-right" style="cursor:pointer"></span></span>
                    </center>
                </div>
            </div>
-->
            </div>
            <div id="section3">
                <div class="row" style="font-family:'Aclonica';">
                        <h3 style="font-weight:bold;">Terms and Conditions</h3>
                            <ol>
                                <li style="font-size:15px;">Register as a User before Shopkeeper Registration.</li>
                                <li style="font-size:15px;">Always inform about Availability by Activating Available button.</li>
                                <li style="font-size:15px;">Customer is provided with 'Decline' service for Cancellation of Order, so, can't blame Company or Customer.</li>
                                <li style="font-size:15px;">Try to check Order History to check Status of Order and interact with Customers.</li>
                                <li style="font-size:15px;">Section and Item Name will be displayed as per added to previous step.</li>
                                <li style="font-size:15px;">Each Order will charge certain amount of money. Following are charging rates -
                                    <ul>
                                        <li>If Bill<=50, then No charges.</li>
                                        <li>If Bill>50 and Bill<=1000, then 2% of Bill will be charged.</li>
                                            <li>If Bill>1000 and Bill<=2000, then 5% of Bill will be charged.</li>
                                        <li>If Bill>2000, then 5% of 2000 = Rs. 100 will be charged.</li>
                                    </ul>
                                </li>
                                <li style="font-size:15px;">Commision payment will take place monthly via UPI Payment. Shopkeeper will be given a payment period of 5 days, else Shopkeeper account will be inactivated.</li>
                                <li style="font-size:15px;">Each one will get 15-days trial period at start.</li>
                                <li style="font-size:15px;">Any update in information can be done by accessing 'Add shop details' section.</li>
                                <li style="font-size:15px;">For any query you can refer to 'Help and Support' section or even Contact us.</li>
                            </ol>
                        
                </div>
                <div class="row">
                    
                    <input type="checkbox" name="agreement" id="agreement" <?php if($flagShop){echo " checked ";}?>required>
                    <label for="agreement"><h4><b>I agree to Terms and Conditions</b></h4></label>
                </div>
<!--
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <center style="font-size:20px;">
                            <span id="step3"><span class="glyphicon glyphicon-chevron-left" style="cursor:pointer"></span></span>
                            <span><b>Step 3 of 3</b></span>
                        </center>
                    </div>
                </div>
    -->
                    <div class="row">
                    <input type="submit" name="submitShop" class="button1" value="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'SUBMIT'; }else{echo 'सब्मिट'; }}else{echo 'SUBMIT';}?>">
                </div>
            </div>
        </div>
            
        </form>
        <?php }
    else{
        ?>
        <script>
            alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Login as a registered user'; }else{echo 'एक पंजीकृत उपयोगकर्ता के रूप में लॉगिन करें'; }}else{echo 'Login as a registered user';}?>");
            window.history.back();
        </script>
        <?php
    }

}
        else{
        ?>
        <script>
            alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Login as a registered user'; }else{echo 'एक पंजीकृत उपयोगकर्ता के रूप में लॉगिन करें'; }}else{echo 'Login as a registered user';}?>");
            window.history.back();
        </script>
        <?php
    }
        
        ?>
        
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/footer.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/register.php');?>
        
    </BODY>
</HTML>