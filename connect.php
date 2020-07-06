
<?php
//    $ip = $_SERVER['SERVER_ADDR']; 
//echo 'User Real IP Address - '.$ip;
session_start();
//if(isset($_SESSION['Language'])){
//echo $_SESSION['Username']." ".$_SESSION['Language'];
//}
//echo "a";
?>
<?php
            $con = mysqli_connect('localhost','root','','Product.inhand');
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }
            mysqli_set_charset($con,'utf8');
//            $conn = mysqli_connect('34.70.14.219','root','','FirstProject');
//            if (!$conn) {
//                die('Could not connect: ' . mysqli_error($conn));
//            }
//            $sql = "select * from entries";
//                            $result = mysqli_query($conn,$sql);
//                            while($row = mysqli_fetch_array($result)){
//                                echo $row['guestName']." ".$row['content'];
//                            }
        ?>