app.factory('SaveMenuService', function($http){
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

        function makeMenuRequst(){//Формируем html код с чекбоксами и категориями для заявок
            $("<div class='selection hide'><div class='rightBlock'><div class='contentBlock'></div></div></div>").appendTo("body");
            //Html-код чекбокса
            var str_code = "<label><input type='checkbox' value='1' name='k' style='opacity:0;'><span></span></label>";
            for (var i = 0; i < DATA.length; i++) {
                $('#activeItem').removeAttr('id');
                for (var j = 0; j < array_menu[i].length; j++) {

                    if(i == 2800) alert('aaa');
                    //Запоминаем если мы перешли по #activeItem
                    if($('div').is('#activeItem')) var isActive = true;
                    else var isActive = false;

                    var str = '.checkbox.i' + j;
                    //Если нет элементов на текущем уровне, то создаем один элемент
                    if(!$('div').is(str))//Если элементов на текущем уровне нет вообще, то создаем элемент
                        if(j != 0) $("#activeItem.checkbox.i" + (j-1)).append("<div id='activeItem' class='checkbox i" + j + "'>" + str_code + "<p>" + array_menu[i][j] + "</p></div>");
                        else $(".selection .rightBlock .contentBlock").append("<div id='activeItem' class='checkbox i" + j + "'>" + str_code + "<p>" + array_menu[i][j] + "</p></div>");
                    else
                        if(j != 0){//Ищем и элемент и закрепляемся на нем или создаем его, если не находим (для не первого уровня дерева)
                            var count_obj = $('#activeItem ' + str).length;

                            for (var k = 0; k < count_obj; k++){
                                var flag = false;
                                var pos = -1;
                                var aa = $('#activeItem ' + str + "> p").eq(k).text();
                                if(strCompare(aa, array_menu[i][j])) { flag = true; pos = k; break;}
                            };

                            if(flag == true)
                                 if(j !=0 ) $('#activeItem ' + str).eq(pos).attr({'id':'activeItem'});
                                 else $(str).eq(pos).attr({'id':'activeItem'});
                            else if(j != 0) $('#activeItem').append("<div id='activeItem' class='checkbox i" + j + "'>" + str_code + "<p>" + array_menu[i][j] + "</p></div>");
                                 else $(".selection .rightBlock .contentBlock").append("<div id='activeItem' class='checkbox i" + j + "'>" + str_code + "<p>" + array_menu[i][j] + "</p></div>");
                        }
                        else{//Ищем и элемент и закрепляемся на нем или создаем его, если не находим (для первого уровня дерева)
                            var count_obj = $(str).length;

                            for (var k = 0; k < count_obj; k++){
                                var flag = false;
                                var pos = -1;
                                var aa = $(str + "> p").eq(k).text();
                                if(strCompare(aa, array_menu[i][j])) { flag = true; pos = k; break;}
                            };

                            if(flag == true) $(str).eq(pos).attr({'id':'activeItem'});
                            else if(j != 0) $('#activeItem').append("<div id='activeItem' class='checkbox i" + j + "'>" + str_code + "<p>" + array_menu[i][j] + "</p></div>");
                                else $(".selection .rightBlock .contentBlock").append("<div id='activeItem' class='checkbox i" + j + "'>" + str_code + "<p>" + array_menu[i][j] + "</p></div>");
                        }
                    //Удаляем якорь ветки
                    if(isActive == true) $('#activeItem').removeAttr('id');
                };
            };
            return $(".selection .rightBlock .contentBlock").html();
        }

        function strCompare(str1,str2){
            if(str1.length != str2.length) return false;
            else{
                var flag = true;
                for (var m = 0; m < str1.length; m++) {
                    if(str1[m] != str2[m]) flag = false;
                };
                if(flag == true) return true;
                else false;
            }
        }

        var menuRequests = makeMenuRequst();

        // $http.post("/admin/act", {action:'saveMenuRequests', menuRequests:menuRequests})
        // .success(function (data){ alert(data) })
        // .error(function(data){ alert('Не удалось обновить меню заявок, сервер не отвечает!')});
    })
    .error(function(){ alert('Не удалось загрузить список товаров, сервер не отвечает!')});
})