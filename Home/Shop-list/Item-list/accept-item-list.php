<?php

if(isset($_POST['submitList'])){
    
    $sid = $_POST['sid'];
    $section = $_POST['SectionCount'];
    
    $list = "";
    $arrName = array();
    $arrWeight = array();
    $arrPrice = array();
    $arrCnt = array();
    for($i=0;$i<$section;$i++){
        if(isset($_POST['name_'.($i+1)])){
        for($j=0;$j<count($_POST['name_'.($i+1)]);$j++){
            if(!empty($_POST['name_'.($i+1)][$j])){
                array_push($arrCnt,$_POST['count_'.($i+1)][$j]);
                
                $arr = array();
                foreach(explode("_",$_POST['name_'.($i+1)][$j]) as $rec){
                    array_push($arr,$rec);
                }
                array_push($arrName,$arr[0]);
                array_push($arrWeight,$arr[1]."_".$arr[2]);
                array_push($arrPrice,$arr[3]);
                //echo $_POST['name_'.($i+1)][$j]." ".$_POST['count_'.($i+1)][$j]."<br><br>";
            }
        }
        }
    }
    echo $sid." ".$section;
            
            $con = mysqli_connect('localhost','root','','Product.inhand');
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }
            $flagin=0;
            $sql = "select rid from Registration where Flag=1";
            $result = mysqli_query($con,$sql);
            $rid = "";
            while($row = mysqli_fetch_array($result)){
                $flagin=1;
                    $rid = $row['rid'];
            }
    if($flagin){
    echo $rid;
            $sql = "select acceptance from List_of_Item where sid=".$sid." AND rid=".$rid;
            $result = mysqli_query($con,$sql);
            $flagStatus = 0;
            while($row = mysqli_fetch_array($result)){
                $flagStatus = 1;
                    $acceptance = $row['acceptance'];
            }
//    for($i=0;$i<count($arrName);$i++){
//        echo $arrName[$i]." ".$arrWeight[$i]." ".$arrPrice[$i]." ".$arrCnt[$i]."<br>";
//    }
    
    if($acceptance == 0 && $flagStatus == 1){
        ?>
        <script>
            alert('Already pending transaction exist with same Shopkeeper');
            window.history.back();
        </script>
        <?php
    }
    else{
        $sum = 0;
        for($i=0;$i<count($arrPrice);$i++){
            $sum=$sum + ($arrPrice[$i]*$arrCnt[$i]);
        }
        echo $sum;
        $commision =0;
        if($sum>50 && $sum<=500){
            $commision = 0.02*$sum;
        }
        else if($sum>500 && $sum<=1000){
            $commision = 0.05*$sum;
        }
        else if($sum>1000){
            $commision = 50;
        }
    $sid = "'".$sid."'";
    $rid = "'".$rid."'";
    $name = "'".json_encode($arrName)."'";
    $price = "'".json_encode($arrPrice)."'";
    $weight = "'".json_encode($arrWeight)."'";
    $count = "'".json_encode($arrCnt)."'";
        
    
    $sqlInsert="INSERT INTO List_of_Item (`rid`,`sid`, `Item_name`,`Item_price`,`Item_size`,`Item_quantity`,`Total`,`Commision`,`DATE`,`TIME`) VALUES ($rid,$sid,$name,$price,$weight,$count,$sum,$commision,NOW(),NOW())";

                if ($con->query($sqlInsert) === FALSE) {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }else{
                    ?>
                        <script>
                            alert('Successfully uploaded item list.');
                            location.replace("http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/Shop-list/Item-list/display-item-list-status.php");
                        </script>
                    <?php
                }
//    $sql = "select rid,Username from Registration where Flag=1";
//    $result = mysqli_query($con,$sql);
    }
}
    else{
        ?>
        <script>
            alert('Login as a Registered user!');
            window.history.back();
    </script>
    <?php
    }
}

    
?>