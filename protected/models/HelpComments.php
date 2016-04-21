<?php

/**
 * This is the model class for table "help_comments".
 *
 * The followings are the available columns in table 'help_comments':
 * @property integer $id
 * @property integer $topic_id
 * @property integer $user_id
 * @property string $text
 * @property string $date
 * @property string $user_name
 * @property string $user_role
 */
class HelpComments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HelpComments the static model class
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
		return 'help_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('topic_id, user_id, text, date, user_name, user_role', 'required'),
			array('topic_id, user_id', 'numerical', 'integerOnly'=>true),
			array('user_name', 'length', 'max'=>150),
			array('user_role', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, topic_id, user_id, text, date, user_name, user_role', 'safe', 'on'=>'search'),
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
			'topic_id' => 'Topic',
			'user_id' => 'User',
			'text' => 'Text',
			'date' => 'Date',
			'user_name' => 'User Name',
			'user_role' => 'User Role',
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
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_role',$this->user_role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}