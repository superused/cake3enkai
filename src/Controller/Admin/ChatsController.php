<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class ChatsController extends AppController
{
	public function talk($id = null)
	{
		$user_id = $this->MyAuth->user("id");
		$this->loadModel("Users");
		
		$this->loadModel("EventUsers");
		$join = $this->EventUsers->findByEventIdAndUserId($id, $user_id)->count();
		
		$this->paginate = [
				'contain' => ['Users'],
				'conditions'=>array('event_id'=>$id),
				'order' => ['modified' => 'ASC'],
		];
		$chats = $this->paginate($this->Chats);
		
		if (!$join) {
			$this->Flash->error(__('イベントに参加していません'));
			return $this->redirect(['controller' => 'events', 'action' => 'view', $id]);
		}
		
		$this->set(compact('chats', 'user_id', 'id'));
	}
	
	public function add($id = null)
	{
		
		$user_id = $this->MyAuth->user("id");
		if ($this->request->is('post')) {
			$this->loadModel("EventUsers");
			$join = $this->EventUsers->findByEventIdAndUserId($id, $user_id)->count(); //イベントに参加しているか
			if (!$join) {
				$this->Flash->error(__('イベントに参加していません'));
				return $this->redirect(['controller' => 'homes', 'action' => 'index']);
			}
			
			$this->loadModel("Events");
			$event = $this->Events->findById($id)->count(); // イベントが存在するか
			if (!$event) {
				$this->Flash->error(__('投稿に失敗しました'));
				return $this->redirect(['controller' => 'homes', 'action' => 'index']);
			}
			
			$chat = $this->Chats->newEntity();
			$chat = $this->Chats->patchEntity($chat, $this->request->data);
			if ($this->Chats->save($chat)) {
				$this->Flash->success(__('投稿しました'));
			} else {
				$this->Flash->error(__('投稿に失敗しました'));
			}
		}
		return $this->redirect(['controller' => 'chats', 'action' => 'talk', $id]);
	}
}