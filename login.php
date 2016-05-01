<?php session_start();?>
<?php require_once 'bootstrap.php';?>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$api = Includes_Requests_Factory::create('users',array());
	$email    = !empty($_POST['email']) ? $_POST['email'] : '';
	$password = !empty($_POST['password']) ? md5($_POST['password']) : '';
	if(empty($email) || empty($password)){
		$msg->error('Please, provide Email and Password');
		header('Location: ' . BASE_URL . '/login.php');
		exit;
	}
	
	$response = $api->login($email,$password);
	$responseArray = json_decode($response['body'],true);
	//dd($responseArray);
	// Do login process
	if($responseArray['code']==200){
		// Sucess
		$_SESSION['loggedin'] 	= 1;
		$_SESSION['id'] 		= $responseArray['data']['id'];
		$_SESSION['email'] 		= $responseArray['data']['email'];
		$_SESSION['first_name'] = $responseArray['data']['first_name'];
		$_SESSION['last_name'] 	= $responseArray['data']['last_name'];
		$_SESSION['role'] 		= $responseArray['data']['role'];
		
		if($responseArray['data']['role'] == 'professor'){
			header('Location: ' .BASE_URL . '/p/classes/classes.php');
			exit;
		} else if($responseArray['data']['role'] == 'student'){
			header('Location: ' .BASE_URL . '/s/classes/classes.php');
			exit;
		} else {
			$msg->error('You are not student or professor. Get out of here');
			header('Location: ' . BASE_URL . '/login.php');
			exit;
		}
	} else {
		$msg->error($responseArray['message']);
		header('Location: ' . BASE_URL . '/login.php');
		exit;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>

.label{
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:11px;
    color:#0066FF;
}
.tableBorder{
    border:solid 1px #0066FF;
    margin-top:100px;
}
.message{
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:14px;
    font-weight:bold;
    color:#0066FF;
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login</title>


</head>
	<body>
		<form method="post" action="">
			<table cellpadding="2px" cellspacing="1px" bgcolor="#F4F5F7" width="400px" class="tableBorder" align="center">
			    <tr>
			        <td colspan="2" bgcolor="#0066FF">&nbsp;</td>
			    </tr>
			    <tr>
			        <td colspan="2" class="label">&nbsp;</td>
			    </tr>
			    
			    <tr>
			        <td align="center" colspan="2">
			            <img src="assets/images/lock-icon.png" border="0" align="absbottom"/>&nbsp;
			            <span class="message">Login to the Admin Panel</span>
			        </td>
			    </tr>                   
			    <tr>
			          <td align="center" colspan="2"><p><?=$msg->display();?></p></td>
			    </tr>
			    <tr>
			        <td colspan="2"Email:</td>
			    </tr>
			    <tr>
			        <td class="label" align="right" width="40%">Email:</td>
			        <td align="left" width="60%"><input type="text" name="email" maxlength="20" value="professor@njit.edu"/></td>
			    </tr>
			    <tr>
			        <td class="label" align="right">Password:</td>
			        <td align="left"><input type="password" name="password" maxlength="20" value="anatema"/></td>
			    </tr>
			    <tr>
			        <td class="label" align="right">&nbsp;</td>
			        <td align="left"><input type="submit" value="Login" /></td>
			    </tr>                   
			    <tr>
			        <td colspan="2" class="label">&nbsp;</td>
			    </tr>                   
			</table>
		</form>
	</body>
</html>