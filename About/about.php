<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>HOME</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="../libraries/3.4.1-bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
            /*Hide spinner*/
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
              -webkit-appearance: none;
              margin: 0;
            }

            /* Firefox */
            input[type=number] {
              -moz-appearance: textfield;
            }
            .titleImg{
                background-image:url('../images/backgroundImage.jpg');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
        <script src="../libraries/3.5.1-jquery.min.js"></script>
        <script src="../common/common.js"></script>
    </HEAD>
    <BODY>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/header.php');?>
        <div class="jumbotron jumbotron-fluid titleImg">
            <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4"></div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <center>
                    <h2 style="font-family: 'Aclonica';font-weight:bold;color:white;"><u>Welcome</u></h2><br>
                    <h4 style="font-family: 'Aclonica';font-weight:bold;color:white;">We stood right from here</h4>
                    </center>
                </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2"></div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h4>Rasing of the idea behind this application was quite accidental. I grabbed an opportunity of attending an online seminar based on 'STARTUP OPPORTUNITY IN CURRENT SITUATION' in LOCKDOWN period. This gave me an insight to look around for problems faced and get a technical solution for it.</h4>
                </div>
            </div>
        </div>
        
        
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/footer.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/register.php');?>
    </BODY>
</HTML>