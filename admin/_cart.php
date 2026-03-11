		<div class="wide">
			<?php include('_left.php'); ?>
			<div class="r-740<?php if($additional[29]==1){ ?> w-1024<?php } ?>">
				<div class="tree"><a href="/">Главная</a>/<a href="/<?=$urls[0]?>/"><?=$seo['menu']?></a></div>
				<div class="pagetext">
					<h1><?=$seo["h1"]?></h1>
					<?=$seo["text"]?>
					<?php
					$carts = mysql_query("SELECT ".MySQLprefix."_cart.id AS id, ".MySQLprefix."_goods.price AS price, ".MySQLprefix."_cart.price AS price2, ".MySQLprefix."_cart.kol AS kol, ".MySQLprefix."_cart.mods, ".MySQLprefix."_cart.good AS good, ".MySQLprefix."_goods.name AS title, ".MySQLprefix."_goods.logo AS pics FROM ".MySQLprefix."_cart, ".MySQLprefix."_goods WHERE ".MySQLprefix."_cart.user='".$user."' AND ".MySQLprefix."_cart.status=1 AND ".MySQLprefix."_cart.good=".MySQLprefix."_goods.id");
					if($carts)
						if(mysql_num_rows($carts)>0){
							?>
					<table class="cart-table">
						<tr class="head-cart">
							<td>Наименование товара</td>
							<td>Цена, руб.</td>
							<td>Кол-во, шт.</td>
							<td>Сумма, руб.</td>
						</tr>
							<?php
							$sum = 0;
							$koll = 0;
							while($cart = mysql_fetch_assoc($carts)){
								$pic = 'admin/uploads/nophoto.png';
								$pics = explode('|', $cart['pics']);
								if(is_array($pics) && count($pics)>0)
									foreach($pics AS $picc)
										if(strlen($picc)>0 && $pic == 'admin/uploads/nophoto.png')
											$pic = $picc;
								?>
						<tr rel="<?=$cart['id']?>">
							<td>
								<a class="good-pic" href="/goods/<?=$cart['good']?>/">
									<img alt="" src="/<?=$pic?>" />
								</a>
								<a class="good-name" href="/goods/<?=$cart['good']?>/"><?=$cart['title']?></a>
								<?php
								if(strlen($cart['mods'])>0){
									$data = explode('|', $cart['mods']);
									foreach($data AS $line)
										if(strlen($line) > 0)
											$good[] = explode(":", $line);
									if(isset($good) && is_array($good) && count($good)>0)
										for($g = 0; $g < count($good)-2; $g++){
											?>
								<br/><?=$good[$g][0]?>: <?=$good[$g][1]?>
											<?php
										}
								}
								unset($good);
								?>
								<a class="del_from_cart">Удалить товар</a>
							</td>
							<td class="pr-row"><?=(strlen($cart['price2'])>0?$cart['price2']:$cart['price'])?> руб.</td>
							<td>
								<input class="text kol" name="kol" value="<?=$cart['kol']?>" />
							</td>
							<td class="sum-row"><?=($cart['kol']*(strlen($cart['price2'])>0?$cart['price2']:$cart['price']))?> руб.</td>
						</tr>
								<?php
								$sum += $cart['kol']*(strlen($cart['price2'])>0?$cart['price2']:$cart['price']);
								$koll += $cart['kol'];
							}
							?>
					</table>
					<p class="itogo">В корзине <span><?=$koll?></span> това<?php if(substr($koll, -2)!=11 && substr($koll, -1)==1){ ?>р<?php }elseif(substr($koll, -2, 1)!=1 && substr($koll, -1)>1 && substr($koll, -1)<5){ ?>ра<?php }else{ ?>ров<?php } ?> на сумму <b class="cart_sum"><?=$sum?> руб.</b></p>
					<div class="actn">
						<a class="hide but-40" href="/<?=$katalog_a['url']?>/">Продолжить покупки</a>
						<a href="/proceed/" class="gotocart but-40 blu">Перейти к оформлению</a>
					</div>
							<?php
						}
					?>
				</div>
			</div>
		</div>