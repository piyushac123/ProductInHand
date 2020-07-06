<div class="jumbotron jumbotron-fluid" style="margin-top:50px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6"><span class="logoText">Product.InHand</span></div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <form method="post" action="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/switchLang.php">
                            <div style="float:right;">
                            <label>Language : </label>
                            <select name="lang" id="lang" onchange="this.form.submit()">
                                <?php
                                if(isset($_SESSION['Language'])){
                                if($_SESSION['Language']=="Hindi"){
                                ?>
                                <option value="English">English</option>
                                <option value="Hindi" selected="selected">हिन्दी</option>
                                <?php
                                }
                                else{
                                  ?>
                                    <option value="English" selected="selected">English</option>
                                    <option value="Hindi">हिन्दी</option>
                                <?php
                                }
                                }
                                else{
                                   ?>
                                    <option value="English" selected="selected">English</option>
                                    <option value="Hindi">हिन्दी</option>
                                <?php 
                                }
                                ?>
                                
                            </select>
                                </div>
                            </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3" style="font-size:20px;margin-top:20px;">
                        <b>
                            <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Company'; }else{echo 'कंपनी'; }}else{echo 'Company';}?>
                        </b>
                        <ul class="footer-text">
                            <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/About/about.php" class="link2">
                                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "About"; }else{echo "के बारे में"; }}else{echo "About";}?>
                            </a></li>
                            <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Suggestion/suggestion.php" class="link2">
                                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Suggestion"; }else{echo "सुझाव"; }}else{echo "Suggestion";}?>
                            </a></li>
                            <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Complaint/complaint.php" class="link2">
                                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Complaint"; }else{echo "शिकायत"; }}else{echo "Complaint";}?>
                                </a>
                            </li>
                            <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Contact/contact.php" class="link2">
                                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Contact"; }else{echo "संपर्क करें"; }}else{echo "Contact";}?>
                            </a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3" style="font-size:20px;margin-top:20px;">
                        <b>
                            <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "For Shopkeeper"; }else{echo "दुकानदार के लिए"; }}else{echo "For Shopkeeper";}?>
                        </b>
                        <ul class="footer-text">
                            <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Shop-Details/shop-detail.php" class="link2">
                                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Add shop details"; }else{echo "दुकान का विवरण डालें"; }}else{echo "Add shop details";}?>
                            </a></li>
                            <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Shopkeeper_History/shop-history.php" class="link2">
                                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Order History"; }else{echo "ऑर्डर का इतिहास"; }}else{echo "Order History";}?>
                            </a></li>
                            <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Suggest-item/suggest-item.php" class="link2">
                                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Suggest more item"; }else{echo "अधिक वस्तुओ का सुझाव दें"; }}else{echo "Suggest more item";}?>
                                </a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3" style="font-size:20px;margin-top:20px;">
                        <b>
                            <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "For you"; }else{echo "आप के लिए"; }}else{echo "For you";}?>
                        </b>
                        <ul class="footer-text">
                            <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Customer_History/customer-history.php" class="link2">
                                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Transaction History"; }else{echo "व्यवहार का इतिहास"; }}else{echo "Transaction History";}?>
                            </a></li>
                            <li>
                                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Privacy and Security"; }else{echo "गोपनीयता और सुरक्षा"; }}else{echo "Privacy and Security";}?>
                            </li>
                            <li>
                                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Terms and Conditions"; }else{echo "नियम और शर्तें"; }}else{echo "Terms and Conditions";}?>
                            </li>
                            <li><a href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Website-tour/website-tour.php" class="link2">
                                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Help and Support"; }else{echo "सहायता और समर्थन"; }}else{echo "Help and Support";}?>
                                </a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3" style="font-size:20px;margin-top:20px;">
                        <b>
                             <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=="English"){echo "Social Media"; }else{echo "सोसिअल मीडिया"; }}else{echo "Social Media";}?>
                        </b><br>
                            <a href="https://www.facebook.com/groups/1445249585659617/"><i class="fa fa-facebook"></i></a>
                              <a href="https://twitter.com/login?lang=en"><i class="fa fa-twitter"></i></a>
                              <a href="https://plus.google.com/discover"><i class="fa fa-google"></i></a>
                              <a href="https://in.linkedin.com/"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>