<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>HOME</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="../libraries/3.4.1-bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
            .shop-icon{
                height: 100px;
                width: 100px;
                margin-top:20px;
                cursor: pointer;
            }       
            .motiveSticker{
                height: 250px;
                width: 250px;
                margin-bottom: 20px;
            }
            .footer-text{
                font-size: 20px;
                list-style-type: none;
                margin-left: -30px;
                cursor: pointer;
            }
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
            
        </style>
<!--        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAAwoG2TIcQWFhojQgN3mfntPUiJKJJ7VA&callback=initMap" async defer></script>-->
<!--
        <script>
            function initMap(){
                var input = document.getElementById('searchInput');
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo('bounds', map);

                var infowindow = new google.maps.InfoWindow();
                var marker = new google.maps.Marker({
                    map: map,
                    anchorPoint: new google.maps.Point(0, -29)
                });
                var place = autocomplete.getPlace();
                var address = '';
                if (place.address_components) {
                    address = [
                      (place.address_components[0] && place.address_components[0].short_name || ''),
                      (place.address_components[1] && place.address_components[1].short_name || ''),
                      (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }
                // Location details
                for (var i = 0; i < place.address_components.length; i++) {
                    if(place.address_components[i].types[0] == 'postal_code'){
                        document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
                    }
                    if(place.address_components[i].types[0] == 'country'){
                        document.getElementById('country').innerHTML = place.address_components[i].long_name;
                    }
                }
                document.getElementById('location').innerHTML = place.formatted_address;
                document.getElementById('lat').innerHTML = place.geometry.location.lat();
                document.getElementById('lon').innerHTML = place.geometry.location.lng();
            }
        </script>
-->
        
        
        <script src="../libraries/3.5.1-jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="home.js"></script>
        <script src="../common/common.js"></script>
    </HEAD>
    <BODY>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/headerHome.php');
        
        //echo $_SERVER['DOCUMENT_ROOT'].'/ProductInHand/header.php';?>
        <script>

//            function showResult(str) {
//          if (str.length==0) {
//            document.getElementById("livesearch").innerHTML="";
//            document.getElementById("livesearch").style.display="none";
//            return;
//          }
//          var xmlhttp=new XMLHttpRequest();
//          xmlhttp.onreadystatechange=function() {
//            if (this.readyState==4 && this.status==200) {
//              document.getElementById("livesearch").innerHTML=this.responseText;
//                document.getElementById("livesearch").style.display="block"; 
//              document.getElementById("livesearch").style.border="1px solid #A5ACB2";
//            }
//          }
//          xmlhttp.open("GET","search.php?q="+str,true);
//          xmlhttp.send();
//        }
//            $('#singleSearch').live('click','li',function(){
//                   document.getElementById('searchInput').innerHTML="Hello";
//                $(this).css('background','#d9f531');
//            });
        </script>
        <form method="post" action="Shop-list/shop-list.php" autocomplete="off">
        <div class="jumbotron jumbotron-fluid titleImg">
            <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4"></div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <center>
                    <h2 style="font-family:'Aclonica';margin-bottom:30px;color:white"><i>We are here to enrich shopping style</i></h2>
                    <div class="autocomplete">
                        
                        <?php 
                        $City=NULL;
                        if(isset($_SESSION['Username']) && $_SESSION['token']==$token){
                            if($city!=NULL && $state!=NULL){$City = $city.", ".$state;}
                        }?>
                        <input type="text" name="location" style="size:30px" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Search City'; }else{echo 'शहर खोजो'; }}else{echo 'Search City';}?>" class="search-bar controls" id="myInput" value="<?php if($City==NULL){echo "";}else{echo $City;}?>" required>
                    </div>
                        <?php
                            $sql = "select City,State from Shopkeeper";
                            $result = mysqli_query($con,$sql);
                            $value = "";
                            $arrCity = array();
                            while($row = mysqli_fetch_array($result)){
                                $flag1=0;
                                for($i=0;$i<count($arrCity);$i++){
                                    if($arrCity[$i]==$row['City'].", ".$row['State']){
                                        $flag1=1;
                                        break;
                                    }
                                }
                                if(!$flag1){
                                    array_push($arrCity,$row['City'].", ".$row['State']);
                                }
                                
                            }
//                            for($i=0;$i<count($arrCity);$i++){
//                                echo $arrCity[$i];
//                            }
                        ?>
                    <script>
                         var city = [<?php for($i=0;$i<count($arrCity)-1;$i++){echo '"'.$arrCity[$i].'", ';} echo '"'.$arrCity[count($arrCity)-1].'"'?>];
                        autocomplete(document.getElementById("myInput"), city);
                    </script>
<!--
                    <div style="position:relative;z-index:0;">
                        <div id="livesearch" class="livesearch" style="position:absolute;z-index:1;"></div>
                    </div>
-->
                    </center>
                </div>
                
                
                <!-- Google map -->
<!--                <div id="map"></div>-->

                <!-- Display geolocation data -->
<!--
                <ul class="geo-data">
                    <li>Full Address: <span id="location"></span></li>
                    <li>Postal Code: <span id="postal_code"></span></li>
                    <li>Country: <span id="country"></span></li>
                    <li>Latitude: <span id="lat"></span></li>
                    <li>Longitude: <span id="lon"></span></li>
                </ul>
-->     </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-0"></div>
                <div class="col-lg-4 col-sm-12" style="font-family:'Aclonica';text-align:center;"><h2>
                     <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Our Motivation'; }else{echo 'हमारी प्रेरणा'; }}else{echo 'Our Motivation';}?>
                </h2></div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6"><img src="../images/motivation1.png" alt="motivation1" class="motiveSticker"></div>
                <div class="col-lg-3 col-md-6 col-sm-6"><img src="../images/motivation2.png" alt="motivation2" class="motiveSticker"></div>
                <div class="col-lg-3 col-md-6 col-sm-6"><img src="../images/motivation3.png" alt="motivation3" class="motiveSticker"></div>
                <div class="col-lg-3 col-md-6 col-sm-6"><img src="../images/motivation4.png" alt="motivation4" class="motiveSticker"></div>
            </div>
        </div>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="row" style="font-family:'Aclonica';text-align:center;">
                    <div class="col-lg-4"><h3><b>Enthusiastic service providers create enthusiastic customers</b></h3>
                        <b style="margin-top:50px;">
                            <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Select as per your choice..."; }else{echo "अपनी पसंद के अनुसार चुनें ..."; }}else{echo "Select as per your choice...";}?>
                        </b></div>
                    <div class="col-lg-4 col-lg-6 col-sm-6">
                        <button type="submit" name="grocery" class="shop-icon-btn" value="grocery and essentials"><img src="../images/grocery3.png" alt="grocery" class="shop-icon"></button><br>
                        <b>
                            <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Grocery and Essentials"; }else{echo "किराने और आवश्यक वस्तुएं"; }}else{echo "Grocery and Essentials";}?>
                        </b><br>
                        <button type="submit" name="medicine" class="shop-icon-btn" value="medicines"><img src="../images/medicine-clipart.png" alt="medicine" class="shop-icon"></button><br>
                        <b>
                            <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Medicines"; }else{echo "दवाइयाँ"; }}else{echo "Medicines";}?>
                        </b>
                    </div>
                    <div class="col-lg-4 col-lg-6 col-sm-6">
                        <button type="submit" name="book" class="shop-icon-btn" value="books and stationary"><img src="../images/book-clipart2.png" alt="book" class="shop-icon"></button><br>
                        <b>
                            <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Books and Stationary"; }else{echo "पुस्तकें और स्टेशनरी"; }}else{echo "Books and Stationary";}?>
                        </b><br>
                        <button type="submit" name="gift" class="shop-icon-btn" value="gifts and lifestyle"><img src="../images/gift-clipart2.png" alt="gift" class="shop-icon"></button><br>
                        <b>
                            <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Gifts and Lifestyle"; }else{echo "उपहार और जीवन शैली"; }}else{echo "Gifts and Lifestyle";}?>
                        </b>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-0"></div>
                <div class="col-lg-5 col-sm-12" style="font-family:'Aclonica';text-align:center;">
                    <h2><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Take a look at our features"; }else{echo "हमारी सुविधाओं पर एक नज़र डालें"; }}else{echo "Take a look at our features";}?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                        <li data-target="#myCarousel" data-slide-to="4"></li>
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <img src="../images/feature1.jpg" alt="feature1" style="height:400px;width:400px;margin:auto;">
                        </div>

                        <div class="item">
                          <img src="../images/feature2.jpg" alt="feature2" style="height:400px;width:400px;margin:auto;">
                        </div>

                        <div class="item">
                          <img src="../images/feature3.jpg" alt="feature3" style="height:400px;width:400px;margin:auto;">
                        </div>
                          
                        <div class="item">
                          <img src="../images/feature4.jpg" alt="feature4" style="height:400px;width:400px;margin:auto;">
                        </div>
                          
                        <div class="item">
                          <img src="../images/feature5.jpg" alt="feature5" style="height:400px;width:400px;margin:auto;">
                        </div>
                      </div>

                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                </div>
            </div>
        </div>
        </form>
        
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/footer.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/register.php');?>
    </BODY>
</HTML>