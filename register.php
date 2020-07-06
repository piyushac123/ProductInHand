<!--Start For Login-->   
        <div id="login-box" class="login-popup">
            <a href="#" class="close"><i style="font-size:24px" class="fa btn_close">&#xf00d;</i></a>
            <h3 class="titlelog">
                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Login Page'; }else{echo 'लॉगिन पेज'; }}else{echo 'Login Page';}?>
            </h3>
            <form method="post" class="signin" action="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/login.php">
                <fieldset>
                    <span><input type="text" name="username" class="input1" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Enter username'; }else{echo 'यूजरनाम डालें'; }}else{echo 'Enter username';}?>"></span>
                    <span><input type="password" name="password" class="input1" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Enter password'; }else{echo 'पासवर्ड डालें'; }}else{echo 'Enter password';}?>"></span><br>
                    <input type="reset" value="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'RESET'; }else{echo 'रिसेट'; }}else{echo 'RESET';}?>" class="button1">
                    <input type="submit" value="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'SUBMIT'; }else{echo 'सब्मिट'; }}else{echo 'SUBMIT';}?>" name="signin" class="button1"><br>
                <a class="forgot" href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/forgotPassword.php">
                    <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Forgot your password?'; }else{echo 'पासवर्ड भूल गए हैं?'; }}else{echo 'Forgot your password?';}?>
                    </a>
                </fieldset>
            </form>
        </div>
        <!--End For SignUp-->
                <!--Start For Login-->   
        <div id="register-box" class="login-popup">
            <a href="#" class="close"><i style="font-size:24px" class="fa btn_close">&#xf00d;</i></a>
            <h3 class="titlelog">
                <?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Create New Account'; }else{echo 'नया अकाउंट बनाएँ'; }}else{echo 'Create New Account';}?>
            </h3>
            <form method="post" class="signin" action="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ProductInHand/Home/login.php">
                <fieldset>
                    <input type="text" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Enter Full Name'; }else{echo 'पूरा नाम डालें'; }}else{echo 'Enter Full Name';}?>" class="input1" name="name">
                    <input type="number" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Enter Phone number'; }else{echo 'फ़ोन नंबर डालें'; }}else{echo 'Enter Phone number';}?>" class="input1 hide-spinner" name="phone">
                    <input type="text" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Enter Username'; }else{echo 'यूजरनाम डालें'; }}else{echo 'Enter Username';}?>" class="input1" name="username">
                    <input type="password" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Enter Password'; }else{echo 'पासवर्ड डालें'; }}else{echo 'Enter Password';}?>" class="input1" name="password">
                    <input type="password" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Re-enter Password'; }else{echo 'दुबारा पासवर्ड डालें'; }}else{echo 'Re-enter Password';}?>" class="input1" name="rpassword">
                    <input type="reset" value="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'RESET'; }else{echo 'रिसेट'; }}else{echo 'RESET';}?>">
                    <input type="submit" value="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'SUBMIT'; }else{echo 'सब्मिट'; }}else{echo 'SUBMIT';}?>" name="signup">
                </fieldset>
            </form>
        </div>
        <!--End For SignUp-->