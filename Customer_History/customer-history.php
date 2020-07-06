<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>CUSTOMER HISTORY</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="customer-history.css">
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
                margin-bottom: 10px;
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
                    margin-bottom: 10px;
                }
            }
        </style>
        <script>
            setTimeout(reloadFunc,20000);
            function reloadFunc(){
                location.reload();
            }
        </script>
        <script src="../libraries/3.5.1-jquery.min.js"></script>
        <script src="customer-history.js"></script>
        <script src="../common/common.js"></script>
    </HEAD>
    <BODY style="overflow-x:hidden;">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/header.php');?>
        <?php
            if($_SESSION['token'] == $token){
        
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
                    $flagLang = 0;
                    $table = '';
                            if(isset($_SESSION['Language'])){
                                if($_SESSION['Language']=='English'){
                                        $table .= 'Shopkeeper';
                                }else{
                                 $table .= 'HShopkeeper';
                                 $flagLang=1;
                                    }
                                    }
                                    else{
                                        $table .= 'Shopkeeper'; 
                                    }
                    
        for($i=0;$i<count($arrList);$i++){
            
            $sql = "select rid from Shopkeeper where sid=".$arrList[$i][2];
            $result = mysqli_query($con,$sql);
            $row1 = mysqli_fetch_array($result);
            $ridTemp = $row1['rid'];
            //echo $ridTemp;
            $sql = "select Shop_name from ".$table." where rid=".$ridTemp;
            $result = mysqli_query($con,$sql);
            $value = "";
             
            
            while($row = mysqli_fetch_array($result)){
                array_push($arrFrom,$row['Shop_name']);
                
            }

//            echo "<br>";
//            array_push($arrFrom,$arrFrom1);
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
//            for($i=0;$i<count($arrFrom);$i++){
//                echo $arrFrom[$i]." ";
//            }
        if($flagList == 1){
        ?>
        
        <form method="post" action="customer-receipt.php"> 
        <div class="container">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-6"><h1 style="font-family: 'Aclonica';font-weight:bold;">
                    <?php if($flagLang){echo 'व्यवहार का इतिहास';}else{echo 'Customer History';}?>
                    </h1></div>
            </div>
            <?php
            for($i=count($arrList)-1;$i>=0;$i--){
            ?>
                <div class="row trans-row" style="margin-bottom:10px;" id="<?php echo 'row_'.$i; ?>">
                    <div class="col-lg-3"><img src="../images/history-logo.png" alt="logo" style="border:2px solid black; padding:5px; border-radius:12px; height:100px;width:100px; background-color:white;"></div>
                    <div class="col-lg-3"><h4><div class="hist-Text"><b>
                        <?php if($flagLang){echo 'दुकान';}else{echo 'Shop';}?> : 
                        </b><br><?php echo $arrFrom[$i];?></div><div class="hist-Text"><b>
                        <?php if($flagLang){echo 'कुल लागत';}else{echo 'Total Cost';}?> : 
                        </b><?php echo "Rs. ".$arrList[$i][9]; ?></div></h4></div>
                    <div class="col-lg-3"><h4><div class="hist-Text"><b>
                        <?php if($flagLang){echo 'व्यवहार की तारीख';}else{echo 'Transaction date';}?> : 
                        </b><?php echo $arrList[$i][10];?></div><div class="hist-Text"><b>
                        <?php if($flagLang){echo 'व्यवहार का समय';}else{echo 'Transaction time';}?> : 
                        </b><?php echo $arrList[$i][11];?></div></h4></div>
                    <div class="col-lg-3">
                        <h4><div class="hist-Text"><b>
                            <?php if($flagLang){echo 'स्थिति';}else{echo 'Status';}?> :
                            <br></b>
                        <?php 
                            if($arrList[$i][7] == 0 && $arrList[$i][8] == 0){
                                echo "<span style='color:red;'>";
                                if($flagLang){echo 'व्यवहार शुरू हुआ';}else{echo 'Transaction started';}
                                echo "</span>";
                            }
                            else if($arrList[$i][7] == 0 && $arrList[$i][8] == 1){
                                echo "<span style='color:blue;'>";
                                if($flagLang){echo 'स्वीकृति की प्रतीक्षा है';}else{echo 'Waiting for Acceptance';}
                                echo "</span>";
                            }
                            else if($arrList[$i][7] == 1 && $arrList[$i][12] == 0){
                                echo "<span style='color:#9400d3;'>";
                                if($flagLang){echo 'ऑर्डर की पुष्टि की गई';}else{echo 'Order confirmed';}
                                echo "</span>";
                            }
                            else if($arrList[$i][12] == 1){
                                echo "<span style='color:green;'>";
                                if($flagLang){echo 'व्यवहार पूरा हुआ';}else{echo 'Transaction completed';}
                                echo "</span>";
                            }
                        ?></div>
                            </h4>
                        <div><button type="submit" name="row_num[]" value="<?php echo $arrList[$i][0];?>">
                            <?php if($flagLang){echo 'विस्तार';}else{echo 'Explore';}?>
                            </button></div>
                    </div>
                
            </div>
            <?php
                }
                ?>
        </div>
            </form>
        <?php
        }
        else{ 
        ?>
        <div class="container">
                <div class="row">
                    <div class="nothing"> <?php if($flagLang){echo 'अभी तक कोई व्यवहार नहीं हुआ';}else{echo 'No transaction yet';}?></div>
                </div>
            </div>
        <?php
        }
        }
        ?>
        
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/footer.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/register.php');?>
    </BODY>
</HTML>