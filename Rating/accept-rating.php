<?php
echo "0";
    $con = mysqli_connect('localhost','root','','Product.inhand');
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }
    
    $lid = $_POST['lid'];
//    $sql = "select lid from List_of_Item where lid=".$lid." AND ratingStatus=1";
//    $result = mysqli_query($con,$sql);
//    while($row = mysqli_fetch_array($result)){
//        $lid = $row['lid'];
//    }

echo "b";
    $sql = "select fid from Reviews where lid=".$lid;
    $result = mysqli_query($con,$sql);
    $flagInserted = 0;
    while($row = mysqli_fetch_array($result)){
        $flagInserted = 1;
        $fid = $row['fid'];
    }
echo "b";
    if(isset($_POST['submitReview'])){
        echo "c";
        $appRate = $_POST['appStar'];
        $app = "'".$_POST['app']."'";
        $shopkeeperRate = $_POST['shopkeeperStar'];
        $shopkeeper = "'".$_POST['shopkeeper']."'";
        $productRate = $_POST['productStar'];
        $product = "'".$_POST['product']."'";
        
        if($flagInserted == 0){
            $sqlInsert="INSERT INTO Reviews (`lid`,`ratingApp`, `commentApp`,`ratingShopkeeper`, `commentShopkeeper`,`ratingProduct`, `commentProduct`) VALUES ($lid,$appRate,$app,$shopkeeperRate,$shopkeeper,$productRate,$product)";
            
                if ($con->query($sqlInsert) === FALSE) {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }else{
                    $sqlUpdate="UPDATE `List_of_Item` SET `ratingStatus`=2 WHERE lid=".$lid;
                    $result1 = mysqli_query($con,$sqlUpdate);
                    ?>
                        <script>
                            alert('Thank you for your visit!');
                            location.replace("http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php");
                        </script>
                    <?php
                }
        }
        else{
            $sqlUpdate="UPDATE `Reviews` SET `ratingApp`=".$appRate.", `commentApp`=".$app.",`ratingShopkeeper`=".$shopkeeperRate.", `commentShopkeeper`=".$shopkeeper.",`ratingProduct`=".$productRate.", `commentProduct`=".$product." WHERE lid=".$lid;
                $result1 = mysqli_query($con,$sqlUpdate);
            $sqlUpdate="UPDATE `List_of_Item` SET `ratingStatus`=2 WHERE lid=".$lid;
                    $result1 = mysqli_query($con,$sqlUpdate);
                ?>
                <script>
                    alert('Thank you for your visit!');
                    location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Customer_History/customer-history.php');
                </script>
            <?php
        }
        
    }
    if(isset($_POST['submitSkip'])){
        echo "d";
            $sqlInsert="INSERT INTO Reviews (`lid`, `commentApp`, `commentShopkeeper`, `commentProduct`) VALUES ($lid,'','','')";

                if ($con->query($sqlInsert) === FALSE) {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }else{
                    $sqlUpdate="UPDATE `List_of_Item` SET `ratingStatus`=1 WHERE lid=".$lid;
                    $result1 = mysqli_query($con,$sqlUpdate);
                    ?>
                        <script>
                            alert('Thank you for your visit!');
                            location.replace("http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php");
                        </script>
                    <?php
                }
    }
?>