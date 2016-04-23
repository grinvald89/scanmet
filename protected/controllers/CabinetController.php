<?php

class CabinetController extends Controller
{
	public $layout = 'site';

	public function actionIndex(){//Взависимости от роли направлям клиента в кабинет поставщика или посетителя
		if(Yii::app()->session['user_id']){
			$user = Users::model()->findByAttributes(array('login'=>Yii::app()->session['login']));
			if($user->role == 'provider') return $this->redirect('/cabinet/provider');
				else if($user->role == 'user') return $this->redirect('/cabinet/user');
							else return $this->redirect('/');
		}
		else return $this->redirect('/');
	}

	public function actionProvider(){
		CabinetController::check_authorization('provider');
		$this->render('provider');
	}

	public function actionUpload(){
		CabinetController::check_authorization('provider');

		$model_excell = new Files;

		//Сохраняем файл
		if(isset($_POST['Files'])){
			$model_excell->attributes=$_POST['Files'];
			$model_excell->file=CUploadedFile::getInstance($model_excell,'file_excell');
			//if($model_excell->save(false)){
				$path=Yii::getPathOfAlias('webroot').'/upload/file.xls';
				$model_excell->file->saveAs($path);
				return $this->redirect('/cabinet/viewFile');
			//}
		}

		$this->render('upload', array('model_excell'=>$model_excell));
	}

	public function actionSaveFromFile(){
		CabinetController::check_authorization('provider');

		$file_excell = Yii::app()->yexcel->readActiveSheet('upload/file.xls');

		echo "<table>";

		$currentRow = 1;
		foreach( $file_excell as $row ){

			$model = new XData;

			if($currentRow > 2){
				$model->id_provider = Yii::app()->session['user_id'];
				$model->category = $file_excell[$currentRow]['B'];
				$model->name = $file_excell[$currentRow]['C'];
				$model->steel = $file_excell[$currentRow]['D'];
				$model->length = $file_excell[$currentRow]['E'];
				$model->coating = $file_excell[$currentRow]['F'];
				$model->extender = $file_excell[$currentRow]['G'];
				$model->extender_thickness = $file_excell[$currentRow]['H'];
				$model->capacity = $file_excell[$currentRow]['I'];
				$model->bodyLength = $file_excell[$currentRow]['J'];
				$model->size = $file_excell[$currentRow]['K'];
				$model->price = $file_excell[$currentRow]['L'];
				$model->date = date("Y-m-d");

				if($model->category != '') $model->save(false);
			}
			$currentRow++;
		}

		return $this->redirect('/');
	}

	public function actionViewFile(){
		CabinetController::check_authorization('provider');

		$file_excell = Yii::app()->yexcel->readActiveSheet('upload/file.xls');

		$this->render('viewFile', array('file_excell'=>$file_excell));
	}

	public function actionRequests_provider(){
		CabinetController::check_authorization('provider');
		$data = ProvidersRequsts::model()->findAllByAttributes(array('id_provider' => Yii::app()->session['user_id']));

		//Так как id_provider нам в представлении не нужен запишем в него имя отправителя заявки
		foreach ($data as $row){
			$row->id_provider = Users::model()->findByPk($row->id_user)->company;
		}
		$this->render('requests_provider', array('data' => $data));
	}

	public function actionProfile_provider(){
		CabinetController::check_authorization('provider');

		$model_photo = new Files;

		//Сохраняем файл
		if(isset($_POST['Files'])){
			$model_photo->attributes=$_POST['Files'];
			$model_photo->file=CUploadedFile::getInstance($model_photo,'file_photo');
			//Взависимости от того какой загрузчик сработал добавляем префикс к сохраняемому файлу
			if(isset($_POST['upload_logo'])) $prefix = '';
			if(isset($_POST['upload_img1'])) $prefix = '_1';
			if(isset($_POST['upload_img2'])) $prefix = '_2';
			if(isset($_POST['upload_img3'])) $prefix = '_3';
			if(isset($_POST['upload_img4'])) $prefix = '_4';
			if(isset($_POST['upload_img5'])) $prefix = '_5';
			$path=Yii::getPathOfAlias('webroot').'/upload/photo/users/'.Yii::app()->session['user_id'].$prefix.'.jpg';
			$model_photo->file->saveAs($path);
			return $this->redirect('/cabinet/profile_provider');
		}

		$user = Users::model()->findByPk(Yii::app()->session['user_id']);

		$this->render('profile', array(	'user_id' => Yii::app()->session['user_id'],
																		'name' => $user->name,
																		'email' => $user->email,
																		'phone' => $user->phone,
																		'company' => $user->company,
																		'spec1' => $user->spec1,
																		'spec2' => $user->spec2,
																		'spec3' => $user->spec3,
																		'spec4' => $user->spec4,
																		'spec5' => $user->spec5,
																		'about' => $user->about,
																		'model_photo' => $model_photo));
	}

	public function actionProfile_user(){
		CabinetController::check_authorization('user');

		$user = Users::model()->findByPk(Yii::app()->session['user_id']);

		$name = $user->name;
		$email = $user->email;
		$phone = $user->phone;
		$company = $user->company;

		$this->render('profile', array('name' => $name, 'email' => $email, 'phone' => $phone, 'company' => $company));
	}

	public function actionUser(){
		CabinetController::check_authorization('user');
		$this->render('user');
	}

	public function actionRequests_user(){
		CabinetController::check_authorization('user');
		$data = Requsts::model()->findAllByAttributes(array('user_id' => Yii::app()->session['user_id']));

		//Так как id_provider нам в представлении не нужен запишем в него имя отправителя заявки
		// foreach ($data as $row){
		// 	$row->id_provider = Users::model()->findByPk($row->id_user)->name;
		// }
		$this->render('requests_user', array('data' => $data));
	}

	//Проверка авторизации
	public function check_authorization($role){//Проверка авторизации
		//Проверяем сессию
		if(Yii::app()->session['user_id']){

			//Получаем запись с текущим идентификатором
			$user = Users::model()->findByPk(Yii::app()->session['user_id']);

			//Проверка роли
			if($role == 'provider') { if($user->role != 'provider') return $this->redirect('/'); }//Если роль не соответствует запрашиваемому доступу перекидываем на главную
				else{
					if($role == 'user') { if($user->role != 'user') return $this->redirect('/'); }//Если роль не соответствует запрашиваемому доступу перекидываем на главную
						else return $this->redirect('/');
					}
		}
		else return $this->redirect('/');//Если сессии нет перекидываем на главную
	}
}