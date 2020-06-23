<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\Event;

class CategoriesController extends AppController
{
	public function index()
	{
		$this->paginate = [
				'limit' => 5,
				'order' => ['id' => 'ASC'],
		];
		$categories = $this->paginate($this->Categories);
		$this->set(compact('categories'));
	}
	
	public function add()
	{
		$category = $this->Categories->newEntity();
		if ($this->request->is('post')) {
			$category = $this->Categories->patchEntity($category, $this->request->data);
			if ($this->Categories->save($category)) {
				$this->Flash->success(__('カテゴリを新規登録しました'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('カテゴリの新規登録に失敗しました'));
		}
		$this->set(compact('category'));
	}
	
	public function edit($id = null)
	{
		$category = $this->Categories->get($id, [
				'contain' => []
		]);
		if ($this->request->is(['patch','post','put'])) {
			
			$category = $this->Categories->patchEntity($category, $this->request->data);
			if ($this->Categories->save($category)) {
				$this->Flash->success(__('カテゴリを編集しました'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('カテゴリの編集に失敗しました'));
		}
		$this->set(compact('category'));
	}
	
	public function delete($id = null)
	{
		$this->loadModel("Events");
		$category = $this->Categories->get($id);
		$event = $this->Events->findByCategoryId($id)->count();

		if ($event == 0){
			if ($this->Categories->delete($category)) {
				$this->Flash->success(__('カテゴリを削除しました'));
			} else {
				$this->Flash->error(__('カテゴリの削除に失敗しました'));
			}
		} else {
			$this->Flash->error(__('このカテゴリは削除できません'));
		}
		return $this->redirect(['action' => 'index']);
	}
	
}