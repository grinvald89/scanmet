<?php
class SiteController extends Controller
{
    public $layout = 'site';

    public function actionIndex(){
        if(!Yii::app()->session['user_id']){
            $session = new CHttpSession;
            $session->open();
            $session['login'] = '';
            $session['password'] = '';
            $session['user_id'] = '';
        }

        $advanced = Advanced::model()->findAll();

        if (count($advanced)){//Передаем данные из временной БД для ускорения загрузки сайта
            foreach ($advanced as $key) $id = $key->id;
            $menuRequests = Advanced::model()->findByPk($id)->menuRequests;
            $popularGoods = XData::model()->findAllByAttributes(array('approved'=>1), array('order'=>'rating DESC'));
            $popularUsers = Users::model()->findAllByAttributes(array('approved'=>1), array('order'=>'rating DESC'));
        }

        $this->render('index', array('menuRequests'=>$menuRequests, 'popularGoods'=>$popularGoods, 'popularUsers'=>$popularUsers));
    }

    public function actionAbout(){
        $pages = Pages::model()->findAll();
        foreach ($pages as $key) $text = $key->text;
        $this->render('about', array('text'=>$text));
    }

    public function actionProviders(){ $this->render('providers'); }

    public function actionNews(){ $this->render('news'); }

    public function actionBlacklist(){ $this->render('blacklist'); }

    public function actionHelp(){
        if(Yii::app()->getRequest()->getPost('newTopic')){//Создаем топик
            $model = new HelpTopics;
            $model->header = Yii::app()->getRequest()->getPost('header');
            $text = '';
            foreach (Yii::app()->getRequest()->getPost('HelpTopics') as $str) $text .= $str.'<br>';
            $model->text = $text;
            $model->date = date('Y-m-d H:i:s');
            $model->user_id = Yii::app()->session['user_id'];
            $model->save(false);
        }

        if(Yii::app()->getRequest()->getPost('newComment')){//Создаем комментарий
            $model = new HelpComments;
            $model->topic_id = Yii::app()->getRequest()->getQuery('topic');
            $model->user_id = Yii::app()->session['user_id'];
            $text = '';
            foreach (Yii::app()->getRequest()->getPost('HelpComments') as $str) $text .= $str.'<br>';
            $model->text = $text;
            $model->date = date('Y-m-d H:i:s');
            $model->save(false);
        }

        if(Yii::app()->getRequest()->getQuery('topic')){//Создаем топик
            $id = Yii::app()->getRequest()->getQuery('topic');
            $model = new HelpComments;
            $comments = HelpComments::model()->findAllByAttributes(array('topic_id'=>$id));
            foreach ($comments as $comment) {//Подставляем в объект данные о user'ах для представления
                $comment->user_name = Users::model()->findByAttributes(array('id'=>$comment->user_id))->name;
                $role = Users::model()->findByAttributes(array('id'=>$comment->user_id))->role;
                if($role == 'provider') $comment->user_role = 'Поставшик';
                else if($role == 'user') $comment->user_role = 'Посетитель';
            }
            //Формируем топик (объект) для передачи в представление
            $topic = HelpTopics::model()->findByPk($id);
            $topic->user_name = Users::model()->findByAttributes(array('id'=>$topic->user_id))->name;
            $role = Users::model()->findByAttributes(array('id'=>$topic->user_id))->role;
            if($role == 'provider') $topic->user_role = 'Поставшик';
            else if($role == 'user') $topic->user_role = 'Посетитель';

            $this->render('topic', array('comments'=>$comments, 'topic'=>$topic, 'model'=>$model));
        }
        else{//Если топик не выбран
            $topics = HelpTopics::model()->findAll();
            foreach ($topics as $topic) {//Подставляем в объект данные о user'ах для представления
                $topic->user_name = Users::model()->findByAttributes(array('id'=>$topic->user_id))->name;
                $role = Users::model()->findByAttributes(array('id'=>$topic->user_id))->role;
                if($role == 'provider') $topic->user_role = 'Поставшик';
                else if($role == 'user') $topic->user_role = 'Посетитель';
            }
            $model = new HelpTopics;
            $this->render('help', array('topics'=>$topics, 'model'=>$model));
        }
    }

