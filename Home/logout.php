<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php
    
//echo $_SESSION['Username'];
    if(isset($_POST['but_logout'])){
        session_destroy();
?>
<script>
    alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Logged Out Successfully'; }else{echo 'सफलतापूर्वक लॉग आउट किया गया'; }}else{echo 'Logged Out Successfully';}?>");
    location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php');
</script>
<?php
    }
mysqli_close($con);
?>