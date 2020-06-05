<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>RATING</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="rating.css">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="rating.js"></script>
        <script src="../common/common.js"></script>
    </HEAD>
    <BODY>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/home.php" class="link2">
                    <img src="../images/bagLogo.jpg" alt="logo" class="logoImg">
                    <span class="logoText" style="margin-left: -50px;">SACI</span>
                    </a>
                </div>
            </div>
        </div>
        <form method="post" action="accept-rating.php">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6"><h1 style="font-family: 'Aclonica';font-weight:bold;text-align:center;">Rate your Experience!</h1></div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="text-align:center;">
                    <h2 style="font-family: 'Aclonica';font-weight:bold;">Rate our Application</h2>
                    <div style="margin-top:20px;">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app1">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app2">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app3">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app4">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="app5">
                        <input type="number" name="appStar" id="appStar" style="display: none;">
                    </div>
                    <div style="margin-top:20px;"><input type="text" name="app" placeholder="Any suggestion" class="inputComment" maxlength="200"></div>
                </div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="text-align:center;">
                    <h2 style="font-family: 'Aclonica';font-weight:bold;">Rate Shopkeeper Service</h2>
                    <div style="margin-top:20px;">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper1">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper2">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper3">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper4">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="shopkeeper5">
                        <input type="number" name="shopkeeperStar" id="shopkeeperStar" style="display: none;">
                    </div>
                    <div style="margin-top:20px;"><input name="shopkeeper" type="text" placeholder="Any suggestion" class="inputComment" maxlength="200"></div>
                </div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="text-align:center;">
                    <h2 style="font-family: 'Aclonica';font-weight:bold;">Rate Product Quality</h2>
                    <div style="margin-top:20px;">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product1">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product2">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product3">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product4">
                        <img src='../images/emptyStar-clipart.png' alt='empty' class='star' id="product5">
                        <input type="number" name="productStar" id="productStar" style="display: none;">
                    </div>
                    <div style="margin-top:20px;"><input name="product" type="text" placeholder="Any suggestion" class="inputComment" maxlength="200"></div>
                </div>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6" style="text-align:center;">
                    <input type="submit" name="submitSkip" value="SKIP">
                    <input type="submit" name="submitReview" value="SUBMIT">
                </div>
                
            </div>
        </div>
            <input type="number" name="lid" value="<?php echo $_GET['lid'];?>" style="display:none;">
        </form>
    </BODY>
</HTML>
        