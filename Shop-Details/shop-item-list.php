<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>SHOP ITEM LIST</TITLE>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="shop-detail.css">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="../libraries/3.4.1-bootstrap.min.css">
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
        
        <script src="../libraries/3.5.1-jquery.min.js"></script>
        <script src="shop-detail.js"></script>
        <script src="../common/common.js"></script>
        
    </HEAD>
    <BODY>
        <?php
        // For Hindi Language
        
        mysqli_set_charset($con,'utf8');
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php" class="link2">
                    <img src="../images/bagLogo.jpg" alt="logo" class="logoImg">
                    <span class="logoText margin1">Product.InHand</span>
                    </a>
                </div>
                <script> var flag=0;</script>
                <div class="col-lg-5 col-md-5 col-sm-5">
<!--
                    <ul class="nav nav-pills" style="float: right;z-index: 0;margin-top:50px;">
                      <li><a href="../feedback/feedback.html" class="pills-features">FEEDBACK</a></li>
                        <?php
                            if(isset($_SESSION['Username'])){
                                $sql = "select Username,token from user_token where Username='".$_SESSION['Username']."'";
                                $result = mysqli_query($con,$sql);
                                $token = "";
                                while($row = mysqli_fetch_array($result)) {
                                    $value = $row['Username'];
                                   $token = $row['token'];
                                }
                                $sql = "select rid from Registration where Username='".$_SESSION['Username']."'";
                                $result = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_array($result)) {
                                    $rid = $row['rid'];
                                }
                                echo $token;
                                if($_SESSION['token'] != $token){
                                    
                                ?>
                                <li id="sec4" class="sec4"><a href="#register-box" class="login-window">Signup</a></li>
                                <li id="sec5" class="sec5"><a href="#login-box" class="login-window">Login</a></li>
                                <?php
                            }
                            else{
                                ?>
                        <script>flag = 1;</script>
                            <form method="post" action="http://<?php //echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/logout.php">

                                <button name="but_logout" id="sec6" class="sec6"><acronym title="SIGN OUT">
                                <?php
                                //echo $value;
                                ?>
                                </acronym></button>
                            </form>
                                <?php
                            }
                        
                    }
                        else{
                            ?>
                                <li id="sec4" class="sec4"><a href="#register-box" class="login-window">Signup</a></li>
                                <li id="sec5" class="sec5"><a href="#login-box" class="login-window">Login</a></li>
                            <?php
                        }
                            
                        ?>
                        <li><a href="http://<?php //echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/Shop-list/Item-list/display-item-list-status.php" class="link2">
                            <img src="http://<?php //echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/images/cart-clipart2.png" alt="cart" style="width:50px;height:50px;margin-top:-5px;cursor:pointer">CART
                            </a></li>
                  </ul>
-->
                </div>
            </div>
        </div>
<!--
        <div id="Log"></div>
        <button onclick="document.getElementById('Log').innerHTML='<h1>'+flag+'</h1>'">Button</button>
-->
        
        <form action="accept-shop-item-list.php" method="post">
        <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 style="font-weight:bold;font-family:'Aclonica';"><?php $flagLang=0;if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Item Section and List'; }else{echo 'उत्पाद अनुभाग और सूची';$flagLang=1; }}else{echo 'Item Section and List';}?></h3>
                    </div>
                    <div class="col-lg-6"><input type="submit" value="PROCEED" name="submitList" style="float:right;"></div>
                </div>
            <div class="row" style="font-size:15px;font-family:'Aclonica';">
                <?php 
                if($flagLang){$table="HShopkeeper";$sid="hsid";$sec="hsec_name";$subsec="hsubsec_name";$com="hcommodity_name";}else{$table="Shopkeeper";$sid="sid";$sec="sec_name";$subsec="subsec_name";$com="commodity_name";}
                        $sql = "select ".$sid." from ".$table." where rid=".$rid;
                        $result = mysqli_query($con,$sql);

                        $shopType = "";
                        $flagShop = 0;
                        while($row = mysqli_fetch_array($result)){
                            $flagShop = 1;
                            $sid = $row[$sid];
                        }
                        $sql = "select Shop_type from Shopkeeper where rid=".$rid;
                        $result = mysqli_query($con,$sql);

                        while($row = mysqli_fetch_array($result)){
                            $shopType = $row['Shop_type'];
                        }
                    $arrList = array();
                    $dat = file_get_contents('Item-list/'.$shopType.'/'.$sid.'_'.$rid.'.txt');
                    foreach(explode(";",$dat) as $rec){
                        //echo strpos($rec,"->");
                        array_push($arrList, $rec);
                    }
                    $arrMain = array();
