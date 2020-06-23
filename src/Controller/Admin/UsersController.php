<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class UsersController extends AppController
{
	
	public function logout()
	{
		$this->Flash->success("ログアウトしました");
		// ログアウト処理を行い、ログアウト後のURLへリダイレクトする
		return $this->redirect($this->MyAuth->logout());
	}
	
	public function index()
	{
		$users = $this->paginate($this->Users);
		$this->set(compact('users'));
	}
	
	public function edit()
	{
		// ログインユーザのIDをMyAuthから取り出す（セッション）
		$id = $this->MyAuth->user("id");
		$user = $this->Users->get($id, [
				'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->PatchEntity($user, $this->request->data);
			if ($this->Users->save($user)) {
				$this->MyAuth->setUser($user->toArray());
				$this->Flash->success(__('ユーザ情報を更新しました'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('ユーザ情報の更新に失敗しました'));
		}
		// パスワードは表示しない
		unset($user["password"]);
		$this->set(compact('user'));
	}
}