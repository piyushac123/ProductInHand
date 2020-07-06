<?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/connect.php');?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE>CONTACT</TITLE>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../common/common.css">
        <link rel="stylesheet" href="../libraries/3.4.1-bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
        body {font-family: Arial, Helvetica, sans-serif;overflow-x: hidden;}
        * {box-sizing: border-box;}

        .inputfield {
          width: 100%;
          padding: 12px;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
          margin-top: 6px;
          margin-bottom: 16px;
          resize: vertical;
        }

        .inputbtn {
          background-color: #4CAF50;
          color: white;
          padding: 12px 20px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
        }

        .inputbtn:hover {
          background-color: #45a049;
        }

        .container {
          border-radius: 5px;
          padding: 20px;
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
        <script src="../libraries/3.5.1-jquery.min.js"></script>
        <script src="../common/common.js"></script>
    </HEAD>
    <BODY>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/header.php');?>

        <div class="container">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-6"><h1 style="font-family: 'Aclonica';font-weight:bold;"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Contact Form'; }else{echo 'संपर्क करें'; }}else{echo 'Contact Form';}?></h1></div>
            </div>
            <div class="row">
          <form action="accept-contact.php" method="post">
            <label for="fname"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Name'; }else{echo 'नाम'; }}else{echo 'Name';}?>*</label>
            <input type="text" id="fname" name="name" class="inputfield" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Your name...'; }else{echo 'आपका नाम...'; }}else{echo 'Your name...';}?>" required>
              
              <label for="email"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Email'; }else{echo 'ईमेल'; }}else{echo 'Email';}?>*</label>
            <input type="email" id="email" name="email" class="inputfield" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Your Email ID...'; }else{echo 'आपकी ईमेल आईडी ...'; }}else{echo 'Your Email ID...';}?>" required>
              
              <label for="subject"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Subject'; }else{echo 'विषय'; }}else{echo 'Subject';}?>*</label>
            <input type="text" id="subject" name="subject" class="inputfield" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'How can we help you?'; }else{echo 'हम आपकी किस प्रकार सहायता कर सकते हैं?'; }}else{echo 'How can we help you?';}?>" required>
              
            <label for="suggestion"><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Message'; }else{echo 'संदेश'; }}else{echo 'Message';}?>*</label>
            <textarea id="suggestion" name="suggestion" class="inputfield" placeholder="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'Your Message...'; }else{echo 'आपका सन्देश...'; }}else{echo 'Your Message...';}?>" style="height:200px" required></textarea>
              
              <i><?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo '* fields are mandatory'; }else{echo '* फ़ील्ड अनिवार्य हैं'; }}else{echo '* fields are mandatory';}?></i><br><br>
              
            <input type="submit" value="<?php if(isset($_SESSION['Language'])){if($_SESSION['Language']=='English'){echo 'SUBMIT'; }else{echo 'सब्मिट'; }}else{echo 'SUBMIT';}?>" class="inputbtn" name="submitContact">
          </form>
            </div>
        </div>
        <div class="container">
            <div class="row">
                
            </div>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/footer.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/ProductInHand/register.php');?>
    </BODY>
</HTML>