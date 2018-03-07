<?php 
session_start();
if(isset($_POST['User']) and isset($_POST['Password']))
{
$errors = 0;
$page_redirect = "index.php";
$vars = "?msg=An error occured!";
require_once("linkserver.php");
	 $Log_User = $_POST['User'];
	 $Log_Password = $_POST['Password'];
	
	if(strlen($Log_User)>0 and strlen($Log_Password)>0)
	{
		///user and password are not empty here:
		
		/// if its not an email change it to email
		if(!filter_var($Log_User, FILTER_VALIDATE_EMAIL)){
		$Log_User .= "@" . $domain ;
		}
		
		$Log_Password = sha1($Log_Password);
		
		$sql = mysql_query("SELECT * FROM users
		WHERE `Username` = '$Log_User' AND `Password` =  '$Log_Password'
		");
		
		$sql_c = mysql_num_rows($sql);
		if($sql_c >0)
		{
			/// login, user and password is found in the database
			// check if the user is active or not?
			
			$User_act = mysql_result($sql, 0, "Activated");
			if($User_act == 1)
			{
					/// Username is active ! proceeding...
//session_destroy(); /// remove all previous sessions first
	if(isset($_SESSION['Password_Expired'])){unset($_SESSION['Password_Expired']);}				
			$_SESSION['Id'] = mysql_result($sql, 0, "Id");
			$_SESSION['Store_Id'] = mysql_result($sql, 0, "Store_Id");

			$_SESSION['Type'] = mysql_result($sql, 0, "Type");
			$_SESSION['Gender'] = mysql_result($sql, 0, "Gender");
			$_SESSION['Date_Of_Birth'] = mysql_result($sql, 0, "Date_Of_Birth");

			$_SESSION['Username'] = mysql_result($sql, 0, "Username");
			$_SESSION['Name'] = mysql_result($sql, 0, "Name");
			$_SESSION['Last'] = mysql_result($sql, 0, "Last_Name");
			$_SESSION['Photo'] = mysql_result($sql, 0, "Photo");
			$Pass_Expired = mysql_result($sql, 0, "Password_Expired");
			///Redirecting to index.php, but if password need to be changed.
			if($Pass_Expired == 1)
			{
			$_SESSION['Password_Expired'] = $Pass_Expired;
				
			/// change this variable to redirect to that page instead of other
			$page_redirect = "expired.php";
			}
					
			//after pssword not expired :
			header("Location: " . $page_redirect); exit;
			}else{
			$errors++;
			$vars .= "<br> The user is <b>Inactive</b>, Please contact Administrator for help.";
			}
			
	
	
		}else
		{
			$errors++;
			$vars .= "<br> The User or the Password is incorrect.";
		}
		
		
	}else
	{$errors ++;
$vars .= "<br> The User or Password is empty.";

	}

}else{
$errors++;
}

if($errors>0){
	
	header("Location: login.php" . $vars );
	exit;}

?>