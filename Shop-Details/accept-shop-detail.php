<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php

if(isset($_POST['submitShop'])){
    $sql = "select rid,Username from Registration where Username='".$_SESSION['Username']."'";
    $result = mysqli_query($con,$sql);

    while($row = mysqli_fetch_array($result)){
        $rid = $row['rid'];
        $username = $row['Username']; 
    }
    $photo="";
    $certificate="";

    if(isset($_FILES['photo'])){
      $errors= array();
      $file_name = $_FILES['photo']['name'];
      $file_size =$_FILES['photo']['size'];
      $file_tmp =$_FILES['photo']['tmp_name'];
      $file_type=$_FILES['photo']['type'];
      $file_ext=strtolower(end(explode('.',$file_name)));
        
        //echo $file_name."<br>".$file_size."<br>".$file_tmp."<br>".$file_type."<br>".$file_ext;
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
    //echo $username." ".$rid;
    $dir = "photo/".$rid;
        //echo $dir;
      if(empty($errors)==true){
          if( is_dir($dir) === false )
            {
                mkdir($dir);
            }
         move_uploaded_file($file_tmp,$dir."/photo1.".$file_ext);
         //echo "Success";
      }else{
         print_r($errors);
      }
        $photo = "'".$dir."/photo1.".$file_ext."'";
   }
    

    if(isset($_FILES['certificate'])){
      $errors= array();
      $file_name = $_FILES['certificate']['name'];
      $file_size =$_FILES['certificate']['size'];
      $file_tmp =$_FILES['certificate']['tmp_name'];
      $file_type=$_FILES['certificate']['type'];
      $file_ext=strtolower(end(explode('.',$file_name)));
        
        //echo $file_name."<br>".$file_size."<br>".$file_tmp."<br>".$file_type."<br>".$file_ext;
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
        //echo $username." ".$rid;
        $dir = "certificate/".$rid;
      if(empty($errors)==true){
          if( is_dir($dir) === false )
            {
                mkdir($dir);
            }
         move_uploaded_file($file_tmp,$dir."/certificate1.".$file_ext);
         //echo "Success";
      }else{
         print_r($errors);
      }
        $certificate = "'".$dir."/certificate1.".$file_ext."'";
   }
    

    
    
    $name="'".$_POST['name']."'";
    $business="'".$_POST['business']."'";
    $email="'".$_POST['email']."'";
    $otime1=$_POST['otime1'];
    $otime2=$_POST['otime2'];
    $ctime1=$_POST['ctime1'];
    $ctime2=$_POST['ctime2'];
    $am1=$_POST['am1'];
    $am2=$_POST['am2'];
    $address1="'".$_POST['address1']."'";
    $address2="'".$_POST['address2']."'";
    $city="'".strtoupper($_POST['city'])."'";
    $landmark="'".$_POST['landmark']."'";
    $state="'".strtoupper($_POST['state'])."'";
    $country="'".strtoupper($_POST['country'])."'";
    $pincode=$_POST['pincode'];
    $day="";
    
    if($am1 == "PM"){
        $otime1=$otime1+12;
    }
    if($am2 == "PM"){
        $ctime1=$ctime1+12;
    }
    $otime="'".$otime1.":".$otime2."'";
    $ctime="'".$ctime1.":".$ctime2."'";

    for($i=1;$i<8;$i++){
        if(isset($_POST['day'.$i])){
            $day.=$i;
        }
    }
    //echo $day."<br>";
    $day="'".$day."'";
    
    $payment="";
    for($i=1;$i<4;$i++){
        if(isset($_POST['payment'.$i])){
            $payment.=$i;
        }
    }
    //echo $payment."<br>";
    $payment="'".$payment."'";
    

    
    
    $arr = array();
    $sql1 = "select rid from Shopkeeper";
    $result1 = mysqli_query($con,$sql1);

    while($row1 = mysqli_fetch_array($result1)){
        $r = $row1['rid'];
        array_push($arr,$r);
    }
    
    $cntRow=0;
    for($i=0;$i<count($arr);$i++){
        if($rid==$arr[$i]){
            $cntRow++;
        }
    }
    //echo $rid.$cntRow.count($arr)."--------------<br>";
    if($cntRow!=0){
        $sqlUpdate="UPDATE `Shopkeeper` SET `Shop_name`=".$name.",`Shop_type`=".$business.",`Email`=".$email.",`opening_time`=".$otime.",`closing_time`=".$ctime.",`open_days`=".$day.",`mode_of_payments`=".$payment.",`Address`=".$address1.",`Area`=".$address2.",`Landmark`=".$landmark.",`City`=".$city.",`State`=".$state.", `Country`=".$country.",`Pincode`=".$pincode." WHERE rid=".$rid;
            $result1 = mysqli_query($con,$sqlUpdate);
        ?>
        <script>
            alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Already Registered Shopkeeper! Updated Information.'; }else{echo 'पहले से ही पंजीकृत दुकानदार!  विवरण अपडेट की गई'; }}else{echo 'Already Registered Shopkeeper! Updated Information.';}?>');
            location.replace("http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Shop-Details/shop-item-list.php");
        </script>
        <?php
    }
    

//    echo $username." ".$rid;
    
    else{
    $sqlInsert="INSERT INTO Shopkeeper (`rid`,`Shop_name`, `Shop_type`,`Shop_photo`,`Shop_certificate`,`Email`,`opening_time`,`closing_time`,`open_days`, `current_open_status`,`mode_of_payments`,`Address`,`Area`,`Landmark`,`City`,`State`,`Country`,`Pincode`) VALUES ($rid,$name,$business,$photo,$certificate,$email,$otime,$ctime,$day,0,$payment,$address1,$address2,$landmark,$city,$state,$country,$pincode)";

                if ($con->query($sqlInsert) === FALSE) {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }else{
                   ?>
                    <script>
                        alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Successfully Registered as a Shopkeeper.'; }else{echo 'एक दुकानदार के रूप में सफलतापूर्वक पंजीकृत'; }}else{echo 'Successfully Registered as a Shopkeeper.';}?>");
                        location.replace("http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Shop-Details/shop-item-list.php");
                    </script>
                    <?php 
                }
    }
//    echo $cnt;
//    echo $name,$email,$business,$day,$otime1.$otime2.$ctime1.$ctime2.$am1.$am2.$address1.$address2,$city,$landmark,$state,$country,$pincode,$payment;
}

?>