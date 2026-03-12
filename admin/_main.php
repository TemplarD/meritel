		<?php
		if($additional[28]==0 && $additional[10]==1)
			include('_slider_on_main.php');
		?>
		<div style="width: 100%; padding: 20px;">
			<?php if($additional[49]==0){ ?>
				<?php
				$ar_rf = array('%%__FORMA__%%');
				$ar_to = array('
<div class="pop-up write-us-pop" style="position:relative;left:0;top:0;margin:20px auto;z-index:1;background:#F9F9F9;box-shadow:0 0 5px #ccc;padding:20px 20px 0 20px;overflow:hidden">
	<form method="post" class="write-us-form">
		'.csrf_field().'
		<label>Ваше имя или название организации:</label>
		<input type="text" name="name" />
		<label>Контактная информация (телефон или e-mail):</label>
		<input type="text" name="contacts" />
		<label>Текст сообщения:</label>
		<textarea name="text"></textarea>
	</form>
	<a class="submit write-us-submit">Отправить</a>
</div>');
				?>
				<?php if($additional[10]==0) include('_slider_on_main.php'); ?>
				<div class="pagetext">
					<h1><?=$seo["h1"]?></h1>
					<?=str_replace($ar_rf,$ar_to,$seo["text"])?>
					<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,gplus" data-yashareTheme="counter" style="float:right;text-align:right"></div>
				</div>
				<?php } ?>
				<?php if($additional[45]==0){ ?>
				<div class="pagetext">
					<h2><?=$katalog_a['menu']?></h2>
					<ul class="goods">
						<?php
						$result = mysql_query("SELECT logo, id, name, price FROM ".MySQLprefix."_goods WHERE onmain=1 AND status=1 ORDER BY sort_id DESC");
						if($result)
							if(mysql_num_rows($result)>0)
								while($good = mysql_fetch_assoc($result)){
									?>
						<li>
							<?php
							$pic = 'admin/uploads/nophoto.png';
							$pics = explode('|', $good['logo']);
							if(is_array($pics) && count($pics)>0)
								foreach($pics AS $picc)
									if(strlen($picc)>0 && $pic == 'admin/uploads/nophoto.png')
										$pic = $picc;
							?>
							<a class="good-a" href="<?=$cur_city[0]?>/goods/<?=$good['id']?>/"><img src="/<?=str_replace(".","_small.",$pic)?>" /></a>
							<a href="<?=$cur_city[0]?>/goods/<?=$good['id']?>/"><span><?=$good['name']?></span></a>
							<?php if($additional[47]==0){ ?><b><?=$good['price']?> руб.</b><?php } ?>
							<?php if($additional[46]==0){ ?><a rel="<?=$good['id']?>" class="to-cart but-26"><?php if($additional[50]==0){ ?>В корзину<em></em><?php }else{ ?>Заказать<?php } ?></a><?php } ?>
						</li>
									<?php
								}
						?>
					</ul>
					<script>
						<!--
						$(document).ready(function(){
							var s = 0;
							$('.goods li').each(function(){
								s++;
								if(s/<?=($additional[29]==0?'4':'5')?>-Math.floor(s/<?=($additional[29]==0?'4':'5')?>)==0)
									$(this).after('<br style="clear:both" />');
							});
						});
						//-->
					</script>
					<a style="float:right;font-size:12px" href="<?=$cur_city[0]?>/<?=$katalog_a['url']?>/">Смотреть все</a>
				</div>
				<?php } ?>
				<?php if($additional[49]==1){ ?>
				<div class="pagetext">
					<h1><?=$seo["h1"]?></h1>
					<?=str_replace($ar_rf,$ar_to,$seo["text"])?>
					<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,gplus" data-yashareTheme="counter" style="float:right;text-align:right"></div>
				</div>
				<?php } ?>
				<?php if($additional[61]==1){ ?>
				<div class="pagetext">
					<h2><?=$additional[62]?></h2>
					<ul class="partners">
						<?php
						$result = mysql_query("SELECT logo, name FROM ".MySQLprefix."_partners ORDER BY id ASC");
						$pCnt = 0;
						if($result && mysql_num_rows($result)>0)
							while($good = mysql_fetch_assoc($result)){
								$pCnt++;
								?>
						<li class="<?=($pCnt>6?'none':'')?>">
							<?php
							$pic = 'admin/uploads/nophoto.png';
							$pics = explode('|', $good['logo']);
							if(is_array($pics) && count($pics)>0)
								foreach($pics AS $picc)
									if(strlen($picc)>0 && $pic == 'admin/uploads/nophoto.png')
										$pic = $picc;
							?>
							<img src="/<?=$pic?>" />
							<span><?=$good['name']?></span>
						</li>
									<?php
								}
						?>
					</ul>
					<a class="partners-all">Смотреть все</a>
					<a class="partners-none">Скрыть</a>
					<script>
						<!--
						$(document).ready(function(){
							var s = 0;
							$('.partners li').each(function(){
								s++;
								if(s/6-Math.floor(s/6)==0)
									$(this).after('<br style="clear:both" />');
							});
							$('.partners-all').click(function(){
								$('.partners li').each(function(){
									if($(this).index()>5)
										$(this).removeClass('none');
								});
								$(this).hide();
								$('.partners-none').show();
							});
							$('.partners-none').click(function(){
								$('.partners li').each(function(){
									if($(this).index()>5)
										$(this).addClass('none');
								});
								$(this).hide();
								$('.partners-all').show();
							});
						});
						//-->
					</script>
				</div>
				<?php } ?>
		</div>		</div>
<?php } ?>
</div>
