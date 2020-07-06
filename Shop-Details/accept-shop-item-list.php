<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php

    $sql = "select rid,Username from Registration where Username='".$_SESSION['Username']."'";
    $result = mysqli_query($con,$sql);

    while($row = mysqli_fetch_array($result)){
        $rid = $row['rid'];
        $username = $row['Username']; 
    }
    
    if(isset($_POST['submitList'])){
        
        $sqlFile="select sid,Shop_type from Shopkeeper where rid=".$rid;
        $resultFile = mysqli_query($con,$sqlFile);

        while($row = mysqli_fetch_array($resultFile)){
            $sid=$row['sid'];
            $business = $row['Shop_type'];
        }
        
        $select_item = "";
        
                    $sql = "select * from Section where shop_type='".$business."'";
                    $result = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_array($result)){
                            $sql1 = "select * from SubSection where sec_id=".$row['sec_id'];
                            $result1 = mysqli_query($con,$sql1);
                            while($row1 = mysqli_fetch_array($result1)){
                                $select_item .= $row['sec_id'].'-'.$row1['subsec_id'].'-';
                                for($i=0;$i<count($_POST['select-'.$row['sec_id'].'-'.$row1['subsec_id']])-1;$i++){
                                    if(isset($_POST['select-'.$row['sec_id'].'-'.$row1['subsec_id']][$i])){
                                        //echo $row['sec_id']." ".$row1['subsec_id']." ".$i." ".$_POST['select-'.$row['sec_id'].'-'.$row1['subsec_id']][$i]."<br>";
                                        $select_item .= $_POST['select-'.$row['sec_id'].'-'.$row1['subsec_id']][$i].',';
                                    }
                                }
                                $select_item .= $_POST['select-'.$row['sec_id'].'-'.$row1['subsec_id']][count($_POST['select-'.$row['sec_id'].'-'.$row1['subsec_id']])-1].';';
                                
                            }
                        }
            echo $select_item."<br>";
                            
//        Below stuff is used to add new items to above list
//        $section_item = "";
//        $arrSec = array();
//        $arrSubSec = array();
//        $arrCom = array();
//    $cnt = count($_POST['section']);
//    for($i=0;$i<$cnt;$i++){
//        array_push($arrSec,$_POST['section'][$i]);
//        for($k=0;$k<count($_POST['section_'.($i+1)]);$k++){
//            array_push($arrsubSec,$_POST['section_'.($i+1)][$k]);
//            for($j=0;$j<count($_POST['name-'.($i+1).'-'.($k+1)]);$j++){
//                $arr = array();
//                array_push($arr,$_POST['name-'.($i+1).'-'.($k+1)][$j]);array_push($arr,$_POST['weight-'.($i+1).'-'.($k+1)][$j]);array_push($arr,$_POST['unit-'.($i+1).'-'.($k+1)][$j]);array_push($arr,$_POST['price-'.($i+1).'-'.($k+1)][$j]);
//            }
//        }
//    }
        
        //        $sql = "select * from Section where shop_type='".$business."'";
//        $result = mysqli_query($con,$sql);
//        $flag1 = 0;
//        while($row = mysqli_fetch_array($result)){
//            if($row['sec_id'])
//        }

    
                    $file_path = "Item-list/".$business."/".$sid."_".$rid.".txt";
                    echo $file_path;
                    file_put_contents($file_path, $select_item);
        

        ?>
        <script>
            alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Account will be activated by 2-3 days'; }else{echo 'खाता 2-3 दिनों तक सक्रिय हो जाएगा'; }}else{echo 'Account will be activated by 2-3 days';}?>');
            location.replace("http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php");
        </script>
        <?php
    }
?>