<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php

if(isset($_POST['submitContact'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $suggestion = $_POST['suggestion'];
    $content = "Email : ".$email."\nSubject : ".$subject."\nSuggestion : \n".$suggestion;
    file_put_contents('Contact-info/('.$name.').txt',$content, FILE_APPEND | LOCK_EX);
    ?>
    <script>
        alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Soon we will respond you...'; }else{echo 'जल्द ही हम आपसे संपर्क करेंगे ...'; }}else{echo 'Soon we will respond you...';}?>");
        location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php');
    </script>
    <?php
}

?>