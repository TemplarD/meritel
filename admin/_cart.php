		<div style="width: 100%; padding: 20px;">
			<div class="tree"><a href="/">Главная</a>/<a href="/<?=$urls[0]?>/"><?=$seo['menu']?></a></div>
			<div class="pagetext">
				<h1><?=$seo["h1"]?></h1>
				<?=$seo["text"]?>
				<?php
				$carts = mysql_query("SELECT ".MySQLprefix."_cart.id AS id, ".MySQLprefix."_goods.price AS price, ".MySQLprefix."_cart.price AS price2, ".MySQLprefix."_cart.kol AS kol, ".MySQLprefix."_cart.mods, ".MySQLprefix."_cart.good AS good, ".MySQLprefix."_goods.name AS title, ".MySQLprefix."_goods.logo AS pics FROM ".MySQLprefix."_cart, ".MySQLprefix."_goods WHERE ".MySQLprefix."_cart.user='".$user."' AND ".MySQLprefix."_cart.status=1 AND ".MySQLprefix."_cart.good=".MySQLprefix."_goods.id");
				
				if($carts && mysql_num_rows($carts)>0){
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
							</td>
							<td class="pr-row"><?=($cart['price2']>0?$cart['price2']:$cart['price'])?></td>
							<td><input type="text" class="kol" value="<?=$cart['kol']?>" style="width:50px;text-align:center;" /></td>
							<td class="sum-row"><?=($cart['kol']*($cart['price2']>0?$cart['price2']:$cart['price']))?></td>
						</tr>
						<?php
						$sum += $cart['kol']*($cart['price2']>0?$cart['price2']:$cart['price']);
						$koll += $cart['kol'];
					}
					?>
					<tr>
						<td colspan="4" class="itogo">
							<p>Итого: <b><?=$sum?> руб.</b></p>
							<p>Товаров: <b><?=$koll?> шт.</b></p>
							<a class="but-40 blu send-order" rel="Оформить заказ" href="/proceed/">Оформить заказ</a>
						</td>
					</tr>
					</table>
					<?php
				} else {
					?>
					<div style="text-align:center;padding:50px 20px;">
						<div style="font-size:48px;margin-bottom:20px;">🛒</div>
						<h2 style="color:#500106;margin-bottom:15px;">Ваша корзина пуста</h2>
						<p style="font-size:16px;color:#666;margin-bottom:30px;">
							К сожалению, в вашей корзине пока нет товаров.<br/>
							Вы можете перейти в каталог и выбрать интересные товары.
						</p>
						<a href="/katalog/" style="display:inline-block;padding:12px 30px;background:linear-gradient(135deg, #500106 0%, #2a0c0e 100%);color:white;text-decoration:none;border-radius:5px;font-size:16px;font-weight:bold;">
							📦 Перейти в каталог
						</a>
					</div>
					<?php
				}
				?>
			</div>
		</div>
