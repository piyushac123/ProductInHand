<?php
    $con = mysqli_connect('localhost','root','','Product.inhand');
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }
session_start();
//echo $_SESSION['Username'];
    if(isset($_POST['but_logout'])){
        session_destroy();
?>
<script>
    alert("Logged Out Successfully");
    location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php');
</script>
<?php
    }
mysqli_close($con);
?>