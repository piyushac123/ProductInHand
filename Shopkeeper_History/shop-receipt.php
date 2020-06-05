<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>SHOPKEEPER HISTORY</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="shop-history.css">
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
        </style>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                array_push($arrList1,$row['lid']);array_push($arrList1,$row['rid']);array_push($arrList1,$row['sid']);array_push($arrList1,$row['Item_name']);array_push($arrList1,$row['Item_price']);array_push($arrList1,$row['Item_size']);array_push($arrList1,$row['Item_quantity']);array_push($arrList1,$row['acceptance']);array_push($arrList1,$row['Status']);array_push($arrList1,$row['Total']);array_push($arrList1,$row['DATE']);array_push($arrList1,$row['TIME']);array_push($arrList1,$row['completion']);array_push($arrList1,$row['OTP']);array_push($arrList1,$row['available_quantity']);
                
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
                            <div class="hist-Text"><b>Username : </b><?php echo $arrFrom[0][1];?></div>
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
                        </h4>
                    </div>
                    <div class="col-lg-6">
                        <h4><div class="hist-Text"><b>Transaction date :</b><?php echo $arrList[0][10];?></div><div class="hist-Text"><b>Transaction time :</b><?php echo $arrList[0][11];?></div></h4>
                    </div>
                </div>
                <form method="post" action="accept-shop-receipt.php">
                <div id ="section1" style="display:block;">
                <div class="row">
                    <?php
                        $arrName = json_decode($arrList[0][3]);
                        $arrPrice = json_decode($arrList[0][4]);
                        $arrWeight = json_decode($arrList[0][5]);
                        $arrCount = json_decode($arrList[0][6]);
                    //echo $arrList[0][14].$arrList[0][13].$arrList[0][12];
                        $arravail_quant = json_decode($arrList[0][14]);
                        $arrTotal = $arrList[0][9];
                        
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
                    echo "<tr><th>Total</th><th></th><th></th><th></th><th></th><th>Rs. ".$arrTotal."</th></tr></table>";
                    echo "<h4>Arrive by :</h4><input type='number' class='number1' name='arrive'><b> Minutes</b>";
                    ?>
                </div>
                <div class="row">
                    <input type="number" name="Lid" value="<?php echo $lid;?>" style="display:none;">
                    <input type="submit" name="submit" style="float: right;" value="SUBMIT">
                </div>
                    </div>
                    <div id="section2" style="display:block;">
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
                    <div id="section3" style="display:block;">
                        <div class="row">
                            <?php
                        echo "<h4>Enter OTP : <input type='number' class='number1' name='otp' maxlength='6'><input type='submit' name='submitOtp' value='SUBMIT' style='margin-left:5px;'></h4><br><i>*Provided to customer</i>";
                            ?>
                            </div>
                    </div>
                    </form>
            </div>
        <?php
            if($arrList[0][8] == 0){
                ?>
                <script>
                    showSection1();
                </script>
                <?php
            }
            else if($arrList[0][8] == 1 && $arrList[0][7]==0 || $arrList[0][12] == 1){
                ?>
                <script>
                    showSection2();
                </script>
                
                <?php
            }
            else if($arrList[0][12] == 0 && $arrList[0][7]==1){
                ?>
                <script>
                    showOtp();
                </script>
                <?php
            }
            ?>
    </BODY>
</HTML>