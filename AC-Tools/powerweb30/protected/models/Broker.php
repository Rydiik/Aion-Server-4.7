<?php

class Broker extends CActiveRecord
{
	/*
	* ���������� ��� �������, ���� ����������� ����� ��������
	
	public $item_id;
	public $item_count;
	public $broker_race;
	public $expire_time;
	public $isSold;
	*/
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	/*
	* �������� �������
	*/
	public function tableName()
	{
		return Config::db('gs').'.broker';
	}
	
	
	/*
	* ������� ���������
	*/
	public function rules()
	{
		return array(
			array('id, itemPointer, item_id, item_count, seller, price, broker_race, expire_time, settleTime, sellerId, isSold, isSettled', 'safe', 'on'=>'search'),
		);
	}
	
	
	/*
	* ����� � ���������
	*/
	public function relations()
	{
		return array(
		);
	}
	
	
	/*
	* �������� ��������
	*/
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			Column::broker('itemPointer') => 'Item Pointer',
			Column::broker('item_id') => 'Item',
			Column::broker('item_count') => 'Item Count',
			'seller' => 'Seller',
			'price' => 'Price',
			Column::broker('broker_race') => 'Broker Race',
			Column::broker('expire_time') => 'Expire Time',
			Column::broker('settleTime') => 'Settle Time',
			Column::broker('sellerId') => 'Seller',
			Column::broker('isSold') => 'Is Sold',
			Column::broker('isSettled') => 'Is Settled',
		);
	}
	
	
	/*
	public function getTest()
	{
		return $this->broker_race;
	}
	*/
	
	
	/*
	* �����
	*/
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('itemPointer',$this->itemPointer);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('item_count',$this->item_count,true);
		$criteria->compare('seller',$this->seller,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('broker_race',$this->broker_race,true);
		$criteria->compare('expire_time',$this->expire_time,true);
		$criteria->compare('settleTime',$this->settleTime,true);
		$criteria->compare('sellerId',$this->sellerId);
		$criteria->compare('isSold',$this->isSold);
		$criteria->compare('isSettled',$this->isSettled);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}