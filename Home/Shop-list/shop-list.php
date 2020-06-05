<?php
$type="";
if(isset($_POST['grocery'])){
    $type='grocery and essentials';
   }
    else if(isset($_POST['medicine'])){
        $type='medicine';
    }
    else if(isset($_POST['book'])){
        $type='books and stationary';
    }
    else if(isset($_POST['gift'])){
        $type='gift and lifestyle';
        
    }
    $city = $_POST['location'];
    $con = mysqli_connect('localhost','root','','Product.inhand');
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }
    $City = explode(', ',$city);
    $sqlUpdate="UPDATE `Registration` SET `City`='".reset($City)."', `State`='".end($City)."' WHERE Flag=1";
    $result1 = mysqli_query($con,$sqlUpdate);

?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>HOME</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../home.css">
        <link rel="stylesheet" href="../../common/common.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
            /*Hide spinner*/
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
              -webkit-appearance: none;
              margin: 0;
            }

            /* Firefox */
            input[type=number] {
              -moz-appearance: textfield;
            }
            .inputn {
              border: 1px solid transparent;
              background-color: #f1f1f1;
              padding: 10px;
              font-size: 16px;
            }
            .inputText {
              background-color: #f1f1f1;
              width: 60%;
            }
            .inputSubmit {
              background-color: DodgerBlue;
              color: #fff;
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../home.js"></script>
        <script src="../../common/common.js"></script>
    </HEAD>
    <BODY>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php" class="link2">
                    <img src="../../images/bagLogo.jpg" alt="logo" class="logoImg">
                    <span class="logoText" style="margin-left: -50px;">SACI</span>
                    </a>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <ul class="nav nav-pills" style="float: right;z-index: 0;margin-top:50px;">
    <!--                  <li><a href="../feedback/feedback.html" class="pills-features">FEEDBACK</a></li>-->
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
                                <li id="sec6" class="sec6"><a href="../logout.php" style="text-decoration:none;"><acronym title="SIGN OUT">
                                <?php
                                echo $value;
                                ?>
                                </acronym></a></li>
                                <?php
                            }
                            
                        ?>
                        <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/Shop-list/Item-list/display-item-list-status.php" class="link2"><img src="../../images/cart-clipart2.png" alt="cart" style="width:50px;height:50px;margin-top:-5px;cursor:pointer">CART</a></li>
                  </ul>
                </div>
            </div>
        </div>
    <form method="post" action="Item-list/item-list.php" autocomplete="off">
    <div class="container">
        <div class="row">
                <h2 style="font-family:'Aclonica';">Place an Order to your Favourite shop.</h2>
            </div>
        <div class="row" >
            <div class="autocomplete">
                <div class="col-lg-6"><input class="inputn inputText" type="text" placeholder="Search for shop" id="myInput" name="shop"></div>
                <div class="col-lg-6"><input type="button" name="submitShop" class="inputn inputSubmit" value="Search"></div>
            </div>
            </div>
<!--
        <div class="row">
                <div class="col-lg-3"><h3 style="font-family:'Aclonica';">SORT BY :-</h3></div>
                <div class="col-lg-6"><div class="button1" style="font-size:20px;margin-left:5px;">Popularity</div><div class="button1" style="font-size:20px;margin-left:5px;width:auto;">Rating</div><div class="button1" style="font-size:20px;margin-left:5px;width:auto;">Recently Added</div></div>
            </div>
