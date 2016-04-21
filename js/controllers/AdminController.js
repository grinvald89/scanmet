app.controller('AdminController',
    function AdminController($scope, $http){

        if(!$scope.currentPage) $scope.selectedPage = 1;//Если текущая страница не выбрана, ставим первую

        //   Ajax-ЗАПРОСЫ НА ЗАГРУЗКУ ДАННЫЙ (BEGIN)
        $scope.getPage = function(nameData){//Грузим основную базу без элементов не прошедших модерацию
            $http.post("/admin/getPage", {nameData:nameData, selectedPage:$scope.selectedPage})
            .success(function (data){ $scope.x_data = data; })
            .error(function(){ alert('Нет доступа к базе данных!')});
        }

        function loadListNew(){//Грузим основную базу новых элементов
            $http.get("/admin/list_new").success(function (data){ $scope.x_data_new = data; setTimeout(function(){getCompaniesNew();},300); })
            .error(function(){ alert('Нет доступа к базе данных товаров!')});
        }

        function loadListUsers(){//Грузим базу пользователей, прошедших модерацию
            $http.get("/admin/list_users").success(function (data){ $scope.x_data_users = data; })
            .error(function(){ alert('Нет доступа к базе данных пользователей!')});
        }

        function loadListUsersNew(){//Грузим базу новых пользователей
            $http.get("/admin/list_users_new").success(function (data){ $scope.x_data_users_new = data; })
            .error(function(){ alert('Нет доступа к базе данных пользователей!')});
        }

        function listRequsts(){//Грузим базу заявок
            $http.get("/admin/list_requsts").success(function (data){ $scope.x_data_requsts = data; })
            .error(function(){ alert('Нет доступа к базе данных заявок!')});
        }

        function listNews(){//Грузим базу новостей
            $http.get("/admin/list_news").success(function (data){ $scope.x_data_news = data; })
            .error(function(){ alert('Нет доступа к базе данных новостей!')});
        }
        //   Ajax-ЗАПРОСЫ НА ЗАГРУЗКУ ДАННЫЙ (END)


        //   КНОПКИ (BEGIN)
        $scope.deleteCategory = function(index){
                var id = parseInt($('tr td.id').eq(index).text());//Получаем id из таблицы
                $http.post("/admin/act", {action: 'deleteCategory', id:id})
                .success(function (data) { alert(data); loadList(); })
                .error(function(){ alert('Не возможно удалить категорию, сервер не отвечает!')});
        }

        $scope.saveTypeSubCategory = function(index){
                var id = parseInt($('tr td.id').eq(index).text());//Получаем id из таблицы
                var type = $('select.type').eq(index).val();
                $http.post("/admin/act", {action:'saveType', typeSave:'subCategory', id:id, type:type})
                .success(function (data) { alert(data); loadList(); })
                .error(function(){ alert('Не возможно установить тип, сервер не отвечает!')});
        }

        $scope.saveTypeCategory = function(index){
                var id = parseInt($('tr td.id').eq(index).text());//Получаем id из таблицы
                var type = $('select.type').eq(index).val();
                $http.post("/admin/act", {action:'saveType', typeSave:'category', id:id, type:type})
                .success(function (data) { alert(data); loadList(); })
                .error(function(){ alert('Не возможно установить тип, сервер не отвечает!')});
        }

        $scope.deleteCheckedCategories = function(){
                var ids = getIdStr();//Получаем id из таблицы
                $http.post("/admin/act", {action: 'deleteCheckedCategories', ids:ids})
                .success(function (data) { alert(data); loadList(); })
                .error(function(){ alert('Не возможно удалить категории, сервер не отвечает!')});
        }

        $scope.deleteGoods = function(index){
                var id = parseInt($('tr td.id').eq(index).text());//Получаем id из таблицы
                $http.post("/admin/act", {action: 'deleteGoods', id:id})
                .success(function (data) { alert(data); loadList(); })
                .error(function(){ alert('Не возможно удалить товар, сервер не отвечает!')});
        }

        $scope.deleteCheckedGoods = function(){
                var ids = getIdStr();//Получаем id из таблицы
                $http.post("/admin/act", {action: 'deleteCheckedGoods', ids:ids})
                .success(function (data) { alert(data); loadList(); })
                .error(function(){ alert('Не возможно удалить товары, сервер не отвечает!')});
        }

        $scope.deleteUser = function(index){
                var id = parseInt($('tr td.id').eq(index).text());//Получаем id из таблицы
                $http.post("/admin/act", {action: 'deleteUser', id:id})
                .success(function (data) { alert(data); loadListUsers(); })
                .error(function(){ alert('Не возможно удалить товар, сервер не отвечает!')});
        }

        $scope.deleteCheckedUsers = function(){
                var ids = getIdStr();//Получаем id из таблицы
                $http.post("/admin/act", {action: 'deleteCheckedUsers', ids:ids})
                .success(function (data) { alert(data); loadListUsers(); })
                .error(function(){ alert('Не возможно удалить пользователей, сервер не отвечает!')});
        }

        $scope.disallowGoods = function(index){
                var id = parseInt($('tr td.id').eq(index).text());//Получаем id из таблицы
                $http.post("/admin/act", {action: 'disallowGoods', id:id})
                .success(function (data) { alert(data); loadListNew(); })
                .error(function(){ alert('Не возможно удалить заявку на добавление товара, сервер не отвечает!')});
        }

        $scope.disallowCheckedGoods = function(){
                var ids = getIdStr();//Получаем id из таблицы
                $http.post("/admin/act", {action: 'disallowCheckedGoods', ids:ids})
                .success(function (data) { alert(data); loadListNew(); })
                .error(function(){ alert('Не возможно откланить заявки на товары, сервер не отвечает!')});
        }

        $scope.approvedGoods = function(index){
                var id = parseInt($('tr td.id').eq(index).text());//Получаем id из таблицы
                $http.post("/admin/act", {action: 'approvedGoods', id:id})
                .success(function (data) { alert(data); loadListNew(); })
                .error(function(){ alert('Не возможно подтвердить заявку на добавление товара, сервер не отвечает!')});
        }

        $scope.approvedCheckedGoods = function(){
                var ids = getIdStr();//Получаем id из таблицы
                $http.post("/admin/act", {action: 'approvedCheckedGoods', ids:ids})
                .success(function (data) { alert(data); loadListNew(); })
                .error(function(){ alert('Не возможно подтвердить заявки на товары, сервер не отвечает!')});
        }


        $scope.disallowUser = function(index){
                var id = parseInt($('tr td.id').eq(index).text());//Получаем id из таблицы
                $http.post("/admin/act", {action: 'disallowUser', id:id})
                .success(function (data) { alert(data); loadListUsersNew(); })
                .error(function(){ alert('Не возможно удалить заявку на добавление пользователя, сервер не отвечает!')});
        }

        $scope.disallowCheckedUsers = function(){
                var ids = getIdStr();//Получаем id из таблицы
                $http.post("/admin/act", {action: 'disallowCheckedUsers', ids:ids})
                .success(function (data) { alert(data); loadListUsersNew(); })
                .error(function(){ alert('Не возможно откланить заявки на добавление пользователей, сервер не отвечает!')});
        }


        $scope.approvedUser = function(index){
                var id = parseInt($('tr td.id').eq(index).text());//Получаем id из таблицы
                $http.post("/admin/act", {action: 'approvedUser', id:id})
                .success(function (data) { alert(data); loadListUsersNew(); })
                .error(function(){ alert('Не возможно подтвердить заявку на добавление пользователя, сервер не отвечает!')});
        }

        $scope.approvedCheckedUsers = function(){
                var ids = getIdStr();//Получаем id из таблицы
                $http.post("/admin/act", {action: 'approvedCheckedUsers', ids:ids})
                .success(function (data) { alert(data); loadListUsersNew(); })
                .error(function(){ alert('Не возможно подтвердить заявки на регистрацию, сервер не отвечает!')});
        }


        $scope.saveAbout = function(){
                var text = $('textarea#about').val();
                $http.post("/admin/act", {action: 'saveAbout', text:text})
                .success(function (data) {alert(data)})
                .error(function(){ alert('Не возможно сохранить изменения, сервер не отвечает!')});
        }

        $scope.saveTypes = function(){
                var countRow = $('table.type tr').length-1;
                for (var i = 1; i < countRow+1; i++) {//Обновляем данные из таблицы
                    $('table.type tr').eq(i).attr({'id':'active'});//Цепляемся к строке таблицы
                    $scope.x_data[i-1].id = parseInt($('table.type tr#active td#id').text());
                    $scope.x_data[i-1].name = $('table.type tr#active td.name input').val();
                    $scope.x_data[i-1].steel = parseInt($('table.type tr#active td.steel input').val());
                    $scope.x_data[i-1].coating = parseInt($('table.type tr#active td.coating input').val());
                    $scope.x_data[i-1].extender = parseInt($('table.type tr#active td.extender input').val());
                    $scope.x_data[i-1].extender_thickness = parseInt($('table.type tr#active td.extender_thickness input').val());
                    $scope.x_data[i-1].length = parseInt($('table.type tr#active td.length input').val());
                    $scope.x_data[i-1].capacity = parseInt($('table.type tr#active td.capacity input').val());
                    $scope.x_data[i-1].size = parseInt($('table.type tr#active td.size input').val());
                    $scope.x_data[i-1].goods = parseInt($('table.type tr#active td.goods input').val());
                    $scope.x_data[i-1].company = parseInt($('table.type tr#active td.company input').val());
                    $scope.x_data[i-1].price = parseInt($('table.type tr#active td.price input').val());
                    $scope.x_data[i-1].bodyLength = parseInt($('table.type tr#active td.bodyLength input').val());
                    $('tr#active').removeAttr('id');//Отцепляемся от строки таблицы
                };

                var x_types = '';
                for (var i = 0; i < $scope.x_data.length; i++) {//Пишем объект в строку для отправки на сервер
                    x_types += '///';//Разделитель строк
                    x_types += $scope.x_data[i].id + '//';
                    x_types += $scope.x_data[i].name + '//';
                    x_types += $scope.x_data[i].steel + '//';
                    x_types += $scope.x_data[i].coating + '//';
                    x_types += $scope.x_data[i].extender + '//';
                    x_types += $scope.x_data[i].extender_thickness + '//';
                    x_types += $scope.x_data[i].length + '//';
                    x_types += $scope.x_data[i].capacity + '//';
                    x_types += $scope.x_data[i].size + '//';
                    x_types += $scope.x_data[i].goods + '//';
                    x_types += $scope.x_data[i].company + '//';
                    x_types += $scope.x_data[i].price + '//';
                    x_types += $scope.x_data[i].bodyLength;
                };
                x_types = x_types.substring(3);//Удаляем первый разделитель для explode

                $http.post("/admin/act", {action: 'saveTypes', types:x_types})
                .success(function (data) {alert(data)})
                .error(function(){ alert('Не возможно сохранить изменения, сервер не отвечает!')});
        }

        $scope.addType = function(){
                $http.post("/admin/act", {action: 'addType'})
                .success(function (data) {alert(data); loadData();})
                .error(function(){ alert('Не возможно добавить новый тип товара, сервер не отвечает!')});
        }

        $scope.createMenu = function(){
                var timeStart = Date.now();

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
                .error(function(){ alert('Не удалось загрузить список товаров, сервер не отвечает!')})
                .then(function(){
                    var timeEnd = Date.now();
                    var res = timeEnd - timeStart;
                    alert("Скрипт выполнялся <"+ res/1000 +"> sec.")
                });
        }
        //   КНОПКИ (END)

        function getIdStr(){//Возвращает строку-массив идентификаторов, для выбранных элементов (чекбоксов)
            var ids = '';
            for (var i = 1; i < $('input.checkbox').length; i++)//Проходим по всем чекбоксам, кроме общего
                if($('input.checkbox').eq(i).is(':checked'))//Если чекбокс выбран
                    ids += ',' + $('tr td.id').eq(i-1).text();//Пишем id в строку

            ids = ids.substring(1);//Удаляем первый разделитель для explode
            return ids;
        }

        function events(){
            $('input.checkbox.all').change(function(){
                if($('input.checkbox.all').prop("checked")) $('input.checkbox').prop({"checked":"checked"});
                else $('input.checkbox').attr("checked",false);
            });
        }
    }
)
