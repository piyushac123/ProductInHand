<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>RATING</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="rating.css">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="../libraries/3.4.1-bootstrap.min.css">
        <script src="../libraries/3.5.1-jquery.min.js"></script>
        <script src="rating.js"></script>
        <script src="../common/common.js"></script>
    </HEAD>
    <BODY>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php" class="link2">
                    <img src="../images/bagLogo.jpg" alt="logo" class="logoImg">
                    <span class="logoText margin1">Product.InHand</span>
                    </a>
                </div>
            </div>
        </div>
        <form method="post" action="accept-rating.php">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6"><h1 style="font-family: 'Aclonica';font-weight:bold;text-align:center;">
                     
                    <?php
                    $flagLang = 0;
                            if(isset($_SESSION['Language'])){
                                if($_SESSION['Language']=='English'){
                                        echo "Rate your Experience!"; 
                                }else{
                                 echo "अपने अनुभव को रेट करें!"; 
                                 $flagLang=1;
                                    }
                                    }
                                    else{
                                        echo "Rate your Experience!"; 
                                    }
                    ?>
                </h1></div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="text-align:center;">
                    <h2 style="font-family: 'Aclonica';font-weight:bold;">
                         <?php if($flagLang){echo "हमारे एप्लीकेशन को रेट करें";}else{echo "Rate our Application";}?>
                    </h2>
                    <div style="margin-top:20px;">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app1">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app2">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app3">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app4">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app5">
                        <input type="number" name="appStar" id="appStar" style="display: none;">
                    </div>
                    <div style="margin-top:20px;"><input type="text" name="app" placeholder="<?php if($flagLang){echo 'कोई सुझाव';}else{echo 'Any suggestion';}?>" class="inputComment" maxlength="200"></div>
                </div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="text-align:center;">
                    <h2 style="font-family: 'Aclonica';font-weight:bold;">
                         <?php if($flagLang){echo "दुकानदार की सेवा को रेट करें";}else{echo "Rate Shopkeeper Service";}?>
                    </h2>
                    <div style="margin-top:20px;">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper1">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper2">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper3">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper4">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper5">
                        <input type="number" name="shopkeeperStar" id="shopkeeperStar" style="display: none;">
                    </div>
                    <div style="margin-top:20px;"><input name="shopkeeper" type="text" placeholder="<?php if($flagLang){echo 'कोई सुझाव';}else{echo 'Any suggestion';}?>" class="inputComment" maxlength="200"></div>
                </div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="text-align:center;">
                    <h2 style="font-family: 'Aclonica';font-weight:bold;">
                         <?php if($flagLang){echo 'उत्पाद की गुणवत्ता को रेट करें';}else{echo 'Rate Product Quality';}?>
                    </h2>
                    <div style="margin-top:20px;">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product1">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product2">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product3">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product4">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product5">
                        <input type="number" name="productStar" id="productStar" style="display: none;">
                    </div>
                    <div style="margin-top:20px;"><input name="product" type="text" placeholder="<?php if($flagLang){echo 'कोई सुझाव';}else{echo 'Any suggestion';}?>" class="inputComment" maxlength="200"></div>
                </div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="text-align:center;">
                    <input type="submit" name="submitSkip" value="<?php if($flagLang){echo 'स्किप';}else{echo 'SKIP';}?>">
                    <input type="submit" name="submitReview" value=" <?php if($flagLang){echo 'सबमिट';}else{echo 'SUBMIT';}?>">
                </div>
                
            </div>
        </div>
            <input type="number" name="lid" value="<?php echo $_GET['lid'];?>" style="display:none;">
        </form>
    </BODY>
</HTML>
        