<?php
$HEVA_CMS = "3.1.5.20130222";
session_start();
include('_mysql.php');
include('_additional.php');
$insert_order = mysql_query("INSERT INTO ".MySQLprefix."_orders (user, customer_name, customer_email, customer_phone, customer_addr, customer_coment, ship, data) VALUES ('".$_SESSION['user']."', '".$_POST['name']."', '".$_POST['email']."', '".$_POST['contacts']."', '".$_POST['address']."', '".$_POST['text']."', '".$_POST['self-shiping']."', NOW())");
$get_order_n = mysql_result(mysql_query("SELECT id FROM ".MySQLprefix."_orders WHERE user='".$_SESSION['user']."' ORDER BY id DESC LIMIT 0, 1"),0);
$update_cart = mysql_query("UPDATE ".MySQLprefix."_cart SET status=".$get_order_n." WHERE user='".$_SESSION['user']."' AND status=1");
$carts = mysql_query("SELECT ".MySQLprefix."_goods.price AS price, ".MySQLprefix."_cart.price AS price2, ".MySQLprefix."_cart.mods, ".MySQLprefix."_cart.kol AS kol, ".MySQLprefix."_cart.good AS good, ".MySQLprefix."_goods.name AS title FROM ".MySQLprefix."_cart, ".MySQLprefix."_goods WHERE ".MySQLprefix."_cart.user='".$_SESSION['user']."' AND ".MySQLprefix."_cart.status=".$get_order_n." AND ".MySQLprefix."_cart.good=".MySQLprefix."_goods.id");
$in_cart = '';
if($carts && mysql_num_rows($carts)>0){
    $in_cart .= '<table cellpadding="2" cellspacing="0" border="1" width="100%"><tr><td align="left">Товар</td><td align="center">Количество</td><td align="right">Цена, руб.</td><td align="right">Сумма, руб.</td></tr>';
	$sum = 0;
	while($cart = mysql_fetch_assoc($carts)){
		$in_cart .= '<tr><td align="left"><a href="'.$_SERVER['HTTP_HOST'].'/goods/'.$cart['good'].'/">'.$cart['title'].'</a>';
		if(strlen($cart['mods'])>0){
			$data = explode('|', $cart['mods']);
			foreach($data AS $line)
				if(strlen($line) > 0)
					$good[] = explode(":", $line);
			if(isset($good) && is_array($good) && count($good)>0)
				for($g = 0; $g < count($good)-2; $g++)
					$in_cart .= '<br/>'.$good[$g][0].': '.$good[$g][1];
		}
		$in_cart .= '</td><td align="center">'.$cart['kol'].'</td><td align="right">'.(strlen($cart['price2'])>0?$cart['price2']:$cart['price']).'</td><td align="right">'.($cart['kol']*(strlen($cart['price2'])>0?$cart['price2']:$cart['price'])).'</td></tr>';
		$sum += $cart['kol']*(strlen($cart['price2'])>0?$cart['price2']:$cart['price']);
	}
	$in_cart .= '<tr><td colspan="3" align="right">Итого:</td><td align="right">'.$sum.'</td></tr></table>';
}
$customer_data = '<p>ФИО: <b>'.$_POST['name'].'</b><br/>';
if(strlen($_POST['email'])>0){
  $customer_data .= 'Email: <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a><br/>';
}
if(strlen($_POST['contacts'])>0){
  $customer_data .= 'Телефон: <b>'.$_POST['contacts'].'</b><br/>';
}
if(strlen($_POST['address'])>0){
  $customer_data .= 'Адрес: <b>'.$_POST['address'].'</b><br/>';
}
if(strlen($_POST['text'])>0){
  $customer_data .= 'Коментарии к заказу: <i>'.$_POST['text'].'</i></p>';
}

if($_POST['self-shiping']=='1'){
  $customer_data .= '<p>Способ доставки: <b>САМОВЫВОЗ</b></p>';
}
$customer_data .= '<br/><center><p>СОСТАВ ЗАКАЗА</p></center><br/>';
$headers  = 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8'."\r\n".'From: '.$additional[2].' <noreplay@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
mail($additional[11], 'Новый заказ', $customer_data.$in_cart, $headers);
if(strlen($_POST['email'])>0){
  $headers  = 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8'."\r\n".'From: '.$additional[2].' <'.$additional[11].'>'."\r\n";
  mail($_POST['email'], 'Вы сделали заказ в магазине '.$additional[2], $customer_data.$in_cart, $headers);
}
if($_POST['robo']=='no'){
	?>Ваш заказ успешно отправлен. Проверьте вашу почту.<?php
}else{
	$mrh_login = $additional[51];
	$mrh_pass1 = $additional[52];
	$inv_id = $get_order_n;
	$inv_desc = "Оплата заказа №".$get_order_n." от ".date('d.m.Y')."г.";
	$out_summ = $sum;
	$shp_item = "1";
	$in_curr = "";
	$culture = "ru";
	$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item");
	?>
<form class="payitform none" action='https://merchant.roboxchange.com/Index.aspx' method='POST'>
	<input type='hidden' name='MrchLogin' value='<?=$mrh_login?>' />
	<input type='hidden' name='OutSum' value='<?=$out_summ?>' />
	<input type='hidden' name='InvId' value='<?=$inv_id?>' />
	<input type='hidden' name='Desc' value='<?=$inv_desc?>' />
	<input type='hidden' name='SignatureValue' value='<?=$crc?>' />
	<input type='hidden' name='Shp_item' value='<?=$shp_item?>' />
	<input type='hidden' name='IncCurrLabel' value='<?=$in_curr?>' />
	<input type='hidden' name='Culture' value='<?=$culture?>' />
	<input type='submit' value='Pay' />
</form>
	<?php
}
?>