		<div style="width: 100%; padding: 20px;">
				<div class="tree">
					<a href="/">Главная</a>/<a href="<?=$cur_city[0]?>/<?=$katalog_a['url']?>/"><?=$katalog_a['menu']?></a><?php
					$tree = '';
					$tree_cat_ar[] = $seo['id'];
					$cat_ids = explode("|", substr($seo['cat_ids'],1,strlen($seo['cat_ids'])-2));
					$parent = $cat_ids[0];
					while($parent!=0){
						if(isset($par_data))
							unset($par_data);
						$par_r = mysql_query("SELECT ".MySQLprefix."_urls.url, ".MySQLprefix."_categories.id, ".MySQLprefix."_categories.name, ".MySQLprefix."_categories.p_id FROM ".MySQLprefix."_categories, ".MySQLprefix."_urls WHERE ".MySQLprefix."_categories.id=".$parent." AND ".MySQLprefix."_urls.target_type='categories' AND ".MySQLprefix."_urls.target_id=".MySQLprefix."_categories.id LIMIT 0, 1");
						if($par_r)
							if(mysql_num_rows($par_r)==1)
								$par_data = mysql_fetch_assoc($par_r);
						$tree = '/<a href="'.$cur_city[0].'/'.$par_data['url'].'/">'.$par_data['name'].'</a>'.$tree;
						$tree_cat_ar[] = $par_data['id'];
						$parent = $par_data['p_id'];
					}
					echo $tree;
				?>/<a><?=$seo['name']?></a></div>
				<div class="pagetext">
					<?php
					$good = mysql_fetch_assoc(mysql_query("SELECT * FROM ".MySQLprefix."_goods WHERE id=".$seo['id']));
					$good_pics = explode('|', $good['logo']);
					if(is_array($good_pics) && count($good_pics)>0){
						for($gp=0; $gp<count($good_pics); $gp++)
							if(strlen($good_pics[$gp])==0)
								unset($good_pics[$gp]);
						$good_pic = array_values($good_pics);
					}
					?>
					<div class="good-photos">
						<?php if(is_array($good_pic) && count($good_pic)>0){ ?>
						<a class="good-main-pic" href="/<?=$good_pic[0]?>"><img src="/<?=$good_pic[0]?>" /></a>
						<?php }else{ ?>
						<a class="good-main-pic"></a>
						<?php } ?>
						<?php if(is_array($good_pic) && count($good_pic)>1){ ?>
						<div class="good-other-pics">
							<?php $smcnt = 0; foreach($good_pic AS $picc){ $smcnt++; ?>
							<a href="/<?=$picc?>"><img src="/<?=str_replace(".","_small.",$picc)?>" /></a>
							<?php if($smcnt%3==0){ ?><br style="clear:both" /><?php }} ?>
						</div>
						<div class="virtual-pics none"><?php foreach($good_pic AS $picc){ ?><a rel="sml" href="/<?=$picc?>" class="none"></a><?php } ?></div>
						<?php } ?>
						<script type="text/javascript">
							<!--
							$(document).ready(function(){
								<?php if(is_array($good_pic) && count($good_pic)>1){ ?>
								$('a[rel="sml"]').fancybox({'transitionIn': 'none', 'transitionOut': 'none'});
								$(".good-main-pic").click(function() {
									$('a[rel="sml"]:eq('+cur_sml+')').click();
									return false;
								});
								<?php }else{ ?>
								$('.good-main-pic').fancybox({'transitionIn': 'none', 'transitionOut': 'none'});
								<?php } ?>
							});
							//-->
						</script>
					</div>
					<h1 class="good-h1"><?=$good['h1']?></h1>
					<?php
					$more_cats_r = mysql_query("SELECT ".MySQLprefix."_good_chars.id, ".MySQLprefix."_good_chars.ed AS char_ed, ".MySQLprefix."_good_chars.name AS char_name, ".MySQLprefix."_good_chars_val.char_val FROM ".MySQLprefix."_good_chars, ".MySQLprefix."_good_chars_val WHERE ".MySQLprefix."_good_chars.id=".MySQLprefix."_good_chars_val.char_id AND ".MySQLprefix."_good_chars_val.good_id=".$seo["id"]." ORDER BY ".MySQLprefix."_good_chars.sort_id");
					if($more_cats_r && mysql_num_rows($more_cats_r)>0)
						while($more_cats = mysql_fetch_assoc($more_cats_r))
							$chars[$more_cats['id']] = $more_cats;
					?>
					<?php if(strlen($good['stock'])>0&&$good['stock']>0){ ?><span class="stock" style="font-size:90%">Товар в наличии: <font style="text-shadow:0 0 0 #000"><?=$good['stock']?></font></span><?php } ?>
					<?php if($good['podzak']==1){ ?><span class="stock" style="font-size:90%">Товар под заказ</span><?php } ?>
					<?php if(strlen($good['g_code'])>0){ ?><br/><span class="stock" style="font-size:90%">Код товара: <font style="text-shadow:0 0 0 #000"><?=$good['g_code']?></font></span><?php } ?>
					<?php if(strlen($good['g_art'])>0){ ?><br/><span class="stock" style="font-size:90%">Артикул: <font style="text-shadow:0 0 0 #000"><?=$good['g_art']?></font></span><?php } ?>
					<span class="price-kol">
						<b class="price"><?php if($additional[47]==0){ ?><?=$good['price']?> руб.<?php } ?></b>
						<?php if($additional[46]==0){ ?>
						Укажите кол-во:
						<input class="text kol" value="1" style="width:20px;float:right;margin:-5px 0 0 5px;text-align:center" />
						<?php } ?>
					</span>
					<?php if($additional[46]==0){ ?>
					<?php if($additional[50]==0){ ?>
					<a rel="<?=$good['id']?>" class="buy-it"><span>Добавить в корзину</span></a>
					<a class="one-click-buy"><span>Купить в 1 клик</span></a>
					<?php }else{ ?>
					<a rel="<?=$good['id']?>" style="width:180px;margin-top:20px;text-align:center" class="buy-it"><span style="background:none;padding:0">Заказать</span></a>
					<?php } ?>
					<?php } ?>
					<div class="sharing">
						Поделиться
						<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
						<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="vkontakte,facebook,twitter,gplus,lj,moimir,odnoklassniki"></div>
					</div> 
					<table class="more-info">
						<?php
						$odd = false;
						foreach($chars AS $chid => $char){
							$odd = !$odd;
							?>
						<tr<?php if($odd){ ?> class="odd"<?php } ?>><td><?=$char['char_name']?><?=(strlen($char['char_ed'])>0?',&nbsp;'.$char['char_ed']:'')?>&nbsp;:</td><td><?=$char['char_val']?></td></tr>
							<?php
						}
						?>
					</table>
					<b class="opis">Описание товара:</b>
					<div class="desc-full"><?=$good['desc_full']?></div>
					<script type="text/javascript">
						$(document).ready(function(){
							$('.desc-full li').each(function(){
								if(!$(this).parent().hasClass('with-this'))
									$(this).css({'float':'left','margin-left':'20px','width':'350px'}).after('<p style="width:100%;">&nbsp;</p>');
							});
						});
					</script>
					<?php if($additional[48]==1){ ?>
					<style>
						.mods-pagetext table{width:100%;border:0;border-collapse:collapse}
							.mods-pagetext table td{padding:5px;font:13px/16px Arial}
							.mods-pagetext table tr:first-child td{font:bold 13px/16px Arial}
							.mods-pagetext table td:last-child input{
								display: block;
								height: 18px;
								width: 24px;
								border-radius:3px;
								border:1px solid #999;
								text-align:center;
								font:12px/16px Arial;
								float:left;
							}
							.mods-pagetext table td:last-child .to-cart-too{
								background:<?=$additional[26]?>;
								border:1px solid <?=$additional[26]?>;
								color: #fff !important;
								float: right;
								font-family: Verdana;
								font-size: 12px;
								font-weight: bold;
								margin: 0px 0 0;
								width: 70px;height: 18px;line-height: 16px;
							}
							.mods-pagetext tr.act a{opacity:0.3;cursor:default}
							.mods-pagetext tr.act td{background:#cfc}
					</style>
					<div class="mods-pagetext" style="clear:both"><?=$good['mods']?></div>
					<script>
						<!--
						function strip_tags( str ){
							return str.replace(/<\/?[^>]+>/gi, '');
						}
						$(document).ready(function(){
							<?php if($additional[46]==0){ ?>
							if($('.mods-pagetext table').length >= 1){
								var tr = 0;
								$('.mods-pagetext table tr').each(function(){
									if($(this).index() == 0)
										$(this).append('<td>Заказать</td>');
									else{
										var rel = '';
										for(var td = 0; td < $(this).find('td').length; td++)
											rel += strip_tags($('.mods-pagetext table tr:eq(0) td:eq(' + td + ')').html()).trim() + ':' + strip_tags($(this).find('td:eq(' + td + ')').html()).trim() + '|';
										$(this).append('<td><input type="text" value="1" name="quantity[' + tr + ']" /><a class="to-cart-too but-26" rel="' + rel + 'id:<?=$seo['id']?>">КУПИТЬ</a></td>');
									}
									tr++;
								});
								$('.mods-pagetext table tr:first td:last').css({'width':'105px'});
								$('.mods-pagetext td a').click(function(){
									if($(this).parent().parent().hasClass('act'))
										return false;
									$.post('/admin/_add_good_to_cart.php', {good: $(this).attr('rel'), kol: $(this).parent().find('input').val()}, function(data){
										if(parseInt(data)>0)
											$('.cart-top i').html(data);
									});
									$(this).parent().parent().addClass('act');
									$(this).parent().find('input').hide();
									$('.pop-up-bg').fadeIn(250,function(){
										$('.just-add-pop').fadeIn(250);
									});
								});
							}
							<?php } ?>
							$('.submit.lefter').click(function(){
								$(this).parent().find('.clz').click();
							});
						});
						//-->
					</script>
					<?php } ?>
					<h2 class="pad-top-clear"><a>С этим товаром покупают</a></h2>
					<ul class="goods with-this">
						<?php
						$result = mysql_query("SELECT logo, id, name, price FROM ".MySQLprefix."_goods WHERE id!='".$seo['id']."' GROUP BY RAND() ORDER BY sort_id DESC LIMIT 0, 4");
						if($result && mysql_num_rows($result)>0)
							while($goodi = mysql_fetch_assoc($result)){
								?>
						<li>
							<?php
							$pic = 'admin/uploads/nophoto.png';
							$pics = explode('|', $goodi['logo']);
							if(is_array($pics) && count($pics)>0)
								foreach($pics AS $picc)
									if(strlen($picc)>0 && $pic == 'admin/uploads/nophoto.png')
										$pic = $picc;
							?>
							<a class="good-a" href="<?=$cur_city[0]?>/goods/<?=$goodi['id']?>/"><img src="/<?=str_replace(".","_small.",$pic)?>" /></a>
							<a href="<?=$cur_city[0]?>/goods/<?=$goodi['id']?>/"><span><?=$goodi['name']?></span></a>
							<?php if($additional[47]==0){ ?><b><?=$goodi['price']?> руб.</b><?php } ?>
							<?php if($additional[46]==0){ ?><a rel="<?=$goodi['id']?>" class="to-cart but-26"><?php if($additional[50]==0){ ?>В корзину<em></em><?php }else{ ?>Заказать<?php } ?></a><?php } ?>
						</li>
								<?php
							}
						?>
					</ul>
				</div>
			</div>
			<?php  ?>
		</div>