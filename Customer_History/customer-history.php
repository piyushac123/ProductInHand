<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>SHOPKEEPER HISTORY</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="customer-history.css">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
            
            .hist-Text{
                margin-Top:20px;
            }
            .trans-row{
                font-family:'Times New Roman', Times, serif;padding:10px;
            }
            .trans-row:hover{
                font-family:'Times New Roman', Times, serif;padding:10px;
                background-color: #eee;
            }
        </style>
        <script>
            setTimeout(reloadFunc,20000);
            function reloadFunc(){
                location.reload();
            }
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="customer-history.js"></script>
        <script src="../common/common.js"></script>
    </HEAD>
    <BODY style="overflow-x:hidden;">
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
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <ul class="nav nav-pills" style="float: right;z-index: 0;margin-top:50px;">
    <!--                  <li><a href="../../feedback/feedback.html" class="pills-features">FEEDBACK</a></li>-->
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
        <?php
            $sql = "select * from List_of_Item where rid=".$rid;
            $result = mysqli_query($con,$sql);
            $value = "";
             
            $arrList = array();
            $flagList = 0;
            while($row = mysqli_fetch_array($result)){
                $flagList = 1;
               $arrList1 = array();
                array_push($arrList1,$row['lid']);array_push($arrList1,$row['rid']);array_push($arrList1,$row['sid']);array_push($arrList1,$row['Item_name']);array_push($arrList1,$row['Item_price']);array_push($arrList1,$row['Item_size']);array_push($arrList1,$row['Item_quantity']);array_push($arrList1,$row['acceptance']);array_push($arrList1,$row['Status']);array_push($arrList1,$row['Total']);array_push($arrList1,$row['DATE']);array_push($arrList1,$row['TIME']);array_push($arrList1,$row['completion']);
                
                array_push($arrList,$arrList1);
            }
            
            $arrFrom = array();
        for($i=0;$i<count($arrList);$i++){
            $arrFrom1= array();
            $sql = "select * from Registration where rid=(select rid from Shopkeeper where sid=".$arrList[$i][2].")";
            $result = mysqli_query($con,$sql);
            $value = "";
             
            
            while($row = mysqli_fetch_array($result)){
                array_push($arrFrom1,$row['Name']);array_push($arrFrom1,$row['Username']);array_push($arrFrom1,$row['Phone_number']);
            }
//            for($i=0;$i<count($arrFrom1);$i++){
//                echo $arrFrom1[$i]." ";
//            }
//            echo "<br>";
            array_push($arrFrom,$arrFrom1);
        }
//        for($i=0;$i<count($arrFrom);$i++){
//            for($j=0;$j<count($arrFrom[$i]);$j++){
//                echo $arrFrom[$i][$j]." ";
//            }
//            echo "<br>";
//        }
//        for($i=0;$i<count($arrList);$i++){
//            for($j=0;$j<count($arrList[$i]);$j++){
//                echo $arrList[$i][$j]." ";
//            }
//            echo "<br>";
//        }
            
        if($flagList == 1){
        ?>
        
        <form method="post" action="customer-receipt.php"> 
        <div class="container">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-6"><h1 style="font-family: 'Aclonica';font-weight:bold;">Customer History</h1></div>
            </div>
            <?php
            for($i=count($arrList)-1;$i>=0;$i--){
            ?>
                <div class="row trans-row" style="margin-bottom:10px;" id="<?php echo 'row_'.$i; ?>">
                    <div class="col-lg-3"><img src="../images/history-logo.png" alt="logo" style="border:2px solid black; padding:5px; border-radius:12px; height:100px;width:100px; background-color:white;"></div>
                    <div class="col-lg-3"><h4><div class="hist-Text"><b>Shopkeeper : </b><?php echo $arrFrom[$i][1];?></div><div class="hist-Text"><b>Total Cost : </b><?php echo "Rs. ".$arrList[$i][9]; ?></div></h4></div>
                    <div class="col-lg-3"><h4><div class="hist-Text"><b>Transaction date : </b><?php echo $arrList[$i][10];?></div><div class="hist-Text"><b>Transaction time : </b><?php echo $arrList[$i][11];?></div></h4></div>
                    <div class="col-lg-3">
                        <h4><div class="hist-Text"><b>Status :<br></b>
                        <?php 
                            if($arrList[$i][7] == 0 && $arrList[$i][8] == 0){
                                echo "<span style='color:red;'>Transaction started</span>";
                            }
                            else if($arrList[$i][7] == 0 && $arrList[$i][8] == 1){
                                echo "<span style='color:blue;'>Waiting for Acceptance</span>";
                            }
                            else if($arrList[$i][7] == 1 && $arrList[$i][12] == 0){
                                echo "<span style='color:#9400d3;'>Order confirmed</span>";
                            }
                            else if($arrList[$i][12] == 1){
                                echo "<span style='color:green;'>Transaction completed</span>";
                            }
                        ?></div>
                            </h4>
                        <div><button type="submit" name="row_num[]" value="<?php echo $arrList[$i][0];?>">Explore</button></div>
                    </div>
                
            </div>
            <?php
                }
                ?>
        </div>
            </form>
        <?php
        }
        else{ echo "Transaction History doesn't exist";}
        ?>
        
        <div class="jumbotron jumbotron-fluid">
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
        
        <!--Start For Login-->   
        <div id="login-box" class="login-popup">
            <a href="#" class="close"><i style="font-size:24px" class="fa btn_close">&#xf00d;</i></a>
            <h3 class="titlelog">Login Page</h3>
            <form method="post" class="signin" action="../Home/login.php">
                <fieldset>
                    <span><input type="text" name="username" class="input1" placeholder="Enter username"></span>
                    <span><input type="password" name="password" class="input1" placeholder="Enter password"></span><br>
                    <input type="reset" value="RESET" class="button1">
                    <input type="submit" value="SUBMIT" name="signin" class="button1"><br>
                <a class="forgot" href="../Home/forgotPassword.php">Forgot your password?</a>
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