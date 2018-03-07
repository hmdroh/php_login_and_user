<?php 
$level = "";
require_once($level . "lock.php");
require_once($level . "linkserver.php");
if(!isset($_SESSION['Password_Expired'])){header("Location: index.php");exit;
}

if(isset($_POST['Password1']))
{
	
	
	
	///////////////////
	$errors = 0;
	$err_val = "?msg=Problem in new password.";
	$Add_New_Password1 = $_POST["Password1"];
	$Add_New_Password2 = $_POST["Password2"];
	
	//check if the password is not less then 8 characters and not more then 16
	if((strlen($Add_New_Password1) <= 16) and (strlen($Add_New_Password1) >= 8)){
		// password lenght is right:
		
		// check if password 1 = password 2 ?:
		if($Add_New_Password1 == $Add_New_Password2){
		//passwords are correct: next step server validations: here
		$Password = sha1($Add_New_Password1);
		$Id = $_SESSION['Id'];
	
	/// checck if it is same as old password
	$check = mysql_query("SELECT Password FROM `users` WHERE `Id`='$Id'");
	if(mysql_result($check,0,"Password") != $Password){
	
			if(mysql_query("
			UPDATE users SET `Password` = '$Password', `Password_Expired` = '0'
			WHERE `Id`='$Id'
			")){
					unset($_SESSION['Password_Expired']);
					header("Location: index.php");
					exit;
				}
	}else{
		$errors++;
		$err_val .= "<br>The new password could not be same as the old password. Please enter a new password";
	}
			
		
		}else{
		$errors++;
		$err_val .= "<br>Passwords did not match. Please type a correct password and re-type it in the second box.";	
		}
		
		
	}else{
	$errors++;
	$err_val .="<br>Password length is too less, please add a longer 8-16 charachter password.";
		// password lenght is wrong do this:
	}
	
	
	
	
	////////////////////////
	
	
	
	
	
	
if($errors>0){
header("Location: expired.php" . $err_val);
exit;
}
	
		
}

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Expired Password</title>
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
#UserP {
	text-align: center;
	padding: 10px;
	height: 25px;
	width: 268px;
	border: 1px solid #C7C7C7;
	font-size: 20px;
	color: #000000;
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
	background-color: #F7F7F7;
}
.logout {
	background-color: #FE4D4D;
	border: 1px solid #ED3030;
	color: #FFFFFF;
	text-shadow: 0px 1px rgba(0, 0, 0, 0.1) 0px;
	height: 36px;
	width: 100%;
}
</style>
<script type="text/javascript">
//images/logo.png
window.onload = function (){
var images = document.getElementsByTagName("img");

images[0].src ="images/logo.png"; 
<?php // change the photo
$PPhoto = "photo_80.png";
if($_SESSION['Photo'] !=""){
$PPhoto = $_SESSION['Id'] . "/" . $_SESSION['Id'] . "_80." . $_SESSION['Photo'];
}
 ?>
images[1].src ="users/images/<?php echo $PPhoto; ?>"; 

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
            <td align="center"><form action="expired.php" method="post" name="Login" id="Login">
              <img width="268" height="50" alt=""/><br>
              
              <table width="268" border="0" cellpadding="3" cellspacing="0" class="tableLogin">
                <tbody>
                  <tr>
                    <td align="center" valign="middle" bgcolor="#EEF0F0"><img src="./" alt="" width="80" height="80"/></td>
                    </tr>
                  <tr>
                    <td align="left" valign="middle" bgcolor="#EEF0F0"><p id="UserP"><?php echo $_SESSION['Username']; ?><br>
                        <span class="info">Password has expired, Enter  new password.</span></p></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" bgcolor="#EEF0F0"><input name="Password1" type="password" class="textboxclass" id="Password1" placeholder="New Password 8-16 Characters." maxlength="20"></td>
                    </tr>
                  <tr>
                    <td align="left" valign="top" bgcolor="#EEF0F0"><input name="Password2" type="password" class="textboxclass" id="Password2" placeholder="Confirm Password" maxlength="20"></td>
                    </tr>
                  <tr>
                    <td align="center" bgcolor="#EEF0F0"><p>
                      <input type="submit" name="submit" id="submit" value="Save Password">
                      <br>
                      <input onClick="javascript:window.location.href='logout.php'" name="Logout" type="button" class="logout" id="Logout" value="Logout">
                    </p></td>
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