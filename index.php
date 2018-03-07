<?php 
$level = "";
require_once($level . "lock.php");
require_once($level . "linkserver.php");
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td><img src="images/logo.png" width="268" height="50"  alt=""/></td>
        <td><img src="<?php 
		$imgpath = "users/images/photo_50.png";
		if($_SESSION['Photo']!="")
		{
			$imgpath = "users/images/". $_SESSION['Id'] . "/".  $_SESSION['Id'] . "_50." . $_SESSION['Photo'];
		
		}
		
		echo $imgpath;
		?>" >
          <br>
  <a href="users/index.php">Manage Users</a><br>
          <a href="logout.php">Logout</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>Welcome <?php echo $_SESSION['Last'];?>!</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="20">
          <tr>
            <td width="25%"><a href="index.php">Add New</a></td>
            <td width="72%">&nbsp;</td>
          </tr>
          <tr>
            <td width="25%">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>