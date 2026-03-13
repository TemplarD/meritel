	<title><?php echo $seo['title']; if(isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p']>1){ echo ' (Страница '.$_GET['p'].')'; } ?></title>
	<meta name="description" content="<?php echo $seo['description']; ?>" />
	<meta name="keywords" content="<?php echo $seo['keywords']; ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="ru" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="/admin/css/style.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="/admin/css/new-menu.css?v=5" media="screen, projection" />
	<?php if($additional[69]==1){ ?><link rel="stylesheet" type="text/css" href="/admin/css/responsitive.css" media="screen, projection" /><?php } ?>
	<link rel="stylesheet" type="text/css" href="/admin/css/jquery.fancybox-1.3.4.css" media="screen, projection" />
	<script type="text/javascript" src="/admin/js/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="/admin/js/ddsmoothmenu.js"></script>
	<script type="text/javascript" src="/admin/js/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript">
		<!--
		var slide_show_Timeout, slide_show_Delay=<?=$additional[42]?>, cur_sl_is, cur_sml = 0, forms_ar = new Array('call-back','write-us','one-click','ask-quest'), scrollTopTO, scrollTopLimit = 0, sliderH = 0, sliderW = 0;
		function checkScrollTop(){
			if($(document).scrollTop()>=scrollTopLimit && !$('.the1').hasClass('fixed')){
				$('.the1, .the2').addClass('fixed');
				resizeMe();
			}else if($(document).scrollTop()<scrollTopLimit && $('.the1').hasClass('fixed')){
				$('.the1, .the2').removeClass('fixed');
				resizeMe();
			}
			scrollTopTO = window.setTimeout('checkScrollTop()', 250);
		}
		function hide_pop(what){
			$('.current-form .'+what+'-pop .clz').click();
			$('.current-form .'+what+'-form p').remove();
			$('.current-form .'+what+'-form *').show();
		}
		function slide_show(nn){
			cur_sl_is = nn;
			var nextSlide = nn+1==$('.slide').length?0:nn+1;
			$('.slide.cur-slide').removeClass('cur-slide').fadeOut();
			$('.slide:eq('+nn+')').addClass('cur-slide').fadeIn(function(){
				$('.sliderNav a.on').addClass('off').removeClass('on');
				$('.sliderNav a:eq('+nn+')').addClass('on');  
			});
			slide_show_Timeout = window.setTimeout('slide_show('+nextSlide+')', slide_show_Delay);
		}
		function struct_it(){
			$('.opnd').each(function(){
				<?php if($additional[59]==0){ ?>
				$(this).parent().find('ul').eq(0).show();
				<?php } ?>
				$(this).parent().parent().parent().find('>a').addClass('opnd');
			});
		}
		function rcnt(){
			var sum = 0;
			$('.cart-table .kol').each(function(){
				var nsum = parseInt(($(this).val().length==0||$(this).val()<1?1:$(this).val()))*parseInt($(this).parent().parent().find('.pr-row').html().replace(' руб.',''));
				sum += nsum;
				$(this).parent().parent().find('.sum-row').html(nsum+' руб.');
			});
			$('.itogo b').html(sum+' руб.');
		}
		function make_cart_on(d){
			if(d.length>0)
				$('.cart-top i').html(d);
			else
				$('.cart-top i').html('0');
			$('.itogo span').html(d);
		}
		function resizeMe(){
			$('.slider').css({'height':(sliderH/sliderW*$('.slider').width()+30)+'px'});
			$('.slide').css({'height':(sliderH/sliderW*$('.slider').width())+'px'});
			$('body > .pop-up').each(function(){
				if($(this).css('display')=='block')
					$(this).animate({'margin-top':'-' + ($(this).height()/2) + 'px'},250);
			});
			var brCnt = ($('.photoalb').width()*2>$('.thumbs').width()-20?<?=($additional[29]==1?3:2)?>:<?=($additional[29]==1?4:3)?>);
			var s = 0;
			$('.thumbs br').each(function(){
				$(this).remove();
			});
			$('.photoalb').each(function(){
				s++;
				if(s/brCnt-Math.floor(s/brCnt)==0)
					$(this).after('<br style="clear:both" />');
			});
			var brCnt = ($('.goods li').width()*2>$('.goods').width()-20?2:($('.goods li').width()*3>$('.goods').width()-20?3:4));
			var s = 0;
			$('.goods br').each(function(){
				$(this).remove();
			});
			$('.goods li').each(function(){
				s++;
				if(s/brCnt-Math.floor(s/brCnt)==0)
					$(this).after('<br style="clear:both" />');
			});
			$('.menu > li > a').css('padding','0 20px');
			var allWth = $('#smoothmenu1 .menu').width(), allMnuCnt = $('.menu > li').length;
			$('.menu > li').each(function(){
				allWth -= $(this).outerWidth();
			});
			if($('#smoothmenu1').length==1){
				var ddsmoothmenu_w=0;
				$('.menu>li').each(function(){
					ddsmoothmenu_w+=$(this).width();
				});
			}
			var lOtsp = Math.floor(allWth/(allMnuCnt), 0);
			$('.menu > li > a').css('padding','0 '+(lOtsp/2+19)+'px');
		}
		$(window).resize(function(){
			resizeMe();
		});
		$(document).ready(function(){
			resizeMe();
		});
		$(window).load(function(){
			sliderH = parseInt($('.slide').css('height'));
			sliderW = <?=($additional[10]==0?740:1024)?>;
			$('.menubtn').click(function(){
				$(this).toggleClass('shw');
				if($(this).hasClass('shw')){
					$('.r-740').animate({'margin-right':'-'+$('.l-250').width()/0.85+'px'}, 500);
					$('.l-250').css({'position':'relative'}).animate({'margin-left':'0'}, 500);
				}else{
					$('.l-250').animate({'margin-left':'-100%'}, 500, function(){
						$(this).css({'position':'absolute'})
					});
					$('.r-740').animate({'margin-right':'0'}, 500);
				}
			});
			<?php if($additional[63]==1){ ?>
			scrollTopLimit = $('#smoothmenu1').offset().top;
			$('.the2').css('height',(scrollTopLimit+$('#smoothmenu1').height())+'px');
			checkScrollTop();
			<?php } ?>
			var allWth = $('#smoothmenu1 .menu').width()/*$('.menu').outerWidth()*/, allMnuCnt = $('.menu > li').length;
			$('.menu > li').each(function(){
				allWth -= $(this).outerWidth();
			});
			if($('#smoothmenu1').length==1){
				ddsmoothmenu.init({mainmenuid: "smoothmenu1", orientation: 'h', classname: 'ddsmoothmenu', contentsource: "markup"});
				var ddsmoothmenu_w=0;
				$('.menu>li').each(function(){
					ddsmoothmenu_w+=$(this).width();
				});
			}
			var lOtsp = Math.floor(allWth/(allMnuCnt), 0);
			$('.menu > li > a').css('padding','0 '+(lOtsp/2+20)+'px');
			$('.clz, .pop-up-bg').click(function(){
				$('.pop-up').fadeOut(250,function(){
					$('.pop-up-bg').fadeOut(250);
				});
			});
			var s = 0;
			$('.photoalb').each(function(){
				s++;
				if(s/3-Math.floor(s/3)==0)
					$(this).after('<br style="clear:both" />');
			});
			$('a[rel="gal"]').fancybox({'transitionIn': 'none', 'transitionOut': 'none'});
			$('.mainnewpic').fancybox({'transitionIn': 'none', 'transitionOut': 'none'});
			$('.slide:eq(0)').addClass('cur-slide').show();
			if($('.slide').length>1)
				slide_show_Timeout = window.setTimeout('slide_show(1)', slide_show_Delay);
			else
				$('.sliderNav').hide();
			$('.sliderNav a').click(function(){
				if(!$(this).hasClass('on')){
					$('.sliderNav a.on').addClass('off').removeClass('on');
					$(this).addClass('on');
					clearTimeout(slide_show_Timeout);
					slide_show(($('.slide').length-$(this).index()-1));
				}
				return false;
			});	
			struct_it();
			$('.lmenu li a').click(function(){
				if($(this).parent().find('ul').length>0){
					$(this).toggleClass('opnd');
					struct_it();
					//return false;
				}
			});
			<?php if($additional[59]==1){ ?>
			$('.catalogue li').each(function(){
				if($(this).find('ul').length>0)
					$(this).find('>a').addClass('top');
			});
			<?php } ?>
			$('.clz, .pop-up-bg').click(function(){
				$('.pop-up').fadeOut(250,function(){
					$('.pop-up-bg').fadeOut(250);
				});
			});
			
			// Уведомления корзины
			function showCartNotification(message, isError) {
				var $notif = $('#cart-notification');
				$notif.text(message).removeClass('error').addClass(isError ? 'error' : '');
				$notif.fadeIn(300).delay(3000).fadeOut(300);
			}
			
			// Анимация обновления корзины
			function animateCartUpdate() {
				$('.cart-top').addClass('updated');
				setTimeout(function() {
					$('.cart-top').removeClass('updated');
				}, 200);
			}
			
			$('.del_from_cart').click(function(){
				var $row = $(this).parent().parent();
				$row.fadeOut(300, function() {
					$(this).remove();
				});
				$.post('/admin/_del_from_cart.php', {id: $row.attr('rel')}, function(data){
					make_cart_on(data);
					rcnt();
					animateCartUpdate();
					showCartNotification('Товар удалён из корзины', false);
				}).fail(function() {
					showCartNotification('Ошибка при удалении', true);
				});
			});
			$('.cart-table .kol').keyup(function(){
				var $row = $(this).parent().parent();
				$('.cart-top').addClass('cart-loading');
				$.post('/admin/_change_cart.php', {id: $row.attr('rel'), kol: ($(this).val().length==0||$(this).val()<1?1:$(this).val())}, function(data){
					make_cart_on(data);
					rcnt();
					animateCartUpdate();
					$('.cart-top').removeClass('cart-loading');
				}).fail(function() {
					showCartNotification('Ошибка при обновлении', true);
					$('.cart-top').removeClass('cart-loading');
				});
			});
			$('.cart-table .kol').change(function(){
				if($(this).val()<1)
					$(this).val(1);
				var $row = $(this).parent().parent();
				$('.cart-top').addClass('cart-loading');
				$.post('/admin/_change_cart.php', {id: $row.attr('rel'), kol: ($(this).val().length==0||$(this).val()<1?1:$(this).val())}, function(data){
					make_cart_on(data);
					rcnt();
					animateCartUpdate();
					showCartNotification('Количество обновлено', false);
					$('.cart-top').removeClass('cart-loading');
				}).fail(function() {
					showCartNotification('Ошибка при обновлении', true);
					$('.cart-top').removeClass('cart-loading');
				});
			});
			$('.robo input').change(function(){
				if($(this).attr('checked')){
					$('input[name="robo"]').val("yes");
					$('.send-order').html($('.send-order').attr('rel'));
				}else{
					$('input[name="robo"]').val("no");
					$('.send-order').html($('.send-order').attr('rel2'));
				}
			});
			$('.send-order').click(function(){
				var allRight = true;
				$('.prcceed-form input').each(function(){
					if(allRight && $(this).val().length==0 && $(this).parent().find('label').html().indexOf('*')>0){
						$(this).focus()
						allRight = false;
					}
				});
				if(allRight)
					$.post('/admin/_place_order.php', $('.prcceed-form').serialize(), function(data){
						if($('.robo input').length==1 && $('.robo input').attr('checked')){
							$('.payitform').remove();
							$('body').append(data);
							$('.payitform').submit();
						}else{
							alert(data);
							$('.prcceed-form .text').each(function(){
								$(this).val('');
							});
							$('.cart-top i').html('0');
						}
					});
			});
			$('.good-other-pics a').click(function(){
				cur_sml = $(this).index();
				$('.good-main-pic').attr('href', $(this).attr('href'));
				$('.good-main-pic img').attr('src', $(this).attr('href'));
				return false;
			});
			$('.adtocart').click(function(){
				$.post('/admin/_add_good_to_cart.php', {good: $(this).attr('rel'), kol: $('.kol').val()}, function(data){
					if(parseInt(data)>0){
						make_cart_on(data);
						$('html, body').scrollTop($('.good-photos').offset().top+20);
					}
				});
				return false;
			});
			<?php if($additional[50]==0){ ?>
			$('.buy-it').click(function(){
				$.post('/admin/_add_good_to_cart.php', {good: $(this).attr('rel'), kol: $('.kol').val()}, function(data){
					if(parseInt(data)>0)
						make_cart_on(data);
					$('.pop-up-bg').fadeIn(250,function(){
						$('.just-add-pop').fadeIn(250);
						resizeMe();
					});
				});
				return false;
			});
			$('.to-cart').click(function(){
				$.post('/admin/_add_good_to_cart.php', {good: $(this).attr('rel'), kol: 1}, function(data){
					if(parseInt(data)>0)
						make_cart_on(data);
					$('.pop-up-bg').fadeIn(250,function(){
						$('.just-add-pop').fadeIn(250);
						resizeMe();
					});
				});
				return false;
			});
			$('.one-click-buy').click(function(){
				$('.pop-up-bg').show();
				$('.one-click-pop').show();
			});
			<?php }else{ ?>
			$('.to-cart, .buy-it').click(function(){
				$('.pop-up-bg').show();
				$('.one-click-pop').show();
				$('input[name="good"]').val($(this).attr('rel'));
				if($(this).hasClass('to-cart')){
					$('input[name="title"]').val($(this).parent().find('span').html());
					if($(this).parent().find('b').length>0)
						$('input[name="price"]').val($(this).parent().find('b').html().replace(' руб.',''));
					else
						$('input[name="price"]').val('0');
				}
			});
			<?php } ?>
			$('.cart-top').click(function(){
				if($(this).find('i').html()=='0')
					return false;
			});
			for(var f = 0; f < forms_ar.length; f++){
				$('.'+forms_ar[f]).click({cls: forms_ar[f]}, function(e){
					$('.pop-up-bg').fadeIn(250,function(){
						$('.'+e.data.cls+'-pop').fadeIn(250);
						resizeMe();
					});
					return false;
				});
				$('.'+forms_ar[f]+'-submit').click({cls: forms_ar[f]}, function(e){
					$(this).parent().addClass('current-form');
					var allRight = true;
					$('.current-form .'+e.data.cls+'-form input, .current-form .'+e.data.cls+'-form textarea').each(function(){
						if(allRight && $(this).val().length==0){
							$(this).focus()
							allRight = false;
						}
					});
					if(allRight)
						$.post('/admin/_'+e.data.cls+'-order.php', $('.current-form .'+e.data.cls+'-form').serialize(), function(data){
							$('.current-form .'+e.data.cls+'-form label, .current-form .'+e.data.cls+'-form input, .current-form .'+e.data.cls+'-form textarea').hide();
							$('.current-form .'+e.data.cls+'-form').append(data);
							var hp = window.setTimeout('hide_pop("'+e.data.cls+'")', 2000);
						});
					return false;
				});
			}
			<?php
			if(isset($_REQUEST["InvId"])){
				$mrh_pass1 = $additional[52];
				$out_summ = $_REQUEST["OutSum"];
				$inv_id = $_REQUEST["InvId"];
				$shp_item = $_REQUEST["Shp_item"];
				$crc = $_REQUEST["SignatureValue"];
				$crc = strtoupper($crc);
				$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item"));
				if($my_crc == $crc){
					?>
			alert("Операция прошла успешно.\nЗаказ №<?=$_REQUEST["InvId"]?> оплачен\nМенеджер свяжется с Вами\nв ближайшее время.");
					<?php
				}
			}
			?>
			resizeMe();
		});
		//-->
	</script>
	<style type="text/css">
		body{background:<?=$additional[8]?><?php if(strlen($additional[13])>0){ ?> url('/<?=$additional[13]?>') no-repeat 50% 0<?php } ?><?php if($additional[64]==1){ ?>;background-attachment:fixed<?php } ?>}
		.hed .te{background:<?php if(strlen($additional[27])>0){ ?> url('/<?=$additional[27]?>') no-repeat 0 0<?php } ?>}
			.main, .cart-top, .menubtn/*, .the1.fixed*/{background-color:<?=$additional[9]?>}
				#smoothmenu1, .ddsmoothmenu ul li ul li, .ddsmoothmenu ul li ul li a, .buy-it, .scroll-buy .adtocart, .one-click-submit, .but-40.blu{background-color:<?=$additional[18]?>;}
					.ddsmoothmenu ul li a, .ddsmoothmenu ul li a:link, .ddsmoothmenu ul li a:visited, .ddsmoothmenu ul li ul li a{color:<?=$additional[25]?> !important}
				.ddsmoothmenu ul li ul li a:hover, .ddsmoothmenu ul li a.selected, .ddsmoothmenu ul li a:hover, .ddsmoothmenu ul li a.act-m{background-color:<?=$additional[19]?>;color:<?=$additional[16]?> !important}
		<?php if($additional[36]==1){ ?>
		.menu{width:100%;height:32px;margin:15px 0 7px 0;text-align:center}
			.menu a{font:17px/20px Arial;padding:6px 18px;margin:0 10px}
			.menu a:hover, .menu a.act-m{text-decoration:none}
					.ddsmoothmenu ul li a.act-m{background-image:url('/admin/img/menu-top-bg.png');background-repeat:repeat-x;background-position:0 0}
							.ddsmoothmenu ul li ul li{box-shadow:0 1px 2px #333}
						.ddsmoothmenu ul li ul li a.act-m{background-image:url('/admin/img/menu-top-bg.png');background-repeat:repeat-x;background-position:0 -100px}
		<?php }else{ ?>
		#smoothmenu1{border-radius:5px;height:50px;margin:0 auto 20px}
			.ddsmoothmenu ul{border-radius:5px}
				.ddsmoothmenu ul ul{width:260px}
				.ddsmoothmenu li:last-child ul{left:auto !important;right:0 !important}
				.ddsmoothmenu ul li{border-radius:5px}
					.ddsmoothmenu ul li a{line-height:50px;border-radius:5px}
					#smoothmenu1, .ddsmoothmenu ul li a, .ddsmoothmenu ul li ul li a{background-image:url('/admin/img/menu-top-bg.png')}
					.ddsmoothmenu ul li a.selected, .ddsmoothmenu ul li a:hover, .ddsmoothmenu ul li ul li a:hover{background-image:none}
		<?php } ?>
			.slider{height:<?=($additional[23]+30)?>px}
				.slide{height:<?=$additional[23]?>px}
				.production{<?php if($additional[20]==1){ ?>height:20px;<?php } ?>}
				.new-one b, .all-news{color:<?=$additional[20]?>}
				.new-one img{border-color:<?=$additional[20]?>}
			<?php if($additional[59]==0){ ?>
			.l-250, .catalogue, .catalogue ul{overflow:hidden}
				.catalogue ul ul ul li a:hover, .catalogue ul ul ul li a.opnd{border-left:4px solid #ADD8E6;background:#ADD8E6;color:#222907}
							.catalogue ul ul li a{padding:5px 0 5px 30px;font:14px/18px Arial}
								.catalogue ul ul ul li a{padding:5px 0 5px 40px;font:13px/16px Arial}
							.catalogue ul ul li a:hover, .catalogue ul ul li a.opnd{border-left:4px solid #ADD8E6;padding:5px 0 5px 36px;background:#ADD8E6;color:#222907}
			<?php }else{ ?>
			.catalogue ul ul{position:absolute;left:100%;top:0}
				.catalogue li:hover > ul{display:block}
						.catalogue ul li a.top{background-image:url('/admin/img/arr.png');background-repeat:no-repeat;background-position:97% 10px}
						.catalogue ul li a.top:hover{background-image:url('/admin/img/arr.png');background-repeat:no-repeat;background-position:97% -20px}
			<?php } ?>
			.catalogue, .news-left, .soc-all{background-color:<?=$additional[44]?>}
				<?php if($additional[59]==1){ ?>
				.catalogue ul ul{background-color:<?=$additional[44]?>;box-shadow:0 0 1px #555}
				<?php } ?>
				.catalogue .akcii-h2, .news-left .akcii-h2, .soc-all .akcii-h2{color:<?=$additional[21]?>;background:<?=$additional[20]?>}
						.new-one a, .catalogue ul li a{color:<?=$additional[43]?>}
						.catalogue ul li a.opnd{border-left:4px solid <?=$additional[20]?>;background-color:<?=$additional[20]?>;color:<?=$additional[21]?>}
						.catalogue ul li a:hover{border-left:4px solid <?=$additional[22]?>;background-color:<?=$additional[20]?>;color:<?=$additional[21]?>}
							<?php if($additional[59]==0){ ?>
							.catalogue ul ul li a:hover, .catalogue ul ul li a.opnd{border-left:4px solid <?=$additional[22]?>;background:<?=$additional[22]?>;color:#222907}
							.catalogue ul ul ul li a:hover, .catalogue ul ul ul li a.opnd{border-left:4px solid <?=$additional[22]?>;background:<?=$additional[22]?>;color:#222907}
							<?php } ?>
			.pagetext{border:2px solid <?=$additional[68]?>}
			.submit, .nap, .sliderNav a:hover, .sliderNav a.on, .one-click, .sort-by a.sort.act, .sort-by a.sort:hover, .sort-by a.displ.act, .sort-by a.displ:hover, .cart-top i, .head-cart td, .search a{background-color:<?=$additional[26]?>}
			.brands table:hover, .brands table.actb{box-shadow:1px 1px 0 <?=$additional[26]?> inset, -1px -1px 0 <?=$additional[26]?> inset}
			.searchline{border:2px solid <?=$additional[26]?>}
			.price-kol .price, .but-26, .goods li b, .good-price, .cart-table tr td:last-child, .pagetext p.itogo b, .atttn-text, .catalogue > li > a.opnd{color:<?=$additional[26]?> !important}
			.cart-table tr:first-child td:last-child{color:#fff !important}
			<?php if(strlen($additional[38])>0){ ?>.media43{background-image:url('/<?=$additional[38]?>')}<?php } ?>
			<?php if($additional[54]==1){ ?>
			.left-td-2 .te{background-image:url('/admin/img/phn2b.png')}
			.footer *{color:#000 !important}
			<?php } ?>
	</style>

	<?=$additional[6]?>

	<?=$additional[7]?>
