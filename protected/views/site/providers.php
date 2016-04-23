<div class="bgContent">
	<div class="manufacturers">
		<div class="header">ПОСТАВЩИКИ</div>

		<div class="providers"><!-- BEGIN .porviders -->
			<?php $i = 0;?>
			<?php foreach ($popularUsers as $user) { ?>
				<div class="item"><!-- BEGIN .item -->
					<div class="rightBlock"><!-- BEGIN .rightBlock -->
						<div class="reviews">
							<div class="header">ОТЗЫВЫ</div>
							<span class="rating hide"><?php echo $user->rating; ?></span>
							<ul class='reviewsBlock'>
								<?php for($j=0; $j < $user->rating; $j++){ ?> <li id="active"></li> <?php } ?>
								<?php for($j=0; $j < (5-$user->rating); $j++){ ?> <li></li> <?php } ?>
							</ul>
						</div>

						<div class="products">
							<div class="header">ПРОДУКЦИЯ:</div>
							<ul class="list">
								<?php if($user->spec1 != '') echo '<li><span>'.$user->spec1.'</span></li>';?>
								<?php if($user->spec2 != '') echo '<li><span>'.$user->spec2.'</span></li>';?>
								<?php if($user->spec3 != '') echo '<li><span>'.$user->spec3.'</span></li>';?>
								<?php if($user->spec4 != '') echo '<li><span>'.$user->spec4.'</span></li>';?>
								<?php if($user->spec5 != '') echo '<li><span>'.$user->spec5.'</span></li>';?>
							</ul>
						</div>
					</div><!-- END .rightBlock -->
					<div class="icon"><img src="/upload/photo/users/<?php echo $user->id;?>.jpg" alt="" width="203px" height="142px"></div>
					<div class="down">
						<div class="name"><?php echo $user->company; ?></div>
						<div class="more" ng-click="modalMoreProvider(<?php echo $user->id;?>)"><a>Подробнее</a></div>
					</div>
				</div><!-- END .item -->
			<?php if(++$i == 6) break; ?>
			<?php } ?>
		<modal-more-provider ng-show="showModalMoreProvider"></modal-more-provider>
		</div><!-- END .porviders -->
	</div>
</div>