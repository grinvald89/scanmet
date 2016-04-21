<?php /* @var $this AdminController */ ?>
<div class="wrap">
	<div class="tableSite cabinet big">
		<table>
			<tr>
				<th style="width:30px; border-left: 1px solid #ff6427;"><input type="checkbox" class="checkbox admin all"></th>
				<th style="width:150px;">Дата</th>
				<th style="width:100px;">Тип</th>
				<th style="width:250px;">Логин</th>
				<th style="width:270px;">Пароль</th>
				<th style="width:280px; border-right: 1px solid #ff6427;">Email</th>
			</tr>
			<tr ng-repeat="element in x_data_users">
				<td style="border:none;"><input type="checkbox" class="checkbox admin"></td>
				<td class="id hide">{{ element.id }}</td>
				<td>{{ element.date }}</td>
				<td>{{ element.role }}</td>
				<td>{{ element.login }}</td>
				<td>{{ element.password }}</td>
				<td>{{ element.email }}</td>
				<td class="button" style="width:40px;" ng-click="deleteUser($index)">&#10008;</td>
			</tr>
		</table>
	</div>
	<div class="buttons admin">
		<div class="button admin group" ng-click="deleteCheckedUsers()">Удалить выбранные</div>
	</div>
</div>