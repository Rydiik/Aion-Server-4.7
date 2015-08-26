<?php


class MailController extends Controller
{
	public $layout='//content';
	
	
	public function actionIndex()
	{
		if (Yii::app()->user->isGuest OR Yii::app()->user->access_level < Config::get('access_level_admin')) {
			$this->redirect(Yii::app()->homeUrl);
		}
		
		$this->pageTitle = Yii::t('title', 'Send mail');
		
		$model = new Mail;
		
		if(isset($_POST['Mail']))
		{
			$model->attributes = $_POST['Mail'];
			
			$player_id = Players::model()->find('name = "'.$model->player_name.'"');
			
			if ($player_id->online == 1) {
				Yii::app()->user->setFlash('message', '<div class="flash_error">'.Yii::t('webshop', 'Error - You must first log out of the game server.').'</div>');
			}
			
			$criteria=new CDbCriteria;
			$criteria->select = 'MAX(mail_unique_id) as mail_unique_id';
			$last_mail_id = Mail::model()->find($criteria);
			$model->mail_unique_id = $last_mail_id->mail_unique_id + 1;
			$model->mail_recipient_id = $player_id->id;
			$model->sender_name = 'Admin';
			$model->mail_title = $model->mail_title;
			$model->mail_message = $model->mail_message;
			$model->unread = 1;
			// Fallenfate - This item ID is for gold.  To send gold, use it, and the quantity you select is the amount of gold to send.
			if ($model->item_id == 182400001) {
				$model->attached_item_id = 0;
				$model->attached_kinah_count = $model->item_count;
			}
			elseif ($model->attached_item_id != NULL AND $model->item_count != NULL) {
				$model->attached_item_id = 0;
				$model->attached_kinah_count = 0;
			}
			else {
				$model->attached_item_id = $this->add_item($model->item_id, $player_id->id, $model->item_count);
				$model->attached_kinah_count = 0;
			}
			$model->express = 1;
			
			if ($model->save(false))
			{
				Yii::app()->user->setFlash('message', '<div class="flash_success">'.Yii::t('main', 'Mail sent!').'</div>');
				$this->refresh();
			}
		}
		
		$this->render('/admin/mail', array(
			'model' => $model
		));
	}
	
	
	public function add_item($item_id, $item_owner, $amount)
	{
		$criteria=new CDbCriteria;
		$criteria->select = 'MAX(item_unique_id) as item_unique_id';
		$last_item_id = Inventory::model()->find($criteria);
		
		$form = new Inventory();
		$form->scenario = 'buy';
		$form->item_id = $item_id;
		$form->item_owner = $item_owner;
		$form->item_creator = '';
		$form->item_count = $amount;
		$form->item_unique_id = $last_item_id->item_unique_id + 1;
		$form->item_location = 127;
		$form->item_skin = $item_id;
		$form->save(false);
		
		return $form->item_unique_id;
	}
}