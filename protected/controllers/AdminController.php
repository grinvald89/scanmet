<?php

class AdminController extends Controller
{
	public $layout = 'admin';

	public function countRowsOnPage(){ $countRowsOnPage = 100; return $countRowsOnPage; }//Количество записей на странице

	/////////////////////////////////////////////////////////// Actions (BEGIN)

	public function actionIndex(){ $this->redirect('admin/categories'); }

	public function actionTypes(){
		$types = Types::model()->findAll();
		$this->render('types', array('types'=>$types));
	}

	public function actionCategories(){ $this->render('categories'); }

	public function actionSubCategories(){ $this->render('subCategories'); }

	public function actionGoods(){ $this->render('goods'); }

	public function actionUsers(){ $this->render('users'); }

	public function actionRequestsCategories(){ $this->render('requestsCategories'); }

	public function actionRequestsGoods(){ $this->render('requestsGoods'); }

	public function actionRequestsRegistration(){ $this->render('requestsRegistration'); }

	public function actionNews(){ $this->render('news'); }

	public function actionHelp(){ $this->render('help'); }

	public function actionAbout(){ 
		$pages = Pages::model()->findAll();
		foreach ($pages as $key) $text = $key->text;
		$this->render('about', array('text'=>$text)); }

	/////////////////////////////////////////////////////////// Actions (END)



/////////////////////////////////////////////////////////// Ajax-ответы JSON (BEGIN)

	public function actionGetPage(){
		$post = json_decode(file_get_contents('php://input'), true);
		if(isset($post['nameData']) && isset($post['selectedPage']))
			echo CJSON::encode(AdminController::getDataOnName($post['nameData'], $post['selectedPage']));
	}

	public function actionList_new(){
		$x_data = XData::model()->findAllByAttributes(array('approved'=>'0'));
		echo CJSON::encode($x_data);
	}

	public function actionList_users(){
	    $x_data = Users::model()->findAllByAttributes(array('approved'=>'1'));
	    echo CJSON::encode($x_data);
	}

	public function actionList_users_new(){
	    $x_data = Users::model()->findAllByAttributes(array('approved'=>'0'));
	    echo CJSON::encode($x_data);
	}

	public function actionList_news(){
	    $x_data = Users::model()->findAll();
	    echo CJSON::encode($x_data);
	}

	public function actionList_requsts(){
	    $x_data = Requsts::model()->findAll();
	    echo CJSON::encode($x_data);
	}

	public function actionList_types(){
	    $x_data = Types::model()->findAll();
	    echo CJSON::encode($x_data);
	}

	/////////////////////////////////////////////////////////// Ajax-ответы JSON (END)



	/////////////////////////////////////////////////////////// Обработка функций админки (BEGIN)

	public function actionAct(){
		$post = json_decode(file_get_contents('php://input'), true);

		if(isset($post['action'])){
			switch ($post['action']){
				case 'deleteCategory': AdminController::deleteCategory($post['id'], true);
					break;
				case 'saveType': AdminController::saveType($post['typeSave'], $post['id'], $post['type']);
					break;
				case 'deleteCheckedCategories': AdminController::deleteCheckedCategories($post['ids']);
					break;

				case 'deleteGoods': AdminController::deleteGoods($post['id'], true);
					break;
				case 'deleteCheckedGoods': AdminController::deleteCheckedGoods($post['ids']);
					break;

				case 'deleteUser': AdminController::deleteUser($post['id'], true);
					break;
				case 'deleteCheckedUsers': AdminController::deleteCheckedUsers($post['ids']);
					break;

				case 'disallowGoods': AdminController::disallowGoods($post['id'], true);
					break;
				case 'disallowCheckedGoods': AdminController::disallowCheckedGoods($post['ids']);
					break;

				case 'approvedGoods': AdminController::approvedGoods($post['id'], true);
					break;
				case 'approvedCheckedGoods': AdminController::approvedCheckedGoods($post['ids']);
					break;

				case 'disallowUser': AdminController::disallowUser($post['id'], true);
					break;
				case 'disallowCheckedUsers': AdminController::disallowCheckedUsers($post['ids']);
					break;

				case 'approvedUser': AdminController::approvedUser($post['id'], true);
					break;
				case 'approvedCheckedUsers': AdminController::approvedCheckedUsers($post['ids']);
					break;

				case 'saveAbout': AdminController::saveAbout($post['text']);
					break;

				case 'saveTypes': AdminController::saveTypes($post['types']);
					break;
				case 'addType': AdminController::addType();
					break;

				case 'saveMenu': AdminController::saveMenu($post['menu']);
					break;

				case 'saveMenuRequests': AdminController::saveMenuRequests($post['menuRequests']);
					break;

				default:
					echo "Ошибка, тип действия не определен!";
				break;
			}
		}
		else echo "Ошибка действие не указано!";
	}

