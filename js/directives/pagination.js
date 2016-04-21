app.directive('pagination', function(){
  return{
        restrict: 'E',
        scope: false,
        templateUrl: '../components/pagination.html',
        controller: function( $scope, $element, $http ){
        	//if(!$scope.currentPage) $scope.currentPage = 1;//Если текущая страница не выбрана, ставим первую
        	$scope.getCountPages = function(nameData){
        	    $http.post("/admin/advAct", {action:'getCountPages', nameData:nameData + 'All'})
        	    .success(function (data){ $scope.countPages = parseInt(data); })
        	    .error(function(){ alert('Нет доступа к базе данных!')})
        	    .then(function(){
        	        for (var i = $scope.countPages; i >0 ; i--)
        	        	angular.element(document.querySelector("pagination li.prev")).after('<li><a>' + i + '</a></li>');

        	        $('pagination li').click(function(){//Привязываем событие клик по номеру страницы
        	        		$(this).attr({'id':'active'});
        	        		var selectedPage = parseInt($('li#active > a').html());
        	        		$('li#active').removeAttr('id');
        	        		$scope.$apply(function(){
        	        			$scope.selectedPage = selectedPage;
        	        		});
        	        		$scope.getPage($scope.nameData);
        	        });
        	    });
        	}
        }
    }
})