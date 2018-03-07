<?php 
//session_start();
$level = "../";
require_once($level . "lock.php");
require_once($level . "linkserver.php");
require_once($level . "functions.php");




///Edit Processing:

if(isset($_POST['User_Id']))
{

////the following code is a copy so don't confuse some variables

	// if user name exists:
$uId = $_POST['User_Id'];	
$anyerror = 0;	
	$fullerrors = "?msg=Please type the information correctly.";// for header
	$Add_New_Password1 = $_POST["Password1"];
	$Add_New_Password2 = $_POST["Password2"];
	$Add_New_User_Type = $_POST['User_Type'];
	$Add_New_User_Change = 0;
	$Change_Password = 0;
	if(isset($_POST['Password_Expired'])){$Add_New_User_Change=$_POST['Password_Expired'];} // this is if user wants to change next login
	$Add_New_Activated = 0; /// if user be active or not
	if(isset($_POST['Activated'])){$Add_New_Activated=$_POST['Activated'];}

	
if($Add_New_Password1!=""){
	//check if the password is not less then 8 characters and not more then 16
$Change_Password = 1;
	if((strlen($Add_New_Password1) <= 16) and (strlen($Add_New_Password1) >= 8)){
		// password lenght is right:
		
		// check if password 1 = password 2 ?:
		if($Add_New_Password1 == $Add_New_Password2){
		//passwords are correct: next step server validations: here
		
			
			


		
	
			
			
			
			
			
		
		}else{
$anyerror++;
$fullerrors .= "&Password=" . "1";	//password does not match
	}
		
		
	}else{
		// password lenght is wrong do this:
$anyerror++;
$fullerrors .= "&Password=" . "2"; // Lenght of password error 2	
}

}


$Add_New_Password1 = @sha1($Add_New_Password1);

/// In this phase Password, User Type are ready with Password Expiring, Change Password 0 or 1
	
///////////////////step1 code above


	/////// This is step 2:
	
	//// Check if Name is not empty
	
	$Form_Name = trim($_POST['Name']);
	$Form_Last = trim($_POST['Last_Name']);
	$Form_Gender =  $_POST['Gender'];
	$Form_M =  $_POST['Month'];
	$Form_D =  $_POST['Day'];
	$Form_Y =  $_POST['Year'];
	
	$Form_Mobile = trim($_POST['Mobile']);
	$Form_Facebook = trim($_POST['Facebook']);
	$Form_Skype = trim($_POST['Skype']);
	$Form_Home_Address = trim($_POST['Home_Address']);
	$Form_Store_Id = $_POST['Store_Id'];
	$Remove_Photo = 0;
	if(isset($_POST['Remove_Photo'])){$Remove_Photo=1;}
//photo should be processed after validating the form
	
	if(isLess($Form_Name)){$anyerror++;}  $fullerrors .= "&Name=" . $Form_Name;
	if(isLess($Form_Last)){$anyerror++; } $fullerrors .= "&Last_Name=" . $Form_Last;
	if(isZero($Form_Gender)){$anyerror++; } $fullerrors .= "&Gender=" . $Form_Gender;
	if((isZero($Form_M)) or (iszero($Form_D) or (iszero($Form_Y)))){$anyerror++;$fullerrors .= "&Date=" . "0";}else{ $fullerrors .= "&Date=" . mktime(0,0,0,$Form_M,$Form_D,$Form_Y);}
	if(isLess($Form_Mobile)){$anyerror++; } $fullerrors .= "&Mobile=" . $Form_Mobile;
	if(isLess($Form_Home_Address)){$anyerror++;} $fullerrors .= "&Home_Address=" . $Form_Home_Address;
	if(isZero($Form_Store_Id)){$anyerror++;} $fullerrors .= "&Store=" . $Form_Store_Id;



// redirect for the error case:
if($anyerror > 0){
header("Location: " . $_SERVER['PHP_SELF'] . $fullerrors .  "&uId=" . $uId); 
exit;	
}else{
	///////////////no validation error occured: proceed to storing data to the database:
	
	// make date like mktime from month day year
	$Form_date = mktime(0,0,0,$Form_M,$Form_D,$Form_Y);	

///Handle if remove photo is active:
if($Remove_Photo == 1){
	$Form_Photo = "";
	
$theDir = "images/" . $uId ;
$newDir = "images/" . $uId . "_old";
@mkdir($newDir);

// Get array of all source files
$mfiles = @scandir($theDir);
// Identify directories
$source = "$theDir/";
$destination = "$newDir/";
// Cycle through all source files
foreach ($mfiles as $mfile) {
  if (in_array($mfile, array(".",".."))) continue;
  // If we copied this successfully, mark it for deletion
  if (copy($source.$mfile, $destination.$mfile)) {
    $delete[] = $source.$mfile;
  }
}
// Delete all successfully-copied files
foreach ($delete as $mfile) {
  unlink($mfile);
}



///end of removing files
}else{
	$Form_Photo = $_POST['File_Ext']; /// this should be old file extention

}

///Handle photo upload file here:
if(isset($_FILES['Photo_Upload'])){
      $errors= array();
      $file_name = $_FILES['Photo_Upload']['name'];
      $file_size =$_FILES['Photo_Upload']['size'];
      $file_tmp =$_FILES['Photo_Upload']['tmp_name'];
      $file_type=$_FILES['Photo_Upload']['type'];
      $file_ext=@strtolower(end(explode('.',$_FILES['Photo_Upload']['name'])));

      $expensions= array("jpeg","jpg","png","gif");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
		 @mkdir("images/");
		 @mkdir("images/" . $uId) . "/";
		 $filename_byid = $uId.".".$file_ext;
         move_uploaded_file($file_tmp,"images/".$uId."/".$filename_byid);
		 /// make thumbnail of the file $
		 $fileUploaded = "images/" . $uId . "/". $filename_byid;
		 $folderDist = "images/" . $uId . "/";
		 
  		 cropImg($fileUploaded, $folderDist . $uId . "_25." . $file_ext, 25, 25);
		 cropImg($fileUploaded, $folderDist . $uId . "_50." . $file_ext, 50, 50);
		 cropImg($fileUploaded, $folderDist . $uId . "_80." . $file_ext, 80, 80);
		 cropImg($fileUploaded, $folderDist . $uId . "_100." . $file_ext, 100, 100);
		 cropImg($fileUploaded, $folderDist . $uId . "_200." . $file_ext, 200, 200);
		 cropImg($fileUploaded, $folderDist . $uId . "_400." . $file_ext, 400, 400);
		 
	
		 $Form_Photo = $file_ext;
      }else{
         print_r($errors);
      }
   }

/// End of photo handling upload
	$currentTime = time();
if($Change_Password == 0){$pass_query = "";}else{$pass_query="	`Password` = '$Add_New_Password1',
";}
	
	$sql = "UPDATE users SET 
	
	`Type` = '$Add_New_User_Type',
	$pass_query
	`Password_Expired` = '$Add_New_User_Change',
	`Name` = '$Form_Name',
	`Last_Name` = '$Form_Last',
	`Gender` = '$Form_Gender',                             
	`Date_Of_Birth` = '$Form_date',                             
	`Mobile` = '$Form_Mobile',                             
	`Facebook` = '$Form_Facebook',                             
	`Skype` = '$Form_Skype',                             
	`Home_Address` = '$Form_Home_Address',                             
	`Store_Id` = '$Form_Store_Id',                            
	`Photo` = '$Form_Photo',                             
	`Activated` = '$Add_New_Activated',                             
	`Added_Date` = '$currentTime'                             
		
	WHERE `Id` = '". $uId . "' ;" ;
	
	if(mysql_query($sql)){
			unset($uId);
			header("Location: " . "index.php");
	exit;
	}else{
		//echo $sql; 
		echo "error x occured";
		exit;
	}
	
	
	exit;
	}//// end of correct validation stage
	




}

