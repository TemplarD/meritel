		<div class="wide">
			<?php include('_left.php'); ?>
			<div class="r-740<?php if($additional[29]==1){ ?> w-1024<?php } ?>">
				<div class="tree"><a href="/">Главная</a>/<a href="/<?=$urls[0]?>/"><?=$seo['menu']?></a></div>
				<div class="pagetext">
					<h1><?=$seo["h1"]?></h1>
					<?=$seo["text"]?>
					<form method="post" class="prcceed-form">
						<div class="fl-ll">
							<label>Ф.И.О.*:</label>
							<input class="text" type="text" name="name" />
						</div>
						<div class="fl-ll">
							<label>Контактный телефон*:</label>
							<input class="text" type="text" name="contacts" />
						</div>
						<div class="fl-ll">
							<label>E-mail*:</label>
							<input class="text" type="text" name="email" />
						</div>
						<div class="fl-ll">
							<label>Самовывоз:</label>
							<span class="ckeck"><input type="checkbox" name="self-shiping" value="1" /> Отметьте если хотите самостоятельно забрать товар с нашего склада.</span>
						</div>
						<div class="fl-ll">
							<label>Адрес доставки:</label>
							<textarea class="text" name="address"></textarea>
						</div>
						<div class="fl-ll">
							<label>Комментарии:</label>
							<textarea class="text" name="text"></textarea>
						</div>
						<div class="star-text">* Поля обязательные для заполнения</div>
						<div class="atttn-text">Пожалуйста, еще раз внимательно проверьте заполненные поля</div>
						<input type="hidden" name="robo" value="no" />
					</form>
					<a class="send-order but-40 blu" style="float:right;margin-right:20px" rel="Перейти к оплате" rel2="Завершить оформление">Завершить оформление</a>
					<?php if($additional[55]==1){ ?><label style="float:left;margin:15px 0 0 0" class="robo"><input type="checkbox" style="vertical-align:-1px"> <b style="font-size:110%">Оплатить онлайн с помощью</b> <img style="vertical-align:-2px" src="/admin/img/robo.png" /></label><?php } ?>
				</div>
			</div>
		</div>