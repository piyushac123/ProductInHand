
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>HOME</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../home.css">
        <link rel="stylesheet" href="../../../common/common.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
            .title-photo{
                height: 500px;
                width:  100%;
                padding:10px;
            }
            .add-photo{
                border:1px solid #eee;
                height: 235px;
                width: 500px;
                background-color: #eee;
                cursor:pointer;
                margin:auto;
                padding:80px 190px 80px 190px;
                font-family:'Aclonica';
            }
            body{
                overflow-x: hidden;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="../../home.js"></script>
        <script src="../../../common/common.js"></script>
    </HEAD>
    <BODY data-spy="scroll" data-target=".nav-pills" data-offset="50">
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
                    <img src="../../../images/bagLogo.jpg" alt="logo" class="logoImg">
                    <span class="logoText" style="margin-left: -50px;">SACI</span>
                    </a>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <ul class="nav nav-pills" style="float: right;z-index: 0;margin-top:50px;">
    <!--                  <li><a href="../../feedback/feedback.html" class="pills-features">FEEDBACK</a></li>-->
                        <?php
                            $sql = "select Username from Registration where Flag=1";
                            $result = mysqli_query($con,$sql);
                            $value = "";
                            while($row = mysqli_fetch_array($result)){
                                $value = $row['Username'];
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
                                echo $value;
                                ?>
                                </acronym></a></li>
                                <?php
                            }
                            
                        ?>
                        <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/Shop-list/Item-list/display-item-list-status.php" class="link2"><img src="../../../images/cart-clipart2.png" alt="cart" style="width:50px;height:50px;margin-top:-5px;cursor:pointer">CART</a></li>
                  </ul>
                </div>
            </div>
        </div>
        <?php
            $sid = $_POST['shop1'];
            $arrSid = array();
            $sqlSid = "select * from Shopkeeper where sid=".$sid;
            $resultSid = mysqli_query($con,$sqlSid);
            while($row = mysqli_fetch_array($resultSid)){
                array_push($arrSid,$row['sid']);array_push($arrSid,$row['rid']);array_push($arrSid,$row['Shop_name']);array_push($arrSid,$row['Shop_type']);array_push($arrSid,$row['Shop_photo']);array_push($arrSid,$row['Shop_certificate']);array_push($arrSid,$row['rating']);array_push($arrSid,$row['opening_time']);array_push($arrSid,$row['closing_time']);array_push($arrSid,$row['open_days']);array_push($arrSid,$row['current_open_status']);array_push($arrSid,$row['mode_of_payments']);array_push($arrSid,$row['Address']);array_push($arrSid,$row['Area']);array_push($arrSid,$row['Landmark']);array_push($arrSid,$row['City']);array_push($arrSid,$row['State']);array_push($arrSid,$row['Country']);array_push($arrSid,$row['Pincode']);
            }
//            for($i=0;$i<count($arrSid);$i++){
//                echo $arrSid[$i]."<br>";
//            } 
            
            $sqlList = "select ratingShopkeeper from Reviews where lid IN (select lid from List_of_Item where sid=".$sid.")";
                $resultList = mysqli_query($con,$sqlList);
                $cntReview = 0;
                $rating = 0;
                while($rowList = mysqli_fetch_array($resultList)){
                    $tmp = $rowList['ratingShopkeeper'];
                    $rating=$rating+$tmp;
                    $cntReview++;
                }
                $rating = $rating/$cntReview;
            $arrRid = array();
            $sqlRid = "select * from Registration where rid=".$arrSid[1];
            $resultRid = mysqli_query($con,$sqlRid);
            while($row = mysqli_fetch_array($resultRid)){
                array_push($arrRid,$row['rid']);array_push($arrRid,$row['Name']);array_push($arrRid,$row['Username']);array_push($arrRid,$row['Phone_number']);
            }
//            for($i=0;$i<count($arrRid);$i++){
//                echo "<br>".$arrRid[$i];
//            }
                
        
            $arrList = array();
            $dat = file_get_contents('../../../Shop-Details/Item-list/'.$arrSid[3].'/'.$arrSid[0].'_'.$arrRid[0].'.txt');
            foreach(explode("\n",$dat) as $rec){
                //echo strpos($rec,"->");
                array_push($arrList, $rec);
                
                
            }
//            for($i=0;$i<count($arrList);$i++){
//                echo $arrList[$i]."<br>";
//            }
        ?>
        <form method="post" action="accept-item-list.php">
            <div class="container">
                <div class="row">
                    <img src="../../../images/Shop_images/parmita-ice-cream.jpg" alt="shop" class="title-photo">
                </div>
                <div class="row" style="margin-left:10px;">
                    <div class="col-lg-6">
                    <h3 style="font-family:'Aclonica';font-weight:bold;"><?php echo $arrSid[2];?></h3>
                    <?php
                    for($i=0;$i<round($rating);$i++){
                        echo "<img src='../../../images/fillStar-clipart.jpg' alt='fill' class='star'>";
                    }
                    for($i=0;$i<5-round($rating);$i++){
                        echo "<img src='../../../images/emptyStar-clipart.png' alt='empty' class='star'>";
                    }
                    ?>
                    
                    <span style="color:red;margin-left:5px;font-size:17px;"><?php echo "<b>".number_format($rating, 2, '.', '')."</b>";?> (<?php echo $cntReview;?> reviews)</span>
                        </div>
                    <div class="col-lg-6"><input type="submit" class="button1" name="submitList" style="float:right;" value="PROCEED"></div>
                </div>
                <div class="row">
                    <?php echo '<input type="number" name="sid" value="'.$arrSid[0].'" style="display:none;">' ?>
                    <ul class="nav nav-tabs" style="margin-top:25px;">
                        <li><a data-toggle="tab" href="#overview">Overviews</a></li>
                        <li class="active"><a data-toggle="tab" href="#order">Order Online</a></li>
                        <li><a data-toggle="tab" href="#review">Reviews</a></li>
                        <li><a data-toggle="tab" href="#photo">Photo</a></li>
                      </ul>
                </div>
                <div class="row">
                    <div class="tab-content">
                        <div id="overview" class="tab-pane fade">
                            <div style="margin:10px;"><?php echo "<b>".strtoupper($arrSid[3])."</b>";?></div>
                            <div style="margin:10px;"><?php echo "<b>Address : </b>".$arrSid[12].", ".$arrSid[13].", near ".$arrSid[14].", ".$arrSid[15].", ".$arrSid[16];?></div>
                            <div style="margin:10px;"><?php echo "<b>PINCODE : </b>".$arrSid[18];?></div>
                            <div style="margin:10px;"><?php echo "<b>Service Hours : </b>".substr($arrSid[7],0,5)." - ".substr($arrSid[8],0,5);?></div>
                            <div style="margin:10px;"><?php if($arrSid[10]==0)echo "<b>Current Service Status : </b><span style='color:red;'>Closed</span>";else echo "<span style='color:green;'>Open</span>" ?></div>
                            <div style="margin:10px;">
                                <?php
                                        echo "<b>Servicing Days : </b>";
                                        $strp="";
                                        if(strpos($arrSid[9],'1')!== false){
                                            $strp.="Monday ";
                                        }
                                        if(strpos($arrSid[9],'2')!== false){
                                            $strp.="Tuesday ";
                                        }
                                        if(strpos($arrSid[9],'3')!== false){
                                            $strp.="Wednesday ";
                                        }
                                        if(strpos($arrSid[9],'4')!== false){
                                            $strp.="Thursday ";
                                        }
                                        if(strpos($arrSid[9],'5')!== false){
                                            $strp.="Friday ";
                                        }
                                        if(strpos($arrSid[9],'6')!== false){
                                            $strp.="Saturday ";
                                        }
                                        if(strpos($arrSid[9],'7')!== false){
                                            $strp.="Sunday";
                                        }
                                        echo $strp;
                                ?>
                            </div>
                            <div style="margin:10px;">
                                <?php
                                        echo "<b>Payment Options : </b>";
                                        $strp="";
                                        if(strpos($arrSid[11],'1')!== false){
                                            $strp.="Cash payment, ";
                                        }
                                        if(strpos($arrSid[11],'2')!== false){
                                            $strp.="Debit/Credit Card payment, ";
                                        }
                                        if(strpos($arrSid[11],'3')!== false){
                                            $strp.="UPI payment";
                                        }
                                        echo $strp;
                                ?>
                            </div>
                            <div style="margin:10px;"><?php echo "<b>Owner Name : </b>".$arrRid[1]; ?></div>
                            <div style="margin:10px;"><?php echo "<b>Phone number : </b>".$arrRid[3]; ?></div>
                        </div>
                        <div id="order" class="tab-pane fade in active">
                            <table style="font-family:'Times New Roman', Times, serif;" class="table table-striped">
                                <?php
                                $cntSection=0;
                                for($i=0;$i<count($arrList)-1;$i++){
                                    if(strpos($arrList[$i],"->") !== false){
                                        $cntSection++;
                                        echo "<tr><th style='font-size:30px;'><b>".str_replace("->","",$arrList[$i])."</b></th><th></th><th></th><th></th></tr>";
                                        }
                                        else{
                                            $arr1 =array();
                                            foreach(explode("_",$arrList[$i]) as $rec){
                                                array_push($arr1,$rec);
                                            }
                                            echo "<tr><td><input type='checkbox' name='name_".$cntSection."[]' value='".$arrList[$i]."'></td><td style='font-size:20px;'><b>".$arr1[0]."</b></td><td>".$arr1[1]." ".$arr1[2]."</td><td>Rs. ".$arr1[3]."</td><td><input type='number' name='count_".$cntSection."[]' value='1' min='1' style='width:40px;'></td></tr>";
                                        }
                                    }
                                echo "<input type='number' name='SectionCount' value='".$cntSection."' style='display:none;'>";
                                ?>  
                            </table>
                        </div>
                        <div id="review" class="tab-pane fade">Reviews</div>
                        <div id="photo" class="tab-pane fade">
                            
                        </div>
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
        
        
        
        <!--Start For Login-->   
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
        <!--End For SignUp-->
                <!--Start For Login-->   
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
        <!--End For SignUp-->
    </BODY>
</HTML>