-->
        <?php
        
            $sql = "select * from Shopkeeper where City='".current(explode(',',$city))."' AND Activation=1 AND Shop_type='".$type."'";
            $result = mysqli_query($con,$sql);
            $flagList=1;
            $shopName = array();
            $flagin=0;
            while($row = mysqli_fetch_array($result)){
                $disabled = $row['current_open_status'];
                $class1 = "";
                if($disabled == 0){
                    $class1= "disabled";
                }
                $flagin=1;
                array_push($shopName,$row['Shop_name']);
                $sqlList = "select ratingShopkeeper from Reviews where lid IN (select lid from List_of_Item where sid=".$row['sid'].")";
                $resultList = mysqli_query($con,$sqlList);
                $cntReview = 0;
                $rating = 0;
                while($rowList = mysqli_fetch_array($resultList)){
                    $tmp = $rowList['ratingShopkeeper'];
                    $rating=$rating+$tmp;
                    $cntReview++;
                }
                $rating = $rating/$cntReview;
                //echo $rating." ".$cntReview;
                $open = $row['current_open_status'];
                if($flagList){
                    $sql1 = "select Phone_number from Registration where rid=".$row['rid'];
                    $result1 = mysqli_query($con,$sql1);
                    $phone = mysqli_fetch_array($result1);
                    
                    echo "<div class='row' style='margin-top:20px;'>
                    <div class='".$class1."'>
                    <div class='col-lg-2'>
                        <img src='../../Shop-Details/".$row['Shop_photo']."' alt='shop' class='motiveSticker1'>
                    </div>
                    <div class='col-lg-4' style='font-family:'Aclonica';'>
                        <h3 style='font-family:'Aclonica';font-weight:bold;'>".$row['Shop_name']."</h3>";
                    for($i=0;$i<round($rating);$i++){
                        echo "<img src='../../images/fillStar-clipart.jpg' alt='fill' class='star'>";
                    }
                    for($i=0;$i<5-round($rating);$i++){
                        echo "<img src='../../images/emptyStar-clipart.png' alt='empty' class='star'>";
                    }
                        echo "<span style='color:red;margin-left:5px;font-size:17px;'><b> ".number_format($rating, 2, '.', '')."</b> (".$cntReview." reviews)</span>
                        <div>".$row['Shop_type']."</div>
                        <div>".$row['Address'].", ".$row['Landmark'].", ".$row['City'].", ".$row['State'].", ".$row['Country']."</div>
                        <div>";
                    if($open){echo "<b style='color:green;'>Open</b> till ".substr($row['closing_time'],0,5);}else{echo "<b style='color:red;'>Closed</b>";};
                    echo " | ".$phone['Phone_number']."</div>
                        <button type='submit' name='shop1' class='shop-icon-btn1' value='".$row['sid']."'><div style='margin-top:10px;' class='btn btn-primary'>Place Order</div></button>
                    </div></div>";
                }
                else{
                    $sql1 = "select Phone_number from Registration where rid=".$row['rid'];
                    $result1 = mysqli_query($con,$sql1);
                    $phone = mysqli_fetch_array($result1);
                    echo "<div class='".$class1."'><div class='col-lg-2'><img src='../../Shop-Details/".$row['Shop_photo']."' alt='shop' class='motiveSticker1'>
                    </div>
                    <div class='col-lg-4' style='font-family:'Aclonica';'>
                        <h3 style='font-family:'Aclonica';font-weight:bold;'>".$row['Shop_name']."</h3>";
                    for($i=0;$i<round($rating);$i++){
                        echo "<img src='../../images/fillStar-clipart.jpg' alt='fill' class='star'>";
                    }
                    for($i=0;$i<5-round($rating);$i++){
                        echo "<img src='../../images/emptyStar-clipart.png' alt='empty' class='star'>";
                    }
                        echo "<span style='color:red;margin-left:5px;font-size:17px;'><b> ".$rating."</b> (".$cntReview." reviews)</span>
                        <div>".$row['Shop_type']."</div>
                        <div>".$row['Address'].", ".$row['Landmark'].", ".$row['City'].", ".$row['State'].", ".$row['Country']."</div>
                        <div>Closed | ".$phone['Phone_number']."</div>
                        <button type='submit' name='shop1' class='shop-icon-btn1'><div style='margin-top:10px;' class='btn btn-primary'>Place Order</div></button>
                    </div></div></div>";
                }
            }
        if($flagin==0){
            echo "<div class='nothing''>Tell your shopkeeper to register here!</div>";
        }
//        for($i=0;$i<count($shopName);$i++){
//            echo $shopName[$i]."<br>";
//        }
        ?>
        </div>
        <script>
           var shop = [<?php for($i=0;$i<count($shopName)-1;$i++){echo '"'.$shopName[$i].'", ';} echo '"'.$shopName[count($shopName)-1].'"'?>];
           autocomplete(document.getElementById("myInput"), shop);
        </script>
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
            <form method="post" class="signin" action="login.php">
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
            <form method="post" class="signin" action="signup.php">
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