<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>HOME</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../home.css">
        <link rel="stylesheet" href="../../../common/common.css">
        <link rel="stylesheet" href="../../../libraries/3.4.1-bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
            .title-photo{
                height: 500px;
                width:  100%;
                padding:10px;
            }
            .add-photo{
                border:1px solid #eee;
                height: 235px;
                width: 500px;
                background-color: #eee;
                cursor:pointer;
                margin:auto;
                padding:80px 190px 80px 190px;
                font-family:'Aclonica';
            }
            .sticky {
              position: fixed;
              top: 0;
                z-index: 1;
                background-color:white;
                margin-left: -10px;
            }
        </style>
        
        <script src="../../../libraries/3.5.1-jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="../../home.js"></script>
        <script src="../../../common/common.js"></script>
        
    </HEAD>
    <BODY data-spy="scroll" data-target=".nav-pills" data-offset="50">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/header.php');?>
        <?php
            $sid = $_POST['shop1'];
            $arrSid = array();
        
            $sql = "select rid from Shopkeeper where sid=".$sid;
            $result = mysqli_query($con,$sql);
            $row1 = mysqli_fetch_array($result);
            $ridTemp = $row1['rid'];
        
            $table = "";
            $flagLang = 0;
            if(isset($_SESSION['Language'])){
            if($_SESSION['Language']=='English'){
                $table.='Shopkeeper'; 
            }else{
                $table.='HShopkeeper';
                $flagLang=1;
            }
            }
            else{
                $table.='Shopkeeper';
            }
        
            $sqlSid = "select * from ".$table." where rid=".$ridTemp;
            $resultSid = mysqli_query($con,$sqlSid);
            while($row = mysqli_fetch_array($resultSid)){
                if($flagLang){array_push($arrSid,$row['hsid']);}else{array_push($arrSid,$row['sid']);}array_push($arrSid,$row['rid']);array_push($arrSid,$row['Shop_name']);array_push($arrSid,$row['Shop_type']);array_push($arrSid,$row['Shop_photo']);array_push($arrSid,$row['Shop_certificate']);array_push($arrSid,$row['rating']);array_push($arrSid,$row['opening_time']);array_push($arrSid,$row['closing_time']);array_push($arrSid,$row['open_days']);array_push($arrSid,$row['current_open_status']);array_push($arrSid,$row['mode_of_payments']);array_push($arrSid,$row['Address']);array_push($arrSid,$row['Area']);array_push($arrSid,$row['Landmark']);array_push($arrSid,$row['City']);array_push($arrSid,$row['State']);array_push($arrSid,$row['Country']);array_push($arrSid,$row['Pincode']);
            }
//            for($i=0;$i<count($arrSid);$i++){
//                echo $arrSid[$i]."<br>";
//            } 
        $type='';
        if($arrSid[3]=="किराने और आवश्यक वस्तुएं" || $arrSid[3]=="grocery and essentials"){
            $type='grocery and essentials';
       }
        else if($arrSid[3]=="दवाइयाँ" || $arrSid[3]=="medicine"){
            $type='medicine';
        }
        else if($arrSid[3]=="पुस्तकें और स्टेशनरी" || $arrSid[3]=="books and stationary"){
            $type='books and stationary';
        }
        else if($arrSid[3]=="उपहार और जीवन शैली" || $arrSid[3]=="gift and lifestyle"){
            $type='gift and lifestyle';

        }  
        $arrReview = array();
            $sqlList = "select * from Reviews where lid IN (select lid from List_of_Item where sid=".$arrSid[0]." AND  ratingStatus=2)";
                $resultList = mysqli_query($con,$sqlList);
                $cntReview = 0;
                $rating = 0;
                while($rowList = mysqli_fetch_array($resultList)){
                    $tmp = $rowList['ratingShopkeeper'];
                    $rating=$rating+$tmp;
                    $cntReview++;
                    $lidReview = $rowList['lid'];
                    
                   $arrReview1 = array(); 
                    $nameReview = "";$dateReview = "";$timeReview = "";
                   $sql1 = "select Name from Registration where rid IN (select rid from List_of_Item where lid=".$lidReview.")";
                $result1 = mysqli_query($con,$sql1);
                    
                    while($row1 = mysqli_fetch_array($result1)){$nameReview = $row1['Name'];}
                    //echo $nameReview;
                    
                    $sql = "select DATE,TIME from List_of_Item where lid=".$lidReview;
                $result = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_array($result)){$dateReview = $row['DATE'];$timeReview = $row['TIME'];}
                    //echo $dateReview,$timeReview;
                    
                       array_push($arrReview1,$nameReview);array_push($arrReview1,$dateReview);array_push($arrReview1,$timeReview);array_push($arrReview1,$rowList['ratingApp']);array_push($arrReview1,$rowList['commentApp']);array_push($arrReview1,$rowList['ratingShopkeeper']);array_push($arrReview1,$rowList['commentShopkeeper']);array_push($arrReview1,$rowList['ratingProduct']);array_push($arrReview1,$rowList['commentProduct']);
                    array_push($arrReview,$arrReview1);
                }
                $rating = $rating/$cntReview;
