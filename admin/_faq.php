		<div class="wide">
			<?php include('_left.php'); ?>
			<div class="r-740<?php if($additional[29]==1){ ?> w-1024<?php } ?>">
				<div class="tree"><a href="/">Главная</a>/<a><?=$seo['menu']?></a></div>
				<div class="pagetext">
					<h1><?=$seo["h1"]?><a class="nap ask-quest">Написать</a></h1>
					<?=$seo["text"]?>
					<?php
					$p = $_GET['p']>1?$_GET['p']:1;
					$onpage = 10;
					$goods_cnt = mysql_result(mysql_query("SELECT count(*) FROM ".MySQLprefix."_faq WHERE st!=0"), 0);
					$goods_r = mysql_query("SELECT * FROM ".MySQLprefix."_faq WHERE st!=0 ORDER BY id DESC LIMIT ".(($p-1)*$onpage).", ".$onpage);
					if($goods_r && mysql_num_rows($goods_r)>0)
						while($good = mysql_fetch_assoc($goods_r)){
							?>
					<div class="question">
						<b><?=$good['name']?></b>
						<em><?=$good['question']?></em>
						<?php if(strlen($good['answer'])>0){ ?>
						<div><?=$good['answer']?></div>
						<?php } ?>
					</div>
							<?php
						}	
					if(ceil($goods_cnt/$onpage)>1){ ?>
					<table class="stranici" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td>
								<a class="pred"<?php if($p-1>0){ ?> href="/<?=$urls[0]?>/?p=<?=($p-1)?>"<?php } ?>>Предыдущая страница</a>
							</td>
							<td>
								<div class="strani">
									<?php for($pi=1; $pi<=ceil($goods_cnt/$onpage); $pi++){ 0?>
									<a <?php if($p == $pi){ ?>class="activ" <?php } ?>href="/<?=$urls[0]?>/?p=<?=$pi?>"><?=$pi?></a>
									<?php } ?>
								</div>
							</td>
							<td>
								<a class="pred"<?php if($p+1<=ceil($goods_cnt/$onpage)){ ?> href="/<?=$urls[0]?>/?p=<?=($p+1)?>"<?php } ?>>Следующая страница</a>
							</td>
						</tr>
					</table>
					<?php } ?>
				</div>
			</div>
		</div>