<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php

if(isset($_POST['submitSuggestion'])){
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $suggestion = $_POST['suggestion'];
    $content = "Subject : ".$subject."\nSuggestion : \n".$suggestion;
    file_put_contents('suggestion-box/('.$name.').txt',$content, FILE_APPEND | LOCK_EX);
    ?>
    <script>
        alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Thanks for your suggestion!'; }else{echo 'आपके सुझाव के लिए धन्यवाद!'; }}else{echo 'Thanks for your suggestion!';}?>");
        location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php');
    </script>
    <?php
}

?>