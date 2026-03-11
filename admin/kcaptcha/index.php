<?
ini_set('display_errors', 0);
include('kcaptcha.php');
session_start();
$captcha = new KCAPTCHA();
if($_REQUEST[session_name()]){
	$_SESSION['captcha_keystring'] = $captcha->getKeyString();
}
?>