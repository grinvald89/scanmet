<div class="bgContent">
	<div class="container">
			<table class="row table table-bordered table-hover" ng-init="getListProviders()">
				<tr class="success">
					<th class="col-md-1">№</th>
					<th class="col-md-5">Компания</th>
					<th class="col-md-2">Рейтинг</th>
					<th class="col-md-2">Телефон</th>
					<th class="col-md-2">E-mail</th>
				</tr>
				<tr data-ng-repeat="provider in providers">
					<td>{{ $index+1 }}</td>
					<td>{{ provider.company }}</td>
					<td>{{ provider.rating }}</td>
					<td>{{ provider.phone }}</td>
					<td>{{ provider.email }}</td>
				</tr>
			</table>
	</div>
</div>