    public function actionMap(){ $this->render('map'); }

    public function actionReviews(){ $this->render('reviews'); }

    public function actionRegistration(){
        if(Yii::app()->getRequest()->getPost('r_login'))
        {
            $model = new Users;

            $allRows = Users::model()->findAll();

            $isExists = false;

            foreach ($allRows as $row) if($row->login == Yii::app()->getRequest()->getPost('r_login')) $isExists = true;

            if($isExists == false){
                $model->login = Yii::app()->getRequest()->getPost('r_login');
                $model->password = Yii::app()->getRequest()->getPost('r_password');
                $model->email = Yii::app()->getRequest()->getPost('r_mail');
                if(Yii::app()->getRequest()->getPost('r_role') == 'ПОСТАВЩИК') $model->role = 'provider';
                    else $model->role = 'user';

                $model->save(false);

                return $this->redirect('/');
            }
            else {
                $message = 'Такой пользователь уже есть!';
                return $this->redirect('/error', array('message'=>$message));
            }
        }
    }

    public function actionEnter(){
        if(Yii::app()->getRequest()->getPost('e_login'))
        {
            Yii::app()->session['login'] = '';
            Yii::app()->session['password'] = '';
            Yii::app()->session['user_id'] = '';

            $allRows = Users::model()->findAll();
            $userExist = false;

            foreach ($allRows as $row)
                if($row->login == Yii::app()->getRequest()->getPost('e_login'))
                    if($row->password == Yii::app()->getRequest()->getPost('e_password'))
                        if($row->approved == '1'){
                            $userExist = true;
                            $currentUser = $row;
                        }

            if($userExist == true){
                Yii::app()->session['login'] = Yii::app()->getRequest()->getPost('e_login');
                Yii::app()->session['password'] = Yii::app()->getRequest()->getPost('e_password');
                Yii::app()->session['user_id'] = $currentUser->id;
            }

            return $this->redirect('/');
        }
    }

    public function actionExit(){

        Yii::app()->session['login'] = '';
        Yii::app()->session['password'] = '';
        Yii::app()->session['user_id'] = '';

        return $this->redirect('/');
    }

    public function actionGet(){
        $post = json_decode(file_get_contents('php://input'), true);

        if(isset($post['action'])){
            switch ($post['action']){
                case 'getMenu': SiteController::getMenu();
                    break;

                case 'getType': SiteController::getType($post['category']);
                    break;

                case 'getData': SiteController::getData($post['category']);
                    break;

                default:
                    echo "Ошибка, тип действий не определен!";
                    break;
            }
        }
        else echo "Ошибка действие не указано!";
    }

    public function actionSaveProfile(){
        $post = json_decode(file_get_contents('php://input'), true);

        if(isset($post['name']) && isset($post['email']) && isset($post['phone']) && isset($post['company'])){
            Users::model()->updateByPk(Yii::app()->session['user_id'], array(   'name'=>$post['name'],
                                                                                'email'=>$post['email'],
                                                                                'phone'=>$post['phone'],
                                                                                'company'=>$post['company']));

            echo 'Запись обновлена\n';
        }
        echo('user '.Yii::app()->session['user_id']);
    }

    public function getMenu()//Отдаем меню в клиент
    {
        $advanced = Advanced::model()->findAll();
        if(count($advanced) != 0){//Если БД не пустая
            foreach ($advanced as $a) $menu = $a->menu;//Сохраняем меню
            echo $menu;
        }
        else echo "Меню не найдено на сервере или база данных пустая!";
    }

    public function getType($category){//Отсылаем запрос с категорией и получаем ответ с нужным типом
        $type_id = XData::model()->findByAttributes(array('category'=>$category))->type_id;//Получаем id типа выбранной категории
        $type = Types::model()->findByPk($type_id);//Получает параметры для выбранного типа
        echo CJSON::encode($type);
    }