//                    for($i=0;$i<count($arrList)-1;$i++){
//                        echo $arrList[$i]."<br>";
//                    }
                    for($i=0;$i<count($arrList)-1;$i++){
                        $arr = array();
                        foreach(explode("-",$arrList[$i]) as $rec){
                            //echo strpos($rec,"->");
                            array_push($arr, $rec);
                        }
                        array_push($arrMain,$arr[2]);
                    }
//                    for($i=0;$i<count($arrMain);$i++){
//                        echo $arrMain[$i]."<br>";
//                    }
                    $arrMainList = array();
                    for($i=0;$i<count($arrMain);$i++){
                        foreach(explode(",",$arrMain[$i]) as $rec){
                            //echo strpos($rec,"->");
                            array_push($arrMainList, $rec);
                        }
                    }
//                    for($i=0;$i<count($arrMainList);$i++){
//                        echo $arrMainList[$i]."<br>";
//                    }
                    
                    
                
                    $sql = "select * from Section where shop_type='".$shopType."'";
                        $result = mysqli_query($con,$sql);
                    echo "<ul>";
                    while($row = mysqli_fetch_array($result)){
                            echo "<li><b style='font-size:25px;'>".$row[$sec]."</b><br>";
                            $sql1 = "select * from SubSection where sec_id=".$row['sec_id'];
                            $result1 = mysqli_query($con,$sql1);
                            echo "<ul>";
                            while($row1 = mysqli_fetch_array($result1)){
                                echo "<li><b style='font-size:20px;'>".$row1[$subsec]."</b><br>";
                                $sql2 = "select * from Commodity where subsec_id=".$row1['subsec_id']." ORDER BY `commodity_name`";
                                $result2 = mysqli_query($con,$sql2);
                                echo "<table  class='table table-bordered'>";
                                while($row2 = mysqli_fetch_array($result2)){
                                    echo "<tr><td><input type='checkbox' name='select-".$row['sec_id']."-".$row1['subsec_id']."[]' value='".$row2['commodity_id']."'";
                                    if(in_array($row2['commodity_id'],$arrMainList)){echo " checked ";}
                                    echo "></td><td>".$row2[$com],"</td><td>",$row2['commodity_size'],"</td><td>Rs. ",$row2['commodity_price'],"</td></tr>";
                                }
                                echo "</table></li>";
                            }
                            echo "</ul></li>";
                        }
                    echo "</ul>";
                    ?>
            </div>
<!--            Below stuff is used to add new items to above list-->
<!--
            <div class="row">
            <div class="col-lg-6">
                        <h3 style="font-weight:bold;font-family:'Aclonica';">Add New Item</h3>
                    </div>
            </div>
-->
<!--
                <div class="row">
                    <table class="table table-bordered" id="dynamic_add">
                        
                        <tr id="row1">
                            <td><input type="text" name="section[]" placeholder="Enter Item Section" class="name-item1">
                                <table  class="table table-bordered" id="dynamic_add_1">
                                    <tr id="row-1-1">
                                        <td><input type="text" name="section_1[]" placeholder="Enter Item Sub Section" class="name-item1">
                                            <table id="dynamic_add_1_1">
                                            <tr id="row-1-1-1">
                                                <td><input type="text" name="name-1-1[]" placeholder="Name" class="name-item1"><br><input type="text" name="weight-1-1[]" placeholder="Weight" class="name-item1"><select name="unit-1-1[]"><option value="kilograms">kilograms</option><option value="grams">grams</option><option value="litres">litres</option><option value="millilitres">millilitres</option></select><br><input type="text" name="price-1-1[]" placeholder="Price" class="name-item1"></td>
                                            </tr>
                                            <tr>
                                                <td><span class="remove-name1" id="1-1"><i class="fa fa-minus"></i></span><span class="add-name1" id="1-1"><i class="fa fa-plus"></i></span></td>
                                            </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="remove-sub-item1" id="1"><i class="fa fa-minus"></i></span><span class="add-sub-item1" id="1"><i class="fa fa-plus"></i></span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="remove-item1" id="remove-item1"><i class="fa fa-minus"></i></span><span class="add-item1" id="add-item1"><i class="fa fa-plus"></i></span></td>
                        </tr>
                    </table>
                    
                </div>
