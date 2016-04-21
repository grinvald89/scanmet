app.factory('CreateMenuService', function($http){
    var array_menu = [];
    $http.get("/site/list").success(function (data){
        var DATA = data;
        var menu = '';//Вспомогательная строка
        //Записываем категории в строку для отправки на сервер
        for (var i = 0; i < data.length; i++){
            array_menu[i] = data[i].category.split('->');
            menu += '///';
            menu += data[i].category.replace(/->/g, '//');
        };
        menu = menu.slice(3);
        $http.post("/admin/act", {action:'saveMenu', menu:menu})
        .success(function (data){ alert(data) })
        .error(function(data){ alert('Не удалось обновить меню, сервер не отвечает!')});
    })
    .error(function(){ alert('Не удалось загрузить список товаров, сервер не отвечает!')});
})