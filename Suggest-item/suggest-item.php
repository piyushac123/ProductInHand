<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>SUGGEST ITEM</TITLE>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="suggest-item.css">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="../libraries/3.4.1-bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
            .time{
                width:50px;
            }
            /*Hide spinner*/
            /* Chrome, Safari, Edge, Opera */
/*
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
              -webkit-appearance: none;
              margin: 0;
            }
*/

            /* Firefox */
/*
            input[type=number] {
              -moz-appearance: textfield;
            }
*/
        </style>
        
        <script src="../libraries/3.5.1-jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="suggest-item.js"></script>
        <script src="../common/common.js"></script>
        
    </HEAD>
    <BODY>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/header.php');?>
                        <?php
                            if(isset($_SESSION['Username'])){
                                
                                if($_SESSION['token'] == $token){
                                    $sql ='select sid from Shopkeeper where rid=(select rid from Registration where Username="'.$_SESSION['Username'].'")';
                                    $result = mysqli_query($con,$sql);
                                    $arrCheck = array();
                                    while($row = mysqli_fetch_array($result)){
                                        array_push($arrCheck,$row['sid']);
                                    }
                                    if(!empty($arrCheck)){
                                ?>
                                
        <form action="accept-suggest-item.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                                <h3 style="font-weight:bold;font-family:'Aclonica';"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Suggest New Item'; }else{echo 'नए वास्तु का सुझाव दे'; }}else{echo 'Suggest New Item';}?></h3>
                            </div>
                    <div class="col-lg-6"><input type="submit" value="PROCEED" name="submitList" style="float:right;"></div>
                </div>
                <div style="margin-top:20px;"></div>
                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a data-toggle="pill" href="#name"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Add Name'; }else{echo 'नाम डालें'; }}else{echo 'Add Name';}?></a></li>
                        <li><a data-toggle="pill" href="#image"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Add image'; }else{echo 'चित्र डालें'; }}else{echo 'Add image';}?></a></li>
                    </ul>
                <div class="tab-content">
                    <div id="name" class="tab-pane fade in active">
                        <div style="margin-top:20px;"></div>
                        <table class="table" id="dynamic_add1">
                            <tr id="rowa1"><th><input type="text" name="item[]" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Enter Item Name'; }else{echo 'आइटम का नाम डालें'; }}else{echo 'Enter Item Name';}?>" class="name-item"></th></tr>
                            <tr><th><span class="remove-item" id="remove-item1"><i class="fa fa-minus"></i></span><span class="add-item" id="add-item1" style="margin-left:10px;"><i class="fa fa-plus"></i></span></th></tr>
                        </table>
                        
                    </div>
                    <div id="image" class="tab-pane fade">
                        <div style="margin-top:20px;"></div>
                        <table class="table" id="dynamic_add2">
                            <tr id="rowb1"><th><input type="file" name="image[]" class="name-item"></th></tr>
                            <tr><th><span class="remove-item" id="remove-item2"><i class="fa fa-minus"></i></span><span class="add-item" id="add-item2" style="margin-left:10px;"><i class="fa fa-plus"></i></span></th></tr>
                        </table>
                    </div>
                </div>
                
            </div>
        </form>
                        <script>
                            $(document).ready(function(){
                                var i=1;
                                $("#add-item1").click(function(){
                                    i++;
                                   $("#dynamic_add1").find('tr:last').before('<tr id="rowa'+i+'"><th><input type="text" name="item[]" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Enter Item Name'; }else{echo 'आइटम का नाम डालें'; }}else{echo 'Enter Item Name';}?>" class="name-item"></th></tr>');
                                });
                                $(document).on('click','#remove-item1',function(){
                                    if(i!=1){
                                        $("#rowa"+i+"").remove();
                                        i--;
                                    }
                                });
                            });
                            $(document).ready(function(){
                                var j=1;
                                $("#add-item2").click(function(){
                                    j++;
                                   $("#dynamic_add2").find('tr:last').before('<tr id="rowb'+j+'"><th><input type="file" name="image[]" class="name-item"></th></tr>');
                                });
                                $(document).on('click','#remove-item2',function(){
                                    if(j!=1){
                                        $("#rowb"+j+"").remove();
                                        j--;
                                    }
                                });
                            });
                        
                        </script>
                                <?php
                                }
                                else{
                                    ?>
                                        <script>
                                            alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Not registered as Shopkeeper!'; }else{echo 'दुकानदार के रूप में पंजीकृत नहीं!'; }}else{echo 'Not registered as Shopkeeper!';}?>");
                                            window.history.back();
                                        </script>
                                    <?php
                                }
                            }
                            else{
                                ?>
        <script>
            alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Login as a registered user'; }else{echo 'एक पंजीकृत उपयोगकर्ता के रूप में लॉगिन करें'; }}else{echo 'Login as a registered user';}?>");
            window.history.back();
        </script>
                                <?php
                            }
                        
                    }
        else{
                                ?>
        <script>
            alert("<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Login as a registered user'; }else{echo 'एक पंजीकृत उपयोगकर्ता के रूप में लॉगिन करें'; }}else{echo 'Login as a registered user';}?>");
            window.history.back();
        </script>
                                <?php
                            }
        
          ?>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/footer.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/register.php');?>
    </BODY>
</HTML>