-->
                <script>
            
//            var remove_name_arr = [];
//                $(document).ready(function(){
//                    var i=1;
//                    var j=[1];
//                    var k=[[1]];
//                        
//                   $("#add-item1").click(function(){
//                       i++;
//                       j.push(1);
//                       k.push([1]);
//                       $("#dynamic_add").find('tr:last').before('<tr id="row'+i+'"><td><input type="text" name="section[]" placeholder="Enter Item Section" class="name-item1"><table   class="table table-bordered" id="dynamic_add_'+i+'"><tr id="row-'+i+'-1"><td><input type="text" name="section_'+i+'[]" placeholder="Enter Item Sub Section" class="name-item1"><table id="dynamic_add_'+i+'_1"><tr id="row-'+i+'-1-1"><td><input type="text" name="name-'+i+'-1[]" placeholder="Name" class="name-item1"><br><input type="text" name="weight-'+i+'-1[]" placeholder="Weight" class="name-item1"><select name="unit-'+i+'-1[]"><option value="kilograms">kilograms</option><option value="grams">grams</option><option value="litres">litres</option><option value="millilitres">millilitres</option></select><input type="text" name="price-'+i+'-1[]" placeholder="Price" class="name-item1"></td></tr><tr><td><span class="remove-name1" id="'+i+'-1"><i class="fa fa-minus"></i></span><span class="add-name1" id="'+i+'-1"><i class="fa fa-plus"></i></span></td></tr></table></td></tr><tr><td><span class="remove-sub-item1" id="'+i+'"><i class="fa fa-minus"></i></span><span class="add-sub-item1" id="'+i+'"><i class="fa fa-plus"></i></span></td></tr></table></td></tr>');
//                   });
//                    $(document).on('click','.remove-item1',function(){
//                        if(i!=1){
//                            $("#row"+i+"").remove();
//                            k.pop();
//                            j.pop();
//                            i--;
//                        }
//                    });
//                    $(document).on('click','.add-sub-item1',function(){
//                        var btn_add_name = $(this).attr("id");
//                        j[btn_add_name-1]++;
//                        k[btn_add_name-1].push(1);
//                        $("#dynamic_add_"+btn_add_name).find('tr:last').before('<tr id="row-'+btn_add_name+'-'+j[btn_add_name-1]+'"><td><input type="text" name="section_'+btn_add_name+'[]" placeholder="Enter Item Sub Section" class="name-item1"><table id="dynamic_add_'+btn_add_name+'_'+j[btn_add_name-1]+'"><tr id="row-'+btn_add_name+'-'+j[btn_add_name-1]+'-1"><td><input type="text" name="name-'+btn_add_name+'-'+j[btn_add_name-1]+'[]" placeholder="Name" class="name-item1"><br><input type="text" name="weight-'+btn_add_name+'-'+j[btn_add_name-1]+'[]" placeholder="Weight" class="name-item1"><select name="unit-'+btn_add_name+'-'+j[btn_add_name-1]+'[]"><option value="kilograms">kilograms</option><option value="grams">grams</option><option value="litres">litres</option><option value="millilitres">millilitres</option></select><input type="text" name="price-'+btn_add_name+'-'+j[btn_add_name-1]+'[]" placeholder="Price" class="name-item1"></td></tr><tr><td><span class="remove-name1" id="'+btn_add_name+'-'+j[btn_add_name-1]+'"><i class="fa fa-minus"></i></span><span class="add-name1" id="'+btn_add_name+'-'+j[btn_add_name-1]+'"><i class="fa fa-plus"></i></span></td></tr></table></td></tr>');
//                        
//                    });
//                    $(document).on('click','.remove-sub-item1',function(){
//                        var name_remove = $(this).attr("id");
//                        if(j[name_remove-1]!=1){
//                            $("#row-"+name_remove+"-"+j[name_remove-1]).remove();
//                            //$("#row-"+name_remove).remove();
//                            j[name_remove-1]--;
//                            k[name_remove-1].pop();
//                        }
//                        
//                    });
//                    $(document).on('click','.add-name1',function(){
//                        var btn_add_name = $(this).attr("id");
////                        j[btn_add_name-1]++;
////                        k[btn_add_name-1].push(1);
//                        var arr = btn_add_name.split("-");
//                        k[arr[0]-1][arr[1]-1]++;
//                        //document.getElementById('a').innerHTML = arr[0]+" "+arr[1];
//                        $("#dynamic_add_"+arr[0]+"_"+arr[1]).find('tr:last').before('<tr id="row-'+btn_add_name+'-'+k[arr[0]-1][arr[1]-1]+'"><td><input type="text" name="name-'+btn_add_name+'[]" placeholder="Name" class="name-item1"><br><input type="text" name="weight-'+btn_add_name+'[]" placeholder="Weight" class="name-item1"><select name="unit-'+btn_add_name+'[]"><option value="kilograms">kilograms</option><option value="grams">grams</option><option value="litres">litres</option><option value="millilitres">millilitres</option></select><input type="text" name="price-'+btn_add_name+'[]" placeholder="Price" class="name-item1"></td></tr>');
//                        
//                    });
//                    $(document).on('click','.remove-name1',function(){
//                        var name_remove = $(this).attr("id");
//                        var arr = name_remove.split("-");
//                        //document.getElementById('a').innerHTML = arr[0]+" "+arr[1]+" "+name_remove+"#row-"+name_remove+"-"+k[arr[0]-1][arr[1]-1];
//                        if(k[arr[0]-1][arr[1]-1]!=1){
//                            $("#row-"+name_remove+"-"+k[arr[0]-1][arr[1]-1]).remove();
//                            //$("#row-"+name_remove).remove();
//                            k[arr[0]-1][arr[1]-1]--;
//                        }
//                        
//                    });
//                });

            </script>
               <div class="row">
                    <div class="col-lg-6">
                        
                    </div>
                    <div class="col-lg-6"><input type="submit" value="PROCEED" name="submitList" style="float:right;"></div>
                </div> 
            </div>
        </form>
        
