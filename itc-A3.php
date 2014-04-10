<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<style type="text/css">.required {font-style:italic;color:#FF0000;font-weight:bold;}

	body {
		background-color: #a6dbed;
 background: url("../images/background2.jpg") repeat fixed;
  /*  background-color: #a6dbed;*/
  background-size:cover;
    border-top:  10px #000;
    color: #000;
    font-size: 0.85em;
    font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    margin: 40px;
    padding: 0px;
    background-position:top left;
     max-width:100%;
}
h2 {
background-color:green;
color:white;
border-bottom:5px solid grey;
}
#footer
{ width: 800px;
  height: 20px;
  padding-top: 20px;
  text-align: center; 
  background: transparent;
  color: green;
   text-shadow: 1px 1px #1D1D1D;}

#header
{ height: 400px;
  width: 800px;
 }



	
</style>

<head>
  <title>ITC260-A3</title>
</head>
<body url("../images/background2.jpg")>
            
       
<div ID="header">



<?php

define('THIS_PAGE',basename($_SERVER['PHP_SELF']));  



# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

switch ($myAction) 
{//check 'act' for type of process
	case "display": # 2)Display user's name!
	 	showName();
	 	break;
	case "clear":
		clearUser();
		showForm();
		break;
	case "logout":
		showForm();
		break;	
	default: # 1)Ask user to enter their name 
	 	showForm();


}

function showForm()
{# shows form so user can enter their name.  Initial scenario
	
	echo 
	'<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
	//here we make sure the user has entered valid data	
	
	function checkInp()
	{
		//var x = document.forms["myForm"]["PhoneNumber"].value,
		var x = document.forms["myForm1"]["PassWord"].value;
		 
		var y = document.forms["myForm1"]["ConfirmPass"].value;
		if (x != y)  //check PassWord is match 
		{
		alert("Your confirm Password is not match PassWord ");
		return false;
		}
	
}
</script>
	
	<p align="center">Please Register your information:</p> 
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkInp()" name="myForm1">
		 <table align="center">
     <th><em><font color="red"><b>*</b> required field</font></em></th>
			<tr>
				<td align="left">
					User Name
				</td>
				<td>
					<input type="text" name="UserName" required="true" placeholder="UserName" title="UserName is required" /><font color="red"><b>*</b></font> <em>(alphabetic only)</em>
				</td>
			</tr>
			<tr>
			   <td align="left">
					Your Password:
				</td>
			   <td><input type="password" name="PassWord" required="true" placeholder="PassWord" title="PassWord is required"/><font color="red"><b>*</b></font> <em>(requirment)</em>
				</td>
     		   </td>
     		</tr>
     		<tr>
			   <td align="left">
					Confirm your Password:
				</td>
			   <td><input type="password" name="ConfirmPass" required="true" placeholder="ConfirmPass" title="Confirm Password is required"/><font color="red"><b>*</b></font> <em>(requirment)</em>
				</td>
     		   </td>
     		</tr>
     		<tr><td colspan="2"><br /><hr></td></tr>
			<tr>
				<td align="right" >
					<input type="submit" name="submit" value="Regist">
				</td >		
				 
				<td align="left" ><input type="reset" name="clear" value="Clear " /></td>
			</tr>
		</table>
		<input type="hidden" name="act" value="display" />
	</form>
	';
	
}

function showName()
{#form submits here we show entered name
	#get_header(); #defaults to footer_inc.php
	/*echo '<pre>';
	echo var_dump ($_POST);
	echo '</pre>';
	die;
	*/
	//ini_set('session.save_path','/xiaomei.dreamhosters.com/sessions');
	startSession();
	#session-start(); 
	if(!isset($_SESSION['user']))
	{
	$_SESSION['user'] = array();
	
	
	}
	
  $_SESSION['user'][] = new User($_POST['UserName'],$_POST['PassWord']);
  //dumpDie($_SESSION['player']);
 // echo '<em><strong>We have <font color="red"><b> ' . count($_SESSION['user']) . '</b></font>  objects in this SESSION.</strong></em><br />';
  echo '<hr>';
  foreach($_SESSION['user'] as $user)

{
    
   /*echo '<p>Welcome User:<pre>' . print_r($_SESSION['user'], 1) . '</pre></p>';*/
  echo '<p>Welcome User:<em>' . $user . '</em></p>'; 
    
    /* echo 'total Annual Phone Bill is:' . $myBill. '*12 = $' . ((float)$_POST['MonthPayment']*12)  . '</b>!</p>';*/
}
  //session_destroy();
  echo '<p align="center"><a href="' . THIS_PAGE . '?act=clear">Clear User!</a></p>';
  echo '<p align="center"><a href="' . THIS_PAGE . '?act=logout">LogOut!</a></p>';
  //echo '<p align="center"><a href="' . THIS_PAGE . '?act=clear">Clear Session!</a></p>';
  
  
  
  //$cleaned = session_clean(); #forces clearing of old sessions
//echo '<p align="center"><b>' . $cleaned . '</b> sessions cleaned! </p>';
       /* 
	if(!isset($_POST['name']) || $_POST['name'] == '')
	{//data must be sent	
		feedback("No form data submitted"); #will feedback to submitting page via session variable
		myRedirect(THIS_PAGE);
	}  
	
	if(!ctype_alnum($_POST['name']))
	{//data must be alphanumeric only	
		feedback("Only letters and numbers are allowed.  Please re-enter your name."); #will feedback to submitting page via session variable
		myRedirect(THIS_PAGE);
	}
	
	$myName = strip_tags($_POST['name']);# here's where we can strip out unwanted data
	
	echo '<h3 align="center">' . smartTitle() . '</h3>';
	echo '<p align="center">Your name is <b>' . $myName . '</b>!</p>';
	echo '<p align="center"><a href="' . THIS_PAGE . '">RESET</a></p>';

	get_footer(); #defaults to footer_inc.php
	*/
}
function startSession()
{
	//if(!isset($_SESSION)){@session_start();}
	if(isset($_SESSION))
	{
		return true;
	}else{
		@session_start();
	}
	if(isset($_SESSION)){return true;}else{return false;}
} #End startSession()

function clearUser()
  {
	  
    if (!isset($_SESSION['user'])) {startSession();}
	 
	 if(isset($_SESSION['user']))
	 {
		 $_SESSION['user'] = array();
		 unset($_SESSION['user']);
		 }
	 echo "Users are Cleared!";
	 
}

class User

{

    Public $UserName = '';

    Public $PassWord = '';

    
    
    
    function __construct($UserName,$PassWord)

    {

        $this->UserName = $UserName;

        $this->PassWord = $PassWord;

       
       

    }

   

    function __toString()

    {

        $output = '';

        $output .= "<em> " . $this->UserName . "</em><br />";

        $output .= "<em>Password: " . $this->PassWord . "</em><br />";

       
		

       

        return $output;

   

    }

}
?>
</div>
<div ID= "footer">
<h4>| Thanks SCCC ITC 250  |  Copyright My Website 2012-<?php echo date('Y'); ?> | Design by Xiaomei Xie </h4>
	  
</div><!--close footer-->  

</body>
</html>