	public function deleteCategory($id, $one){//Удаляем категорию по id
	    if($id){
	    	//Получаем категорию
	    	$category = XData::model()->findByPk($id)->category;
	    	//Записываем все товары с подходящей категории в массив
	    	$data = XData::model()->findAllByAttributes(array('category'=>$category, 'approved'=>'1'));
	    	//Удаляем все комментарии к удаляемым товарам
	    	foreach ($data as $element) Reviews::model()->deleteAllByAttributes(array('goods_id'=>$element->id));
	    	$count = count($data);
	    	//Удаляем все товары текущей категории
	    	XData::model()->deleteAllByAttributes(array('category'=>$category, 'approved'=>'1'));
	    	//Если функция вызвана для одного элемента, то выводим сообщение
	    	if($one) echo $count." товаров из категории ".$category." успешно удалены.";
	    	else return $count;

	    	//Добавить пересчет ретинга поставщика!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	    }
	    else echo "Нет значения!";
	}

	public function saveType($typeSave, $id, $type){//$post['typeSave'], $post['id'], $post['category'], $post['type']
		if($typeSave == 'subCategory'){//Если тип нужно применить к подкатегории
			if($id and $type){//Если идентификатор и тип передан
				$row = XData::model()->findByPk($id);//Ищем текущую запись
				$categories = XData::model()->findAllByAttributes(array('category'=>$row->category));//Ищем все товары выбранной категории
				foreach ($categories as $element) XData::model()->updateByPk($element->id, array('type_id'=>$type));//Обновляем записи
				echo count($categories)." записей в категории ".$row->category." успешно обновлено!";
			}
		}
		else if($typeSave == 'category'){//Если тип нужно применить к категории
			if($id and $type){//Если идентификатор и тип передан
				Categories::model()->updateByPk($id, array('type_id'=>$type));//Обновляем тип данных в главной категории
				$row = Categories::model()->findByPk($id);//Ищем текущую запись
				$categories = XData::model()->findAllByAttributes(array('category_id'=>$id));//Ищем все товары выбранной категории
				foreach ($categories as $element) XData::model()->updateByPk($element->id, array('type_id'=>$type));//Обновляем записи
				echo count($categories)." записей в категории ".$row->name." успешно обновлено!";
			}
		}
	}

	public function deleteCheckedCategories($ids){//Удаляем категории по id
	    if($ids){
	    	$ids = explode(',', $ids);
	    	foreach ($ids as $id){
	    		$countGen += AdminController::deleteCategory($id, false);
	    	}
	    	echo $countGen." товаров в ".count($ids)." категориях успешно удалены.";

	    	//Добавить пересчет ретинга поставщика!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	    }
	    else echo "Нет значения!";
	}

	public function deleteGoods($id, $one){//Удаляем товар по id
	    if($id){
	    	//Удаляем все комментарии к удаляемому товару
				Reviews::model()->deleteAllByAttributes(array('goods_id'=>$element->id));
	    	//Удаляем товар
	    	XData::model()->deleteByPk($id);
	    	//Если функция вызвана для одного элемента, то выводим сообщение
	    	if($one) echo "Товар id".$id." успешно удалены.";

	    	//Добавить пересчет ретинга поставщика!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	    }
	    else echo "Нет значения!";
	}

	public function deleteCheckedGoods($ids){//Удаляем товары по id
	    if($ids){
	    	$ids = explode(',', $ids);
	    	foreach ($ids as $id) AdminController::deletegoods($id, false);
	    	echo count($ids)." товаров успешно удалены.";

	    	//Добавить пересчет ретинга поставщика!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	    }
	    else echo "Нет значения!";
	}

	public function deleteUser($id, $one){//Удаляем пользователя по id
	    if($id){
	    	//Удаляем все отзывы данного пользователя, если это посетитель
				Reviews::model()->deleteAllByAttributes(array('user_id'=>$id));
				//Удаляем все товары, если это поставщик
				XData::model()->deleteAllByAttributes(array('id_provider'=>$id));
				//Удаляем самого пользователя
				Users::model()->deleteByPk($id);
	    	//Если функция вызвана для одного элемента, то выводим сообщение
	    	if($one) echo "Пользователь id".$id." успешно удален.";

	    	//Добавить пересчет ретинга поставщика!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	    }
	    else echo "Нет значения!";
	}

	public function deleteCheckedUsers($ids){//Удаляем пользователей по id
	    if($ids){
	    	$ids = explode(',', $ids);
	    	foreach ($ids as $id) AdminController::deleteUser($id, false);
	    	echo count($ids)." пользователей успешно удалены.";

	    	//Добавить пересчет ретинга поставщика!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	    }
	    else echo "Нет значения!";
	}

	public function disallowGoods($id, $one){//Удаляем заявку на добавление товара по id
	    if($id){
	    	XData::model()->deleteByPk($id, $one);
	    	//Если функция вызвана для одного элемента, то выводим сообщение
	    	if($one) echo "Заявка на добавление товара ".$id." удалена.";
	    }
	    else echo "Нет значения!";
	}

	public function disallowCheckedGoods($ids){//Удаляем заявки на добавление товаров по id
	    if($ids){
	    	$ids = explode(',', $ids);
	    	foreach ($ids as $id) AdminController::disallowGoods($id, false);
	    	echo count($ids)." заявок отклонено.";

	    	//Добавить пересчет ретинга поставщика!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	    }
	    else echo "Нет значения!";
	}

	public function approvedGoods($id, $one){//Одобряем заявку на добавление товара по id
	    if($id){
	    	XData::model()->updateByPk($id,array('approved'=>'1'));
	    	//Если функция вызвана для одного элемента, то выводим сообщение
	    	if($one) echo "Заявка на добавление товара ".$id." одобрена.";
	    }
	    else echo "Нет значения!";
	}

	public function approvedCheckedGoods($ids){//Одобряем заявки на добавление товаров по id
	    if($ids){
	    	$ids = explode(',', $ids);
	    	foreach ($ids as $id) AdminController::approvedGoods($id, false);
	    	echo count($ids)." заявок подтверждено.";

	    	//Добавить пересчет ретинга поставщика!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	    }
	    else echo "Нет значения!";
	}

	public function disallowUser($id, $one){//Удаляем заявку на добавление пользователя по id
	    if($id){
	    	Users::model()->deleteByPk($id);
	    	//Если функция вызвана для одного элемента, то выводим сообщение
	    	if($one) echo "Заявка на добавление пользователя ".$id." удалена.";
	    }
	    else echo "Нет значения!";
	}

	public function disallowCheckedUsers($ids){//Удаляем заявку на добавление пользователей по id
	    if($ids){
	    	$ids = explode(',', $ids);
	    	foreach ($ids as $id) AdminController::disallowUser($id, false);
	    	echo count($ids)." заявок на регистрацию отклонено.";

	    	//Добавить пересчет ретинга поставщика!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	    }
	    else echo "Нет значения!";
	}

	public function approvedUser($id, $one){//Одобряем заявку на добавление польльзователя по id
	    if($id){
	    	Users::model()->updateByPk($id,array('approved'=>'1'));
	    	//Если функция вызвана для одного элемента, то выводим сообщение
	    	if($one) echo "Заявка на добавление пользователя ".$id." одобрена.";
	    }
	    else echo "Нет значения!";
	}

	public function approvedCheckedUsers($ids){//Одобряем заявки на добавление товаров по id
	    if($ids){
	    	$ids = explode(',', $ids);
	    	foreach ($ids as $id) AdminController::approvedUser($id, false);
	    	echo count($ids)." заявок на регистрацию подтверждено.";

	    	//Добавить пересчет ретинга поставщика!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	    }
	    else echo "Нет значения!";
	}

	public function saveAbout($text){//Сохраняет текст о портале
		$pages = Pages::model()->findAll();
		if(count($pages) == 0){
			$model = new Pages;

			$model->text = $text;
			$model->save(false);

			echo "Данные успешно добавлены!";
		}
		else{
			Pages::model()->updateAll(array('text' => $text));
			echo "Данные успешно сохранены!";
		}
	}

	public function saveTypes($types){//Обновляем типы товаров
		$types = explode('///', $types);

		foreach ($types as $type){
			$type = explode('//', $type);
			Types::model()->updateByPk($type[0], array('name'=>$type[1],
																									'steel'=>$type[2],
																									'coating'=>$type[3],
																									'extender'=>$type[4],
																									'extender_thickness'=>$type[5],
																									'length'=>$type[6],
																									'capacity'=>$type[7],
																									'size'=>$type[8],
																									'goods'=>$type[9],
																									'company'=>$type[10],
																									'price'=>$type[11],
																									'bodyLength'=>$type[12]));
		}

		echo "Таблица типов обновлена!";
	}

	public function addType(){//Сохраняет текст о портале
		$model = new Types;

		$model->name = 'Новый тип товара!';
		$model->steel = '0';
		$model->coating = '0';
		$model->extender = '0';
		$model->extender_thickness = '0';
		$model->length = '0';
		$model->capacity = '0';
		$model->size = '0';
		$model->goods = '0';
		$model->company = '0';
		$model->price = '0';
		$model->bodyLength = '0';

		$model->save(false);

		echo "Добавлен новый тип товара!";
	}

	public function saveMenu($menu){//Пишем меню в БД, для ускорения загрузки сайта
		$advanced = Advanced::model()->findAll();
		if(count($advanced) != 0){//Если в БД есть запись
			foreach ($advanced as $a) $id = $a->id;//Запоминаем идентификатор
			Advanced::model()->updateByPk($id, array('menu'=>$menu));//Обновляем меню в БД
			echo "Меню на сервере обновлено!";
		}
		else{//Если БД пустая, создаем запись и пишем в нее меню
			$model = new Advanced;

			$model->menu = $menu;
			$model->save(false);
			echo "Меню на сервере создано!";
		}
	}

	public function saveMenuRequests($menuRequests){//Пишем меню заявок в БД, для ускорения загрузки сайта
		$advanced = Advanced::model()->findAll();
		if(count($advanced) != 0){//Если в БД есть запись
			foreach ($advanced as $a) $id = $a->id;//Запоминаем идентификатор
			Advanced::model()->updateByPk($id, array('menuRequests'=>$menuRequests));//Обновляем меню в БД
			echo "Меню заявок на сервере обновлено!";
		}
		else{//Если БД пустая, создаем запись и пишем в нее меню заявок
			$model = new Advanced;

			$model->menuRequests = $menuRequests;
			$model->save(false);
			echo "Меню заявок на сервере создано!";
		}
	}

	public function createFile($fileName){//Создаем меню и пишем в файл
		$file = 'components/'.$fileName.'.html';
		if(file_exists($file)){//Если файл уже есть
		    $fp = fopen($file,'a');
		    fclose($fp);
		} else{
		    $fp = fopen($file,'w');
		    fclose($fp);
		}
	}

	/////////////////////////////////////////////////////////// Обработка функций админки (END)



	/////////////////////////////////////////////////////////// Дополнительные функции (BEGIN)

	public function roundCountRows($data){//Расчитываем количество записей для навигационной панели
		$countRowsOnPage = AdminController::countRowsOnPage();
		$count = count($data)/$countRowsOnPage;//Получаем количество записей из БД
		$countRows = round($count, 0, PHP_ROUND_HALF_DOWN);//Округляем
		if($count == $countRows || $count < $countRows) return $countRows;//Если округлилось в большую сторону или число целое
			else return $countRows + 1;//Если округлилось в меньшую сторону
	}

	public function getDataOnName($nameData, $selectedPage){//Получаем данные из БД по названию таблицы

		$countRowsOnPage = AdminController::countRowsOnPage();

		switch ($nameData){
			case 'goodsApprovedAll': $data = XData::model()->findAll(array('condition'=>'approved=1'));
				break;
			case 'goodsApproved': $data = XData::model()->findAll(array('condition'=>'approved=1', 'limit'=>$countRowsOnPage, 'offset'=>$countRowsOnPage*($selectedPage-1)));
				break;

			case 'goodsApprovedFromSubCategoriesAll': $data = XData::model()->findAll(array('condition'=>'approved=1'));
				break;
			case 'goodsApprovedFromSubCategories': $data = AdminController::GetGoodsApprovedFromSubCategories($countRowsOnPage, $selectedPage);
				break;

			case 'goodsFromCategoriesAll': $data = Categories::model()->findAll();
				break;
			case 'goodsFromCategories': $data = AdminController::GetGoodsFromCategories($countRowsOnPage, $selectedPage);
				break;

			case 'typesAll': $data = Types::model()->findAll();
				break;
			case 'types': $data = Types::model()->findAll(array('limit'=>$countRowsOnPage, 'offset'=>$countRowsOnPage*($selectedPage-1)));
				break;
		}

		return $data;
	}

	public function getCountPages($nameData){//Получаем количество страниц для навигационной панели
		$data = AdminController::getDataOnName($nameData, 0);
		$countPages = AdminController::roundCountRows($data);
		return $countPages;
	}

	/////////////////////////////////////////////////////////// Дополнительные функции (END)



	/////////////////////////////////////////////////////////// Дополнительные Ajax-запросы (BEGIN)

	public function actionAdvAct(){//Обработчик запросов
		$post = json_decode(file_get_contents('php://input'), true);

		if(isset($post['action'])){
			switch ($post['action']){
				case 'getCountPages': echo AdminController::getCountPages($post['nameData']);
					break;

				default:
					echo "Ошибка, тип действия не определен!";
				break;
			}
		}
		else echo "Ошибка действие не указано!";
	}

	/////////////////////////////////////////////////////////// Дополнительные Ajax-запросы (END)



	/////////////////////////////////////////////////////////// Подготовка данных к выводу (BEGIN)

	public function GetGoodsApprovedFromSubCategories($countRowsOnPage, $selectedPage){//Подготовка подкатегорий
		$subCategories = XData::model()->findAll(array('condition'=>'approved=1', 'limit'=>$countRowsOnPage, 'offset'=>$countRowsOnPage*($selectedPage-1)));
		$types = Types::model()->findAll();

		foreach ($subCategories as $subCategory){
			$currentTypeId = $subCategory->type_id;//Запоминаем тип для выбранной категории
			$typeCode = '<select class="type">';
			foreach ($types as $type){//Формируем список типов
				if($currentTypeId == $type->id) $typeCode .= '<option selected value='.$type->id.'>'.$type->name.'</option>';
					else $typeCode .= '<option value='.$type->id.'>'.$type->name.'</option>';
			}
			$typeCode .= '</select>';
			$subCategory->ratingCode = $typeCode;//Используем поле формирования рейтинга товара для формирования списка типов
		}

		return $subCategories;
	}

	public function GetGoodsFromCategories($countRowsOnPage, $selectedPage){//Подготовка категорий
		$categories = Categories::model()->findAll(array('limit'=>$countRowsOnPage, 'offset'=>$countRowsOnPage*($selectedPage-1)));
		$types = Types::model()->findAll();

		foreach ($categories as $category){
			$currentTypeId = $category->type_id;//Запоминаем тип для выбранной категории
			$typeCode = '<select class="type">';
			foreach ($types as $type){//Формируем список типов
				if($currentTypeId == $type->id) $typeCode .= '<option selected value='.$type->id.'>'.$type->name.'</option>';
					else $typeCode .= '<option value='.$type->id.'>'.$type->name.'</option>';
			}
			$typeCode .= '</select>';
			$category->typeCode = $typeCode;
		}

		return $categories;
	}

	/////////////////////////////////////////////////////////// Подготовка данных к выводу (END)
}


//Код для проставления идентификаторов главной категории для подкатегорий
// $categories = Categories::model()->findAll();
// $subCategories = XData::model()->findAll();

// foreach ($subCategories as $subCategory){
// 	$strCat = substr($subCategory->category, 0, strpos($subCategory->category, '->'));
// 	foreach ($categories as $category){
// 		if($strCat == $category->name) XData::model()->updateByPk($subCategory->id, array('category_id'=>$category->id));
// 	}
// }




//Код для уникализации категорий из подкатегорий
// $subCategories = XData::model()->findAll();
// foreach ($subCategories as $subCategory)
// 	$subCategory->category = substr($subCategory->category, 0, strpos($subCategory->category, '->'));
// foreach ($subCategories as $subCategory){
// 	$model = new Categories;
// 	$model->name = $subCategory->category;
// 	$model->save(false);
// }
// $categories = Categories::model()->findAll();
// foreach($categories as $category){
// 	$currentId = $category->id;
// 	$currentName = Categories::model()->findByPk($currentId)->name;
// 	if($currentName != NULL){
// 		Categories::model()->updateByPk($currentId, array('name'=>'&&&&&'));
// 		Categories::model()->deleteAllByAttributes(array('name'=>$currentName));
// 		Categories::model()->updateByPk($currentId, array('name'=>$currentName));
// 	}
// }