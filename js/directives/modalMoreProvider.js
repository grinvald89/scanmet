app.directive('modalMoreProvider', function(){
  return{
        restrict: 'E',
        scope: false,
        templateUrl: '../components/modalMoreProvider.html',
        controller: function( $scope, $element, $http ){
            $(".sliderProviderGoods").tinycarousel();
            $scope.createSliders = function(){
                //Формируем слайдер для фотографий компании (BEGIN)
                var srcImg = "/upload/photo/users/" + $scope.activeProvider.id;
                //Создаем слайды для всех элементов
                if($scope.activeProvider.img1 != 0) $('.sliderProviderAboutCompany ul.overview').append('<li class="img1"><img src="' + srcImg + '_1.jpg' + '" alt="" width="200px" heigth="150px"/></li>');
                if($scope.activeProvider.img2 != 0) $('.sliderProviderAboutCompany ul.overview').append('<li class="img2"><img src="' + srcImg + '_2.jpg' + '" alt="" width="200px" heigth="150px"/></li>');
                if($scope.activeProvider.img3 != 0) $('.sliderProviderAboutCompany ul.overview').append('<li class="img3"><img src="' + srcImg + '_3.jpg' + '" alt="" width="200px" heigth="150px"/></li>');
                if($scope.activeProvider.img4 != 0) $('.sliderProviderAboutCompany ul.overview').append('<li class="img4"><img src="' + srcImg + '_4.jpg' + '" alt="" width="200px" heigth="150px"/></li>');
                if($scope.activeProvider.img5 != 0) $('.sliderProviderAboutCompany ul.overview').append('<li class="img5"><img src="' + srcImg + '_5.jpg' + '" alt="" width="200px" heigth="150px"/></li>');
                //Запускаем слайдер
                $(".sliderProviderAboutCompany").tinycarousel();
                //Формируем слайдер для фотографий компании (END)
            }
        }
    }
})