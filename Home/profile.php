<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php
    if(isset($_POST['update'])){
        $rid = $_POST['rid'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $username = $_POST['username'];
        //echo $rid,$name,$phone,$username;
        //echo $_FILES['photo']['name'];
        $photo=NULL;
        //echo "a";
        if(!empty($_FILES['photo']['name'])){
            //echo "b";
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

          if($file_size > 10097152){
             $errors[]='File size must be excately 10 MB';
          }

            //echo $username." ".$rid;
            $dir = $_SERVER['DOCUMENT_ROOT']."/ProductInHand/images/Profile_photo";
          if(empty($errors)==true){
              if( is_dir($dir) === false )
                {
                    mkdir($dir);
                }
             move_uploaded_file($file_tmp,$dir."/".$username."_".$rid.".".$file_ext);
             //echo $dir."/".$username."_".$rid.".".$file_ext;
              
          }else{
             print_r($errors);
          }
            $photo = "'".$username."_".$rid.".".$file_ext."'";
            $sqlUpdate="UPDATE `Registration` SET `Photo`=".$photo." WHERE rid=".$rid;
            $result1 = mysqli_query($con,$sqlUpdate);
            //echo $photo;
       }
        else if(isset($_POST['rPhoto'])){
            //echo "c";
            $sqlUpdate="UPDATE `Registration` SET `Photo`='img_avatar2.png' WHERE rid=".$rid;
            $result1 = mysqli_query($con,$sqlUpdate);
        }
        $sqlUpdate="UPDATE `Registration` SET `Name`='".$name."', `Username`='".$username."', `Phone_number`=".$phone." WHERE rid=".$rid;
            $result1 = mysqli_query($con,$sqlUpdate);
            
            ?>
            <script>
                alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Profile updated'; }else{echo 'प्रोफाइल को सफलतापूर्वक अपडेट किया गया'; }}else{echo 'Profile updated';}?>');
                location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php');
                </script>
            <?php
    }


?>