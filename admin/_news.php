		<div style="width: 100%; padding: 20px;">
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