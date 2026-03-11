		<div class="wide">
			<?php include('_left.php'); ?>
			<div class="r-740<?php if($additional[29]==1){ ?> w-1024<?php } ?>">
				<div class="tree"><a href="/">Главная</a>/<a><?=$seo['h1']?></a></div>
				<div class="pagetext">
					<h1><?=$seo["h1"]?></h1>
					<?php
					$p = $_GET['p']>0?$_GET['p']:1;
					$result = mysql_query("SELECT ".MySQLprefix."_news.pic, ".MySQLprefix."_news.h1, ".MySQLprefix."_news.date_create, ".MySQLprefix."_news.comment, ".MySQLprefix."_urls.url FROM ".MySQLprefix."_news, ".MySQLprefix."_urls WHERE ".MySQLprefix."_news.shows=1 AND ".MySQLprefix."_news.id=".MySQLprefix."_urls.target_id AND ".MySQLprefix."_urls.target_type='news' AND ".MySQLprefix."_news.date_create<='".date('Y-m-d')." 12:00:00' ORDER BY ".MySQLprefix."_news.date_create DESC LIMIT ".(20*($p-1)).", 20");
					$all_p = ceil(mysql_result(mysql_query("SELECT count(*) FROM ".MySQLprefix."_news WHERE shows=1 AND date_create<='".date('Y-m-d')." 12:00:00'"),0) / 20);
					if($result)
						while($anon = mysql_fetch_assoc($result)){
							?>
				<div class="new-one">
					<a href="/<?=$anon['url']?>/"><?=$anon['h1']?></a>
					<b><?=date('d.m.Y',strtotime($anon['date_create']))?></b>
							<?php
							$pic = '';
							$pics = explode('|', $anon['pic']);
							if(is_array($pics) && count($pics)>0)
								foreach($pics AS $picc)
									if(strlen($picc)>0 && $pic == '')
										$pic = $picc;
							if($pic != ''){
								?>
					<img src="/<?=$pic?>" />
								<?php
							}
							?>
					<p><?=textTrimm($anon['comment'],1500)?></p>
				</div>
							<?php
						}
					?>
				<?php if($all_p>1){ ?>
				<p class="pages">
					<?php
					for($pi = 1; $pi <= $all_p; $pi++){
						unset($gets);
						foreach($_GET AS $k => $v){
							if($k == 'p')
								$v = $pi;
							$gets[] = $k."=".$v;
						}
						if(!isset($_GET['p']))
							$gets[] = "p=".$pi;
						?>
					<a<?php if($pi != $p){ ?> href="/news/?<?=implode("&", $gets)?>"<?php } ?>><?=$pi?></a>
					<?php } ?>
				</p>
				<?php } ?>
					</div>
			</div>
		</div>