    public function getData($category){//Отсылаем запрос с категорией и получаем список товаров в этой категории
        $data = XData::model()->findAllByAttributes(array('category'=>$category, 'approved'=>1));//Получает список товаров по категории
        //Выставляем названия поставщиков для отправки в представление
        foreach ($data as $element) $element->company = Users::model()->findByPk($element->id_provider)->company;
        //Выставляем html код рейтинга товара для отправки в представление
        foreach ($data as $element){
            switch ($element->rating) {
                case 0:
                    $a = '<span class="rating hide">0</span> <ul class="reviewsBlock"> <li class="i_1"></li> <li class="i_2"></li> <li class="i_3"></li> <li class="i_4"></li> <li class="i_5"></li> </ul>';
                    break;

                case 1:
                    $a = '<span class="rating hide">1</span> <ul class="reviewsBlock"> <li class="i_1" id="active"></li> <li class="i_2"></li> <li class="i_3"></li> <li class="i_4"></li> <li class="i_5"></li> </ul>';
                    break;

                case 2:
                    $a = '<span class="rating hide">2</span> <ul class="reviewsBlock"> <li class="i_1" id="active"></li> <li class="i_2" id="active"></li> <li class="i_3"></li> <li class="i_4"></li> <li class="i_5"></li> </ul>';
                    break;

                case 3:
                    $a = '<span class="rating hide">3</span> <ul class="reviewsBlock"> <li class="i_1" id="active"></li> <li class="i_2" id="active"></li> <li class="i_3" id="active"></li> <li class="i_4"></li> <li class="i_5"></li> </ul>';
                    break;

                case 4:
                    $a = '<span class="rating hide">4</span> <ul class="reviewsBlock"> <li class="i_1" id="active"></li> <li class="i_2" id="active"></li> <li class="i_3" id="active"></li> <li class="i_4" id="active"></li> <li class="i_5"></li> </ul>';
                    break;

                case 5:
                    $a = '<span class="rating hide">5</span> <ul class="reviewsBlock"> <li class="i_1" id="active"></li> <li class="i_2" id="active"></li> <li class="i_3" id="active"></li> <li class="i_4" id="active"></li> <li class="i_5" id="active"></li> </ul>';
                    break;
            }
            $element->ratingCode = $a;
        }
        echo CJSON::encode($data);
    }

    public function actionList(){
        $x_data = XData::model()->findAllByAttributes(array('approved'=>'1'), array('order'=>'rating DESC'));
        echo CJSON::encode($x_data);
    }

    public function actionList_users(){
        $x_users = Users::model()->findAllByAttributes(array('approved'=>'1'), array('order'=>'rating DESC'));
        //Заменим логин и пароль в объекте перед вывдом в представление
        foreach ($x_users as $user) { $user->login = '*'; $user->password = '*'; }
        echo CJSON::encode($x_users);
    }

    public function actionSend_requsts(){//Отправляем заявку
        $post = json_decode(file_get_contents('php://input'), true);

        if(isset($post['list_categories'])){
            if(Yii::app()->session['user_id']){
                echo "Ваша заявка успешно отправлена!";
                SiteController::send_requsts($post['list_categories'],$post['text']);
            }
            else echo "Только авторизованные пользователи могут оставлять заявки!";
        }
        else echo "Сервер не отвечает!";
    }

    public function actionReview(){//Оставляем отзыв
        $post = json_decode(file_get_contents('php://input'), true);

        if(isset($post['rating']) and isset($post['id'])){
             if(Yii::app()->session['user_id']){
                 if(Users::model()->findByPk(Yii::app()->session['user_id'])->role == 'user'){
                     SiteController::save_review($post['rating'], $post['id']);
                 } else echo 'Вы зарегистрированы как поставщик, отзывы могут оставлять только посетители!';
             } else echo "Только авторизованные пользователи могут оставлять отзывы! Зарегиструйтесь как посетитель.";
        } else echo "Сервер не отвечает!";
    }

