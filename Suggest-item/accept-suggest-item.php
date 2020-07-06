<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php
    if(isset($_POST['submitList'])){
        $fileData= '';
        for($i=0;$i<count($_POST['item']);$i++){
            $fileData .= $_POST['item'][$i]."\n";
        }
        file_put_contents('suggest-list.txt',$fileData, FILE_APPEND | LOCK_EX);
        
        
        for($i=0;$i<count($_FILES['image']['name']);$i++){
            if(isset($_FILES['image']['name'][$i])){
                // Set the current working directory 
            $directory = getcwd()."/suggest-image/"; 

            // Initialize filecount variavle 
            $filecount = 0; 

            $files2 = glob( $directory ."*" ); 

            if( $files2 ) { 
                $filecount = count($files2); 
            } 

            //echo $filecount . "files ";
                
                $errors= array();
                  $file_name = $_FILES['image']['name'][$i];
                  $file_size =$_FILES['image']['size'][$i];
                  $file_tmp =$_FILES['image']['tmp_name'][$i];
                  $file_type=$_FILES['image']['type'][$i];
                  $file_ext=strtolower(end(explode('.',$file_name)));

                    //echo $file_name."<br>".$file_size."<br>".$file_tmp."<br>".$file_type."<br>".$file_ext;

                  $extensions= array("jpeg","jpg","png");

                  if(in_array($file_ext,$extensions)=== false){
                     $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                  }

                  if($file_size > 10097152){
                     $errors[]='File size must be excately 10 MB';
                  }
            //      echo $_SERVER['DOCUMENT_ROOT']."/ProductInHand/Complaint/Complaint-box/".$rid."/";
                    //echo $username." ".$rid;
            //        chmod($_SERVER['DOCUMENT_ROOT']."/ProductInHand/Complaint/Complaint-box/".$rid."/",0777);
                $dir = 'suggest-image';
                  if(empty($errors)==true){
                      if( !is_dir($dir))
                        {
                            mkdir($dir, 0755, true);
                        }
                     move_uploaded_file($file_tmp,$dir."/".($filecount+1).".".$file_ext);
                     //echo "Success";
                  }else{
                     print_r($errors);
                  }
                //echo $i."<br>";
            }
        }
        ?>
        <script>
            alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Thanks for your suggestion!'; }else{echo 'आपके सुझाव के लिए धन्यवाद!'; }}else{echo 'Thanks for your suggestion!';}?>');
            location.replace('http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php');
        </script>
        <?php
    

    }

?>