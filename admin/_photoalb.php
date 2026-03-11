		<div class="wide">
			<?php include('_left.php'); ?>
			<div class="r-740<?php if($additional[29]==1){ ?> w-1024<?php } ?>">
				<div class="tree">
					<a href="/">Главная</a>/
					<?php
					$photogal_a = mysql_fetch_assoc(mysql_query("SELECT menu, url FROM ".MySQLprefix."_mypages WHERE id='64'"));
					?>
					<a href="/<?=$photogal_a['url']?>/"><?=$photogal_a['menu']?></a>
					<?php
					$tree = '';
					$tree_cat_ar[] = $urls[1];
					$parent = mysql_result(mysql_query("SELECT p_id FROM ".MySQLprefix."_photoalb WHERE id=".$urls[1]),0);
					while($parent!=0){
						if(isset($par_data))
							unset($par_data);
						$par_r = mysql_query("SELECT id, name, p_id FROM ".MySQLprefix."_photoalb WHERE id=".$parent." LIMIT 0, 1");
						if($par_r && mysql_num_rows($par_r)==1)
							$par_data = mysql_fetch_assoc($par_r);
						$tree = '/<a href="/photos/'.$par_data['id'].'/">'.$par_data['name'].'</a>'.$tree;
						$tree_cat_ar[] = $par_data['id'];
						$parent = $par_data['p_id'];
					}
					echo $tree;
					?>
					/<a><?=$seo['name']?></a>
				</div>
				<div class="pagetext">
					<h1><?=mysql_result(mysql_query("SELECT name FROM ".MySQLprefix."_photoalb WHERE id=".$urls[1]), 0)?></h1>
					<div class="thumbs">
						<?php
						$img_ = mysql_query("SELECT * FROM ".MySQLprefix."_photoalb WHERE p_id=".$urls[1]." ORDER BY sort_id ASC");
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
						$img_ = mysql_query("SELECT * FROM ".MySQLprefix."_photogal WHERE p_id=".$urls[1]." ORDER BY sort_id ASC");
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