<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\Event;

class EventsController extends AppController
{
	public function mylist()
	{
		$user_id = $this->MyAuth->user("id");
		$this->paginate = [
				'contain' => ['EventUsers','Categories','Users'],
				'limit' => 5,
				'order' => ['id' => 'ASC'],
				'conditions'=>array('user_id'=>$user_id),
		];
		$events = $this->paginate($this->Events);

		$this->set(compact('events'));
	}
	
	public function view($id = null)
	{
		$user_id = $this->MyAuth->user("id");
		$this->loadModel("EventUsers");
		$event = $this->Events->get($id, [
				'contain' => ['EventUsers','Categories','Users']
		]);
		
		$this->paginate = [
				'contain' => ['Events','Users'],
				'conditions'=>array('event_id'=>$id),
				'order' => ['id' => 'ASC'],
		];
		$eventusers = $this->paginate($this->EventUsers);
		
		$join = $this->EventUsers->findByEventIdAndUserId($id, $user_id)->count();
		
		$this->set(compact('event', 'eventusers', 'join'));
	}
	
	public function add()
	{
		$user_id = $this->MyAuth->user("id");
		$event = $this->Events->newEntity();
		if ($this->request->is('post')) {

			$event = $this->Events->patchEntity($event, $this->request->data);
			if ($this->Events->save($event)) {
				$this->Flash->success(__('イベントを新規登録しました'));
				return $this->redirect(['action' => 'mylist']);
			}
			$this->Flash->error(__('イベントの新規登録に失敗しました'));
		}
		$categories = $this->Events->categories->find('list');
		$users = $this->Events->users->find('list');
		$event["user_id"] = $user_id;
		$this->set(compact('event', 'categories', 'users'));
	}
	
	public function edit($id = null)
	{
		$event = $this->Events->get($id, [
				'contain' => []
		]);
		if ($this->request->is(['patch','post','put'])) {
				
			$event = $this->Events->patchEntity($event, $this->request->data);
			if ($this->Events->save($event)) {
				$this->Flash->success(__('イベントを編集しました'));
				return $this->redirect(['action' => 'mylist']);
			}
			$this->Flash->error(__('イベントの編集に失敗しました'));
		}
		$categories = $this->Events->categories->find('list');
		$users = $this->Events->users->find('list');
		$this->set(compact('event', 'categories', 'users'));
	}
	
	public function delete($id = null)
	{
		$this->loadModel("EventUsers");
		$event = $this->Events->get($id);
		$eventuser = $this->EventUsers->findByEventId($id)->count();
		$user_id = $this->MyAuth->user("id");

		if ($event["user_id"] != $user_id) {
			$this->Flash->error(__('管理しているイベントのみが削除可能です'));
			return $this->redirect(['action' => 'mylist']);
	    }
		if ($eventuser == 0){
			if ($this->Events->delete($event)) {
				$this->Flash->success(__('イベントを削除しました'));
			} else {
				$this->Flash->error(__('イベントの削除に失敗しました'));
			}
		} else {
			$this->Flash->error(__('参加者のいるイベントは削除できません'));
		}
		return $this->redirect(['action' => 'mylist']);
	}
}