		<div class="wide">
			<?php include('_left.php'); ?>
			<div class="r-740<?php if($additional[29]==1){ ?> w-1024<?php } ?>">
				<?php $photogal_a = mysql_fetch_assoc(mysql_query("SELECT menu, url FROM ".MySQLprefix."_mypages WHERE id='64'")); ?>
				<div class="tree"><a href="/">Главная</a>/<a><?=$photogal_a['menu']?></a></div>
				<div class="pagetext">
					<h1><?=$seo["h1"]?></h1>
					<div class="thumbs">
						<?php
						$img_ = mysql_query("SELECT * FROM ".MySQLprefix."_photoalb WHERE p_id=0 ORDER BY sort_id ASC");
						if($img_ && mysql_num_rows($img_)>0)
							while($img = mysql_fetch_assoc($img_)){
								?>
						<div class="photoalb">
							<a href="/photos/<?=$img['id']?>/">
								<img src="/<?=str_replace(".","_small.",$img['logo'])?>" />
							</a>
							<a href="/photos/<?=$img['id']?>/"><?=$img['name']?></a>
						</div>
								<?php
							}
						$img_ = mysql_query("SELECT * FROM ".MySQLprefix."_photogal WHERE p_id=0 ORDER BY sort_id ASC");
						if($img_ && mysql_num_rows($img_)>0)
							while($img = mysql_fetch_assoc($img_)){
								?>
						<div class="photoalb">
							<a rel="gal" href="/<?=$img['logo']?>">
								<img src="/<?=str_replace(".","_small.",$img['logo'])?>" />
							</a>
							<a><?=$img['name']?></a>
						</div>
								<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>