<!--
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
                            <li><a href="http://<?php //echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Shop-Details/shop-detail.php" class="link2">Add shop details</a></li>
                            <li><a href="http://<?php //echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Shopkeeper_History/shop-history.php" class="link2">Order History</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3" style="font-size:20px;margin-top:20px;">
                        <b>For you</b>
                        <ul class="footer-text">
                            <li><a href="http://<?php //echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Customer_History/customer-history.php" class="link2">Transaction History</a></li>
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
-->
        
        
        
        <!--Start For Login   -->
<!--
        <div id="login-box" class="login-popup">
            <a href="#" class="close"><i style="font-size:24px" class="fa btn_close">&#xf00d;</i></a>
            <h3 class="titlelog">Login Page</h3>
            <form method="post" class="signin" action="http://<?php //echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/login.php">
                <fieldset>
                    <span><input type="text" name="username" class="input1" placeholder="Enter username"></span>
                    <span><input type="password" name="password" class="input1" placeholder="Enter password"></span><br>
                    <input type="reset" value="RESET" class="button1">
                    <input type="submit" value="SUBMIT" name="signin" class="button1"><br>
                <a class="forgot" href="forgotPassword.php">Forgot your password?</a>
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
            <form method="post" class="signin" action="http://<?php //echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/login.php">
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