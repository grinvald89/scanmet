<?php /* @var $this AdminController */ ?>
<div class="tableSite cabinet big" ng-init="nameData='goodsApprovedFromSubCategories'"><!-- BEGIN .table.cabinet.big -->
	<table ng-init="getPage(nameData)">
		<tr>
			<th class="number" style="width:30px; border-left: 1px solid #ff6427;">№</th>
			<th style="width:30px;"><input type="checkbox" class="checkbox admin all"></th>
			<th style="width:700px;">Подкатегории</th>
			<th style="width:150px;">Тип</th>
			<th style="width:93px; border-right: 1px solid #ff6427;">Товаров</th>
		</tr>
		<tr ng-repeat="element in x_data">
			<td class="number">{{ $index + 1 + ((selectedPage-1) * 100) }}</td>
			<td style="border:none;"><input type="checkbox" class="checkbox admin"></td>
			<td class="id hide">{{ element.id }}</td>
			<td>{{ element.category }}</td>
			<td ng-bind-html-unsafe="element.ratingCode">{{ element.ratingCode }}</td>
			<td></td>
			<td class="button" style="width:40px;" ng-click="deleteCategory($index)">&#10008;</td>
			<td class="button" style="width:40px;" ng-click="saveTypeSubCategory($index)">&#10003;</td>
		</tr>
	</table>
</div><!-- END .table.cabinet.big -->

<pagination ng-show="countPages"></pagination>

<div>Текущая стараница - {{ selectedPage }}</div>

<div>Текущая форма вывода данных - {{ nameData }}</div>

<div class="buttons admin">
	<div class="button admin group" ng-click="deleteCheckedCategories()">Удалить выбранные</div>
</div>