    //Отправка заявок поставщикам
    public function send_requsts($list_categories,$text){
        $categories = explode("//", $list_categories);
        $providers = '';
        $providers_id = '';
        $bd = XData::model()->findAllByAttributes(array('approved'=>'1'));

        //Ищем поставщиков с подходящими категориями
        foreach ($categories as $key) {
            foreach ($bd as $x) {
                if(strpos($x->category, $key) !== false)//Если строка есть
                    if(strpos($x->category, $key) == 0){//Если вхождение подстроки 0-й элемент
                        $user = Users::model()->findByPk($x->id_provider);
                        if($providers == ''){
                            $providers .= $user->company;
                            $providers_id .= $user->id;
                        }
                        else{
                            $providers .='//';
                            $providers .= $user->company;
                            $providers_id .='//';
                            $providers_id .= $user->id;
                        }
                    }
            }
        }

        $array_providers = explode("//", $providers);
        $array_providers_id = explode("//", $providers_id);
        $array_providers = array_unique($array_providers);
        $array_providers_id = array_unique($array_providers_id);

        //Выводим список поставщиков
        echo "\nСледующим поставщикам:";
        foreach ($array_providers as $key){
            echo "\n".$key;
        }

        $categories = implode("//",$categories);

        //Пишем заявку в базу поставщиков
        foreach ($array_providers_id as $provider_id){
            $model = new ProvidersRequsts;
            $model->categories = $categories;
            $model->id_provider = $provider_id;
            $model->text = $text;
            $model->date = date("Y-m-d");
            $model->id_user = Yii::app()->session['user_id'];
            $model->save(false);
        }

        //Пишем заявку в общую базу
        $array_providers = implode("//",$array_providers);
        $model = new Requsts;

        $model->categories = $categories;
        $model->providers = $array_providers;
        $model->text = $text;
        $model->date = date("Y-m-d");
        $model->user_id = Yii::app()->session['user_id'];
        $model->save(false);
    }

    //Пишем отзыв в БД, пересчитываем рейтинг товара и постащика и обновляем БД для ускорения загрузки сайта
    public function save_review($rating, $id){
        //Ищем старый отзыв, 0 - если его не было
        $old_review = Reviews::model()->findByAttributes(array('user_id'=>Yii::app()->session['user_id'], 'goods_id'=>$id));
        //Если данный пользователь уже оставлял оценку для данного товара, то просто обновляем ее
        if(count($old_review) != 0) {
            Reviews::model()->updateByPk($old_review->id, array('rating'=>$rating));
            echo "Ваш отзыв обновлен на ".$rating."!";
        }
        else {//Иначе создаем новый отзыв
            $model = new Reviews;
            $model->user_id = Yii::app()->session['user_id'];
            $model->goods_id = $id;
            $model->rating = $rating;
            $model->save(false);
            echo "Ваш отзыв успешно добавлен!";
        }

        //Обновляем рейтинг товара в БД
        $all_reviews = Reviews::model()->findAllByAttributes(array('goods_id'=>$id));
        $rating_full = 0;
        foreach ($all_reviews as $element) $rating_full += $element->rating;
        $rating = $rating_full/count($all_reviews);
        XData::model()->updateByPk($id, array('rating'=>$rating));

        //Обновляем рейтинг поставщика
        $provider_id = XData::model()->findByPk($id)->id_provider;
        $provider_goods = XData::model()->findAllByAttributes(array('id_provider'=>$provider_id));
        $rating_full = 0;
        $count_reviews = 0;
        foreach ($provider_goods as $element)
            if($element->rating != 0){//Если рейтинг отзывы есть
                $rating_full += $element->rating;
                $count_reviews++;
            }
        $rating = $rating_full/$count_reviews;
        Users::model()->updateByPk($provider_id, array('rating'=>$rating));
    }

    public function actionList_providers(){//Отсылаем список поставщиков
        $providers = Users::model()->findAllByAttributes(array('approved'=>'1', 'role'=>'provider'));
        foreach ($providers as $provider){//Заменяем логин и пароль пользователей для защиты
            $provider->login = '*';
            $provider->password = '*';
        }
        echo CJSON::encode($providers);
    }

    public function actionList_news(){//Отсылаем список новостей
        $news = News::model()->findAll();
        echo CJSON::encode($news);
    }

    public function actionSSS(){
        $post = json_decode(file_get_contents('php://input'), true);

        if(isset($post['str'])) echo $post['str'];
    }
}




// ALTER TABLE  `pages` ADD  `iiiii` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
// ALTER TABLE  `pages` ADD  `454545` INT NOT NULL ;