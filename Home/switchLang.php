<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php
    $language = $_POST['lang'];
    $_SESSION['Language'] = $language;
    ?>
    <script>
        location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php');
    </script>
    <?php
?>