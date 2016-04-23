	<div class="bodyContent"><!-- BEGIN .bodyContent -->
		<div class="bgContent"><!-- BEGIN .bgContent -->
			<div class="wrap"><!-- BEGIN .wrap -->
				<div class="products">
					<!-- <div class="content block"> -->
					<ul class='products' ng-init="loadMenu()">
						<li class="previous" ng-click="previous()"><span>назад</span></li>
						<li class='nav' ng-repeat="element in x_menu|limitTo:count_pos_menu">
							<span ng-click="next($index)">{{element}}</span>
						</li>
					</ul>

					<ul class="submenu">
						<li class="back"><a href="#">назад</a></li>
						<li><a href="#">Какой-то тектст</a></li>
						<li><a href="#">Какой-то тектст</a></li>
						<li><a href="#">Какой-то тектст</a></li>
						<li><a href="#">Какой-то тектст</a></li>
					</ul>
					<!-- </div> -->
				</div>

				<div class="content"><!-- BEGIN .content -->
					<div class="sliderANDtable"><!-- BEGIN .sliderANDtable -->
						<div class="slider"><!-- BEGIN .slider -->
							<a class="buttons prev" href="#"></a>
							<div class="viewport">
								<ul class="overview">
									<li><img src="images/slide_1.jpg" /></li>
									<li><img src="images/slide_1.jpg" /></li>
									<li><img src="images/slide_1.jpg" /></li>
									<li><img src="images/slide_1.jpg" /></li>
									<li><img src="images/slide_1.jpg" /></li>
								</ul>
							</div>
							<a class="buttons next" href="#"></a>

							<ul class="bullets">
								<li><a href="#" class="bullet active" data-slide="0"></a></li>
								<li><a href="#" class="bullet" data-slide="1"></a></li>
								<li><a href="#" class="bullet" data-slide="2"></a></li>
								<li><a href="#" class="bullet" data-slide="3"></a></li>
								<li><a href="#" class="bullet" data-slide="4"></a></li>
							</ul>
						</div><!-- END .slider -->

						<div class="tableSite" ng-show="tableShow">
							<div class="content">
								<ul class="header">
									<li><a href="#">Все</a></li>
									<li><a href="#">25</a></li>
									<li><a href="#">35</a></li>
									<li><a href="#">А400</a></li>
									<li><a href="#">В500</a></li>
									<li><a href="#">Все</a></li>
									<li><a href="#">Бухты</a></li>
									<li><a href="#">м/д</a></li>
									<li><a href="#">н/д</a></li>
								</ul>
							</div>
							<table ng-mouseenter="reviewsBlock()">
								<tr><!--  class="up_row" -->
									<th class="_goods">НАИМЕНОВАНИЕ</th>
									<th class="_steel">МАРКА СТАЛИ</th>
									<th class="_coating">ПОКРЫТИЕ</th>
									<th class="_extender">НАПОЛНИТЕЛЬ</th>
									<th class="_extender_thickness">ТОЛЩИНА НАПОЛНИТЕЛЯ</th>
									<th class="_length">ДЛИНА/РАСКРОЙ</th>
									<th class="_capacity">ГРУЗОПОДЪЕМНОСТЬ</th>
									<th class="_bodyLength">ДЛИНА КУЗОВА</th>
									<th class="_size">РАЗМЕР</th>
									<th class="_company">ПОСТАВЩИК</th>
									<th class="_price">ЦЕНА</th>
									<th style="width: 80px;">ОТЗЫВЫ</th>
								</tr>
								<tr ng-repeat="element in x_data|filter: filter">
									<td class="id hide">{{ element.id }}</td>
									<td class="_goods">{{ element.name }}</td>
									<td class="_steel">{{ element.steel }}</td>
									<td class="_coating">{{ element.coating }}</td>
									<td class="_extender">{{ element.extender }}</td>
									<td class="_extender_thickness">{{ element.extender_thickness }} мм</td>
									<td class="_length">{{ element.length }} мм</td>
									<td class="_capacity">{{ element.capacity }}</td>
									<td class="_bodyLength">{{ element.bodyLength }}</td>
									<td class="_size">{{ element.size }}</td>
									<td class="_company">{{ element.company }}</td>
									<td class="_price">{{ element.price }} руб</td>
									<td class="rating" ng-bind-html-unsafe="element.ratingCode">{{ element.ratingCode }}</td>
								</tr>
							</table>
						</div>
					</div><!-- END .sliderANDtable -->



					<div class="selection"><!-- BEGIN .selection -->
						<div class="header">ВЫСЛАТЬ ЗАКАЗ ПОСТАВЩИКАМ</div>
						<div class="content">
							<p>Поля со звездочкой (*) обязательны для заполнения</p>
							<div class="leftForm"><!-- BEGIN .leftForm -->
								<div class="leftBlock"><!-- BEGIN .leftBlock -->
									<input type="text" placeholder='Имя *'>
									<input type="text" placeholder='Телефон *'>
									<input type="text" placeholder='Email *'>
									<input type="text" placeholder='Компания *'>

									<div class="downloadForm">
										<div class="text">Прикрепить реквизиты</div>
										<div class="button">Отправить</div>
									</div>
								</div><!-- END .leftBlock -->
								<div class="rightBlock"><!-- BEGIN .rightBlock -->
									<div class="header">Выбор поставщиков</div>
									<div class="contentBlock"><!-- BEGIN .contentBlock -->
										<?php //echo $menuRequests;?>
										<checkboxes></checkboxes>
									</div><!-- END .contentBlock -->
								</div><!-- END .rightBlock -->
							</div><!-- END .leftForm -->

							<textarea placeholder='Заявка'></textarea>
						</div>
					</div><!-- END .selection -->
				</div><!-- END .content -->

				<div class="popular"><!-- BEGIN .popular -->
					<div class="header">ПОПУЛЯРНЫЕ ПОЗИЦИИ</div>
					<?php $i = 0;?>
					<?php foreach ($popularGoods as $goods){ ?>
						<div class="item">
							<img src="" alt="" width="370px" height="258px">
							<div class="name"><?php echo $goods->name;?> <span>от <span class='price'><?php echo $goods->price;?></span> руб.</span></div>
							<div class="more"><a href="#">Подробнее</a></div>
						</div>
						<?php if(++$i == 6) break;?>
					<?php }?>
				</div><!-- END .popular -->

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

					<div class="item block"><!-- BEGIN .item -->
						<div class="header">КАРТА МЕТАЛЛОБАЗ</div>
						<div class="overlay"></div>
						<div class="icon"><img src="images/map.jpg" alt=""></div>
						<div class="more"><a href="#">Подробнее</a></div>
					</div><!-- END .item -->

					<div class="item block"><!-- BEGIN .item -->
						<div class="header">НОВОСТИ</div>
						<div class="overlay"></div>
						<div class="icon"><img src="images/news.jpg" alt=""></div>
						<div class="more"><a href="#">Подробнее</a></div>
					</div><!-- END .item -->

					<div class="item block" style="margin-right:0px;"><!-- BEGIN .item -->
						<div class="header">ПОМОЩЬ</div>
						<div class="overlay"></div>
						<div class="icon"><img src="images/help.jpg" alt=""></div>
						<div class="more"><a href="#">Подробнее</a></div>
					</div><!-- END .item -->
				</div>
			</div><!-- END .wrap -->
		</div><!-- END .bgContent -->
	</div><!-- END .bodyContent -->

	<div class="popup">
		<div class="overlay"></div>
		<form method="POST" class="enter" action="/site/enter">
			<div class="header enter">ВХОД</div>
			<p>Логин:</p>
			<input type="text" name='e_login'>
			<p>Пароль:</p>
			<input type="password" name='e_password'>
			<input type="submit" class='butSend' value='ОТПРАВИТЬ'>
		</form>

		<form method="POST" class="reg" action="/site/registration">
			<div class="header enter">ВХОД</div>
			<div class="header reg">РЕГИСТРАЦИЯ</div>
			<div class="selectRang">
				<div class="active">ПОСЕТИТЕЛЬ</div>
				<div>ПОСТАВЩИК</div>
				<input type="text" name='r_role' value="ПОСЕТИТЕЛЬ" style="display:none;">
			</div>
			<p>(*) Логин:</p>
			<input type="text" name='r_login'>
			<div class="email">
				<p>(*) Введите e-mail</p>
				<input type="text" name='r_mail'>
			</div>
			<p>(*) Пароль:</p>
			<input type="password" name='r_password'>
			<div class="confirm">
				<p>(*) Подтвердите пароль:</p>
				<input type="password" name='r_password'>
			</div>
			<input type="submit" class='butSend' value='ОТПРАВИТЬ'>
		</form>
	</div>