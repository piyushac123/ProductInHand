<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>HELP AND SUPPORT</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="../libraries/3.4.1-bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
            body{
                font-family:'Aclonica';
            }
            .iframe1{
                width:420px;
                height:315px;
            }
            @media screen and (max-width: 450px) {
                .iframe1{
                  width:auto;
                    height:315px;
                }
              }
            .bg-primary{
                border-radius:10px;
            }
            .title1{
                color:white;
            }
            .title1:hover{
                
                border-radius:10px;
                background-color:blue;
            }
        </style>
        <script src="../libraries/3.5.1-jquery.min.js"></script>
        <script src="../common/common.js"></script>
    </HEAD>
    <BODY data-spy="scroll" data-target="#myScrollspy" data-offset="20">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/header.php');?>
        <?php 
            $arr = array();

            $dat = file_get_contents('description.txt');
            #explode - split
            #FILTER_SANITIZE_FULL_SPECIAL_CHARS - remove special characters
            foreach(explode("\n",$dat) as $rec){
                array_push($arr, filter_var($rec, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            }
        $arrTitle = array();
        $arrSteps = array();
            for($i=0;$i<count($arr);$i++){
                $arr1 = array();
                foreach(explode(":-",$arr[$i]) as $rec){
                    array_push($arr1, filter_var($rec, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                }
                array_push($arrTitle,$arr1[0]);
                $arrSteps1 = array();
                foreach(explode(";",$arr1[1]) as $rec){
                    array_push($arrSteps1, filter_var($rec, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                }
                array_push($arrSteps,$arrSteps1);
            }
        ?>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-lg-3 col-md-3 col-sm-3" id="myScrollspy">
                    <ul class="nav nav-pills nav-stacked">
                        <?php 
                        for($i=0;$i<count($arrTitle);$i++){
                            echo '<li class="bg-primary"><a class="title1" href="#'.$i.'">'.htmlspecialchars_decode($arrTitle[$i], ENT_QUOTES).'</a></li>';
                        }
                        
                        ?>
                      </ul>
                </nav>
                <div class="col-lg-1 col-md-1 col-sm-1"></div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <i>If you are facing sound problem regarding playing YOUTUBE video watch this</i> - <a href='https://www.youtube.com/watch?v=HAZr18LsNfc' target="_blank">LINK</a>
                    <?php
                        for($i=0;$i<count($arrTitle);$i++){
                            echo "<div id='".$i."'>";
                            echo "<h1><b>".htmlspecialchars_decode($arrTitle[$i], ENT_QUOTES)."</b></h1>";
                            ?>
                     <iframe class='iframe1'
                        src="https://www.youtube.com/embed/fAn0PhDCqnU">
                        </iframe> 
                    <?php
                            echo "<ol>";
                            for($j=0;$j<count($arrSteps[$i]);$j++){
                                echo "<h4><li>";
                                echo htmlspecialchars_decode($arrSteps[$i][$j], ENT_QUOTES);
                                echo "</li></h4>";
                            }
                            echo "</ol>";
                            echo "</div>";
                        }
                    ?>
                    
                </div>
            </div>
        </div>
        
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/footer.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/register.php');?>
    </BODY>
</HTML>