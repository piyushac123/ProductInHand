<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php

$rid = $_POST['rid'];
$sql = "select current_open_status,Activation from Shopkeeper where rid=".$rid;
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result)){
      $switch = $row['current_open_status'];
   }
if(isset($_POST['btn-off'])){
    $sqlUpdate="UPDATE `Shopkeeper` SET `current_open_status`=1 WHERE rid=".$rid;
            $result1 = mysqli_query($con,$sqlUpdate);
    $sqlUpdate="UPDATE `HShopkeeper` SET `current_open_status`=1 WHERE rid=".$rid;
            $result1 = mysqli_query($con,$sqlUpdate);
    ?>
    <script>
        location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php');
    </script>
    <?php
}
    
    
if(isset($_POST['btn-on'])){
    $sqlUpdate="UPDATE `Shopkeeper` SET `current_open_status`=0 WHERE rid=".$rid;
            $result1 = mysqli_query($con,$sqlUpdate);
    $sqlUpdate="UPDATE `HShopkeeper` SET `current_open_status`=0 WHERE rid=".$rid;
            $result1 = mysqli_query($con,$sqlUpdate);
    ?>
    <script>
        location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php');
    </script>
    <?php
}
    
    
?>