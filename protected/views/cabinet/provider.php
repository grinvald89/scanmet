<?php /* @var $this CabinetController */ ?>

<div class="span3">
	<div class="bodyContent"><!-- BEGIN .bodyContent -->
		<div class="bgContent" ng-controller="SiteController"><!-- BEGIN .bgContent -->
			<div class="wrap"><!-- BEGIN .wrap -->

				<div class="products">
					<!-- <div class="content block"> -->
					<ul class='products'>
						<li class="previous" ng-click="previous()">назад</li>
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
					<div class="sliderANDtable cabinet provider"><!-- BEGIN .sliderANDtable -->

						<?php include_once "menu_provider.php"; ?>

						<div class="table">
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
							<table>
								<tr><!--  class="up_row" -->
									<th>НАИМЕНОВАНИЕ</th>
									<th style="width: 50px;">МАРКА СТАЛИ</th>
									<th style="width: 65px;">ДЛИНА/РАСКРОЙ</th>
									<th>ПОКРЫТИЕ</th>
									<th>НАПОЛНИТЕЛЬ</th>
									<th style="width: 105px;">ТОЛЩИНА НАПОЛНИТЕЛЯ</th>
									<th style="width: 37px;">ЦЕНА</th>
									<th>ПОСТАВЩИК</th>
									<th style="width: 80px;">ОТЗЫВЫ</th>
								</tr>
								<tr ng-repeat="element in x_data|filter: filter">
									<td>{{ element.name }}</td>
									<td>{{ element.steel }}</td>
									<td>{{ element.length }} мм</td>
									<td>{{ element.coating }}</td>
									<td>{{ element.extender }}</td>
									<td>{{ element.extender_thickness }} мм</td>
									<td>{{ element.price }} руб</td>
									<td>{{ element.company }}</td>
									<td><ul class='reviewsBlock'><li class="active"></li><li class="active"></li><li class="active"></li><li class="active"></li><li></li></ul></td>
								</tr>
							</table>
						</div>
					</div><!-- END .sliderANDtable -->
				</div><!-- END .content -->
			</div><!-- END .wrap -->
		</div><!-- END .bgContent -->
	</div><!-- END .bodyContent -->
</div>