<?php

/**
 * This is the model class for table "x_users".
 *
 * The followings are the available columns in table 'x_users':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $role
 * @property string $email
 * @property integer $approved
 * @property string $date
 * @property string $company
 * @property string $phone
 * @property string $name
 * @property integer $rating
 * @property string $spec1
 * @property string $spec2
 * @property string $spec3
 * @property string $spec4
 * @property string $spec5
 * @property string $about
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'x_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, password, role, email, approved, date, company, phone, name, rating, spec1, spec2, spec3, spec4, spec5, about', 'required'),
			array('approved, rating', 'numerical', 'integerOnly'=>true),
			array('login, password, email', 'length', 'max'=>30),
			array('role', 'length', 'max'=>10),
			array('company', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>20),
			array('name', 'length', 'max'=>100),
			array('spec1, spec2, spec3, spec4, spec5', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, login, password, role, email, approved, date, company, phone, name, rating, spec1, spec2, spec3, spec4, spec5, about', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'password' => 'Password',
			'role' => 'Role',
			'email' => 'Email',
			'approved' => 'Approved',
			'date' => 'Date',
			'company' => 'Company',
			'phone' => 'Phone',
			'name' => 'Name',
			'rating' => 'Rating',
			'spec1' => 'Spec1',
			'spec2' => 'Spec2',
			'spec3' => 'Spec3',
			'spec4' => 'Spec4',
			'spec5' => 'Spec5',
			'about' => 'About',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('approved',$this->approved);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('spec1',$this->spec1,true);
		$criteria->compare('spec2',$this->spec2,true);
		$criteria->compare('spec3',$this->spec3,true);
		$criteria->compare('spec4',$this->spec4,true);
		$criteria->compare('spec5',$this->spec5,true);
		$criteria->compare('about',$this->about,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}