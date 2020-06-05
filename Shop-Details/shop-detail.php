<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>SHOP DETAILS</TITLE>
        <link rel="stylesheet" href="shop-detail.css">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
            .time{
                width:50px;
            }
            /*Hide spinner*/
            /* Chrome, Safari, Edge, Opera */
/*
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
              -webkit-appearance: none;
              margin: 0;
            }
*/

            /* Firefox */
/*
            input[type=number] {
              -moz-appearance: textfield;
            }
*/
        </style>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="shop-detail.js"></script>
        <script src="../common/common.js"></script>
        
    </HEAD>
    <BODY>
        <?php
            $con = mysqli_connect('localhost','root','','Product.inhand');
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php" class="link2">
                    <img src="../images/bagLogo.jpg" alt="logo" class="logoImg">
                    <span class="logoText" style="margin-left: -50px;">SACI</span>
                    </a>
                </div>
                <script> var flag=0;</script>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <ul class="nav nav-pills" style="float: right;z-index: 0;margin-top:50px;">
    <!--                  <li><a href="../feedback/feedback.html" class="pills-features">FEEDBACK</a></li>-->
                        <?php
                            $sql = "select rid,Username from Registration where Flag=1";
                            $result = mysqli_query($con,$sql);
                            $value = "";
                            while($row = mysqli_fetch_array($result)){
                                $value = $row['Username'];
                                $rid = $row['rid'];
                            }
                            if($value == ""){
                                ?>
                        
                                <li id="sec4" class="sec4"><a href="#register-box" class="login-window">Signup</a></li>
                                <li id="sec5" class="sec5"><a href="#login-box" class="login-window">Login</a></li>
                                <?php
                            }
                            else{
                                ?>
                        <script> flag =1;</script>
                                <li id="sec6" class="sec6"><a href="../Home/logout.php" style="text-decoration:none;"><acronym title="SIGN OUT">
                                <?php
                                echo $value;
                                ?>
                                </acronym></a></li>
                                <?php
                            }
                            
                        ?>
                        <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/Shop-list/Item-list/display-item-list-status.php" class="link2"><img src="../images/cart-clipart2.png" alt="cart" style="width:50px;height:50px;margin-top:-5px;cursor:pointer">CART</a></li>
                  </ul>
                </div>
            </div>
        </div>
        <script>
            function validateCheckbox(){
            if($('div.checkbox-group-payment.required :checkbox:checked').length == 0 || $('div.checkbox-group-day.required :checkbox:checked').length == 0){
                    alert('Fill input in Checkbox');
                    return false;
            }
            else if(flag==0){
                alert('Login as a user before Shopkeeper Registration!');
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
            $sql = "select * from Shopkeeper where rid=".$rid;
            $result = mysqli_query($con,$sql);
             
            $arrShop = array();
            $flagShop = 0;
            while($row = mysqli_fetch_array($result)){
                $flagShop = 1;
                array_push($arrShop,$row['sid']);array_push($arrShop,$row['Shop_name']);array_push($arrShop,$row['Shop_type']);array_push($arrShop,$row['Shop_photo']);array_push($arrShop,$row['Shop_certificate']);array_push($arrShop,$row['Email']);array_push($arrShop,$row['rating']);array_push($arrShop,$row['opening_time']);array_push($arrShop,$row['closing_time']);array_push($arrShop,$row['open_days']);array_push($arrShop,$row['current_open_status']);array_push($arrShop,$row['mode_of_payments']);array_push($arrShop,$row['Address']);array_push($arrShop,$row['Area']);array_push($arrShop,$row['Landmark']);array_push($arrShop,$row['City']);array_push($arrShop,$row['State']);array_push($arrShop,$row['Country']);array_push($arrShop,$row['Pincode']);array_push($arrShop,$row['Activation']);
            }
//        for($i=0;$i<count($arrShop);$i++){
//            echo $arrShop[$i]." ";
//        }
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
        ?>
        <?php
        ?>
        <form method="post" action="accept-shop-detail.php" enctype="multipart/form-data" onsubmit="return validateCheckbox()">
        <div class="container">
            <div class="row">
                <div class="col-20"></div>
                <div class="col-60">
                    <h1 style="font-weight:bold;">Shopkeeper's Registration</h1>
                </div>
            </div>
            <div id="section1">
            <div class="row">
                <div class="col-lg-6">
                    <label style="margin-top:25px;">Shop Name*</label><br>
                    <input type="text" name="name" class="input1" placeholder="Full Name" value="<?php echo $arrShop[1];?>" required><br>
                    <label>Business type*</label><br>
                    <input type="radio" name="business" id="grocery" value="grocery and essentials" <?php if($arrShop[2]=='grocery and essentials'){echo " checked ";}?>required>
                    <label for="grocery">Grocery and Essentials</label><br>
                    <input type="radio" name="business" id="medicine" value="medicine" <?php if($arrShop[2]=='medicine'){echo " checked ";}?>>
                    <label for="medicine">Medicine</label><br>
                    <input type="radio" name="business" id="book" value="books and stationary" <?php if($arrShop[2]=='books and stationary'){echo " checked ";}?>>
                    <label for="book">Books and stationary</label><br>
                    <input type="radio" name="business" id="gift" value="gift and lifestyle" <?php if($arrShop[2]=='gift and lifestyle'){echo " checked ";}?>>
                    <label for="gift">Gift and Lifestyle</label><br>
                    
                    <label style="margin-top:25px;">Email ID</label><br>
                    <input type="email" name="email" class="input1" placeholder="abc@xyz.com" value="<?php echo $arrShop[5];?>"><br>
                    
                    <div class="checkbox-group-day required">
                        <label>Open days*</label><br>
                        <input type="checkbox" id="day1" name="day1" value="Monday" <?php if(strpos($arrShop[9],'1')!== false){echo " checked ";}?>>
                        <label for="day1"> Monday</label><br>
                        <input type="checkbox" id="day2" name="day2" value="Tuesday" <?php if(strpos($arrShop[9],'2')!== false){echo " checked ";}?>>
                        <label for="day2"> Tuesday</label><br>
                        <input type="checkbox" id="day3" name="day3" value="Wednesday" <?php if(strpos($arrShop[9],'3')!== false){echo " checked ";}?>>
                        <label for="day3"> Wednesday</label><br>
                        <input type="checkbox" id="day4" name="day4" value="Thursday" <?php if(strpos($arrShop[9],'4')!== false){echo " checked ";}?>>
                        <label for="day4"> Thursday</label><br>
                        <input type="checkbox" id="day5" name="day5" value="Friday" <?php if(strpos($arrShop[9],'5')!== false){echo " checked ";}?>>
                        <label for="day5"> Friday</label><br>
                        <input type="checkbox" id="day6" name="day6" value="Saturday" <?php if(strpos($arrShop[9],'6')!== false){echo " checked ";}?>>
                        <label for="day6"> Saturday</label><br>
                        <input type="checkbox" id="day7" name="day7" value="Sunday" <?php if(strpos($arrShop[9],'7')!== false){echo " checked ";}?>>
                        <label for="day7"> Sunday</label><br>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <label style="margin-top:25px;">Shop Photo*</label><br>
                    <input type="file" name="photo" required><br>
                    <i>Only jpeg,png,jpg images allowed of upto 2MB</i>
                    <div style="margin-bottom:25px;"></div>
                    
                    <label>Shop Certificate*</label><br>
                    <input type="file" name="certificate" required><br>
                    <i>Only jpeg,png,jpg images allowed of upto 2MB</i>
                    <div style="margin-bottom:25px;"></div>
                    
                    <label>Opening time*</label><br>
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
                    
                    <label>Closing time*</label><br>
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
                        <label>Payment options*</label><br>
                        <input type="checkbox" id="payment1" name="payment1" value="Cash" <?php if(strpos($arrShop[11],'1')!== false){echo " checked ";}?>>
                        <label for="payment1"> Cash payment</label><br>
                        <input type="checkbox" id="payment2" name="payment2" value="Card" <?php if(strpos($arrShop[11],'2')!== false){echo " checked ";}?>>
                        <label for="payment2"> Debit/Credit Card</label><br>
                        <input type="checkbox" id="payment3" name="payment3" value="UPI" <?php if(strpos($arrShop[11],'3')!== false){echo " checked ";}?>>
                        <label for="payment3"> UPI Payment</label><br>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3"><h3><b>Address details</b></h3></div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label style="margin-top:25px;">Address Line 1*</label><br>
                    <input type="text" name="address1" class="input2" placeholder="Plot number, Colony and Street name"  value="<?php echo $arrShop[12];?>" required><br>
                    <label>Address Line2*</label><br>
                    <input type="text" name="address2" class="input2" placeholder="Area"  value="<?php echo $arrShop[13];?>" required><br>
                    <label>Landmark*</label><br>
                    <input type="text" name="landmark" class="input2" placeholder="Nearby famous spot"  value="<?php echo $arrShop[14];?>" required><br>
                    <label>City*</label><br>
                    <input type="text" name="city" class="input2" placeholder="Enter City"  value="<?php echo $arrShop[15];?>" required><br>
                </div>
                <div class="col-lg-6">
                    <label style="margin-top:25px;">State*</label><br>
                    <input type="text" name="state" class="input2" placeholder="Enter State"  value="<?php echo $arrShop[16];?>" required><br>
                    <label>Country*</label><br>
                    <input type="text" name="country" class ="input2" placeholder="Enter Country"  value="<?php echo $arrShop[17];?>" required><br>
                    <label>Pincode/Zipcode*</label><br>
                    <input type="number" min="100000" max="999999" name="pincode" class="input2" placeholder="Pincode or Zipcode"  value="<?php echo $arrShop[18];?>" required><br>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <center style="font-size:20px;">
                        <span><b>Step 1 of 3</b></span>
                        <span id="step1"><span class="glyphicon glyphicon-chevron-right" style="cursor:pointer"></span></span>
                    </center>
                </div>
            </div>
            </div>
            <div id="section2">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 style="font-weight:bold;font-family:'Aclonica';">Item Section and List</h3>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-bordered" id="dynamic_add">
                        <tr id="row1">
                            <td><input type="text" name="section[]" placeholder="Enter Item Section" class="name-item1">
                                <table id="dynamic_add_1">
                                    <tr row="row-1-1">
                                        <td><input type="text" name="name-1[]" placeholder="Name" class="name-item1"><br><input type="text" name="weight-1[]" placeholder="Weight" class="name-item1"><select name="unit-1[]"><option value="kilograms">kilograms</option><option value="grams">grams</option><option value="litres">litres</option><option value="millilitres">millilitres</option></select><br><input type="text" name="price-1[]" placeholder="Price" class="name-item1"></td>
                                    </tr>
                                    <tr>
                                        <td><span class="remove-name1" id="1"><i class="fa fa-minus"></i></span><span class="add-name1" id="1"><i class="fa fa-plus"></i></span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="remove-item1" id="remove-item1"><i class="fa fa-minus"></i></span><span class="add-item1" id="add-item1"><i class="fa fa-plus"></i></span></td>
                        </tr>
                    </table>
                    
                </div>
                <script>
            
            var remove_name_arr = [];
                $(document).ready(function(){
                    var i=1;
                    var j=[1];
                        
                   $("#add-item1").click(function(){
                       i++;
                       j.push(1);
                       $("#dynamic_add").find('tr:last').before('<tr id="row'+i+'"><td><input type="text" name="section[]" placeholder="Enter Item Section" class="name-item1"><table id="dynamic_add_'+i+'"><tr id="row-'+i+'-1"><td><input type="text" name="name-'+i+'[]" placeholder="Name" class="name-item1"><br><input type="text" name="weight-'+i+'[]" placeholder="Weight" class="name-item1"><select name="unit-'+i+'[]"><option value="kilograms">kilograms</option><option value="grams">grams</option><option value="litres">litres</option><option value="millilitres">millilitres</option></select><input type="text" name="price-'+i+'[]" placeholder="Price" class="name-item1"></td></tr><tr><td><span class="remove-name1" id="'+i+'"><i class="fa fa-minus"></i></span><span class="add-name1" id="'+i+'"><i class="fa fa-plus"></i></span></td></tr></table></td></tr>');
                   });
                    $(document).on('click','.remove-item1',function(){
                        if(i!=1){
                            $("#row"+i+"").remove();
                            j.pop();
                            i--;
                        }
                    });
                    $(document).on('click','.add-name1',function(){
                        var btn_add_name = $(this).attr("id");
                        j[btn_add_name-1]++;
                        $("#dynamic_add_"+btn_add_name).find('tr:last').before('<tr id="row-'+btn_add_name+'-'+j[btn_add_name-1]+'"><td><input type="text" name="name-'+btn_add_name+'[]" placeholder="Name" class="name-item1"><br><input type="text" name="weight-'+btn_add_name+'[]" placeholder="Weight" class="name-item1"><select name="unit-'+btn_add_name+'[]"><option value="kilograms">kilograms</option><option value="grams">grams</option><option value="litres">litres</option><option value="millilitres">millilitres</option></select><input type="text" name="price-'+btn_add_name+'[]" placeholder="Price" class="name-item1"></td></tr>');
                        
                    });
                    $(document).on('click','.remove-name1',function(){
                        var name_remove = $(this).attr("id");
                        if(j[name_remove-1]!=1){
                            $("#row-"+name_remove+"-"+j[name_remove-1]).remove();
                            j[name_remove-1]--;
                        }
                        
                    });
                });

            </script>
        
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <center style="font-size:20px;">
                            <span id="step2l"><span class="glyphicon glyphicon-chevron-left" style="cursor:pointer"></span></span>
                            <span><b>Step 2 of 3</b></span>
                            <span id="step2r"><span class="glyphicon glyphicon-chevron-right" style="cursor:pointer"></span></span>
                        </center>
                    </div>
                </div>
                
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
                                        <li>If Bill>1000, then 2% of 1000 = Rs. 20 will be charged.</li>
                                    </ul>
                                </li>
                                <li style="font-size:15px;">Commision payment will take place monthly via UPI Payment. Shopkeeper will be given a payment period of 5 days, else Shopkeeper account will be inactivated.</li>
                                <li style="font-size:15px;">Each one will get 15-days trial period at start.</li>
                                <li style="font-size:15px;">Any update in information can be done by accessing 'Add shop details' section.</li>
                                <li style="font-size:15px;">For any query you can refer to 'Help and Support' section or even Contact us.</li>
                            </ol>
                        
                </div>
                <div class="row">
                    <input type="checkbox" name="agreement" id="agreement" required>
                    <label for="agreement"><h4><b>I agree to Terms and Conditions</b></h4></label>
                </div>
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <center style="font-size:20px;">
                            <span id="step3"><span class="glyphicon glyphicon-chevron-left" style="cursor:pointer"></span></span>
                            <span><b>Step 3 of 3</b></span>
                        </center>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" name="submitShop" class="button1" value="SUBMIT">
                </div>
            </div>
        </div>
            
        </form>
        
        <div class="jumbotron jumbotron-fluid" style="margin-top:50px;">
            <div class="container">
                <div class="row">
                    <span class="logoText">SACI</span>
                </div>
                <div class="row">
                    <div class="col-lg-3" style="font-size:20px;margin-top:20px;">
                        <b>Company</b>
                        <ul class="footer-text">
                            <li>About</li>
                            <li>Blogs</li>
                            <li>Partners</li>
                            <li>Suggestion</li>
                            <li>Contact</li>
                        </ul>
                    </div>
                    <div class="col-lg-3" style="font-size:20px;margin-top:20px;">
                        <b>For Shopkeeper</b>
                        <ul class="footer-text">
                            <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Shop-Details/shop-detail.php" class="link2">Add shop details</a></li>
                            <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Shopkeeper_History/shop-history.php" class="link2">Order History</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3" style="font-size:20px;margin-top:20px;">
                        <b>For you</b>
                        <ul class="footer-text">
                            <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Customer_History/customer-history.php" class="link2">Transaction History</a></li>
                            <li>Privacy</li>
                            <li>Terms</li>
                            <li>Security</li>
                            <li>Help and Support</li>
                        </ul>
                    </div>
                    <div class="col-lg-3" style="font-size:20px;margin-top:20px;">
                        <b>Social Links</b><br>
                            <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                              <a href="https://twitter.com/login?lang=en"><i class="fa fa-twitter"></i></a>
                              <a href="https://plus.google.com/discover"><i class="fa fa-google"></i></a>
                              <a href="https://in.linkedin.com/"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <!--Start For Login   -->
        <div id="login-box" class="login-popup">
            <a href="#" class="close"><i style="font-size:24px" class="fa btn_close">&#xf00d;</i></a>
            <h3 class="titlelog">Login Page</h3>
            <form method="post" class="signin" action="../Home/login.php">
                <fieldset>
                    <span><input type="text" name="username" class="input1" placeholder="Enter username"></span>
                    <span><input type="password" name="password" class="input1" placeholder="Enter password"></span><br>
                    <input type="reset" value="RESET" class="button1">
                    <input type="submit" value="SUBMIT" name="signin" class="button1"><br>
                <a class="forgot" href="forgotPassword.php">Forgot your password?</a>
                </fieldset>
            </form>
        </div>
        <!--End For SignUp-->
                <!--Start For Login-->   
        <div id="register-box" class="login-popup">
            <a href="#" class="close"><i style="font-size:24px" class="fa btn_close">&#xf00d;</i></a>
            <h3 class="titlelog">Create New Account</h3>
            <form method="post" class="signin" action="../Home/signup.php">
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
        <!--End For SignUp-->
        
    </BODY>
</HTML>