		<?php if($additional[31]==0){ ?>
		<div class="slider<?php if($additional[28]==1 && $additional[10]==1){ ?> before-menu<?php } ?>">
			<?php
			$slides = mysql_query("SELECT * FROM ".MySQLprefix."_slides ORDER BY id");
			$numbs = '';
			$numb = 0;
			if($slides && mysql_num_rows($slides)>0)
				while($slide = mysql_fetch_assoc($slides)){
					$numb++;
					$numbs .= '<a'.($numb==1?' class="on"':'').'></a>';
					?>
			<div class="slide">
				<img alt="" src="/<?=$slide['logo']; ?>" />
				<div><?=$slide['text']?></div>
			</div>
					<?php
				}
			?>
			<div class="sliderNav">
				<?php echo $numbs; ?>
			</div>
		</div>
		<?php } ?>