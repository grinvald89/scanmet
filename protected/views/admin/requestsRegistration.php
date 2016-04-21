<?php /* @var $this AdminController */ ?>
<div class="wrap">
	<div class="tableSite cabinet big">
		<table>
			<tr>
				<th style="width:30px; border-left: 1px solid #ff6427;"><input type="checkbox" class="checkbox admin all"></th>
				<th style="width:150px;">Дата</th>
				<th style="width:100px;">Тип</th>
				<th style="width:235px;">Логин</th>
				<th style="width:235px;">Пароль</th>
				<th style="width:230px; border-right: 1px solid #ff6427;">Email</th>
			</tr>
			<tr ng-repeat="element in x_data_users_new">
				<td style="border:none;"><input type="checkbox" class="checkbox admin"></td>
				<td class="id hide">{{ element.id }}</td>
				<td>{{ element.date }}</td>
				<td>{{ element.role }}</td>
				<td>{{ element.login }}</td>
				<td>{{ element.password }}</td>
				<td>{{ element.email }}</td>
				<td class="button" style="width:40px;" ng-click="disallowUser($index)">&#10008;</td>
				<td class="button" style="width:40px;" ng-click="approvedUser($index)">&#10003;</td>
			</tr>
		</table>
	</div>
	<div class="buttons admin">
		<div class="button admin group" ng-click="disallowCheckedUsers()">отклонить выбранные</div>
		<div class="button admin group" ng-click="approvedCheckedUsers()">подтвердить выбранные</div>
	</div>
</div>