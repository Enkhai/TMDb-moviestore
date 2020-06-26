<html>
<head>
<script type="text/javascript" language="javascript">
	function submit_form(){
		document.getElementById('myForm').submit();
	}
</script>
</head>
<body onLoad="submit_form()">
<?php
	/*necessary (token number)*/
	require_once 'session.php';
	
	/*authentication for client and request token*/	
	$authenticationRepository = new \Tmdb\Repository\AuthenticationRepository($client);
	$requestToken = $authenticationRepository->getRequestToken();
	
	/*create a session token based on account credentials*/
	try{
	$sessionToken = $authenticationRepository->getSessionTokenWithLogin(
		$requestToken,
		$_POST['user'],
		$_POST['pass']
	);
	}catch(Exception $e){ header('Location:login.php?error='.$e->getCode());}
		
	echo '<form id="myForm" action="session_alt.php" method="post">
	<input name="token" type="hidden" value="'.$sessionToken.'">
	<input name="redirect" type="hidden" value="'.$_POST['redirect'].'">
	</form>
	';
?>
</body>
</html>