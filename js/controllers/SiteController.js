app.controller('SiteController',
    function SiteController($scope, $http){
        var id_goods = -1;//Id товара для отзыва
        var current_rating = 0;
        var dataIsLoaded = 0;//Флаг (загругка данных)
        var flagViewProviders = 0;//Флаг для остановки таймера

        function loadDB(){//Получаем данные с сервера
            //dataIsLoaded = 0;
            // $http.get("/site/list").success(function (data) { $scope.x_data = data; })
            // .error(function(){ alert('Не удалось загрузить список товаров, сервер не отвечает!')})
            // .then(function(){
                // $http.get("/site/list_users").success(function (data){ $scope.list_users = data; })
                // .error(function(){ alert('Не удалось загрузить список пользователей, сервер не отвечает!')})
                // .then(function(){
            dataIsLoaded = 1;//Данные загружены
                // });
            // });
        }

        $scope.loadMenu = function(){//Получаем меню с сервера
            $http.post("/site/get", {action:'getMenu'})
            .success(function (data) {
                array_data = data.split('///');
                    for (var i = 0; i < array_data.length; i++) {
                        array_menu[i] = array_data[i].split('//');
                    };
                formMenuUni();
            })
            .error(function(){ alert('Не удалось загрузить меню, сервер не отвечает!')});
        }

        loadDB();
    /////ОТРИСОВКА ГЛАВНОГО МЕНЮ (BEGIN)////////////////////////////////////////////////////////////////////

        //Объявляем переменные
        var array_data = [], array_menu = [], array_menu_uni = [];//Массив данных и меню и массив уникальных меню
        var array_current_category = [];//Текущая категория
        var current_pos_menu = 0;//Текущая позиция в меню
        var count_pos_menu = 0;//Количество элементов в меню

        $scope.filter = "";

        $scope.next = function(index){
            if(array_menu_uni[index].length > current_pos_menu+1){
                array_current_category[current_pos_menu] = array_menu_uni[index][current_pos_menu];
                current_pos_menu++;
                formMenuUni();
                //Показываем ссылку назад
                if(current_pos_menu>0) { var back = angular.element(document.querySelector(".products ul.products li.previous")); back.css("display","block"); }
            } else {
                var str_filter='';
                for (var i = 0; i < array_menu_uni[index].length; i++) {
                     if(i == array_menu_uni[index].length-1) str_filter += array_menu_uni[index][i];
                     else 
                    str_filter += array_menu_uni[index][i] + '->';
                };
                $scope.filter = str_filter;
                //Отсылаем запрос с категорией и получаем список товаров в этой категории
                $http.post("/site/get", {action: 'getData', category:str_filter})
                .success(function (data) { $scope.x_data = data; $scope.tableShow = false; })
                .error(function(){ alert('Не удалось получить данные для выбранной категории, сервер не отвечает!')})
                .then(function(){//Отсылаем запрос с категорией и получаем ответ с нужным типом
                    $http.post("/site/get", {action: 'getType', category:str_filter})
                    .success(function (data) { 
                        alert('Категория: ' + str_filter + '\nТип данных: ' + data.name);
                        setViewTable(data);//Настраиваем таблицу
                        $scope.tableShow = true;//Показываем таблицу
                        $('.content .sliderANDtable .slider').css({'display':'none'});//Скрываем слайдер
                        $scope.x_type = data;//Запоминаем выбранный тип данных
                        events();//ПРОВЕРИТЬ РАБОТУ ФУНКЦИИ!!!!
                })
                    .error(function(){ alert('Не удалось получить тип данных для выбранной категории, сервер не отвечает!')})
                });
            }
        }

        $scope.previous = function(){
            if(current_pos_menu>0) {
                current_pos_menu--;
                formMenuUni();
            }
            //Скрываем ссылку назад
            if(current_pos_menu == 0) { var back = angular.element(document.querySelector(".products ul.products li.previous")); back.css("display","none"); }
        }

        $scope.getListProviders = function(){//Запрашиваем список поставщиков
            $http.get("/site/list_providers").success(function (data){ $scope.providers = data; })
            .error(function(){ alert('Сервер не отвечает!')});
        }

        $scope.getListNews = function(){//Запрашиваем список новостей
            $http.get("/site/list_news").success(function (data){ $scope.news = data; })
            .error(function(){ alert('Сервер не отвечает!')});
        }

        $scope.saveProfile = function(){//Сохраняем профиль
            $http.post("/site/saveProfile", {
                name : $('.data_input.name input').val(),
                email : $('.data_input.email input').val(),
                phone : $('.data_input.phone input').val(),
                company : $('.data_input.company input').val()
            }).success(function (data){ location.reload(true) })
            .error(function(){ alert('Сервер не отвечает!')});
        }

        function formMenuUni(){//Формируем меню для вывода в scope

            count_pos_menu = 0;

            //Перезаписываем меню для scope
            if (current_pos_menu>0)
                for (var i = 0; i < array_menu.length; i++){
                    var flag = false;
                    for (var j = 0; j < current_pos_menu; j++) {
                        if(array_menu[i][j] == array_current_category[j]) flag = true;
                        else flag = false;
                    };
                    if(flag == true){
                        array_menu_uni[count_pos_menu] = array_menu[i];
                        count_pos_menu++;
                    }
                }
            else
                for (var i = 0; i < array_menu.length; i++){
                    array_menu_uni[i] = array_menu[i];
                    count_pos_menu++;
                }

            //Удаляем дубликаты из меню
            if(array_menu.length>1)//Если элементов больше одного
            for (var i = 0; i < count_pos_menu-1; i++) {
                for (var j = i+1; j < count_pos_menu; j++) {
                    if(array_menu_uni[i][current_pos_menu] == array_menu_uni[j][current_pos_menu]){
                        array_menu_uni.splice(j,1);
                        j--;
                        count_pos_menu--;
                    }
                };
            };

            //Отдаем меню в scope
            $scope.count_pos_menu = count_pos_menu;
            $scope.x_menu = [];
            for (var i = 0; i < count_pos_menu; i++) {
                $scope.x_menu[i] = array_menu_uni[i][current_pos_menu];
            };
        }
    /////ОТРИСОВКА ГЛАВНОГО МЕНЮ (ENG)////////////////////////////////////////////////////////////////////

    var timer = setInterval(function(){
        //Выставляем отступы у поставщиков
        $('.manufacturers .providers .item').eq(2).css({'margin-right':'0px'});
        $('.manufacturers .providers .item').eq(5).css({'margin-right':'0px'});
        setRatingProviders();//Выставляем рейтинг поставщиков
        if (dataIsLoaded == 1)//Если данные загружены
            if($scope.list_users.length != 0)//Если поставщики имеются
                if($('.manufacturers .providers .item').length != 0)//Если DOM дерево построилось
                    clearInterval(timer);//Сбрасываем таймер
            else clearInterval(timer);//Сбрасываем таймер если нет поставщиков
    },100);


    /////ПРИВЯЗКА СОБЫТИЙ (BEGIN)////////////////////////////////////////////////////////////////////
    function events(){
        $('.checkbox p').click(function(){//Показываем или скрываем вложеные чекбоксы по клику на родитель
            $(this).parents('.checkbox').attr({'id':'activeCheckbox'});
            if($('#activeCheckbox > .checkbox').css('display') == 'block'){
                $('#activeCheckbox > .checkbox').css({'display':'none'});
                $('#activeCheckbox').removeAttr('id');
            }

            else
                if($('#activeCheckbox > .checkbox').css('display') == 'none'){
                     $('#activeCheckbox > .checkbox').css({'display':'block'});
                     $('#activeCheckbox').removeAttr('id');
                }
        });



        $('.selection .leftBlock .button').click(function(){//Отправка заявки поставщикам

            var str_category = '';//Список выгодных категорий

            //Формиреум список выбранных категорий
            for (var i = 0; i < $(".selection .contentBlock input:checkbox:checked").length; i++){
                $(".selection .contentBlock input:checkbox:checked").eq(i).attr({'id':'activeCheckbox'});
                for (var j = 0; j < $('.checkbox:has(#activeCheckbox)').length; j++) {
                    if( j !=0 ) str_category += '->' + $('.checkbox:has(#activeCheckbox) > p').eq(j).text();
                    else str_category += $('.checkbox:has(#activeCheckbox) > p').eq(j).text();
                };
                if(i != $(".selection .contentBlock input:checkbox:checked").length - 1) str_category += '//';
                $('#activeCheckbox').removeAttr('id');
            };

            var text = $('.selection .content textarea').val();

            //Отправляем выбранные категории на сервер и текст заявки
            $http.post("/site/send_requsts", { list_categories: str_category, text:text })
            .success(function (data) { alert(data); })
            .error(function(){ alert('Не удалось отправить запрос!'); });
        });


    }
    /////ПРИВЯЗКА СОБЫТИЙ (ENG)////////////////////////////////////////////////////////////////////

    function setViewTable(type){
        if (type.goods != 0) $('.sliderANDtable table ._goods').css({'width':type.goods}).fadeIn(0);
            else $('.sliderANDtable table ._goods').css({'display':'none'});
        if (type.steel != 0) $('.sliderANDtable table ._steel').css({'width':type.steel}).fadeIn(0);
            else $('.sliderANDtable table ._steel').css({'display':'none'});
        if (type.coating != 0) $('.sliderANDtable table ._coating').css({'width':type.coating}).fadeIn(0);
            else $('.sliderANDtable table ._coating').css({'display':'none'});
        if (type.extender != 0) $('.sliderANDtable table ._extender').css({'width':type.extender}).fadeIn(0);
            else $('.sliderANDtable table ._extender').css({'display':'none'});
        if (type.extender_thickness != 0) $('.sliderANDtable table ._extender_thickness').css({'width':type.extender_thickness}).fadeIn(0);
            else $('.sliderANDtable table ._extender_thickness').css({'display':'none'});
        if (type.length != 0) $('.sliderANDtable table ._length').css({'width':type.length}).fadeIn(0);
            else $('.sliderANDtable table ._length').css({'display':'none'});
        if (type.capacity != 0) $('.sliderANDtable table ._capacity').css({'width':type.capacity}).fadeIn(0);
            else $('.sliderANDtable table ._capacity').css({'display':'none'});
        if (type.bodyLength != 0) $('.sliderANDtable table ._bodyLength').css({'width':type.bodyLength}).fadeIn(0);
            else $('.sliderANDtable table ._bodyLength').css({'display':'none'});
        if (type.size != 0) $('.sliderANDtable table ._size').css({'width':type.size}).fadeIn(0);
            else $('.sliderANDtable table ._size').css({'display':'none'});
        if (type.company != 0) $('.sliderANDtable table ._company').css({'width':type.company}).fadeIn(0);
            else $('.sliderANDtable table ._company').css({'display':'none'});
        if (type.price != 0) $('.sliderANDtable table ._price').css({'width':type.price}).fadeIn(0);
            else $('.sliderANDtable table ._price').css({'display':'none'});
    }

    $scope.reviewsBlock = function(){//Показываем звездочки при наведении на них
        $('td ul.reviewsBlock li').mouseenter(function(){
            $(this).parents('tr').attr({'id':'active'});//Цепляем к строке таблицы
            current_rating = parseInt($("tr#active td.rating span.rating").text());
            $('tr#active ul.reviewsBlock li').removeAttr('id');//Удаляем все активные звездочки

            var n = 0;

            //Считаем сколько выбрано звездочек
            switch ($(this).attr('class')) {
                case 'i_1':
                   n = 1
                   break
                case 'i_2':
                   n = 2
                   break
                case 'i_3':
                   n = 3
                   break
                case 'i_4':
                   n = 4
                   break
                case 'i_5':
                    n = 5
                    break
               default:
                  n = 0
                  break
            }

            //Рисуем звездочки в строке
            for (var i = 0; i < n; i++) $('tr#active ul.reviewsBlock li').eq(i).attr({'id':'active'});

            id_goods = $('table tr#active td.id').html();

            $('tr#active').removeAttr('id');//Отцепляемся от строки таблицы
        });

        $('td ul.reviewsBlock li').mouseleave(function(){
            $(this).parents('tr').attr({'id':'active'});//Цепляем к строке таблицы
            $("tr#active td.rating span.rating").text(current_rating);
            $('tr#active ul.reviewsBlock li').removeAttr('id');//Удаляем все активные звездочки

            //Рисуем звездочки в строке
            for (var i = 0; i < current_rating; i++) $('tr#active ul.reviewsBlock li').eq(i).attr({'id':'active'});

            $('tr#active').removeAttr('id');//Отцепляемся от строки таблицы
        });


        $('td ul.reviewsBlock li').click(function(){//Сохраняем отзыв по клику
            var n = 0;

            //Считаем сколько выбрано звездочек
            switch ($(this).attr('class')) {
                case 'i_1':
                   n = 1
                   break
                case 'i_2':
                   n = 2
                   break
                case 'i_3':
                   n = 3
                   break
                case 'i_4':
                   n = 4
                   break
                case 'i_5':
                    n = 5
                    break
               default:
                  n = 0
                  break
            }

            //Отправляем данные на сервер
            $http.post("/site/review", { rating: n, id: id_goods })
            .success(function (data) { alert(data); })
            .error(function(){ alert('Не удалось отправить запрос!'); })
            .then(function(){loadDB();});

            throw "stop";
        });
    }
    })