<?php
	/*necessary stuff*/
	require_once 'vendor/autoload.php';
	$token  = new Tmdb\ApiToken('a661c1b3dbd81e14e49ce4945b4d0460');

	/*client contsruct*/
	$client = new \Tmdb\Client($token, ['session_token' => new \Tmdb\SessionToken($_POST['token'])]); 

	/*account construct*/
	$accountRepository = new \Tmdb\Repository\AccountRepository($client);
	$account = $accountRepository->getAccount(); 
	
	/*setting account cookie*/	
	setcookie('moviestore_account_name', $account->getUsername(), time() + (86400 * 30)); // 86400 = 1 day*/
	
	/*bla bla test-doesn't work*/
	echo '<html><head></head><body><div>'.$_COOKIE['moviestore_account_name'].
	'</div></body></html>';
	
	/*redirect after update*/
	if($_POST['redirect']=='') header('Location:index.php'); 
	else header('Location:'.$_POST['redirect']);
	
?>