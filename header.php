        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php" class="link2">
                    <img src="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/images/bagLogo.jpg" alt="logo" class="logoImg">
                    <span class="logoText margin1">Product.InHand</span>
                    </a>
                </div>
                <script> var flag=0;</script>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <ul class="nav nav-pills" style="float: right;z-index: 0;margin-top:50px;">
    <!--                  <li><a href="../feedback/feedback.html" class="pills-features">FEEDBACK</a></li>-->
                        <?php
                            if(isset($_SESSION['Username'])){
                                $sql = "select Username,token from user_token where Username='".$_SESSION['Username']."'";
                                $result = mysqli_query($con,$sql);
                                $token = "";
                                while($row = mysqli_fetch_array($result)) {
                                    $value = $row['Username'];
                                   $token = $row['token'];
                                }
                                if($_SESSION['token']==$token){
                                $sql = "select rid,Name,Username,Phone_number,City,State,Photo from Registration where Username='".$_SESSION['Username']."'";
                                $result = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_array($result)) {
                                    $rid = $row['rid'];
                                    $value = $row['Username'];
                                $city = $row['City'];
                                $state = $row['State'];
                                $name = $row['Name'];
                                $phone = $row['Phone_number'];
                                $photo = $row['Photo']; 
                                }
                                }
                                //echo $token;
                                if($_SESSION['token'] != $token){
                                    //echo "a";
                                ?>
                                <li id="sec4" class="sec4"><a href="#register-box" class="login-window">
                                    <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Signup"; }else{echo "साइन अप"; }}else{echo "Signup";}?>
                                </a></li>
                                <li id="sec5" class="sec5"><a href="#login-box" class="login-window">
                                    <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Login"; }else{echo "लॉगिन"; }}else{echo "Login";}?>
                                    </a></li>
                                <?php
                            }
                            else{//echo "b";
                                if($photo == NULL){
                                    $photo = "img_avatar2.png";
                                }
                                ?>
<!--                            -->
                        <script>flag=1;</script>
                                <div class="profile">
                                <button type="button" name="but" id="sec6" class="sec6"><acronym title="PROFILE">
                                <?php
                                echo $value;
                                ?>
                                </acronym></button>
                                <div class="profile-item" id="profile" style="margin-top:10px;">
                                    <center><table>
                                        <form action="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/profile.php" method="post" enctype="multipart/form-data">
                                        <tr><img src="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/images/Profile_photo/<?php echo $photo;?>" alt="Avatar" class="avatar"></tr><br>
                                        <tr><input type="file" name="photo" style="opacity:0;" id="photo"><div id='val'></div>
                                            <input type="button" name="photo" value="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Add Photo'; }else{echo 'फोटो डालें'; }}else{echo 'Add Photo';}?>" id="button11"><br>
                                            <input type="checkbox" name="rPhoto" id="rPhoto" style="margin-top:10px;margin-bottom:10px;"><lable for="rPhoto">
                                             <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Remove Current Photo"; }else{echo "वर्तमान तस्वीर हटा दे"; }}else{echo "Remove Current Photo";}?>
                                        </lable></tr><br>
                                        <tr>
                                            <b><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Full Name"; }else{echo "पूरा नाम"; }}else{echo "Full Name";}?></b><br>
                                            <input type="text" class="input-profile" name="name" value="<?php echo $name;?>">
                                        </tr>
                                        <tr>
                                            <b> <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Username"; }else{echo "यूजरनेम"; }}else{echo "Username";}?></b><br>
                                            <input type="text" class="input-profile" name="username" value="<?php echo $_SESSION['Username'];?>">
                                        </tr>
                                        <tr>
                                            <b><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Phone number"; }else{echo "फ़ोन नंबर"; }}else{echo "Phone number";}?></b><br>
                                            <input type="number" class="input-profile hide-spinner" name="phone" value="<?php echo $phone;?>">
                                        </tr>
                                        <tr><button type="submit" name="update" style="margin-top:5px;margin-bottom:5px;">
                                             <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "UPDATE PROFILE"; }else{echo "प्रोफ़ाइल अपडेट करें"; }}else{echo "UPDATE PROFILE";}?>
                                        </button></tr>
                                        <input type="number" style="display:none;" name="rid" value="<?php echo $rid;?>"></form><hr>
                                        <form method="post" action="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/logout.php"><tr>
                                                <button type="submit" style="margin-top:5px;margin-bottom:5px;" name="but_logout">
                                                    <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "LOGOUT"; }else{echo "लॉग आउट"; }}else{echo "LOGOUT";}?>
                                            </button></tr></form>
                                    </table></center>       
                                    </div>
                                </div>
                        <script>
                            
                            
                            $(document).ready(function(){
                                $('#profile').hide(); 
                               $('#sec6').click(function(){
                                    $('#profile').toggle(); 
                               });
                                $('#button11').click(function(){
                                   $("#photo").trigger('click');
                                });

                                $("#photo").change(function(){
                                   $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''));
                                }); 
                            });
                        </script>
<!--                            </form>-->
                                <?php
                            }
                        
                    }
                        else{//echo "c";
                            ?>
                                <li id="sec4" class="sec4"><a href="#register-box" class="login-window">
                                    <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Signup"; }else{echo "साइन अप"; }}else{echo "Signup";}?>
                                </a></li>
                                <li id="sec5" class="sec5"><a href="#login-box" class="login-window">
                                     <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Login"; }else{echo "लॉगिन"; }}else{echo "Login";}?>
                                </a></li>
                            <?php
                        }
                            
                        ?>
                        <li style="margin-top:10px;margin-bottom:10px;"><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/Shop-list/Item-list/display-item-list-status.php" class="link2">
                            <img src="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/images/cart-clipart2.png" alt="cart" style="width:50px;height:50px;margin-top:-5px;cursor:pointer"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "CART"; }else{echo "सामान"; }}else{echo "CART";}?>
                            </a></li>
                  </ul>
                </div>
            </div>
        </div>