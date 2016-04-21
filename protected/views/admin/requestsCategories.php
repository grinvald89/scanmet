<?php /* @var $this AdminController */ ?>
<div class="wrap">
	<div class="tableSite cabinet big">
		<table>
			<tr>
				<th style="width:30px; border-left: 1px solid #ff6427;"><input type="checkbox" class="checkbox admin all"></th>
				<th style="width:100px;">Дата</th>
				<th style="width:644px;">Категория</th>
				<th style="width:194px; border-right: 1px solid #ff6427;">Поставщик</th>
			</tr>
			<tr ng-repeat="element in x_data_new">
				<td style="border:none;"><input type="checkbox" class="checkbox admin"></td>
				<td class="id hide">{{ element.id }}</td>
				<td>{{ element.date }}</td>
				<td>{{ element.category }}</td>
				<td>{{ element.company }}</td>
				<td class="button" style="width:40px;">&#10008;</td>
				<td class="button" style="width:40px;">&#10003;</td>
			</tr>
		</table>
	</div>
	<div class="buttons admin">
		<div class="button admin group">Отклонить выбранные</div>
		<div class="button admin group">Подтвердить выбранные</div>
	</div>
</div>