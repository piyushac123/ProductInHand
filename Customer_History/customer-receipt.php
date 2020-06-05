<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>CUSTOMER RECEIPT</TITLE>
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
            .number1{
                -webkit-appearance: none;
              margin: 0;
                -moz-appearance: textfield;
            }
            .star{
                width:40px;
                height: 40px;
                cursor:pointer;
            }
            .inputComment{
                width:80%;
                border: 1px solid black;
                border-left: none;
                border-top: none;
                border-right: none;
            }
            .new-text{
                font-family: 'Aclonica';font-weight:bold;
            }
        </style>
        
<!--
        <script>
            function showSection1(){
                document.getElementById("section3").style.display ="none";
                document.getElementById("section1").style.display ="block";
                document.getElementById("section2").style.display ="none";
            }
            function showSection2(){
                document.getElementById("section3").style.display ="none";
                document.getElementById("section1").style.display ="none";
                document.getElementById("section2").style.display ="block";
            }
            function showOtp(){
                document.getElementById("section3").style.display ="block";
                document.getElementById("section1").style.display ="none";
                document.getElementById("section2").style.display ="block";
            }
        </script>
-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#app1').click(function(){
                    $('#app1').attr('src','../images/fillStar-clipart.jpg');
                    $('#app2,#app3,#app4,#app5').attr('src','../images/emptyStar-clipart.png');
                    $('#appStar').val(1);
                }); 
                $('#app2').click(function(){
                    $('#app1,#app2').attr('src','../images/fillStar-clipart.jpg');
                    $('#app3,#app4,#app5').attr('src','../images/emptyStar-clipart.png');
                    $('#appStar').val(2);
                }); 
                $('#app3').click(function(){
                    $('#app1,#app2,#app3').attr('src','../images/fillStar-clipart.jpg');
                    $('#app4,#app5').attr('src','../images/emptyStar-clipart.png');
                    $('#appStar').val(3);
                }); 
                $('#app4').click(function(){
                    $('#app1,#app2,#app3,#app4').attr('src','../images/fillStar-clipart.jpg');
                    $('#app5').attr('src','../images/emptyStar-clipart.png');
                    $('#appStar').val(4);
                }); 
                $('#app5').click(function(){
                    $('#app1,#app2,#app3,#app4,#app5').attr('src','../images/fillStar-clipart.jpg');
                    $('#appStar').val(5);
                }); 
                $('#shopkeeper1').click(function(){
                    $('#shopkeeper1').attr('src','../images/fillStar-clipart.jpg');
                    $('#shopkeeper2,#shopkeeper3,#shopkeeper4,#shopkeeper5').attr('src','../images/emptyStar-clipart.png');
                    $('#shopkeeperStar').val(1);
                }); 
                $('#shopkeeper2').click(function(){
                    $('#shopkeeper1,#shopkeeper2').attr('src','../images/fillStar-clipart.jpg');
                    $('#shopkeeper3,#shopkeeper4,#shopkeeper5').attr('src','../images/emptyStar-clipart.png');
                    $('#shopkeeperStar').val(2);
                }); 
                $('#shopkeeper3').click(function(){
                    $('#shopkeeper1,#shopkeeper2,#shopkeeper3').attr('src','../images/fillStar-clipart.jpg');
                    $('#shopkeeper4,#shopkeeper5').attr('src','../images/emptyStar-clipart.png');
                    $('#shopkeeperStar').val(3);
                }); 
                $('#shopkeeper4').click(function(){
                    $('#shopkeeper1,#shopkeeper2,#shopkeeper3,#shopkeeper4').attr('src','../images/fillStar-clipart.jpg');
                    $('#shopkeeper5').attr('src','../images/emptyStar-clipart.png');
                    $('#shopkeeperStar').val(4);
                }); 
                $('#shopkeeper5').click(function(){
                    $('#shopkeeper1,#shopkeeper2,#shopkeeper3,#shopkeeper4,#shopkeeper5').attr('src','../images/fillStar-clipart.jpg');
                    $('#shopkeeperStar').val(5);
                });
                $('#product1').click(function(){
                    $('#product1').attr('src','../images/fillStar-clipart.jpg');
                    $('#product2,#product3,#product4,#product5').attr('src','../images/emptyStar-clipart.png');
                    $('#productStar').val(1);
                }); 
                $('#product2').click(function(){
                    $('#product1,#product2').attr('src','../images/fillStar-clipart.jpg');
                    $('#product3,#product4,#product5').attr('src','../images/emptyStar-clipart.png');
                    $('#productStar').val(2);
                }); 
                $('#product3').click(function(){
                    $('#product1,#product2,#product3').attr('src','../images/fillStar-clipart.jpg');
                    $('#product4,#product5').attr('src','../images/emptyStar-clipart.png');
                    $('#productStar').val(3);
                }); 
                $('#product4').click(function(){
                    $('#product1,#product2,#product3,#product4').attr('src','../images/fillStar-clipart.jpg');
                    $('#product5').attr('src','../images/emptyStar-clipart.png');
                    $('#productStar').val(4);
                }); 
                $('#product5').click(function(){
                    $('#product1,#product2,#product3,#product4,#product5').attr('src','../images/fillStar-clipart.jpg');
                    $('#productStar').val(5);
                }); 
            });
        </script>
        <script src="customer-history.js"></script>
        <script src="../common/common.js"></script>
    </HEAD>
    <BODY style="overflow-x:hidden;">
        <?php
            for($i=0;$i<count($_POST['row_num']);$i++){
                if(isset($_POST['row_num'][$i])){
                    $lid = $_POST['row_num'][$i];
                }
            }
            $con = mysqli_connect('localhost','root','','Product.inhand');
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }
        
        
            $sql = "select * from List_of_Item where lid=".$lid;
            $result = mysqli_query($con,$sql);
            $value = "";
             
            $arrList = array();
            $flagList = 0;
            while($row = mysqli_fetch_array($result)){
                $flagList = 1;
               $arrList1 = array();
                array_push($arrList1,$row['lid']);array_push($arrList1,$row['rid']);array_push($arrList1,$row['sid']);array_push($arrList1,$row['Item_name']);array_push($arrList1,$row['Item_price']);array_push($arrList1,$row['Item_size']);array_push($arrList1,$row['Item_quantity']);array_push($arrList1,$row['acceptance']);array_push($arrList1,$row['Status']);array_push($arrList1,$row['Total']);array_push($arrList1,$row['DATE']);array_push($arrList1,$row['TIME']);array_push($arrList1,$row['completion']);array_push($arrList1,$row['available_quantity']);array_push($arrList1,$row['ratingStatus']);
                
                array_push($arrList,$arrList1);
            }
            
        //echo $arrList[0][12].$arrList[0][13];
        if($arrList[0][12]==1){
        
            $arrFrom = array();
            $arrShop = array();
            for($i=0;$i<count($arrList);$i++){
                $arrFrom1= array();
                $sql = "select * from Registration where rid=(select rid from Shopkeeper where sid=".$arrList[$i][2].")";
                $result = mysqli_query($con,$sql);
                $value = "";


                while($row = mysqli_fetch_array($result)){
                    array_push($arrFrom1,$row['Name']);array_push($arrFrom1,$row['Username']);array_push($arrFrom1,$row['Phone_number']);
                }
                array_push($arrFrom,$arrFrom1);

                $arrShop1= array();
                $sql = "select * from Shopkeeper where sid=".$arrList[$i][2];
                $result = mysqli_query($con,$sql);
                $value = "";


                while($row = mysqli_fetch_array($result)){
                    array_push($arrShop1,$row['Address']);array_push($arrShop1,$row['Area']);array_push($arrShop1,$row['Landmark']);array_push($arrShop1,$row['City']);array_push($arrShop1,$row['State']);array_push($arrShop1,$row['Country']);array_push($arrShop1,$row['Pincode']);
                }
                array_push($arrShop,$arrShop1);
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
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php" class="link2">
                    <img src="../images/bagLogo.jpg" alt="logo" class="logoImg">
                    <span class="logoText" style="margin-left: -50px;">SACI</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6"><h1 style="font-family: 'Aclonica';font-weight:bold;text-align:center">Transaction Receipt</h1></div>
                </div>
                <div class="row" style="text-align:center;">
                    <div class="col-lg-6">
                        <h4>
                            <div class="hist-Text"><b>Shopkeeper : </b><?php echo $arrFrom[0][1];?></div>
                            <div class="hist-Text"><b>Status :</b>
                                <?php 
                                    if($arrList[0][7] == 0 && $arrList[0][8] == 0){
                                        echo "<span style='color:red;'>Transaction started</span>";
                                    }
                                    else if($arrList[0][7] == 0 && $arrList[0][8] == 1){
                                        echo "<span style='color:blue;'>Waiting for Acceptance</span>";
                                    }
                                    else if($arrList[0][7] == 1 && $arrList[0][12] == 0){
                                        echo "<span style='color:#9400d3;'>Order confirmed</span>";
                                    }
                                    else if($arrList[0][12] == 1){
                                        echo "<span style='color:green;'>Transaction completed</span>";
                                    }
                                ?>
                            </div>
                            <div class="hist-Text"><b>Phone number : </b><?php echo $arrFrom[0][2];?></div>
                        </h4>
                    </div>
                    <div class="col-lg-6">
                        <h4><div class="hist-Text"><b>Transaction date : </b><?php echo $arrList[0][10];?></div><div class="hist-Text"><b>Transaction time : </b><?php echo $arrList[0][11];?></div></h4>
                    </div>
                </div>
                <div class="row" style="text-align:center;">
                    <h4><div class="hist-Text"><b>Address : </b><?php echo $arrShop[0][0].", ".$arrShop[0][1].", near ".$arrShop[0][2].", ".$arrShop[0][3].", ".$arrShop[0][4].", ".$arrShop[0][5]."</div><div class='hist-Text' style='text-align:left;margin-left:70px;'><b>Pincode : </b>".$arrShop[0][6];?></div></h4>
                </div>
                
                    <?php
                        $arrName = json_decode($arrList[0][3]);
                        $arrPrice = json_decode($arrList[0][4]);
                        $arrWeight = json_decode($arrList[0][5]);
                        $arrCount = json_decode($arrList[0][6]);
                    //echo $arrList[0][14].$arrList[0][13].$arrList[0][12];
                        $arravail_quant = json_decode($arrList[0][13]);
                        $arrTotal = $arrList[0][9];
                    ?>
                    <div class="row">
                        <?php
                            $newarrTotal = 0;
                            echo "<table class='table table-striped' style='margin-top:20px;'><tr><th>Name</th><th>Size</th><th>Quantity</th><th>Price</th></tr>";
                        for($i=0;$i<count($arrName);$i++){
                            echo "<tr><td>".$arrName[$i]."</td>";
                            $arr = array();
                            foreach(explode("_",$arrWeight[$i]) as $rec){
                               array_push($arr,$rec);
                            }
                            echo "<td>".$arr[0]." ".$arr[1]."</td>";
                            echo "<td>".$arravail_quant[$i]."</td><td>Rs. ".$arrPrice[$i]."</td></tr>";
                            $newarrTotal += ($arravail_quant[$i]*$arrPrice[$i]);
                        }
                    echo "<tr><th>Total</th><th></th><th></th><th>Rs. ".$newarrTotal."</th></tr></table>";
                        ?>
                        </div>
            </div>
        <?php 
            if($arrList[0][14]==1){
                ?>
                <form method="post" action="../Rating/accept-rating.php">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6"><h1 style="font-family: 'Aclonica';font-weight:bold;text-align:center;">Rate your Experience!</h1></div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="text-align:center;">
                    <h2 style="font-family: 'Aclonica';font-weight:bold;">Rate our Application</h2>
                    <div style="margin-top:20px;">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app1">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app2">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app3">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app4">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app5">
                        <input type="number" name="appStar" id="appStar" style="display: none;">
                    </div>
                    <div style="margin-top:20px;"><input type="text" name="app" placeholder="Any suggestion" class="inputComment" maxlength="200"></div>
                </div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="text-align:center;">
                    <h2 style="font-family: 'Aclonica';font-weight:bold;">Rate Shopkeeper Service</h2>
                    <div style="margin-top:20px;">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper1">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper2">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper3">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper4">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper5">
                        <input type="number" name="shopkeeperStar" id="shopkeeperStar" style="display: none;">
                    </div>
                    <div style="margin-top:20px;"><input name="shopkeeper" type="text" placeholder="Any suggestion" class="inputComment" maxlength="200"></div>
                </div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="text-align:center;">
                    <h2 style="font-family: 'Aclonica';font-weight:bold;">Rate Product Quality</h2>
                    <div style="margin-top:20px;">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product1">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product2">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product3">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product4">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product5">
                        <input type="number" name="productStar" id="productStar" style="display: none;">
                    </div>
                    <div style="margin-top:20px;"><input name="product" type="text" placeholder="Any suggestion" class="inputComment" maxlength="200"></div>
                </div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="text-align:center;">
                    <input type="submit" name="submitReview" value="SUBMIT">
                </div>
                
            </div>
        </div>
            <input type="number" name="lid" value="<?php echo $lid;?>" style="display:none;">
        </form>
                <?php
            }
            else{
            $sql = "select * from Reviews where lid=".$lid;
            $result = mysqli_query($con,$sql);
            $arrReview = array();
            while($row = mysqli_fetch_array($result)){
                array_push($arrReview,$row['ratingApp']);array_push($arrReview,$row['commentApp']);array_push($arrReview,$row['ratingShopkeeper']);array_push($arrReview,$row['commentShopkeeper']);array_push($arrReview,$row['ratingProduct']);array_push($arrReview,$row['commentProduct']);
            }
            echo "<div class='container'>";
            for($i=0;$i<count($arrReview);$i+=2){
                if($i==0)$temp = "Application";
                else if($i==2)$temp = "Shopkeeper";
                else if($i==4)$temp = "Product Quality";
                $star = "";
                $reverse = "";
                for($j=0;$j<$arrReview[$i];$j++){$star.="<img src='../images/fillStar-clipart.jpg' alt='fill-star' class='star'>";}
                for($j=0;$j<(5-$arrReview[$i]);$j++){$reverse.="<img src='../images/emptyStar-clipart.png' alt='empty-star' class='star'>";}
                echo "<div class='row'><h3 class='new-text'>".$temp." Review</h3></div><div class='row'><div class='col-lg-6'>".$star.$reverse."</div><div class='col-lg-6' style='margin-top:10px;'><b>Comment : </b>".$arrReview[$i+1]."</div></div>";
            }
            echo "</div>";
        }
        }
        else{
            ?>
            <script>location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/Shop-list/Item-list/display-item-list-status.php');</script>
            <?php
        }
        ?>
    </BODY>
</HTML>