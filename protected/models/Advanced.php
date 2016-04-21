<?php

/**
 * This is the model class for table "advanced".
 *
 * The followings are the available columns in table 'advanced':
 * @property integer $id
 * @property string $menu
 * @property string $menuRequests
 * @property string $popularGoods
 * @property string $popularUsers
 */
class Advanced extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Advanced the static model class
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
		return 'advanced';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu, menuRequests, popularGoods, popularUsers', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menu, menuRequests, popularGoods, popularUsers', 'safe', 'on'=>'search'),
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
			'menu' => 'Menu',
			'menuRequests' => 'Menu Requests',
			'popularGoods' => 'Popular Goods',
			'popularUsers' => 'Popular Users',
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
		$criteria->compare('menu',$this->menu,true);
		$criteria->compare('menuRequests',$this->menuRequests,true);
		$criteria->compare('popularGoods',$this->popularGoods,true);
		$criteria->compare('popularUsers',$this->popularUsers,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}