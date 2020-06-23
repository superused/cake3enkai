<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\Event;

class EventUsersController extends AppController
{	
	public function add($id = null)
	{
		$user_id = $this->MyAuth->user("id");
		$join = $this->EventUsers->findByEventIdAndUserId($id, $user_id)->count(); // イベントに既に参加してるか
		$max = $this->EventUsers->findByEventId($id)->count(); // イベントに何人参加しているか
		$this->loadModel("Events");
		$event = $this->Events->findById($id)->toArray(); // イベントの最大参加者数を知るためにeventtableを取得
		$eventuser = $this->EventUsers->newEntity();
		
		if ($join) {
			$this->Flash->error(__('イベントに参加済みです'));
			return $this->redirect(['controller' => 'homes', 'action' => 'index']);
		}
		
		if ($max >= $event[0]["max_participant"]) {
			$this->Flash->error(__('最大参加者数に到達しています'));
			return $this->redirect(['controller' => 'homes', 'action' => 'index']);
		}
		
		$data["event_id"] = $id;
		$data["user_id"] = $user_id;
		$eventuser = $this->EventUsers->patchEntity($eventuser, $data);
		
		if ($this->EventUsers->save($eventuser)) {
			$this->Flash->success(__('イベントに参加しました'));
		} else {
			$this->Flash->error(__('イベントの参加に失敗しました'));
		}
		
		return $this->redirect(['controller' => 'events', 'action' => 'view', $id]);
	}
	
	public function delete($id = null)
	{
		$user_id = $this->MyAuth->user("id");
		$data = $this->EventUsers->findByEventIdAndUserId($id, $user_id);
		$count = $data->count();
		$data = $data->toArray();
		
		if (!$count) {
			$this->Flash->error(__('イベントに参加していません'));
			return $this->redirect(['controller' => 'events', 'action' => 'view', $id]);
		}
		$eventuser = $this->EventUsers->get($data[0]["id"]);

		if ($this->EventUsers->delete($eventuser)) {
			$this->Flash->success(__('イベントから辞退しました'));
		} else {
			$this->Flash->error(__('イベントからの辞退に失敗しました'));
		}
		
		return $this->redirect(['controller' => 'events', 'action' => 'view', $id]);
	}
}