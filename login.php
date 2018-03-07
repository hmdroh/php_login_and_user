<?php 
session_start();
if(isset($_SESSION['Id']))
{	
	echo "Click here to login...." ; 
	header("Location: index.php");
	exit;
}


?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<style type="text/css">
.Captcha {
	text-align: center;
	letter-spacing: 5px;
	font-weight: bold;
}
label {
}
#submit {
	background-color: #4D90FE;
	border: 1px solid #3079ED;
	color: #FFFFFF;
	text-shadow: 0px 1px rgba(0, 0, 0, 0.1) 0px;
	height: 36px;
	width: 100%;
}
#Captcha {
	width: 70px;
}
body {
	font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
	color: #282828;
}
.info {
	color: #1C2D8C;
	font-size: small;
}
.textboxclass {
	padding: 10px;
	height: 40px;
	width: 268px;
	border: 1px solid #A0A0A0;
	font-size: 18px;
}
.tableLogin {
}
.error {
	color: #FF0004;
}
</style>
<script type="text/javascript">
//images/logo.png
window.onload = function (){
var images = document.getElementsByTagName("img");

images[0].src ="images/logo.png"; 
images[1].src ="users/images/photo_80.png"; 

}

</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><table width="600" border="0" cellspacing="0" cellpadding="5">
        <tbody>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><form action="process.php" method="post" name="Login" id="Login">
              <img width="268" height="50" alt=""/><br>
              
              <table width="268" border="0" cellpadding="3" cellspacing="0" class="tableLogin">
                <tbody>
                  <tr>
                    <td align="center" valign="middle" bgcolor="#EEF0F0"><img width="80" height="80" alt=""/></td>
                    </tr>
                  <tr>
                    <td align="left" valign="top" bgcolor="#EEF0F0"><input name="User" type="text" class="textboxclass" id="User" placeholder="Username" maxlength="30"></td>
                    </tr>
                  <tr>
                    <td align="left" valign="top" bgcolor="#EEF0F0"><input name="Password" type="password" class="textboxclass" id="Password" placeholder="Password" maxlength="20"></td>
                    </tr>
                  <tr>
                    <td align="center" bgcolor="#EEF0F0"><p>
                      <input type="submit" name="submit" id="submit" value="Login">
                    </p>
                      <p>Forgotten your <a href="#">password</a>?</p></td>
                  </tr>
                 
                 <?php if(isset($_GET['msg'])){ ?> <tr>
                    <td align="center" class="error" bgcolor="#EEF0F0"><?php echo $_GET['msg']; ?>&nbsp;</td>
                  </tr><?php } ?>
                </tbody>
              </table>
            </form></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>