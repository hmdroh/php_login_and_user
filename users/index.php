<?php 
//session_start();
$level = "../";
require_once($level . "lock.php");
require_once($level . "linkserver.php");
require_once($level . "functions.php");







?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Users</title>
<style type="text/css">
body {
	background-color: #FFFFFF;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
	color: #3B3B3B;
}
h1 {
	color: #FF0004;
	font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
	font-size: 1.3em;
}
h2 {
	font-size: 1.1em;
	color: #9F0F0F;
}
.span_act {
	color: #0AFF00;
	background-color: #0D8334;
}
a {
	color: #F50F13;
}
.span_deact {
	color: #FF0004;
	background-color: #972211;
}
.ban1 {
	background-color: #C6C6C6;
}
.ban1:hover {
	background-color: #E3DDDD;
}
.ban2 {
	background-color: #E1E1E1;
}
.ban2:hover {
	background-color: #E3DDDD;
}
.tbl_title {
	background-color: #FF0004;
	color: #FFFFFF;
}
.inTitle {
	color: #807B7B;
}
.tbl_title td strong a {
	color: #FFFFFF;
}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tbody>
          <tr>
            <td align="center" valign="top"><h1>User Management</h1></td>
          </tr>
          <tr>
            <td align="center" valign="top"><table width="500" border="0" cellspacing="0" cellpadding="5">
              <tbody>
                <tr>
                  <td align="left"><a href="../index.php"><img src="images/back_25.png" width="25" height="25" id="add_img2" alt="" align="middle" /></a><a href="../index.php">Go back to Home Page</a></td>
                  </tr>
                <tr>
                  <td align="left"><a href="signup.php?ref=new"><img src="images/add_25.png" width="25" height="25" id="add_img" alt="" align="middle" />Create new user</a></td>
                </tr>
              </tbody>
            </table></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tbody>
          <tr>
            <td align="center" valign="top"><h2>List of current users:</h2></td>
          </tr>
          <tr>
            <td align="center" valign="top"><table width="616" border="1" cellspacing="0" cellpadding="5">
              <tbody>
                <tr class="tbl_title">
                  <td width="1%" nowrap="nowrap">&nbsp;</td>
                  <td width="67" nowrap="nowrap"><strong><a href="<?php
				  $by2 = "Name"; $order2 ="ASC"; /// Each initial feild data
				   if(isset($_GET['By'])){if($_GET['By']==$by2){
					   if(isset($_GET['Order'])){
					   		if($_GET['Order']=='ASC'){$order2="DESC";}
					   }
					   
					   }} 
					   echo "?By=". $by2 . "&Order=" . $order2;
					   ?>">Name</a></strong></td>
                  <td width="105" nowrap="nowrap"><strong><a href="<?php
				  $by2 = "Username"; $order2 ="ASC"; /// Each initial feild data
				   if(isset($_GET['By'])){if($_GET['By']==$by2){
					   if(isset($_GET['Order'])){
					   		if($_GET['Order']=='ASC'){$order2="DESC";}
					   }
					   
					   }} 
					   echo "?By=". $by2 . "&Order=" . $order2;
					   ?>">Email</a></strong></td>
                  <td width="92" nowrap="nowrap"><strong>Contacts</strong></td>
                  <td width="99" nowrap="nowrap"><strong><a href="<?php
				  $by2 = "Home_Address"; $order2 ="ASC"; /// Each initial feild data
				   if(isset($_GET['By'])){if($_GET['By']==$by2){
					   if(isset($_GET['Order'])){
					   		if($_GET['Order']=='ASC'){$order2="DESC";}
					   }
					   
					   }} 
					   echo "?By=". $by2 . "&Order=" . $order2;
					   ?>">Address</a></strong></td>
                  <td width="99" nowrap="nowrap"><strong>Store Name</strong></td>
                  <td width="1%" nowrap="nowrap"><strong>Activated</strong></td>
                  <td width="1%" nowrap="nowrap">&nbsp;</td>
                </tr>
     <?php 
//Get data from GET sort and by
	 if(isset($_GET['By'])){$By = $_GET['By'];}else{$By='Id';}
	 if(isset($_GET['Order'])){$Order = $_GET['Order'];}else{$Order='DESC';}

	 $thesql = mysql_query("SELECT * FROM users ORDER BY $By $Order;");
	 $cssstyle = "";

	 while($sql = @mysql_fetch_array($thesql)){
	 if($cssstyle == "ban1"){$cssstyle="ban2";}else{$cssstyle="ban1";}
	 
	 ?>           
                <tr class="<?php echo $cssstyle;?>">
                  <td width="1%" align="center" valign="middle" nowrap="nowrap"><img src="<?php 
				 $defImg ="images/photo_50.png"; 
				  if($sql["Photo"]!=""){
					  
					  $defImg = "images/" . $sql['Id'] . "/". $sql['Id'] . "_50." . $sql["Photo"];}
					  echo $defImg;
				  
				  ?>" width="50" height="50" alt=""/></td>
                  <td><?php echo $sql['Name'] . " " . $sql['Last_Name']; ?></td>
                  <td nowrap="nowrap"><?php echo $sql['Username'];?></td>
                  <td><p><?php echo $sql['Mobile'];?><br>
                    <span class="inTitle">FB: </span><?php echo $sql['Facebook'];?><br>
                    <span class="inTitle">Skype: </span><?php echo $sql['Skype'];?>
                  </p></td>
                  <td><?php echo $sql['Home_Address'];?></td>
                  <td><?php 
				  $getStore = mysql_query("SELECT * FROM stores Where Id=" . $sql['Store_Id']) ;
				  while($getStoreName = mysql_fetch_array($getStore)){
				  echo $getStoreName['Name'];
				  }
				   ?></td>
                  <td width="1%" nowrap="nowrap">
                  <?php $act = $sql['Activated'];
				  if($act == 1){?>
                  <p class="span_act">Active</p><?php }else{?>
                    <p class="span_deact">Inactive</p></td>
                  <?php }?>
                  
                  <td width="1%" nowrap="nowrap"><a href="edit.php?uId=<?php echo $sql['Id']; ?>">EDIT</a></td>
                </tr>
           <?php } /// end of fetch array sql;?>     
                
              </tbody>
            </table></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>