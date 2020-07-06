<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
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
    $City = explode(', ',$city);
    $sqlUpdate="UPDATE `Registration` SET `City`='".reset($City)."', `State`='".end($City)."' WHERE Username='".$_SESSION['Username']."'";
    $result1 = mysqli_query($con,$sqlUpdate);

?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>SHOP LIST</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../home.css">
        <link rel="stylesheet" href="../../common/common.css">
        <link rel="stylesheet" href="../../libraries/3.4.1-bootstrap.min.css">
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
        <script src="../../libraries/3.5.1-jquery.min.js"></script>
        <script src="../home.js"></script>
        <script src="../../common/common.js"></script>
    </HEAD>
    <BODY>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/header.php');
        //if(strpos($_SERVER['HTTP_REFERER'],'item-list.php')!==FALSE){
        ?>
        <script>
//            setTimeout(reloadFunc(), 1000);
//            function reloadFunc(){
//            if(window.location.href.substr(-2) !== "?r") {
////                alert("Hello");
//              window.location = window.location.href + "?r";
//            }
//            }
        </script>
        <?php //}?>
    <form method="post" action="Item-list/item-list.php" autocomplete="off">
    <div class="container">
        <div class="row">
                <h2 style="font-family:'Aclonica';">
                    <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Place an Order to your Favourite shop.'; }else{echo 'अपनी पसंदीदा दुकान पर ऑर्डर दें।'; }}else{echo 'Place an Order to your Favourite shop.';}?>
            </h2>
            </div>
<!--
        <div class="row">
            <div class="autocomplete">
                <div class="col-lg-6"><input class="inputn inputText" type="text" placeholder="Search for shop" id="myInput" name="shop"></div>
                <div class="col-lg-6"><input type="button" name="submitShop" class="inputn inputSubmit" value="Search"></div>
            </div>
            <div></div>
        </div>
-->
<!--
        <div class="row">
                <div class="col-lg-3"><h3 style="font-family:'Aclonica';">SORT BY :-</h3></div>
                <div class="col-lg-6"><div class="button1" style="font-size:20px;margin-left:5px;">Popularity</div><div class="button1" style="font-size:20px;margin-left:5px;width:auto;">Rating</div><div class="button1" style="font-size:20px;margin-left:5px;width:auto;">Recently Added</div></div>
            </div>
-->
        <?php
            $sql = "select rid from Shopkeeper where City='".current(explode(',',$city))."' AND Activation=1 AND Shop_type='".$type."'";
            $result = mysqli_query($con,$sql);
            $row1 = mysqli_fetch_array($result);
            $ridTemp = $row1['rid'];
        
            $table = "";
            if(isset($_SESSION['Language'])){
            if($_SESSION['Language']=='English'){
                $table.='Shopkeeper'; 
            }else{
                $table.='HShopkeeper';
            }
            }
            else{
                $table.='Shopkeeper';
            }
            $sql = "select * from ".$table." where rid=".$ridTemp;
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
                
            if(isset($_SESSION['Language'])){
            if($_SESSION['Language']=='English'){
                $sid11=$row['sid'];
            }else{
                $sid11=$row['hsid'];
            }
            }
            else{
                $sid11=$row['sid'];
            }
                
                $sqlList = "select ratingShopkeeper from Reviews where lid IN (select lid from List_of_Item where sid=".$sid11." AND ratingStatus=2)";
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
                        <img src='http://".$_SERVER['SERVER_ADDR']."/ProductInHand/Shop-Details/".$row['Shop_photo']."' alt='shop' class='motiveSticker1'>
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
                        <button type='submit' name='shop1' class='shop-icon-btn1' value='".$sid11."'><div style='margin-top:10px;' class='btn btn-primary'>Place Order</div></button>
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
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/footer.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/register.php');?>
    </BODY>
</HTML>