if(!isset($_GET['uId'])){
header("Location: index.php");
exit;
}


/// end of edit processing






?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit</title>
<style type="text/css">
.required {	color: #FF0004;
}
.Info {
	color: #0F187C;
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
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td><span class="required"><?php if(isset($_GET['msg'])){echo $_GET['msg'];} ?></span>&nbsp;</td>
          </tr>
          <tr>
            <td><?php if((isset($_GET['uId']))){
				   $uId = $_GET['uId'];
				  //retrieve data from the database by using the uID
				  $query = "SELECT * FROM `users` WHERE `Id`='$uId'";
				  // User Name: email:
				  $Username_ret = mysql_result(mysql_query($query),0,"Username"); 
				  // Type Id :
				  $Type_Id_ret = mysql_result(mysql_query($query),0,"Type");
					
					// Type Name should re retrieved from the Users_Types Table
				  $Type_retx = "SELECT * FROM `users_type` WHERE `Id`='$Type_Id_ret' LIMIT 1";
				  $Type_Name_re = mysql_result(mysql_query($Type_retx),0,"Name");
				
					
				 	
					$Change_Pass_ret2 = mysql_result(mysql_query($query),0,"Password_Expired");;
					$User_Activated = mysql_result(mysql_query($query),0,"Activated");;
					// Convert 0 to No and 1 To Yes for display
					if($Change_Pass_ret2 == 0){
						$Change_Pass_ret = "NO";
					}else{
						$Change_Pass_ret= "YES";
					}
				  	
					$Photo = mysql_result(mysql_query($query),0,"Photo");;
					
				  
				  
				  
				   ?>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="Add_New_2" id="Add_New_2">
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                  <tbody>
                    <tr>
                      <td colspan="2" align="left" valign="top" bgcolor="#EFEFEF">EDIT USER
                        <input name="User_Id" type="hidden" id="User_Id" value="<?php echo $uId; ?>"></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#FFFFFF">User Name</td>
                      <td bgcolor="#FFFFFF"><?php echo $Username_ret; ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#FFFFFF">Type</td>
                      <td bgcolor="#FFFFFF"><select name="User_Type" onchange="return wait_for_load(this, event, function() { editor_date_month_change(this, 'birthday_day','birthday_year'); });" id="User_Type">
                        <option value="1"<?php 
						  $utype = 1;
						  $uval = "Type"; //Database Value
						  if(isset($_GET["$uval"])){if($_GET["$uval"]==$utype){echo ' selected="selected"';}}else{
						   if( mysql_result(mysql_query($query),0,"$uval")==$utype){
							   echo ' selected="selected" ';
							   }	  ///////here goes from DB Name
						  
						  }?>>Admin</option>
                          <option value="2"<?php 
						  $utype = 2;
						  $uval = "Type"; //Database Value
						  if(isset($_GET["$uval"])){if($_GET["$uval"]==$utype){echo ' selected="selected"';}}else{
						   if( mysql_result(mysql_query($query),0,"$uval")==$utype){
							   echo ' selected="selected" ';
							   }	  ///////here goes from DB Name
						  
						  }?>>Store Admin</option>
                          <option value="3"<?php 
						  $utype = 3;
						  $uval = "Type"; //Database Value
						  if(isset($_GET["$uval"])){if($_GET["$uval"]==$utype){echo ' selected="selected"';}}else{
						   if( mysql_result(mysql_query($query),0,"$uval")==$utype){
							   echo ' selected="selected" ';
							   }	  ///////here goes from DB Name
						  
						  }?>>Research</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#FFFFFF">New Password</td>
                      <td bgcolor="#FFFFFF"><input type="password" name="Password1" id="Password1"></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#FFFFFF">Confirm New Password</td>
                      <td bgcolor="#FFFFFF"><p>
                        <input type="password" name="Password2" id="Password2">
                      </p>
                        <p class="Info">If you don't wish to change the password, leave the password fields blank. </p></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#FFFFFF">Active</td>
                      <td bgcolor="#FFFFFF"><input name="Activated" type="checkbox" id="Activated" value="1" <?php if($User_Activated == 0){
						
					}else{
						echo " checked ";
					} ?>>
                        <label for="Activated">Active User</label></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#FFFFFF">Change Password Next Login</td>
                      <td bgcolor="#FFFFFF"><input name="Password_Expired" type="checkbox" id="Password_Expired" value="1" <?php if($Change_Pass_ret2 == 0){
						
					}else{
						echo " checked ";
					} ?>>
                        Must 
                          <label for="Password_Expired">Change Password Next Login</label></td>
                    </tr>
                    <tr>
                      <td width="42%" align="right" valign="top" bgcolor="#EFEFEF"><span class="required">*</span>Name</td>
                      <td width="58%" bgcolor="#EFEFEF"><input name="Name" type="text" id="Name" value="<?php if(isset($_GET['Name'])){echo $_GET['Name'];}else{
						   echo mysql_result(mysql_query($query),0,"Name");	  ///////here goes from DB Name
						  
						  } ///////show if there is name in GET STATEMENT?>">
                        <?php if(isset($_GET['Name'])){if(isLess($_GET['Name'])){ ?>
                        <span class="required">*Please write correct Name</span>
                        <?php }}?></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#EFEFEF"><span class="required">*</span>Last Name</td>
                      <td bgcolor="#EFEFEF"><input name="Last_Name" type="text" id="Last_Name" value="<?php if(isset($_GET['Last_Name'])){echo $_GET['Last_Name'];}else{
						   echo mysql_result(mysql_query($query),0,"Last_Name");	  ///////here goes from DB Name
						  
						  } ///////show if there is name in GET STATEMENT?>">
                        <?php if(isset($_GET['Last_Name'])){if(isLess($_GET['Last_Name'])){?>
                        <span class="required">*Please write Correct Last Name</span>
                        <?php }} ?></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#EFEFEF"><span class="required">*</span>Gender</td>
                      <td bgcolor="#EFEFEF"><select name="Gender" onchange="return wait_for_load(this, event, function() { editor_date_month_change(this, 'birthday_day','birthday_year'); });" id="Gender">
                        <option value="0">Select Gender</option>
                        <option value="1"<?php if(isset($_GET['Gender'])){if($_GET['Gender']==1){echo ' selected="selected"';}}else{
						   if( mysql_result(mysql_query($query),0,"Gender")==1){
							   echo ' selected="selected" ';
							   }	  ///////here goes from DB Name
						  
						  }?>>Male</option>
                        <option value="2"<?php if(isset($_GET['Gender'])){if($_GET['Gender']==2){echo " selected";}}else{
						   if( mysql_result(mysql_query($query),0,"Gender")==2){
							   echo ' selected="selected" ';
							   }	  ///////here goes from DB Name
						  
						  }?>>Female</option>
                      </select>
                        <?php if(isset($_GET['Gender'])){if(isZero($_GET['Gender'])){?>
                        <span class="required">*Please select correct Gender</span>
                        <?php }} ?></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#EFEFEF"><span class="required">*</span>Date of Birth</td>
                      <td bgcolor="#EFEFEF"><select name="Month" onchange="return wait_for_load(this, event, function() { editor_date_month_change(this, 'birthday_day','birthday_year'); });" id="Month">
                        <option value="0">Month</option>
                        <?php 
						
						if(isset($_GET['Date'])){if(isLess($_GET['Date'])){}else{echo '<option value="'. date("m",$_GET['Date']) . '" selected>' . date("F",$_GET['Date']) . '</option>';}}else{
							$dofBirth = mysql_result(mysql_query($query),0,"Date_Of_Birth");
					echo '<option value="' . date("m", $dofBirth) . '" selected>'	. date("F", $dofBirth) . '</option>';
						}
						///////if there is date and add month/day/year?>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                      </select>
                        <select name="Day" id="Day">
                          <?php if(isset($_GET['Date'])){if(isLess($_GET['Date'])){}else{echo '<option value="'. date("d",$_GET['Date']) . '" selected>' . date("d",$_GET['Date']) . '</option>';}}else{
							$dofBirth = mysql_result(mysql_query($query),0,"Date_Of_Birth");
					echo '<option value="' . date("d", $dofBirth) . '" selected>'	. date("d", $dofBirth) . '</option>';
						} ///////if there is date and add month/day/year?>
                          <option value="0">Day</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                        <select name="Year" id="Year">
                          <option value="0">Year</option>
                          <?php if(isset($_GET['Date'])){if(isLess($_GET['Date'])){}else{echo '<option value="'. date("Y",$_GET['Date']) . '" selected>' . date("Y",$_GET['Date']) . '</option>';}}else{
							$dofBirth = mysql_result(mysql_query($query),0,"Date_Of_Birth");
					echo '<option value="' . date("Y", $dofBirth) . '" selected>'	. date("Y", $dofBirth) . '</option>';
						} ///////if there is date and add month/day/year?>
                          <option value="2009">2009</option>
                          <option value="2008">2008</option>
                          <option value="2007">2007</option>
                          <option value="2006">2006</option>
                          <option value="2005">2005</option>
                          <option value="2004">2004</option>
                          <option value="2003">2003</option>
                          <option value="2002">2002</option>
                          <option value="2001">2001</option>
                          <option value="2000">2000</option>
                          <option value="1999">1999</option>
                          <option value="1998">1998</option>
                          <option value="1997">1997</option>
                          <option value="1996">1996</option>
                          <option value="1995">1995</option>
                          <option value="1994">1994</option>
                          <option value="1993">1993</option>
                          <option value="1992">1992</option>
                          <option value="1991">1991</option>
                          <option value="1990">1990</option>
                          <option value="1989">1989</option>
                          <option value="1988">1988</option>
                          <option value="1987">1987</option>
                          <option value="1986">1986</option>
                          <option value="1985">1985</option>
                          <option value="1984">1984</option>
                          <option value="1983">1983</option>
                          <option value="1982">1982</option>
                          <option value="1981">1981</option>
                          <option value="1980">1980</option>
                          <option value="1979">1979</option>
                          <option value="1978">1978</option>
                          <option value="1977">1977</option>
                          <option value="1976">1976</option>
                          <option value="1975">1975</option>
                          <option value="1974">1974</option>
                          <option value="1973">1973</option>
                          <option value="1972">1972</option>
                          <option value="1971">1971</option>
                          <option value="1970">1970</option>
                          <option value="1969">1969</option>
                          <option value="1968">1968</option>
                          <option value="1967">1967</option>
                          <option value="1966">1966</option>
                          <option value="1965">1965</option>
                          <option value="1964">1964</option>
                          <option value="1963">1963</option>
                          <option value="1962">1962</option>
                          <option value="1961">1961</option>
                          <option value="1960">1960</option>
                          <option value="1959">1959</option>
                          <option value="1958">1958</option>
                          <option value="1957">1957</option>
                          <option value="1956">1956</option>
                          <option value="1955">1955</option>
                          <option value="1954">1954</option>
                          <option value="1953">1953</option>
                          <option value="1952">1952</option>
                          <option value="1951">1951</option>
                          <option value="1950">1950</option>
                          <option value="1949">1949</option>
                          <option value="1948">1948</option>
                          <option value="1947">1947</option>
                          <option value="1946">1946</option>
                          <option value="1945">1945</option>
                          <option value="1944">1944</option>
                          <option value="1943">1943</option>
                          <option value="1942">1942</option>
                          <option value="1941">1941</option>
                          <option value="1940">1940</option>
                          <option value="1939">1939</option>
                          <option value="1938">1938</option>
                          <option value="1937">1937</option>
                          <option value="1936">1936</option>
                          <option value="1935">1935</option>
                          <option value="1934">1934</option>
                          <option value="1933">1933</option>
                          <option value="1932">1932</option>
                          <option value="1931">1931</option>
                          <option value="1930">1930</option>
                          <option value="1929">1929</option>
                          <option value="1928">1928</option>
                          <option value="1927">1927</option>
                          <option value="1926">1926</option>
                          <option value="1925">1925</option>
                          <option value="1924">1924</option>
                          <option value="1923">1923</option>
                          <option value="1922">1922</option>
                          <option value="1921">1921</option>
                          <option value="1920">1920</option>
                          <option value="1919">1919</option>
                          <option value="1918">1918</option>
                          <option value="1917">1917</option>
                          <option value="1916">1916</option>
                          <option value="1915">1915</option>
                          <option value="1914">1914</option>
                          <option value="1913">1913</option>
                          <option value="1912">1912</option>
                          <option value="1911">1911</option>
                          <option value="1910">1910</option>
                          <option value="1909">1909</option>
                        </select>
                        <?php if(isset($_GET['Date'])){if(isLess($_GET['Date'])){?>
                        &nbsp;<span class="required">*Please write correct data</span>
                        <?php }} ?></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#EFEFEF"><span class="required">*</span>Mobile Number</td>
                      <td bgcolor="#EFEFEF"><input name="Mobile" type="text" id="Mobile" value="<?php if(isset($_GET['Mobile'])){echo $_GET['Mobile'];}else{
						   echo mysql_result(mysql_query($query),0,"Mobile");	  ///////here goes from DB Name
						  
						  } ///////show if there is name in GET STATEMENT?>">
                        <?php if(isset($_GET['Mobile'])){if(isLess($_GET['Mobile'])){?>
                        <span class="required">*Please write correct Mobile Number</span>
                        <?php }} ?></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#EFEFEF">Facebook</td>
                      <td bgcolor="#EFEFEF"><input name="Facebook" type="text" id="Facebook" value="<?php if(isset($_GET['Facebook'])){echo $_GET['Facebook'];}else{
						   echo mysql_result(mysql_query($query),0,"Facebook");	  ///////here goes from DB Name
						  
						  } ///////show if there is name in GET STATEMENT?>"></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#EFEFEF">Skype</td>
                      <td bgcolor="#EFEFEF"><input name="Skype" type="text" id="Skype" value="<?php if(isset($_GET['Skype'])){echo $_GET['Skype'];}else{
						   echo mysql_result(mysql_query($query),0,"Skype");	  ///////here goes from DB Name
						  
						  } ///////show if there is name in GET STATEMENT?>"></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#EFEFEF"><span class="required">*</span>Home Address</td>
                      <td bgcolor="#EFEFEF"><input name="Home_Address" type="text" id="Home_Address" value="<?php if(isset($_GET['Home_Address'])){echo $_GET['Home_Address'];}else{
						   echo mysql_result(mysql_query($query),0,"Home_Address");	  ///////here goes from DB Name
						  
						  } ///////show if there is name in GET STATEMENT?>">
                        <?php if(isset($_GET['Home_Address'])){if(isLess($_GET['Home_Address'])){?>
                        <span class="required">*Please write correct home address</span>
                        <?php }} ?></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#EFEFEF"><span class="required">*</span>Working Store</td>
                      <td bgcolor="#EFEFEF"><?php $storeq = mysql_query("SELECT * FROM stores ORDER BY NAME ASC;")
						   ?>
                        <select name="Store_Id" onchange="return wait_for_load(this, event, function() { editor_date_month_change(this, 'birthday_day','birthday_year'); });" id="Store_Id">
                          <option value="0">Store</option>
                          <?php 
						while($store = mysql_fetch_array($storeq)){
						$Store_Name = $store['Name'];
						$store_Id = $store['Id']; ?>
                          <option value="<?php echo $store_Id; ?>"<?php if(isset($_GET['Store'])){if($_GET['Store']==$store_Id){echo " selected";}}else{
					
							$StId = mysql_result(mysql_query($query),0,"Store_Id");
		 				if($StId==$store_Id){echo " selected";}
						
						  }?>><?php echo $Store_Name; ?></option>
                          <?php } ?>
                        </select>
                        <?php if(isset($_GET['Store'])){if(isZero($_GET['Store'])){?>
                        <span class="required">*Please select correct working store</span>
                        <?php }} ?></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" bgcolor="#EFEFEF">Change Photo</td>
                      <td bgcolor="#EFEFEF"><p class="Info">If you don't want to change the photo, don't upload anything.
                        </p>
                        <p class="Info">If you only wish to remove photo without uploading new photo turn on the &quot;Remove current photo&quot; checkbox and don't choose any file.</p>
                        <p><img src="<?php
						
						if($Photo == ""){
						echo  "images/photo_100.png";
					
					}else
					{
						echo "images/" . $uId . "/" . $uId . "_100." . $Photo;
					}
						
						 ?>"> &nbsp;                          
                          <input name="File_Ext" type="hidden" id="File_Ext" value="<?php echo $Photo; ?>">
                        </p>
                        <p>
                          <input name="Remove_Photo" type="checkbox" id="Remove_Photo" value="1" ?> 
                          Remove current photo
                          <label for="Remove_Photo"></label>
<br>
                          Change Photo:<br>
                          <input type="file" name="Photo_Upload" id="Photo_Upload">
                        </p></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="submit" name="Save" id="Save" value="Save Changes"> 
                        <a href="index.php">Cancel</a></td>
                    </tr>
                  </tbody>
                </table>
              </form>
              <?php } ?></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>