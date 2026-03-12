		<div style="width: 100%; padding: 20px;">
				<div class="tree">
					<a href="/">Главная</a>/<a href="<?=$cur_city[0]?>/<?=$katalog_a['url']?>/"><?=$katalog_a['menu']?></a>
					<?=$tree?>
				</div>
				<div class="pagetext">
					<h1><?=$seo['h1']?></h1>
					<?php
					if($urls[0]==$katalog_a['url'])
						$under_cats_main = "(cat_ids = '||' OR cat_ids LIKE '%|0|%')";
					else
						$under_cats_main = "cat_ids LIKE '%|".$seo['id']."|%'";
					if($additional[65]==1){
						$brands = mysql_query("SELECT brand FROM ".MySQLprefix."_goods WHERE status=1 AND ".$under_cats_main." GROUP BY brand ORDER BY brand");
						if($brands && mysql_num_rows($brands)>0){
							while($brand = mysql_fetch_assoc($brands))
								$brnd[] = $brand['brand'];
							$brand_s = mysql_query("SELECT * FROM ".MySQLprefix."_brands WHERE id IN (".implode(",", $brnd).")");
							if($brand_s && mysql_num_rows($brand_s)>0){
								?>
					<div class="brands">
								<?php
								$get = $_GET;
								unset($get['p']);
								while($brand_ = mysql_fetch_assoc($brand_s)){
									$get['brand'] = $brand_['id'];
									?>
						<table<?=($_GET['brand']==$brand_['id']?' class="actb"':'')?>><tr><td><a href="?<?=http_build_query($get)?>" title="<?=$brand_['name']?>"><img src="/<?=$brand_['logo']?>" alt="<?=$brand_['name']?>" /></a></td></tr></table>
									<?php
								}
								?>
					</div>
								<?php
							}
						}
					}
					?>
					<p class="sort-by">
						<span>Вид:</span>
						<?php $get = $_GET; ?>
						<?php $get['displ'] = 'float'; ?>
						<a href="?<?=http_build_query($get)?>" class="displ float<?php if(!isset($_GET['displ']) || isset($_GET['displ']) && $_GET['displ']=='float'){ ?> act<?php } ?>"></a>
						<?php $get['displ'] = 'block'; ?>
						<a href="?<?=http_build_query($get)?>" class="displ block<?php if(isset($_GET['displ']) && $_GET['displ']=='block'){ ?> act<?php } ?>"></a>
						<span>Сортировать по:</span>
						<?php $get = $_GET; ?>
						<?php $get['sort'] = 'priceup'; ?>
						<a href="?<?=http_build_query($get)?>" class="sort spriceup<?php if(isset($_GET['sort']) && $_GET['sort']=='priceup'){ ?> act<?php } ?>">цене &uarr;</a>
						<?php $get['sort'] = 'pricedw'; ?>
						<a href="?<?=http_build_query($get)?>" class="sort spricedw<?php if(isset($_GET['sort']) && $_GET['sort']=='pricedw'){ ?> act<?php } ?>">цене &darr;</a>
						<?php $get['sort'] = 'name'; ?>
						<a href="?<?=http_build_query($get)?>" class="sort sname<?php if(isset($_GET['sort']) && $_GET['sort']=='name'){ ?> act<?php } ?>">названию</a>
						<?php $get['sort'] = 'sort_id'; ?>
						<a href="?<?=http_build_query($get)?>" class="sort ssort_id<?php if(!isset($_GET['sort']) || isset($_GET['sort']) && $_GET['sort']=='sort_id'){ ?> act<?php } ?>">популярности</a>
					</p>
					<ul class="goods">
						<?php
						$result = mysql_query("SELECT ".MySQLprefix."_urls.url, ".MySQLprefix."_categories.logo, ".MySQLprefix."_categories.name FROM ".MySQLprefix."_categories, ".MySQLprefix."_urls WHERE ".MySQLprefix."_categories.p_id='".($urls[0]==$katalog_a['url']?0:$seo['id'])."' AND ".MySQLprefix."_categories.id=".MySQLprefix."_urls.target_id AND ".MySQLprefix."_urls.target_type='categories' GROUP BY ".MySQLprefix."_categories.id ORDER BY ".MySQLprefix."_categories.name ASC");
						if($result && mysql_num_rows($result)>0){
							while($good = mysql_fetch_assoc($result)){
								$pic = 'admin/img/folder.png';
								$pics = explode('|', $good['logo']);
								if(is_array($pics) && count($pics)>0)
									foreach($pics AS $picc)
										if(strlen($picc)>0 && $pic == 'admin/img/folder.png')
											$pic = $picc;
								?>
							<li>
								<a class="good-a" href="<?=$cur_city[0]?>/<?=$good['url']?>/"><img src="/<?=$pic?>" /></a>
								<a href="<?=$cur_city[0]?>/<?=$good['url']?>/"><span><?=$good['name']?></span></a>
							</li>
								<?php
							}
						}else{
							$onpage = 20;
							$p = (isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p']>1)?$onpage*($_GET['p']-1):0;
							switch($_GET['sort']){
								case 'priceup':
									$sort = "price ASC";
								break;
								case 'pricedw':
									$sort = "price DESC";
								break;
								case 'name':
									$sort = "name DESC";
								break;
								default:
									$sort = "sort_id ASC";
							}
							$goods_cnt = mysql_result(mysql_query("SELECT count(*) FROM ".MySQLprefix."_goods WHERE status=1 AND ".$under_cats_main.(isset($_GET['brand'])&&$_GET['brand']>0?" AND brand='".$_GET['brand']."'":"")), 0);
							$result = mysql_query("SELECT logo, id, name, price".((isset($_GET['displ']) && $_GET['displ']=='block')?", desc_full":"")." FROM ".MySQLprefix."_goods WHERE status=1 AND ".$under_cats_main.(isset($_GET['brand'])&&$_GET['brand']>0?" AND brand='".$_GET['brand']."'":"")." ORDER BY ".$sort." LIMIT ".$p.", ".$onpage);
							if($result && mysql_num_rows($result)>0)
								while($good = mysql_fetch_assoc($result)){
									?>
						<li<?php if(isset($_GET['displ']) && $_GET['displ']=='block'){ ?> class="list"<?php } ?>>
							<?php
							$pic = 'admin/uploads/nophoto.png';
							$pics = explode('|', $good['logo']);
							if(is_array($pics) && count($pics)>0)
								foreach($pics AS $picc)
									if(strlen($picc)>0 && $pic == 'admin/uploads/nophoto.png')
										$pic = $picc;
							?>
							<?php if(isset($_GET['displ']) && $_GET['displ']=='block'){ ?>
							<div class="r-pr">
								<?php if($additional[47]==0){ ?><b><?=$good['price']?> руб.</b><?php } ?>
								<?php if($additional[46]==0){ ?><a rel="<?=$good['id']?>" class="to-cart but-26">В корзину<em></em></a><?php } ?>
							</div>
							<?php } ?>
							<a class="good-a" href="<?=$cur_city[0]?>/goods/<?=$good['id']?>/"><img src="/<?=str_replace(".","_small.",$pic)?>" /></a>
							<a href="<?=$cur_city[0]?>/goods/<?=$good['id']?>/"><span><?=$good['name']?></span></a>
							<?php if(isset($_GET['displ']) && $_GET['displ']=='block'){ ?>
							<span class="desc"><?=textTrimm($good['desc_full'], 500)?></span>
							<?php }else{ ?>
							<?php if($additional[47]==0){ ?><b><?=$good['price']?> руб.</b><?php } ?>
							<?php if($additional[46]==0){ ?><a rel="<?=$good['id']?>" class="to-cart but-26"><?php if($additional[50]==0){ ?>В корзину<em></em><?php }else{ ?>Заказать<?php } ?></a><?php } ?>
							<?php } ?>
						</li>
									<?php
								}
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
					<?php
					if($goods_cnt/$onpage>1){
						?>
					<div class="pagination">
						<a class="prev-p" href="<?=substr($_SERVER['REQUEST_URI'], 0, strrpos('/',$_SERVER['REQUEST_URI']))?>?p=<?php echo ($p/$onpage); if(isset($_GET['sort'])){ echo '&sort='.$_GET['sort']; } ?><?php if(isset($_GET['displ'])){ echo '&displ='.$_GET['displ']; } ?>">Предыдущая страница</a>
						<?php
						for($pi=1; $pi<=ceil($goods_cnt/$onpage); $pi++){
							?>
						<a <?php if($p/$onpage+1 == $pi){ ?>class="cur-p" <?php } ?>href="<?php echo substr($_SERVER['REQUEST_URI'], 0, strrpos('/',$_SERVER['REQUEST_URI'])); ?>?p=<?php echo $pi; if(isset($_GET['sort'])){ echo '&sort='.$_GET['sort']; } ?><?php if(isset($_GET['displ'])){ echo '&displ='.$_GET['displ']; } ?>"><?php echo $pi; ?></a>
							<?php
						}
						if($p/$onpage+1<ceil($goods_cnt/$onpage)){
							?>
						<a class="next-p" href="<?=substr($_SERVER['REQUEST_URI'], 0, strrpos('/',$_SERVER['REQUEST_URI']))?>?p=<?php echo ($p/$onpage+2); if(isset($_GET['sort'])){ echo '&sort='.$_GET['sort']; } ?><?php if(isset($_GET['displ'])){ echo '&displ='.$_GET['displ']; } ?>">Следующая страница</a>
							<?php
						}
						?>
					</div>
						<?php
					}
					?>
				</div>
				<?php if(strlen($seo['text'])>0){ ?>
				<div class="pagetext">
					<?=$seo["text"]?>
				</div>
				<?php } ?>
			</div>
		</div>