//        for($i=0;$i<count($arrReview);$i++){
//            for($j=0;$j<count($arrReview[$i]);$j++){
//                echo $arrReview[$i][$j]." ";
//            }
//            echo "<br>";
//        }
            $arrRid = array();
            $sqlRid = "select * from Registration where rid=".$arrSid[1];
            $resultRid = mysqli_query($con,$sqlRid);
            while($row = mysqli_fetch_array($resultRid)){
                array_push($arrRid,$row['rid']);array_push($arrRid,$row['Name']);array_push($arrRid,$row['Username']);array_push($arrRid,$row['Phone_number']);
            }
//            for($i=0;$i<count($arrRid);$i++){
//                echo "<br>".$arrRid[$i];
//            }
                
        
            $arrList = array();
        //echo $arrSid[3].$type.$arrSid[0].$arrRid[0];
            $dat = file_get_contents('../../../Shop-Details/Item-list/'.$type.'/'.$arrSid[0].'_'.$arrRid[0].'.txt');
            foreach(explode(";",$dat) as $rec){
                //echo strpos($rec,"->");
                array_push($arrList, $rec);
                
                
            }
//            for($i=0;$i<count($arrList);$i++){
//                echo $arrList[$i]."<br>";
//            }
        ?>
        <form method="post" action="accept-item-list.php">
            <div class="container">
                <div class="row">
                    <img src="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Shop-Details/<?php echo $arrSid[4];?>" alt="shop" class="title-photo">
                </div>
                <div id="myNavbar">
                <div class="row" style="margin-left:10px;">
                    <div class="col-lg-6">
                    <h3 style="font-family:'Aclonica';font-weight:bold;"><?php echo $arrSid[2];?></h3>
                    <?php
                    for($i=0;$i<round($rating);$i++){
                        echo "<img src='../../../images/fillStar-clipart.jpg' alt='fill' class='star'>";
                    }
                    for($i=0;$i<5-round($rating);$i++){
                        echo "<img src='../../../images/emptyStar-clipart.png' alt='empty' class='star'>";
                    }
                    ?>
                    
                    <span style="color:red;margin-left:5px;font-size:17px;"><?php echo "<b>".number_format($rating, 2, '.', '')."</b>";?> (<?php echo $cntReview;?> reviews)</span>
                        </div>
                    <div class="col-lg-6"><input type="submit" class="button1" name="submitList" style="float:right;" value="PROCEED"></div>
                </div>
                <div class="row">
                    <?php echo '<input type="number" name="sid" value="'.$arrSid[0].'" style="display:none;">' ?>
                    <ul class="nav nav-tabs" style="margin-top:25px;">
                        <li><a data-toggle="tab" href="#overview"><?php if($flagLang){echo "विस्तृत";}else{echo "Overviews";}?></a></li>
                        <li class="active"><a data-toggle="tab" href="#order"><?php if($flagLang){echo "ऑनलाइन ऑर्डर";}else{echo "Order Online";}?></a></li>
                        <li><a data-toggle="tab" href="#review"><?php if($flagLang){echo "रिव्यु ";}else{echo "Reviews";}?></a></li>
                        <li><a data-toggle="tab" href="#photo"><?php if($flagLang){echo "तस्वीरें";}else{echo "Photo";}?></a></li>
                      </ul>
                </div>
                </div>
                <div class="row">
                    <div class="tab-content">
                        <div id="overview" class="tab-pane fade">
                            <div style="margin:10px;"><?php echo "<b>".strtoupper($arrSid[3])."</b>";?></div>
                            <div style="margin:10px;"><?php if($flagLang){$temp="पता";}else{$temp="Address";}echo "<b>".$temp." : </b>".$arrSid[12].", ".$arrSid[13].", near ".$arrSid[14].", ".$arrSid[15].", ".$arrSid[16];?></div>
                            <div style="margin:10px;"><?php if($flagLang){$temp="पिन कोड";}else{$temp="PINCODE";}echo "<b>".$temp." : </b>".$arrSid[18];?></div>
                            <div style="margin:10px;"><?php if($flagLang){$temp="सेवा के घंटे";}else{$temp="Service Hours";}echo "<b>".$temp." : </b>".substr($arrSid[7],0,5)." - ".substr($arrSid[8],0,5);?></div>
                            <div style="margin:10px;"><?php if($flagLang){$temp="वर्तमान सेवा स्थिति";}else{$temp="Current Service Status";}if($arrSid[10]==0){echo "<b>".$temp." : </b><span style='color:red;'>Closed</span>";}else{ echo "<span style='color:green;'>Open</span>";} ?></div>
                            <div style="margin:10px;">
                                <?php
                                    if($flagLang){$temp="सर्विसिंग डेज";}else{$temp="Servicing Days";}
                                        echo "<b>".$temp." : </b>";
                                        $strp="";
                                        if(strpos($arrSid[9],'1')!== false){
                                            if($flagLang){$strp.="सोमवार ";}else{$strp.="Monday ";}
                                        }
                                        if(strpos($arrSid[9],'2')!== false){
                                            if($flagLang){$strp.="मंगलवार ";}else{$strp.="Tuesday ";}
                                        }
                                        if(strpos($arrSid[9],'3')!== false){
                                            if($flagLang){$strp.="बुधवार ";}else{$strp.="Wednesday ";}
                                        }
                                        if(strpos($arrSid[9],'4')!== false){
                                            if($flagLang){$strp.="गुरूवार ";}else{$strp.="Thursday ";}
                                        }
                                        if(strpos($arrSid[9],'5')!== false){
                                            if($flagLang){$strp.="शुक्रवार ";}else{$strp.="Friday ";}
                                        }
                                        if(strpos($arrSid[9],'6')!== false){
                                            if($flagLang){$strp.="शनिवार ";}else{$strp.="Saturday ";}
                                        }
                                        if(strpos($arrSid[9],'7')!== false){
                                            if($flagLang){$strp.="रविवार";}else{$strp.="Sunday";}
                                        }
                                        echo $strp;
                                ?>
                            </div>
                            <div style="margin:10px;">
                                <?php
                                        if($flagLang){$temp="भुगतान विकल्प";}else{$temp="Payment Options";}
                                        echo "<b>".$temp." : </b>";
                                        $strp="";
                                        if(strpos($arrSid[11],'1')!== false){
                                            if($flagLang){$strp.="नकद भुगतान, ";}else{$strp.="Cash payment, ";}
                                        }
                                        if(strpos($arrSid[11],'2')!== false){
                                            if($flagLang){$strp.="डेबिट / क्रेडिट कार्ड से भुगतान, ";}else{$strp.="Debit/Credit Card payment, ";}
                                        }
                                        if(strpos($arrSid[11],'3')!== false){
                                            if($flagLang){$strp.="UPI भुगतान";}else{$strp.="UPI payment";}
                                        }
                                        echo $strp;
                                ?>
                            </div>
                            <div style="margin:10px;"><?php if($flagLang){$temp="मालिक का नाम";}else{$temp="Owner name";}echo "<b>".$temp." : </b>".$arrRid[1]; ?></div>
                            <div style="margin:10px;"><?php if($flagLang){$temp="फ़ोन नंबर";}else{$temp="Phone number";}echo "<b>".$temp." : </b>".$arrRid[3]; ?></div>
                        </div>
                        <div id="order" class="tab-pane fade in active">
                            <div  data-spy="scroll" data-target=".navbar" data-offset="50">
                                <nav class="navbar navbar-inverse">
                                    <div class="container">
                                        <div>
                                          <div class="collapse navbar-collapse" id="myNavbar">
                                            <ul class="nav navbar-nav">
                                                <?php
                                                for($i=0;$i<count($arrList)-1;$i++){
                                                            $arr =array();
                                                            foreach(explode("-",$arrList[$i]) as $rec){
                                                                array_push($arr,$rec);
                                                            }
                                                    $sql = "select * from Section where sec_id=".$arr[0];
                                                    $result = mysqli_query($con,$sql);
                                                    $row = mysqli_fetch_array($result);
                                                    if($flagLang){$sec = $row['hsec_name'];}else{$sec = $row['sec_name'];}
                                                    
                                                    echo "<li><a href='#section".$arr[0]."'>".$sec."</a></li>";
                                                    
                                                }
                                                    ?>
                                            </ul>
                                          </div>
                                        </div>
                                    </div>
                                </nav>
                                <script>
                                    window.onscroll = function() {myFunction()};

                                    var navbar = document.getElementById("myNavbar");
                                    var sticky = navbar.offsetTop;

                                    function myFunction() {
                                      if (window.pageYOffset >= sticky) {
                                        navbar.classList.add("sticky")
                                      } else {
                                        navbar.classList.remove("sticky");
                                      }
                                    }
                                    </script>
                                <div id="a"></div>
                            <table style="font-family:'Times New Roman', Times, serif;" class="table table-striped">
                                <?php
                                $cntSection=0;
                                $cntSection1=1;
                                for($i=0;$i<count($arrList)-1;$i++){
                                            $arr =array();
                                            foreach(explode("-",$arrList[$i]) as $rec){
                                                array_push($arr,$rec);
                                            }
                                    $sql = "select * from Section where sec_id=".$arr[0];
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_array($result);
                                    if($flagLang){$sec = $row['hsec_name'];}else{$sec = $row['sec_name'];}
                                    
                                    $sql = "select * from SubSection where subsec_id=".$arr[1];
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_array($result);
                                    if($flagLang){$subsec = $row['hsubsec_name'];}else{$subsec = $row['subsec_name'];}
                                    echo "<tr id='section".$arr[0]."'><th style='font-size:25px;'>".$sec."</th><th></th><th></th><th></th><th></th></tr>"."<tr><th style='font-size:20px;'>".$subsec."</th><th></th><th></th><th></th><th></th></tr>";
//                                            $arr1 =array();
//                                            foreach(explode(",",$arr[2]) as $rec){
//                                                array_push($arr1,$rec);
//                                            }
                                    
                                    $sql = "select * from Commodity where commodity_id IN (".$arr[2].")";
                                    
                                    $result = mysqli_query($con,$sql);
                                    $arrCommodity = array();
                                    while($row = mysqli_fetch_array($result)){
                                        $arrCommodity1 = array();
                                       
                                        
                                       if($flagLang){array_push($arrCommodity1,$row['hcommodity_name']);}
                                        else{array_push($arrCommodity1,$row['commodity_name']);} 
                                        array_push($arrCommodity1,$row['commodity_size']);array_push($arrCommodity1,$row['commodity_price']);array_push($arrCommodity1,$row['commodity_id']);
                                        array_push($arrCommodity,$arrCommodity1);
                                    }
                                    
                                    
                                    //echo "<tr><td><input type='checkbox' name='name_".$cntSection."[]' value='".$arrList[$i]."'></td>";
                                    for($j=0;$j<count($arrCommodity);$j++){
                                            echo "<tr style='font-size:15px;'><td><input type='checkbox' name='name_".$arrCommodity[$j][3]."' value='".$arr[0]."-".$arr[1]."-".$arrCommodity[$j][3]."_".$arrCommodity[$j][2]."'></td>";
                                            echo"<td>".$arrCommodity[$j][0]."</td><td>".$arrCommodity[$j][1]."</td><td>Rs. ".$arrCommodity[$j][2]."</td>";
                                            echo "<td><input type='number' name='count_".$arrCommodity[$j][3]."' value='1' min='1' style='width:40px;'></td></tr>";
                                    }
                                    $cntSection1+=1;
                                    //echo "<td><input type='number' name='count_".$cntSection."[]' value='1' min='1' style='width:40px;'></td></tr>";
                                        
                                    }
                                
                                echo "<input type='number' name='SectionCount' value='".$cntSection."' style='display:none;'>";
                                ?>  
                            </table>
                                </div>
                        </div>
                        <div id="review" class="tab-pane fade">
                            <table style="font-family:'Times New Roman', Times, serif;" class="table table-striped">
                                <?php
                                $cntSection=0;
                                for($i=count($arrReview)-1;$i>=0;$i--){
                                    $fillStar1 = "";
                                    $fillStar2 = "";
                                    for($j=0;$j<round($arrReview[$i][5]);$j++){
                                        $fillStar1 .= "<img src='../../../images/fillStar-clipart.jpg' alt='fill' class='star'>";
                                    }
                                    for($j=0;$j<5-round($arrReview[$i][5]);$j++){
                                        $fillStar1 .= "<img src='../../../images/emptyStar-clipart.png' alt='empty' class='star'>";
                                    }
                                    for($j=0;$j<round($arrReview[$i][7]);$j++){
                                        $fillStar2 .= "<img src='../../../images/fillStar-clipart.jpg' alt='fill' class='star'>";
                                    }
                                    for($j=0;$j<5-round($arrReview[$i][7]);$j++){
                                        $fillStar2 .= "<img src='../../../images/emptyStar-clipart.png' alt='empty' class='star'>";
                                    }
                                    echo "<tr><td><b>".$arrReview[$i][0]."<br>".$arrReview[$i][1]." ".$arrReview[$i][2]."</b></td>";
                                    echo "<td><b>Service rating</b><br>".$fillStar1." ".$arrReview[$i][6]."</td>";
                                    echo "<td><b>Product Quality rating</b><br>".$fillStar2." ".$arrReview[$i][8]."</td><tr>";
                                }
                                ?>  
                            </table>
                        </div>
                        <div id="photo" class="tab-pane fade">
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/footer.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/register.php');?>
    </BODY>
</HTML>