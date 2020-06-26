<?php
	/*initiate session*/
	session_start();
	
	/*necessary stuff*/
	require_once 'vendor/autoload.php';
	$token  = new Tmdb\ApiToken('a661c1b3dbd81e14e49ce4945b4d0460');
	
	/*client construct*/
	$client = new Tmdb\Client($token);
	
?>
