<?php

/**
 * This is the model class for table "x_data".
 *
 * The followings are the available columns in table 'x_data':
 * @property integer $id
 * @property string $category
 * @property string $name
 * @property integer $rating
 * @property string $company
 * @property integer $price
 * @property string $coating
 * @property string $extender
 * @property double $extender_thickness
 * @property string $steel
 * @property integer $approved
 * @property double $length
 * @property string $date
 * @property integer $id_provider
 * @property integer $type_id
 * @property integer $capacity
 * @property string $size
 * @property double $bodyLength
 * @property string $ratingCode
 * @property integer $category_id
 */
class XData extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return XData the static model class
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
		return 'x_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category, name, rating, company, price, coating, extender, extender_thickness, steel, approved, length, date, id_provider, type_id, capacity, size, bodyLength, ratingCode, category_id', 'required'),
			array('rating, price, approved, id_provider, type_id, capacity, category_id', 'numerical', 'integerOnly'=>true),
			array('extender_thickness, length, bodyLength', 'numerical'),
			array('category', 'length', 'max'=>500),
			array('name', 'length', 'max'=>255),
			array('company, coating, extender, steel', 'length', 'max'=>50),
			array('size', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category, name, rating, company, price, coating, extender, extender_thickness, steel, approved, length, date, id_provider, type_id, capacity, size, bodyLength, ratingCode, category_id', 'safe', 'on'=>'search'),
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
			'category' => 'Category',
			'name' => 'Name',
			'rating' => 'Rating',
			'company' => 'Company',
			'price' => 'Price',
			'coating' => 'Coating',
			'extender' => 'Extender',
			'extender_thickness' => 'Extender Thickness',
			'steel' => 'Steel',
			'approved' => 'Approved',
			'length' => 'Length',
			'date' => 'Date',
			'id_provider' => 'Id Provider',
			'type_id' => 'Type',
			'capacity' => 'Capacity',
			'size' => 'Size',
			'bodyLength' => 'Body Length',
			'ratingCode' => 'Rating Code',
			'category_id' => 'Category',
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
		$criteria->compare('category',$this->category,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('coating',$this->coating,true);
		$criteria->compare('extender',$this->extender,true);
		$criteria->compare('extender_thickness',$this->extender_thickness);
		$criteria->compare('steel',$this->steel,true);
		$criteria->compare('approved',$this->approved);
		$criteria->compare('length',$this->length);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('id_provider',$this->id_provider);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('capacity',$this->capacity);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('bodyLength',$this->bodyLength);
		$criteria->compare('ratingCode',$this->ratingCode,true);
		$criteria->compare('category_id',$this->category_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}