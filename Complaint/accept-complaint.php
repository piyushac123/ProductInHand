<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php

if(isset($_SESSION['Username'])){
    $sql = "select Username,token from user_token where Username='".$_SESSION['Username']."'";
    $result = mysqli_query($con,$sql);
    $token = "";
    while($row = mysqli_fetch_array($result)) {
        $value = $row['Username'];
        $token = $row['token'];
    }
    if($_SESSION['token']==$token){
        $sql = "select rid,Phone_number from Registration where Username='".$_SESSION['Username']."'";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result)) {
            $rid = $row['rid'];
            $value = $row['Phone_number'];
        }
        echo $_SERVER['DOCUMENT_ROOT']."/ProductInHand/Complaint/Complaint-box/";
    $dir = "Complaint-box/".$rid;
//    chmod($_SERVER['DOCUMENT_ROOT']."/ProductInHand/Complaint/Complaint-box/",0777);
    if( !is_dir($dir)){
                mkdir($dir, 0755, true);
            }
        
    // Set the current working directory 
    $directory = getcwd()."/Complaint-box/".$rid."/"; 

    // Initialize filecount variavle 
    $filecount = 0; 

    $files2 = glob( $directory ."*" ); 

    if( $files2 ) { 
        $filecount = count($files2); 
    } 

    echo $filecount . "files ";     
        
    if(isset($_POST['submitComplaint'])){
        
    if(isset($_FILES['screenshot'])){
      $errors= array();
      $file_name = $_FILES['screenshot']['name'];
      $file_size =$_FILES['screenshot']['size'];
      $file_tmp =$_FILES['screenshot']['tmp_name'];
      $file_type=$_FILES['screenshot']['type'];
      $file_ext=strtolower(end(explode('.',$file_name)));
        
        //echo $file_name."<br>".$file_size."<br>".$file_tmp."<br>".$file_type."<br>".$file_ext;
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
//      echo $_SERVER['DOCUMENT_ROOT']."/ProductInHand/Complaint/Complaint-box/".$rid."/";
        //echo $username." ".$rid;
        $dir = "Complaint-box/".$rid;
//        chmod($_SERVER['DOCUMENT_ROOT']."/ProductInHand/Complaint/Complaint-box/".$rid."/",0777);
      if(empty($errors)==true){
          if( !is_dir($dir))
            {
                mkdir($dir, 0755, true);
            }
         move_uploaded_file($file_tmp,$dir."/".($filecount+1).".".$file_ext);
         echo "Success";
      }else{
         print_r($errors);
      }
        echo $dir."/".($filecount+1).".".$file_ext;
   }    
//        echo $_SERVER['DOCUMENT_ROOT']."/ProductInHand/Complaint/Complaint-box/".$rid."/".($filecount+1).'/';
        
        $subject = $_POST['subject'];
        $complaint = $_POST['complaint'];
        $content = "Subject : ".$subject."\nComplaint : \n".$complaint;
//        chmod($_SERVER['DOCUMENT_ROOT']."/ProductInHand/Complaint/Complaint-box/".$rid."/".($filecount+1).'/',0777);
        file_put_contents('Complaint-box/'.$rid.'/'.($filecount+1).'.txt',$content, FILE_APPEND | LOCK_EX);
        ?>
        <script>
            alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Soon we will respond you...'; }else{echo 'जल्द ही हम आपसे संपर्क करेंगे ...'; }}else{echo 'Soon we will respond you...';}?>");
            location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php');
        </script>
        <?php
    }
}
}
else{
    ?>
        <script>
            alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Login as a registered user'; }else{echo 'एक पंजीकृत उपयोगकर्ता के रूप में लॉगिन करें'; }}else{echo 'Login as a registered user';}?>");
            window.history.back();
        </script>
        <?php
}
?>