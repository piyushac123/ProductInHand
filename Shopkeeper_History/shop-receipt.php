<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>SHOPKEEPER RECEIPT</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="shop-history.css">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="../libraries/3.4.1-bootstrap.min.css">
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
        </style>
        <script>
            window.onload = function() {
//                if(!window.location.hash){
//                    window.location.reload();
//                }
            }
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
        <script src="../libraries/3.5.1-jquery.min.js"></script>
        <script src="shop-history.js"></script>
        <script src="../common/common.js"></script>
    </HEAD>
    <BODY style="overflow-x:hidden;">
        
        <?php
            for($i=0;$i<count($_POST['row_num']);$i++){
                if(isset($_POST['row_num'][$i])){
                    $lid = $_POST['row_num'][$i];
                }
            }
        
        
            $sql = "select * from List_of_Item where lid=".$lid;
            $result = mysqli_query($con,$sql);
            $value = "";
             
            $arrList = array();
            $flagList = 0;
            while($row = mysqli_fetch_array($result)){
                $flagList = 1;
               $arrList1 = array();
                array_push($arrList1,$row['lid']);array_push($arrList1,$row['rid']);array_push($arrList1,$row['sid']);array_push($arrList1,$row['Item_info']);array_push($arrList1,$row['Item_quantity']);array_push($arrList1,$row['acceptance']);array_push($arrList1,$row['Status']);array_push($arrList1,$row['Total']);array_push($arrList1,$row['DATE']);array_push($arrList1,$row['TIME']);array_push($arrList1,$row['completion']);array_push($arrList1,$row['OTP']);array_push($arrList1,$row['available_quantity']);
                
                array_push($arrList,$arrList1);
            }
            
            $arrFrom = array();
        for($i=0;$i<count($arrList);$i++){
            $arrFrom1= array();
            $sql = "select * from Registration where rid=".$arrList[$i][1];
            $result = mysqli_query($con,$sql);
            $value = "";
             
            
            while($row = mysqli_fetch_array($result)){
                array_push($arrFrom1,$row['Name']);array_push($arrFrom1,$row['Username']);array_push($arrFrom1,$row['Phone_number']);
            }
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
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php" class="link2">
                    <img src="../images/bagLogo.jpg" alt="logo" class="logoImg">
                    <span class="logoText margin1">Product.InHand</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6"><h1 style="font-family: 'Aclonica';font-weight:bold;text-align:center">
                        <?php
                        $flagLang=0;
                        if(isset($_SESSION['Language'])){
                                if($_SESSION['Language']=='English'){
                                        echo 'Transaction Receipt';
                                }else{
                                 echo 'व्यवहार रसीद';
                                 $flagLang=1;
                                    }
                                    }
                                    else{
                                        echo 'Transaction Receipt';
                                    }
                    ?>
                        </h1></div>
                </div>
                <div class="row" style="text-align:center;">
                    <div class="col-lg-6">
                        <h4>
                            <div class="hist-Text"><b><?php if($flagLang){echo 'ग्राहक';}else{echo 'Customer';}?> : </b><?php echo $arrFrom[0][0];?></div>
                            <div class="hist-Text"><b><?php if($flagLang){echo 'स्थिति';}else{echo 'Status';}?> :</b>
                                <?php 
                                    if($arrList[0][5] == 0 && $arrList[0][6] == 0){
                                        echo "<span style='color:red;'>";
                                        if($flagLang){echo 'व्यवहार शुरू हुआ';}else{echo 'Transaction started';}
                                        echo "</span>";
                                    }
                                    else if($arrList[0][5] == 0 && $arrList[0][6] == 1){
                                        echo "<span style='color:blue;'>";
                                        if($flagLang){echo 'स्वीकृति की प्रतीक्षा है';}else{echo 'Waiting for Acceptance';}
                                        echo "</span>";
                                    }
                                    else if($arrList[0][5] == 1 && $arrList[0][10] == 0){
                                         echo "<span style='color:#9400d3;'>";
                                        if($flagLang){echo 'ऑर्डर की पुष्टि की गई';}else{echo 'Order confirmed';}
                                        echo "</span>";
                                    }
                                    else if($arrList[0][10] == 1){
                                        echo "<span style='color:green;'>";
                                        if($flagLang){echo 'व्यवहार पूरा हुआ';}else{echo 'Transaction completed';}
                                        echo "</span>";
                                    }
                                ?>
                            </div>
                        </h4>
                    </div>
                    <div class="col-lg-6">
                        <h4><div class="hist-Text"><b><?php if($flagLang){echo 'व्यवहार की तारीख';}else{echo 'Transaction date';}?> : </b><?php echo $arrList[0][8];?></div><div class="hist-Text"><b><?php if($flagLang){echo 'व्यवहार का समय';}else{echo 'Transaction time';}?> : </b><?php echo $arrList[0][9];?></div></h4>
                    </div>
                </div>
                <form method="post" action="accept-shop-receipt.php">
                <div id ="section1" style="display:block;">
                <div class="row">
                    <?php
                        $arrItem = json_decode($arrList[0][3]);
                        $arrCount = json_decode($arrList[0][4]);
                    //echo $arrList[0][14].$arrList[0][13].$arrList[0][12];
                        $arravail_quant = json_decode($arrList[0][12]);
                        $arrTotal = $arrList[0][7];
                    $arrName = array();
                    $arrPrice = array();
                    $arrWeight = array();
                    
                    $arrCommodity = array();
                for($i=0;$i<count($arrItem);$i++){
                    $temp = 0;
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
                
                        
                    
                    if($flagLang){$name="नाम";$weight="वजन";$quantity="मात्रा";$price="कीमत";$total="टोटल";$arrival="तक आ जाना";}
                    else{$name="Name";$weight="Weight";$quantity="Quantity";$price="Price";$total="Total";$arrival="Arrive by";}
                        
                        echo "<table class='table table-striped' style='margin-top:20px;'><tr><th></th><th>Name</th><th>Size</th><th>Quantity</th><th>Available Quantity</th><th>Price</th></tr>";
                        for($i=0;$i<count($arrName);$i++){
                            echo "<tr><td><input type='checkbox' name='check[]' value='".($i+1)."'><td>".$arrName[$i]."</td>";
                            $arr = array();
                            foreach(explode("_",$arrWeight[$i]) as $rec){
                               array_push($arr,$rec);
                            }
                            echo "<td>".$arr[0]." ".$arr[1]."</td>";
                            echo "<td>".$arrCount[$i]."</td><td><input type='number' name='count[]' style='width:45px;' value='".$arrCount[$i]."'></td><td>Rs. ".$arrPrice[$i]."</td></tr>";
                        }
                    echo "<tr><th>".$total."</th><th></th><th></th><th></th><th></th><th>Rs. ".$arrTotal."</th></tr></table>";
                    echo "<h4>".$arrival." :</h4><input type='number' class='number1' name='arrive'><b> Minutes</b>";
                    ?>
                </div>
                <div class="row">
                    <input type="number" name="Lid" value="<?php echo $lid;?>" style="display:none;">
                    <input type="submit" name="submit" style="float: right;" value="<?php if($flagLang){echo 'सबमिट';}else{echo 'SUBMIT';}?>">
                </div>
                    </div>
                    <div id="section2" style="display:block;">
                        <div class="row">
                        <?php
                            $newarrTotal = 0;
                            echo "<table class='table table-striped' style='margin-top:20px;'><tr><th>".$name."</th><th>".$weight."</th><th>".$quantity."</th><th>".$price."</th></tr>";
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
                    echo "<tr><th>".$total."</th><th></th><th></th><th>Rs. ".$newarrTotal."</th></tr></table>";
                        ?>
                        </div>
                    </div>
                    <div id="section3" style="display:block;">
                        <div class="row">
                            <?php
                            if($flagLang){$sub='सबमिट';$otpe='OTP दर्ज करें';$cust='ग्राहक को प्रदान किया गया';}else{$sub='SUBMIT';$otpe='Enter OTP';$cust='Provided to customer';}
                        echo "<h4>".$otpe." : <input type='number' class='number1' name='otp' maxlength='6'><input type='submit' name='submitOtp' value='".$sub."' style='margin-left:5px;'></h4><br><i>*".$cust."</i>";
                            ?>
                            </div>
                    </div>
                    </form>
            </div>
        <?php
            if($arrList[0][6] == 0){
                ?>
                <script>
                    showSection1();
                </script>
                <?php
            }
            else if($arrList[0][6] == 1 && $arrList[0][5]==0 || $arrList[0][10] == 1){
                ?>
                <script>
                    showSection2();
                </script>
                
                <?php
            }
            else if($arrList[0][10] == 0 && $arrList[0][5]==1){
                ?>
                <script>
                    showOtp();
                </script>
                <?php
            }
            ?>
    </BODY>
</HTML>