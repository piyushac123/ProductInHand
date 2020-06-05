<?php

if(isset($_POST['submitShop'])){
    
    

    $con = mysqli_connect('localhost','root','','Product.inhand');
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }
    $sql = "select rid,Username from Registration where Flag=1";
    $result = mysqli_query($con,$sql);

    while($row = mysqli_fetch_array($result)){
        $rid = $row['rid'];
        $username = $row['Username']; 
    }
    
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
        ?>
        <script>
            alert('Already Registered Shopkeeper');
            window.history.back();
        </script>
        <?php
    }
    

//    echo $username." ".$rid;
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
    $dir = "photo/".$username."_".$rid;
        //echo $dir;
      if(empty($errors)==true){
          if( is_dir($dir) === false )
            {
                mkdir($dir);
            }
         move_uploaded_file($file_tmp,$dir."/".$file_name);
         //echo "Success";
      }else{
         print_r($errors);
      }
        $photo = "'".$dir."/".$file_name."'";
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
        $dir = "certificate/".$username."_".$rid;
      if(empty($errors)==true){
          if( is_dir($dir) === false )
            {
                mkdir($dir);
            }
         move_uploaded_file($file_tmp,$dir."/".$file_name);
         //echo "Success";
      }else{
         print_r($errors);
      }
        $certificate = "'".$dir."/".$file_name."'";
   }
    
    $section_item = "";
    $cnt = count($_POST['section']);
    for($i=0;$i<$cnt;$i++){
        $section_item .= "->".$_POST['section'][$i]."\n";
        for($j=0;$j<count($_POST['name-'.($i+1)]);$j++){
            $section_item .= $_POST['name-'.($i+1)][$j]."_".$_POST['weight-'.($i+1)][$j]."_".$_POST['unit-'.($i+1)][$j]."_".$_POST['price-'.($i+1)][$j]."\n";
        }
    }
    //echo "-<br>".$section_item."<br>-";
    
    
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
    
    $sqlInsert="INSERT INTO Shopkeeper (`rid`,`Shop_name`, `Shop_type`,`Shop_photo`,`Shop_certificate`,`opening_time`,`closing_time`,`open_days`, `current_open_status`,`mode_of_payments`,`Address`,`Area`,`Landmark`,`City`,`State`,`Country`,`Pincode`) VALUES ($rid,$name,$business,$photo,$certificate,$otime,$ctime,$day,0,$payment,$address1,$address2,$landmark,$city,$state,$country,$pincode)";

                if ($con->query($sqlInsert) === FALSE) {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }else{
                    $sqlFile="select sid from Shopkeeper where rid=".$rid;
                    $resultFile = mysqli_query($con,$sqlFile);
                    
                    while($row = mysqli_fetch_array($resultFile)){
                        $sid=$row['sid'];
                    }
                    
                    $file_path = "Item-list/".$_POST['business']."/".$sid."_".$rid.".txt";
                    echo $file_path;
                    file_put_contents($file_path, $section_item);
                   ?>
                    <script>
                        alert("Successfully Registered as a Shopkeeper.");
                        window.history.back();
                    </script>
                    <?php 
                }

//    echo $cnt;
//    echo $name,$email,$business,$day,$otime1.$otime2.$ctime1.$ctime2.$am1.$am2.$address1.$address2,$city,$landmark,$state,$country,$pincode,$payment;
}

?>