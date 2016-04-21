<?php

/**
 * This is the model class for table "x_types".
 *
 * The followings are the available columns in table 'x_types':
 * @property integer $id
 * @property string $name
 * @property integer $coating
 * @property integer $extender
 * @property integer $length
 * @property integer $capacity
 * @property integer $size
 * @property integer $goods
 * @property integer $company
 * @property integer $price
 * @property integer $bodyLength
 * @property integer $steel
 * @property integer $extender_thickness
 */
class Types extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Types the static model class
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
		return 'x_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, coating, extender, length, capacity, size, goods, company, price, bodyLength, steel, extender_thickness', 'required'),
			array('coating, extender, length, capacity, size, goods, company, price, bodyLength, steel, extender_thickness', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, coating, extender, length, capacity, size, goods, company, price, bodyLength, steel, extender_thickness', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'coating' => 'Coating',
			'extender' => 'Extender',
			'length' => 'Length',
			'capacity' => 'Capacity',
			'size' => 'Size',
			'goods' => 'Goods',
			'company' => 'Company',
			'price' => 'Price',
			'bodyLength' => 'Body Length',
			'steel' => 'Steel',
			'extender_thickness' => 'Extender Thickness',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('coating',$this->coating);
		$criteria->compare('extender',$this->extender);
		$criteria->compare('length',$this->length);
		$criteria->compare('capacity',$this->capacity);
		$criteria->compare('size',$this->size);
		$criteria->compare('goods',$this->goods);
		$criteria->compare('company',$this->company);
		$criteria->compare('price',$this->price);
		$criteria->compare('bodyLength',$this->bodyLength);
		$criteria->compare('steel',$this->steel);
		$criteria->compare('extender_thickness',$this->extender_thickness);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}