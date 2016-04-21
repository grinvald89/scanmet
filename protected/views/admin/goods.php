<?php /* @var $this AdminController */ ?>

<div class="wrap">
	<div class="tableSite cabinet big">
		<table>
			<tr>
				<th style="width:30px; border-left: 1px solid #ff6427;"><input type="checkbox" class="checkbox admin all"></th>
				<th style="width:100px;">Дата</th>
				<th style="width:500px;">Категория</th>
				<th style="width:230px;">Товар</th>
				<th style="width:161px;">Поставщик</th>
				<th style="width:70px; border-right: 1px solid #ff6427;">Заявки</th>
			</tr>
			<tr ng-repeat="element in x_data">
				<td style="border:none;"><input type="checkbox" class="checkbox admin"></td>
				<td class="id hide">{{ element.id }}</td>
				<td>{{ element.date }}</td>
				<td>{{ element.category }}</td>
				<td>{{ element.name }}</td>
				<td>{{ element.company }}</td>
				<td></td>
				<td class="button" style="width:40px;" ng-click="deleteGoods($index)">&#10008;</td>
			</tr>
		</table>
	</div>
	<div class="buttons admin">
		<div class="button admin group" ng-click="deleteCheckedGoods()">Удалить выбранные</div>
	</div>
</div>