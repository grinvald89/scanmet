<?php /* @var $this AdminController */ ?>
<div class="tableSite cabinet big" ng-init="nameData='types'">
	<table class="profile type" ng-init="getPage(nameData)">
		<tr>
			<th style="width:30px; border-left: 1px solid #ff6427;">id</th>
			<th>Тип</th>
			<th><div class="rotate">Наим-е</div></th>
			<th><p class="rotate">Компания</p></th>
			<th><p class="rotate">Цена</p></th>
			<th><p class="rotate">Марка стали</p></th>
			<th><p class="rotate">Покрытие</p></th>
			<th><p class="rotate">Наполнитель</p></th>
			<th><p class="rotate">Толщина н-ля</p></th>
			<th><p class="rotate">Длина</p></th>
			<th><p class="rotate">Грузопод-ть</p></th>
			<th><p class="rotate">Длина кузова</p></th>
			<th><p class="rotate">Размер</p></th>
			<th style="width:60px;"><p class="rotate">Отзывы</p></th>
			<th style="width:182px; border-right: 1px solid #ff6427;"><p class="rotate">Размер таблицы</p></th>
		</tr>

		<tr ng-repeat="element in x_data">
			<td id="id">{{element.id}}</td>
			<td class="data_input type name"><input class="type" type="text" value={{element.name}} style="width:155px; text-indent:5px;"></td>
			<td class="data_input type goods"><input class="type" type="text" value={{element.goods}}></td>
			<td class="data_input type company"><input class="type" type="text" value={{element.company}}></td>
			<td class="data_input type price"><input class="type" type="text" value={{element.price}}></td>
			<td class="data_input type steel"><input class="type" type="text" value={{element.steel}}></td>
			<td class="data_input type coating"><input class="type" type="text" value={{element.coating}}></td>
			<td class="data_input type extender"><input class="type" type="text" value={{element.extender}}></td>
			<td class="data_input type extender_thickness"><input class="type" type="text" value={{element.extender_thickness}}></td>
			<td class="data_input type length"><input class="type" type="text" value={{element.length}}></td>
			<td class="data_input type capacity"><input class="type" type="text" value={{element.capacity}}></td>
			<td class="data_input type bodyLength"><input class="type" type="text" value={{element.bodyLength}}></td>
			<td class="data_input type size"><input class="type" type="text" value={{element.size}}></td>
			<td class="data_input type reviews">80</td>
			<td class="sizeTable">пока не считается</td>
		</tr>
	</table>
</div>

<pagination ng-show="countPages"></pagination>

<div>Текущая стараница - {{ selectedPage }}</div>

<div>Текущая форма вывода данных - {{ nameData }}</div>

<div class="buttons admin">
	<div class="button admin group" ng-click="saveTypes()">Применить изменения</div>
	<div class="button admin group" ng-click="addType()">Добавить новый тип товара</div>
</div>