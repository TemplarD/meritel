		<div class="wide">
			<?php include('_left.php'); ?>
			<div class="r-740<?php if($additional[29]==1){ ?> w-1024<?php } ?>">
				<div class="tree"><a href="/">Главная</a>/<a href="/news/">Новости</a>/<a><?=$seo['h1']?></a></div>
				<div class="pagetext">
					<h1><?=$seo['h1']?></h1>
					<?php
					$pic = '';
					$pics = explode('|', $seo['pic']);
					if(is_array($pics) && count($pics)>0)
						foreach($pics AS $picc)
							if(strlen($picc)>0 && $pic == '')
								$pic = $picc;
					if($pic != ''){
						?>
					<a class="mainnewpic" href="/<?=$pic?>"><img class="mainnewpic" src="/<?=$pic?>" /></a>
						<?php
					}
					?>
					<?=$seo['comment']?>
				</div>
			</div>
		</div>