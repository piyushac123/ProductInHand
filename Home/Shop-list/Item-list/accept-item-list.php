<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<?php
//if(isset($_SESSION['Username'])){
//echo $_SESSION['Username']." ".$_SESSION['token'];
//}
if(isset($_POST['submitList'])){
    
    $sid = $_POST['sid'];
    //$section = $_POST['SectionCount'];
    
    $sql = "select token from user_token where Username='".$_SESSION['Username']."'";
                                $result = mysqli_query($con,$sql);
                                $token = "";
                                while($row = mysqli_fetch_array($result)) {
                                   $token = $row['token'];
                                }
    if(isset($_SESSION['Username'])){
    if($_SESSION['token']==$token){
            $sql = "select rid from Registration where Username='".$_SESSION['Username']."'";
            $result = mysqli_query($con,$sql);
            $rid = "";
            while($row = mysqli_fetch_array($result)){
                    $rid = $row['rid'];
            }
    //echo $rid;
            $sql = "select completion from List_of_Item where sid=".$sid." AND rid=".$rid;
            $result = mysqli_query($con,$sql);
            $flagStatus = 0;
            while($row = mysqli_fetch_array($result)){
                $flagStatus = 1;
                    $completion = $row['completion'];
            }
            $sql = "select rid,Shop_type from Shopkeeper where sid=".$sid;
            $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($result)){
                $Shop_rid = $row['rid'];
                    $business = $row['Shop_type'];
            }
        
        $arrList = array();
            $dat = file_get_contents('../../../Shop-Details/Item-list/'.$business.'/'.$sid.'_'.$Shop_rid.'.txt');
            foreach(explode(";",$dat) as $rec){
                //echo strpos($rec,"->");
                array_push($arrList, $rec); 
            }
//        for($i=0;$i<count($arrList);$i++){
//            echo $arrList[$i]."<br>";
//        }
        
        $list = "";
    $arrItem = array();
    $arrPrice = array();
    $arrCnt = array();
        
        
        
        for($i=0;$i<count($arrList)-1;$i++){
            $arr =array();
            $temp = '';
            foreach(explode("-",$arrList[$i]) as $rec){
                $temp=$rec;
            }
            foreach(explode(",",$temp) as $rec){
                array_push($arr,$rec);
            }
//            for($k=0;$k<count($arrList);$k++){
//            echo $arr[$k]."<br>";
//        }
//            echo "<br>";
//            for($j=0;$j<count($arr);$j++){
//                echo $arr[$j]." ";
//            }
            echo "<br>";
            for($j=0;$j<count($arr);$j++){
                if(isset($_POST['name_'.$arr[$j]])){
                    $arr1 = array();
                        //echo $_POST['name_'.$arr[$j]]." ".$_POST['count_'.$arr[$j]]."<br>";
                        array_push($arrCnt,$_POST['count_'.$arr[$j]]);
                        foreach(explode("_",$_POST['name_'.$arr[$j]]) as $rec){
                            array_push($arr1,$rec);
                        }
                        array_push($arrItem,$arr1[0]);
                        
                        array_push($arrPrice,$arr1[1]);
                }
            }
            
            
        }
        
//        for($i=0;$i<count($arrItem);$i++){
//            echo $arrCnt[$i]." ".$arrItem[$i]." ".$arrPrice[$i]."<br>";
//        }
    
    
//    for($i=0;$i<$section;$i++){
//        if(isset($_POST['name_'.($i+1)])){
//        for($j=0;$j<count($_POST['name_'.($i+1)]);$j++){
//            if(!empty($_POST['name_'.($i+1)][$j])){
//                array_push($arrCnt,$_POST['count_'.($i+1)][$j]);
//                
//                $arr = array();
//                foreach(explode("_",$_POST['name_'.($i+1)][$j]) as $rec){
//                    array_push($arr,$rec);
//                }
//                array_push($arrName,$arr[0]);
//                array_push($arrWeight,$arr[1]."_".$arr[2]);
//                array_push($arrPrice,$arr[3]);
//                //echo $_POST['name_'.($i+1)][$j]." ".$_POST['count_'.($i+1)][$j]."<br><br>";
//            }
//        }
//        }
//    }
    //echo $sid;
//    for($i=0;$i<count($arrName);$i++){
//        echo $arrName[$i]." ".$arrWeight[$i]." ".$arrPrice[$i]." ".$arrCnt[$i]."<br>";
//    }
    
    if($flagStatus == 1 && $completion == 0){
        ?>
        <script>
            alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Already pending transaction exist with same Shopkeeper'; }else{echo 'दुकानदार के पास पहले से ही लेन-देन की सूची मौजूद है'; }}else{echo 'Already pending transaction exist with same Shopkeeper';}?>');
            window.history.back();
        </script>
        <?php
    }
    else{
        $sum = 0;
        for($i=0;$i<count($arrPrice);$i++){
            //echo $sum."<br>";
            $sum=$sum + ($arrPrice[$i]*$arrCnt[$i]);
        }
        //echo $sum;
        $commision =0;
        if($sum>50 && $sum<=1000){
            $commision = 0.02*$sum;
        }
        else if($sum>1000){
            $commision = 20;
        }
        echo $sum." ".$commision;
    $sid = "'".$sid."'";
    $rid = "'".$rid."'";
    $item = "'".json_encode($arrItem)."'";
    $count = "'".json_encode($arrCnt)."'";
    echo $count."<br>".$item;
    
    $sqlInsert="INSERT INTO List_of_Item (`rid`,`sid`, `Item_info`,`Item_quantity`,`Total`,`Commision`,`DATE`,`TIME`) VALUES ($rid,$sid,$item,$count,$sum,$commision,NOW(),NOW())";

                if ($con->query($sqlInsert) === FALSE) {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }else{
                    ?>
                        <script>
                            alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Successfully uploaded item list.'; }else{echo 'आइटम सूची सफलतापूर्वक भेजी गई'; }}else{echo 'Successfully uploaded item list.';}?>');
                            location.replace("http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/Shop-list/Item-list/display-item-list-status.php");
                        </script>
                    <?php
                }
//    $sql = "select rid,Username from Registration where Flag=1";
//    $result = mysqli_query($con,$sql);
//    }
    }
    }
    }
    else{
        ?>
        <script>
            alert('<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Login as a registered user'; }else{echo 'एक पंजीकृत उपयोगकर्ता के रूप में लॉगिन करें'; }}else{echo 'Login as a registered user';}?>');
            location.replace("http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php");
    </script>
    <?php
    }
}

    
?>