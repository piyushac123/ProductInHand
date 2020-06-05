<?php
//    $ip = $_SERVER['SERVER_ADDR']; 
//echo 'User Real IP Address - '.$ip;
session_start();
if(isset($_SESSION['Username'])){
echo $_SESSION['Username']." ".$_SESSION['token'];
}
?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>HOME</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
            .shop-icon{
                height: 100px;
                width: 100px;
                margin-top:20px;
                cursor: pointer;
            }
            .motiveSticker{
                height: 250px;
                width: 250px;
                margin-bottom: 20px;
            }
            .footer-text{
                font-size: 20px;
                list-style-type: none;
                margin-left: -30px;
                cursor: pointer;
            }
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
            
        </style>
<!--        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAAwoG2TIcQWFhojQgN3mfntPUiJKJJ7VA&callback=initMap" async defer></script>-->
<!--
        <script>
            function initMap(){
                var input = document.getElementById('searchInput');
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo('bounds', map);

                var infowindow = new google.maps.InfoWindow();
                var marker = new google.maps.Marker({
                    map: map,
                    anchorPoint: new google.maps.Point(0, -29)
                });
                var place = autocomplete.getPlace();
                var address = '';
                if (place.address_components) {
                    address = [
                      (place.address_components[0] && place.address_components[0].short_name || ''),
                      (place.address_components[1] && place.address_components[1].short_name || ''),
                      (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }
                // Location details
                for (var i = 0; i < place.address_components.length; i++) {
                    if(place.address_components[i].types[0] == 'postal_code'){
                        document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
                    }
                    if(place.address_components[i].types[0] == 'country'){
                        document.getElementById('country').innerHTML = place.address_components[i].long_name;
                    }
                }
                document.getElementById('location').innerHTML = place.formatted_address;
                document.getElementById('lat').innerHTML = place.geometry.location.lat();
                document.getElementById('lon').innerHTML = place.geometry.location.lng();
            }
        </script>
-->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="home.js"></script>
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
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php" class="link2">
                    <img src="../images/bagLogo.jpg" alt="logo" class="logoImg">
                    <span class="logoText" style="margin-left: -50px;">SACI</span>
                    </a>
                </div>
                <?php
                        if(isset($_SESSION['Username'])){
                            $sql = "select rid,Username,City,State from Registration where Username='".$_SESSION['Username']."'";
                            $result = mysqli_query($con,$sql);
                            $value = "";$city="";$state="";
                            while($row = mysqli_fetch_array($result)){
                                $rid = $row['rid'];
                                $value = $row['Username'];
                                $city = $row['City'];
                                $state = $row['State'];
                            }
                            if($_SESSION['Username']!=""){
                                $sql = "select current_open_status,Activation from Shopkeeper where rid=".$rid;
                                $result = mysqli_query($con,$sql);
                                $flagActive=0;
                                while($row = mysqli_fetch_array($result)){
                                    $flagActive=1;
                                    $active = $row['Activation'];
                                    $switch = $row['current_open_status'];
                                }
                                if($flagActive==1){
                                if($active == 1){
                                    echo "<div class='col-lg-1 col-md-1 col-sm-1' style='margin-top:40px;'><center><form method='post' action='switch.php'><input type='number' name='rid' value=".$rid." style='display:none;'>";
                                    if($switch==0){
                                        echo "<span><button class='shop-icon-btn1' name='btn-off'><img src='../images/switchoff.jpeg' alt='switchoff' style='height:50px;width:50px;cursor:pointer'></button><br><b style='margin-left:-5px;' onclick='switchOn()'>Availability</b></span>";
                                    }
                                    else{
                                        echo "<span><button class='shop-icon-btn1' name='btn-on'><img src='../images/switchon.jpeg' alt='switchoff' style='height:50px;width:50px;cursor:pointer'></button><br><b style='margin-left:-5px;' id=''>Availability</b></span>";
                                    }
                                    echo "</form></center></div>";
                                }
                                }
                            }
                        }
                    ?>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <ul class="nav nav-pills" style="float: right;z-index: 0;margin-top:50px;">
    <!--                  <li><a href="../feedback/feedback.html" class="pills-features">FEEDBACK</a></li>-->
                        <?php
                            if(isset($_SESSION['Username'])){
                                $sql = "select token from user_token where Username='".$_SESSION['Username']."'";
                                $result = mysqli_query($con,$sql);
                                $token = "";
                                while($row = mysqli_fetch_array($result)) {
                                   $token = $row['token'];
                                }
                                //echo $token;
                                if($_SESSION['token'] != $token){
                                    //echo "a";
                                ?>
                                <li id="sec4" class="sec4"><a href="#register-box" class="login-window">Signup</a></li>
                                <li id="sec5" class="sec5"><a href="#login-box" class="login-window">Login</a></li>
                                <?php
                            }
                            else{//echo "b";
                                ?>
                            <form method="post" action="logout.php">

                                <button name="but_logout" id="sec6" class="sec6"><acronym title="SIGN OUT">
                                <?php
                                echo $value;
                                ?>
                                </acronym></button>
                            </form>
                                <?php
                            }
                        
                    }
                        else{//echo "c";
                            ?>
                                <li id="sec4" class="sec4"><a href="#register-box" class="login-window">Signup</a></li>
                                <li id="sec5" class="sec5"><a href="#login-box" class="login-window">Login</a></li>
                            <?php
                        }
                            
                        ?>
                        <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/Shop-list/Item-list/display-item-list-status.php" class="link2">
                            <img src="../images/cart-clipart2.png" alt="cart" style="width:50px;height:50px;margin-top:-5px;cursor:pointer">CART
                            </a></li>
                  </ul>
                </div>
            </div>
        </div>
        <script>

//            function showResult(str) {
//          if (str.length==0) {
//            document.getElementById("livesearch").innerHTML="";
//            document.getElementById("livesearch").style.display="none";
//            return;
//          }
//          var xmlhttp=new XMLHttpRequest();
//          xmlhttp.onreadystatechange=function() {
//            if (this.readyState==4 && this.status==200) {
//              document.getElementById("livesearch").innerHTML=this.responseText;
//                document.getElementById("livesearch").style.display="block"; 
//              document.getElementById("livesearch").style.border="1px solid #A5ACB2";
//            }
//          }
//          xmlhttp.open("GET","search.php?q="+str,true);
//          xmlhttp.send();
//        }
//            $('#singleSearch').live('click','li',function(){
//                   document.getElementById('searchInput').innerHTML="Hello";
//                $(this).css('background','#d9f531');
//            });
        </script>
        <form method="post" action="Shop-list/shop-list.php" autocomplete="off">
        <div class="jumbotron jumbotron-fluid titleImg">
            <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4"></div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <center>
                    <h2 style="font-family:'Aclonica';margin-bottom:30px;color:white"><i>We are here to enrich shopping style</i></h2>
                    <div class="autocomplete">
                        
                        <?php $City="";if($city!=NULL && $state!=NULL){$City = $city.", ".$state;}?>
                        <input type="text" name="location" style="size:30px" placeholder="Search City" class="search-bar controls" id="myInput" value="<?php if($City==", "){echo "";}else{echo $City;}?>" required>
                    </div>
                        <?php
                            $sql = "select City,State from Shopkeeper";
                            $result = mysqli_query($con,$sql);
                            $value = "";
                            $arrCity = array();
                            while($row = mysqli_fetch_array($result)){
                                $flag1=0;
                                for($i=0;$i<count($arrCity);$i++){
                                    if($arrCity[$i]==$row['City'].", ".$row['State']){
                                        $flag1=1;
                                        break;
                                    }
                                }
                                if(!$flag1){
                                    array_push($arrCity,$row['City'].", ".$row['State']);
                                }
                                
                            }
//                            for($i=0;$i<count($arrCity);$i++){
//                                echo $arrCity[$i];
//                            }
                        ?>
                    <script>
                         var city = [<?php for($i=0;$i<count($arrCity)-1;$i++){echo '"'.$arrCity[$i].'", ';} echo '"'.$arrCity[count($arrCity)-1].'"'?>];
                        autocomplete(document.getElementById("myInput"), city);
                    </script>
<!--
                    <div style="position:relative;z-index:0;">
                        <div id="livesearch" class="livesearch" style="position:absolute;z-index:1;"></div>
                    </div>
-->
                    </center>
                </div>
                
                
                <!-- Google map -->
<!--                <div id="map"></div>-->

                <!-- Display geolocation data -->
<!--
                <ul class="geo-data">
                    <li>Full Address: <span id="location"></span></li>
                    <li>Postal Code: <span id="postal_code"></span></li>
                    <li>Country: <span id="country"></span></li>
                    <li>Latitude: <span id="lat"></span></li>
                    <li>Longitude: <span id="lon"></span></li>
                </ul>
-->     </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-0"></div>
                <div class="col-lg-4 col-sm-12" style="font-family:'Aclonica';text-align:center;"><h2>Our Motivation</h2></div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6"><img src="../images/motivation1.png" alt="motivation1" class="motiveSticker"></div>
                <div class="col-lg-3 col-md-6 col-sm-6"><img src="../images/motivation2.png" alt="motivation2" class="motiveSticker"></div>
                <div class="col-lg-3 col-md-6 col-sm-6"><img src="../images/motivation3.png" alt="motivation3" class="motiveSticker"></div>
                <div class="col-lg-3 col-md-6 col-sm-6"><img src="../images/motivation4.png" alt="motivation4" class="motiveSticker"></div>
            </div>
        </div>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="row" style="font-family:'Aclonica';text-align:center;">
                    <div class="col-lg-4"><h3><b>Enthusiastic service providers create enthusiastic customers</b></h3><b style="margin-top:50px;">Select as per your choice...</b></div>
                    <div class="col-lg-4 col-lg-6 col-sm-6">
                        <button type="submit" name="grocery" class="shop-icon-btn" value="grocery and essentials"><img src="../images/grocery3.png" alt="grocery" class="shop-icon"></button><br><b>Grocery and Essentials</b><br>
                        <button type="submit" name="medicine" class="shop-icon-btn" value="medicines"><img src="../images/medicine-clipart.png" alt="medicine" class="shop-icon"></button><br><b>Medicines</b>
                    </div>
                    <div class="col-lg-4 col-lg-6 col-sm-6">
                        <button type="submit" name="book" class="shop-icon-btn" value="books and stationary"><img src="../images/book-clipart2.png" alt="book" class="shop-icon"></button><br><b>Books and Stationary</b><br>
                        <button type="submit" name="gift" class="shop-icon-btn" value="gifts and lifestyle"><img src="../images/gift-clipart2.png" alt="gift" class="shop-icon"></button><br><b>Gifts and Lifestyle</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-0"></div>
                <div class="col-lg-5 col-sm-12" style="font-family:'Aclonica';text-align:center;"><h2>Take a look at our features</h2></div>
            </div>
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                        <li data-target="#myCarousel" data-slide-to="4"></li>
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <img src="../images/feature1.jpg" alt="feature1" style="height:400px;width:400px;margin:auto;">
                        </div>

                        <div class="item">
                          <img src="../images/feature2.jpg" alt="feature2" style="height:400px;width:400px;margin:auto;">
                        </div>

                        <div class="item">
                          <img src="../images/feature3.jpg" alt="feature3" style="height:400px;width:400px;margin:auto;">
                        </div>
                          
                        <div class="item">
                          <img src="../images/feature4.jpg" alt="feature4" style="height:400px;width:400px;margin:auto;">
                        </div>
                          
                        <div class="item">
                          <img src="../images/feature5.jpg" alt="feature5" style="height:400px;width:400px;margin:auto;">
                        </div>
                      </div>

                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
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
            <form method="post" class="signin" action="login.php">
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