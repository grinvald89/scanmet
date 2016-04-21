<div class="bgContent">
	<div class="container">
		<table class="table row" ng-init="getListNews()">
			<tr ng-repeat="post in news">
				<td class="col-md-1 center">{{ $index+1 }}</td>
				<td class="col-md-3"><img src="images/iconProd6.jpg" heigth="200px" width="200px"></td>
				<td class="col-md-6 news header"><h3>{{ post.header }}</h3></td>
				<td class="col-md-2 center">{{ post.date }}</td>
			</tr>
		</table>
	</div>
</div>